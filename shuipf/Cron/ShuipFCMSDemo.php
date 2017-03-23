<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 计划任务 - 示例脚本
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace CronScript;

class ShuipFCMSDemo {

    //任务主体
    public function run($cronId) {
        \Think\Log::record("我执行了计划任务事例 ShuipFCMSDemo.php！");
    }

}
