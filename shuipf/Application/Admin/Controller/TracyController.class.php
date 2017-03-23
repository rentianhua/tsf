<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 插件商店
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Common\Controller\AdminBase;

class TracyController extends AdminBase {

   //所有月份行情
    public function index() {
		$db = M('tracy');
		$list = $db->select();
		$this -> assign("data",$list);
		$this -> display();
	}
	
	//添加行情
    public function add() {
		$db = M('tracy');
		if($_POST){			
            $data = $db->create($_POST);
			$rs = $db->add($data);
			if($rs){
				$this->success("添加成功",U("Tracy/index"));	
			}else{
				$this->error("添加失败");	
			}
		}else{			
			$this -> display();
		}
	}
	
	//编辑行情
    public function edit() {
		$db = M('tracy');
		if(IS_POST){	
            $data = $db->create($_POST);
			$rs = $db->where('id='.$_POST['id'])->save($data);
			if($rs){
				$this ->success("保存成功",U("Tracy/index"));
			}
		}else{
			if($_GET['id'] == ""){
				$this ->error("非法操作");
				exit;
			}else{
				$vo = $db->where('id='.$_GET['id'])->find();
				$this -> assign("vo",$vo);
			}
			$this -> display();
		}
	}
	
	//删除行情
    public function delete() {
		if(IS_GET){
			if($_GET['id'] == ''){
				$this -> error("非法操作");	
			}else{
				$rs = M('tracy')->where('id='.$_GET['id'])->delete();
				if($rs){
					$this->success("删除成功",U("Tracy/index"));	
				}else{
					$this->error("删除失败",U("Tracy/index"));	
				}	
			}
		}
	}
	
}
