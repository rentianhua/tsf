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



class CalculateController extends Base {
  //税费计算器
  public function shuifei(){
  	$this->display();
  }
	
	//税费计算器_app封装页面
  public function shuifei_m(){
  	$this->display();
  }
	
	//房贷计算器
  public function fangdai(){
  	$this->display();
  }
}