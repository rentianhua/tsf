<?php
/**
 * 阿里大鱼 插件
 * Some rights reserved：abc3210.com
 * Contact email:admin@abc3210.com
 */

namespace Addon\Alidayu;

use \Addons\Util\Addon;

class AlidayuAddon extends Addon {

    //插件信息
    public $info = array(
        'name' => 'Alidayu',
        'title' => '阿里大鱼',
        'description' => '阿里大鱼短信',
        'status' => 1,
        'author' => '凡人',
        'version' => '0.1',
        'has_adminlist' => 1,
        'sign' => 'fe3ee923178f4a93b8f3880fdde14b19',
    );

    //有开启插件后台情况下，添加对应的控制器方法
    //也就是插件目录下 Action/AdminController.class.php中，public属性的方法！
    //每个方法都是一个数组形式，删除，修改类需要具体参数的，建议隐藏！
    public $adminlist = array(
        array(
            //方法名称
            "action" => "",
            //附加参数 例如：a=12&id=777
            "data" => "",
            //类型，1：权限认证+菜单，0：只作为菜单
            "type" => 0,
            //状态，1是显示，0是不显示
            "status" => 1,
            //名称
            "name" => "",
            //备注
            "remark" => "",
            //排序
            "listorder" => 0,
        ),
    );

    //安装
    public function install() {
        return true;
    }

    //卸载
    public function uninstall() {
        return true;
    }

}
