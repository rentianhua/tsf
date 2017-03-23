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



class JingjirenController extends Base {

  //获取经纪人列表
  public function list_jjr() {
	  /*var_dump($_GET);
	  exit;*/
	if($_GET['ct']){
		$sql .= "mainarea like '%".$_GET['ct']."%'"; 
	}
	if($_GET['bq']){
		if($sql){
			$sql .= " and biaoqian like '%".$_GET['bq']."%'"; 
		}else{
			$sql .= "biaoqian like '%".$_GET['bq']."%'"; 
		}		
	}
	if($_GET['kw']){
		if($sql){
			$sql .= " and realname like '%".$_GET['kw']."%'"; 
		}else{
			$sql .= "realname like '%".$_GET['kw']."%'"; 
		}		
	}
    $db = M('member_agent');
	if($sql){
		$count = $db -> where($sql)-> count();
	}else{
		$count = $db -> count();
	}
    
	
    $page = $this->page($count, 20);
	if($sql){
		$data = $db->where($sql)->limit($page->firstRow . ',' . $page->listRows)->select();
	}else{
		$data = $db->limit($page->firstRow . ',' . $page->listRows)->select();
	}
    
	$this->assign("count", $count);
    $this->assign("Page", $page->show('Admin'));

    $this->assign("list", $data);

    $this->display();

  }

  

  //经纪人详情

  public function show_jjr()

  {

    if(IS_GET){

      $db = M('member_agent');

      $info = $db -> where('userid='.$_GET['id']) -> find();
	  $q = M('member')->where('userid='.$_GET['id'])->field('vtel,username')->find();
	  $info['vtel'] = $q['vtel'];
	  $info['username'] = $q['username'];
      $this->assign("info", $info);

    }

    $this->display();

  }

}