<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 计划任务卸载脚本
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Cron\Uninstall;

use Libs\System\UninstallBase;

class Uninstall extends UninstallBase {

    //End
    public function end() {
        //移除Cron目录
        ShuipFCMS()->Dir->delDir(PROJECT_PATH . 'Cron/');
        return true;
    }

}
