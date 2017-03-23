<?php



// +----------------------------------------------------------------------

// | ShuipFCMS URL规则管理

// +----------------------------------------------------------------------

// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.

// +----------------------------------------------------------------------

// | Author: 水平凡 <admin@abc3210.com>

// +----------------------------------------------------------------------



namespace Content\Controller;



use Common\Controller\Base;

use Content\Model\ContentModel;



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
	public function test(){
		$this->display();	
	}
}