<?php
namespace Libs\Service;

/* 短信模块主类 */
class Sms extends \Libs\System\Service{

    protected static $sms = NULL;
    
    /**
     * 连接短信系统
     * @param type $name 服务名
     * @param type $options 参数
     * @return \Libs\Service\class
     */
    public static function connect($name = '', $options = array()) {
        if (empty($options['type'])) {
            //驱动类型
            $type = 'Alidayu';
        } else {
            $type = $options['type'];
        }
        //附件存储方案
        $class = strpos($type, '\\') ? $type : 'Libs\\Driver\\Sms\\' . ucwords(strtolower($type));
        if (class_exists($class)) {
            self::$sms = new $class($options);
        } else {
            E("短信驱动 {$class} 不存在！");
        }
        return self::$sms;
    }

    // 发送短消息
    public function send_verify($phones, $verifycode, $SMS_ID) {
        return self::$sms->send_verify($phones, $verifycode, $SMS_ID);
    }
    // 发送短消息
    public function send($phones, $SMS_ID, $sms_param) {
        return self::$sms->send($phones, $SMS_ID, $sms_param);
    }
    
    public function get_errors () {
        return self::$sms->error_msg;
    }
}