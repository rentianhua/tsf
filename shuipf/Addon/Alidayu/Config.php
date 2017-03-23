<?php

/**
 * 插件配置，下面是示例
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */
return array(
    'app_key' => array(//配置在表单中的键名 ,这个会是config[title]
        'title' => 'App Key:', //表单的文字
        'type' => 'text', //表单的类型：text、textarea、checkbox、radio、select等
        'value' => '', //表单的默认值
        'style' => "width:200px;", //表单样式
    ),
    'app_secret' => array(//配置在表单中的键名 ,这个会是config[title]
        'title' => 'App Secret:', //表单的文字
        'type' => 'text', //表单的类型：text、textarea、checkbox、radio、select等
        'value' => '', //表单的默认值
        'style' => "width:200px;", //表单样式
    ),
    'template_code' => array(//配置在表单中的键名 ,这个会是config[title]
        'title' => '短信模板ID:', //表单的文字
        'type' => 'text', //表单的类型：text、textarea、checkbox、radio、select等
        'value' => '', //表单的默认值
        'style' => "width:200px;", //表单样式
    ),
    'sms_param' => array(
        'title' => '模板内容变量:',
        'type' => 'textarea',
        'value' => '',
        'style' => "width:400px;",
        'tips' => "变量设置格式，变量名称:变量内容；如：var:value<br>可设置多个变量，一行一个<br>变量名称只能是字母，数字"
    ),
    'free_sign' => array(//配置在表单中的键名 ,这个会是config[title]
        'title' => '短信签名:', //表单的文字
        'type' => 'text', //表单的类型：text、textarea、checkbox、radio、select等
        'value' => '', //表单的默认值
        'style' => "width:200px;", //表单样式
    ),
);
