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

class MsgController extends AdminBase {
	
	//系统消息
	public function message(){
		$this -> display();
	}
	
	//给所有经纪人发送消息
	public function send_jjr(){
		$db = M('message');
		$data['content']=$_POST['content'];
		$data['from_id']=0;
		$data['inputtime']=time();
		$data['from_status']=2;
		$data['to_status']=1;
		
		$list = M('member')->where('modelid=36')->field('userid')->select();
		
		foreach($list as $k=>$v){
			$data['to_uid']=$v['userid'];
			$db->add($data);
		}
		$this->success("发送成功");
	}
	
	//给所有普通用户发送消息
	public function send_user(){
		
		$db = M('message');
		$data['content']=$_POST['content'];
		$data['from_id']=0;
		$data['inputtime']=time();
		$data['from_status']=2;
		$data['to_status']=1;
		
		$list = M('member')->where('modelid=35')->field('userid')->select();
		
		foreach($list as $k=>$v){
			$data['to_uid']=$v['userid'];
			$db->add($data);
		}
		$this->success("发送成功");
	}
}
