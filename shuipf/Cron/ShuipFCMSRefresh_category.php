<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 计划任务 - 刷新静态栏目页
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace CronScript;

//指定内容模块生成，没有指定默认使用GROUP_NAME
defined('GROUP_MODULE') or define('GROUP_MODULE', 'Content');

class ShuipFCMSRefresh_category {

    //任务主体
    public function run($cronId) {
        $r = M('Cron')->where(array('cron_id' => $cronId))->find();
        if ($r) {
            $catid = explode(",", $r['data']);
            if (is_array($catid)) {
                foreach ($catid as $cid) {
                    ShuipFCMS()->Html->category($cid);
                }
            }
        }
    }

}
