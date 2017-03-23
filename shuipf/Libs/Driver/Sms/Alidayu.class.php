<?php
namespace Libs\Driver\Sms;
use Libs\Service\Sms;
require_once(dirname(__FILE__) . '/alidayu/TopSdk.php');
/**
 * 阿里大鱼短信配置项
 * 使用方法
 * $sms = service("Sms", array('key' => 'xx', 'secret' => 'xx', 'sign' => '登录验证', 'sms_param' => array('product' => '凡人测试')));
 * 发送验证码短信
 * $res = $sms->send_verify($mobile, $code, $sms_id);
 * 发送短信
 * $res = $sms->send($phones, $SMS_ID, $sms_param);
 */
class Alidayu extends Sms{

    /**
     * 存放TopClient对象
     *
     * @access  private
     * @var     object      $tc
     */
    private $tc = null;
    
    /**
     * 存放AlibabaAliqinFcSmsNumSendRequest对象
     *
     * @access  private
     * @var     object      $tc
     */
    private $req = null;
    private $config = null;
    
    private $sms_param = array();
    /**
     *
     * @access  public
     * @var     array       $errors
     */
    public $error_msg = '';
    
    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    public function __construct($config) {
        $this->sms($config);
    }

    /**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
    function sms($config) {
        if (empty($config['key'])) {
            E("缺少参数key");
        }
        if (empty($config['secret'])) {
            E("缺少参数secret");
        }
        if (empty($config['sign'])) {
            E("缺少参数sign");
        }
        if (is_array($config['sms_param']) && !empty($config['sms_param'])) {
            $this->sms_param = $config['sms_param'];
        }elseif(is_string($config['sms_param']) && !empty($config['sms_param'])) {
            $this->sms_param = $this->format_param($config['sms_param']);
        }
        $this->config = $config;
        
        /* 此处最好不要从$GLOBALS数组里引用，防止出错 */
        $this->tc = new \TopClient;
        $this->tc->appkey = $this->config['key'];
        $this->tc->secretKey = $this->config['secret'];
        $this->req = new \AlibabaAliqinFcSmsNumSendRequest;
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
     * 发送验证码
     * @param type $phones
     * @param type $verifycode
     * @param type $SMS_ID
     * @return boolean
     */
    public function send_verify($phones, $verifycode, $SMS_ID) {
        if (empty($verifycode)) {
            $this->error_msg = "验证码不能为空";
            return false;
        }
        $sms_param['code'] = $verifycode;
        return $this->send($phones, $SMS_ID, $sms_param);
    }
    
    /* 发送通知
     *
     * @access  public
     * @param   string  $phone          要发送到哪些个手机号码，传的值是一个数组
     * @param   string  $msg            发送的消息内容
     */

    function send($phones, $SMS_ID, array $sms_param) {
        $sms_param = array_merge($this->sms_param, $sms_param);
	
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
                $this->req->setSmsFreeSignName($this->config['sign']);
                $this->req->setSmsParam(json_encode($sms_param));
                $this->req->setRecNum($rec_num);
                $this->req->setSmsTemplateCode($SMS_ID);
                $resp = $this->tc->execute($this->req);
                $result = $this->simplexml_obj2array($resp);
                sleep(1);
            }
        }else{
            $rec_num = implode(",", $phones[0]);
            // $this->req->setExtend("123456");
            $this->req->setSmsType("normal");
            $this->req->setSmsFreeSignName($this->config['sign']);
	
            $this->req->setSmsParam(json_encode($sms_param));
			
            $this->req->setRecNum($rec_num);
            $this->req->setSmsTemplateCode($SMS_ID);
            $resp = $this->tc->execute($this->req);
            $result = $this->simplexml_obj2array($resp);
        }
        if (isset($result['result']) && $result['result']['success'] == 'true') {
            return true;
        }else{
            $this->error_msg = '短信接口错误：' . $result['sub_msg'];//手机号码有误
            return false;
        }
    }

    public function get_phones($phones) {
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
     *
     */
    function is_moblie($moblie) {
        return !!preg_match('/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/', $moblie);
    }

    // XML转换成数组
    public function simplexml_obj2array($obj) {
        if (is_object($obj)) {
            $result = array();
            foreach ((array)$obj as $key => $item) {
                $result[$key] = $this->simplexml_obj2array($item);
            }
            return $result;
        }
        return $obj;
    }
}
