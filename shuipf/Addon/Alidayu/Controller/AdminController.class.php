<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 插件后台管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Addon\Alidayu\Controller;

use Addons\Util\Adminaddonbase;

class AdminController extends Adminaddonbase {

    private $sms_param = null;
    public $error_msg;

    public function _initialize() {
        parent::_initialize();
        include $this->addonPath . "/alidayu/TopSdk.php";

        $this->config = $this->getAddonConfig();
        $this->tc = new \TopClient;
        $this->tc->appkey = $this->config['app_key'];
        $this->tc->secretKey = $this->config['app_secret'];
        $this->req = new \AlibabaAliqinFcSmsNumSendRequest;
    }

    public function index() {
        $this->display();
    }

    public function test() {
        $mobile = I("mobile", "", "trim");
        $sms_id = I("sms_id", "", "trim");
        $sms_param = I("sms_param", array(), "trim");
        if (!$this->is_moblie($mobile)) {
            $this->error("手机格式不正确！");
        }
        if (!empty($sms_param)) {
            $sms_param = $this->format_param($sms_param);
        }
        if (empty($sms_id)) {
            $sms_id = $this->config['template_code'];
            $verifycode = $this->random(6, true);
            $res = $this->send_verify($mobile, $verifycode, $sms_id);
        } else {
            $res = $this->send($mobile, $sms_id, $sms_param);
        }
        if (!$res) {
            $this->error($this->error_msg);
        } else {
            $this->success("发送成功！");
        }
    }

    /**
     * 生成指定长度的随机字符串
     * @param int $length
     * @param bool $numeric
     * @author 凡人 <fanren3150@qq.com>
     * @return string
     */
    private function random($length, $numeric = FALSE) {
        $seed = base_convert(md5(microtime() . $_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed) . '012340567890') : ($seed . 'zZ' . strtoupper($seed));
        if ($numeric) {
            $hash = '';
        } else {
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $seed{mt_rand(0, $max)};
        }
        return $hash;
    }

    /**
     * 发送验证码短信
     * @param string|array $phones  手机号码，多个号码以数组形式
     * @param string $verifycode 验证码
     * @param string $SMS_ID 短信模板ID
     * @return boolean
     */
    private function send_verify($phones, $verifycode, $SMS_ID) {
        if (empty($verifycode)) {
            $this->error_msg = "验证码不能为空";
            return false;
        }
        $sms_param['code'] = $verifycode;
        return $this->send($phones, $SMS_ID, $sms_param);
    }

    /**
     * 发送短信
     * @param string|array $phones 手机号码，多个号码以数组形式
     * @param string $SMS_ID 短信模板ID
     * @param array $sms_param 短信内容数组，键值对
     * @return boolean
     */
    private function send($phones, $SMS_ID, array $sms_param) {
        $sms_set_param = $this->get_param();
        $sms_param = array_merge($sms_set_param, $sms_param);
        $phones = $this->get_phones($phones);
        if (empty($phones)) {
            $this->error_msg = "手机号码有误";
            return false;
        }
        if (empty($SMS_ID)) {
            $this->error_msg = "短信模板ID有误";
            return false;
        }
        if (count($phones) > 1) {
            foreach ($phones as $rec_nums) {
                $rec_num = implode(",", $rec_nums);
                // $this->req->setExtend("123456");
                $this->req->setSmsType("normal");
                $this->req->setSmsFreeSignName($this->config['free_sign']);
                $this->req->setSmsParam(json_encode($sms_param));
                $this->req->setRecNum($rec_num);
                $this->req->setSmsTemplateCode($SMS_ID);
                $resp = $this->tc->execute($this->req);
                $result = $this->simplexml_obj2array($resp);
                sleep(1);
            }
        } else {
            $rec_num = implode(",", $phones[0]);
            // $this->req->setExtend("123456");
            $this->req->setSmsType("normal");
            $this->req->setSmsFreeSignName($this->config['free_sign']);
            $this->req->setSmsParam(json_encode($sms_param));
            $this->req->setRecNum($rec_num);
            $this->req->setSmsTemplateCode($SMS_ID);
            $resp = $this->tc->execute($this->req);
            $result = $this->simplexml_obj2array($resp);
        }
        if (isset($result['result']) && $result['result']['success'] == 'true') {
            return true;
        } else {
            $this->error_msg = '短信接口错误：' . $result['sub_msg'] . $result['msg']; //手机号码有误
            return false;
        }
    }

    /**
     * 获取自定义变量：参数
     * @return array
     */
    private function get_param() {
        if (!empty($this->sms_param)) {
            return $this->sms_param;
        }
        $this->sms_param = $this->format_param($this->config['sms_param']);
        return $this->sms_param;
    }

    private function format_param($sms_param) {
        $tmp_sms_param = explode("\n", $sms_param);
        $sms_param = array();
        foreach ($tmp_sms_param as $param) {
            $tmp_param = explode(":", $param);
            if (count($tmp_param) == 2 && $this->validNumberLetter($tmp_param[0])) {
                $sms_param[trim($tmp_param[0])] = trim($tmp_param[1]);
            }
        }
        return $sms_param;
    }

    /**
     * 验证数字与字母
     * @param string $val
     * @author 凡人 <fanren3150@qq.com>
     * @return boolean
     */
    function validNumberLetter($val) {
        return $this->validRegexp('/^[A-Za-z0-9]+$/', $val);
    }

    /**
     * 根据正则验证文本
     * @param string $val
     * @author 凡人 <fanren3150@qq.com>
     * @return boolean
     */
    function validRegexp($regexp, $val) {
        return !!preg_match($regexp, $val);
    }

    /**
     * 获取正确的手机号码
     * @param string|array $phones
     * @return array
     */
    private function get_phones($phones) {
        if (empty($phones)) {
            return false;
        }
        if (!is_array($phones)) {
            $phones = explode(",", $phones);
        }
        $phones = array_unique($phones);
        $phone_key = 0;
        $i = 0;
        $phone = array();
        foreach ($phones as $key => $value) {
            if ($i < 200) {
                $i++;
            } else {
                $i = 0;
                $phone_key++;
            }
            if ($this->is_moblie($value)) {
                $phone[$phone_key][] = $value;
            } else {
                $i--;
            }
        }
        return $phone;
    }

    /**
     * 检测手机号码是否正确
     */
    private function is_moblie($moblie) {
        return !!preg_match('/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/', $moblie);
    }

    // XML转换成数组
    private function simplexml_obj2array($obj) {
        if (is_object($obj)) {
            $result = array();
            foreach ((array) $obj as $key => $item) {
                $result[$key] = $this->simplexml_obj2array($item);
            }
            return $result;
        }
        return $obj;
    }

}
