<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 3G手机版
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.cn, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 随风 <admin@shuipfcms.cn>
// +----------------------------------------------------------------------

namespace Wap\Controller;

use Common\Controller\Base;



class OtherController extends Base {

  //图表
  public function chart() {
	$this -> display();  
	}
	
	//首页搜索
  public function search() {
	$this -> display();  
	}
}