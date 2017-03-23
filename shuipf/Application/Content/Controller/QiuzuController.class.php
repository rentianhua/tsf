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

class QiuzuController extends Base {
	
	protected function _initialize() {		
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if(!$userinfo['username']){
			$this->error('您还没有登录', U('Member/Index/login'));
			exit;
		}
		
	}
   	
    //新增求租
    public function add()
    {
		
      if (IS_POST) {
        $userinfo = $this->userinfo = service("Passport")->getInfo();
        
        //插入到qiuzu表
        $db = M('userqiuzu');
		// 启动事务
        $db->startTrans();
        $data = $db->create($_POST);
        $data['catid'] = 55;
        $data['username'] = $userinfo['username'];
        $data['status'] = 1;
        $data['updatetime'] = $data['inputtime'] = time();
		$data['lock'] = 0;
        $rs = $db->add($data);
        if ($rs) {          
          //插入一条数据到附表中
          $u['id'] = $rs;
          $u['content'] = "";
          $u['relation'] = "";
          $rs1 = M('userqiuzu_data')->add($u);
        }
        if ($rs && $rs1 ) {
          $db->commit();
          //发布成功，跳转到我的求租          
          $this->success('添加成功', U('Member/User/qiuzu'));
        } else {
          $db->rollback();
          $this->error('添加失败');
        }
      } else {
        $this->display("Qiuzu:add");
      }
    }

	
	//删除求租
	public function del() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$id = $_GET['id'];
		$x['id'] = $id;
		$x['username'] = $userinfo['username'];
		$lock = M('userqiuzu')->where($x)->getfield('lock');
		if($lock == 1){
			$this->success('删除失败！');
			exit;
		}
        $rs = M('userqiuzu')-> where($x) -> delete();
		//插入一条记录到"history"表中
        $h['catid'] = 48;
        $h['status'] = 99;
        $h['inputtime'] = $h['updatetime'] = time();
        $h['type'] = "求租";
        $h['fromid'] = $id;
        $h['fromtable'] = "userqiuzu";
        $h['userid'] = $userinfo['userid'];
        $h['username'] = $userinfo['username'];
        $h['title'] = $userinfo['username'];
        $h['action'] = "删除";
        $n = M('history')->add($h);
		//插入一条数据到history附表中
      $u['id'] = $n;
      $u['content'] = "";
      $u['relation'] = "";
      M('history_data')->add($u);
	  
		if($rs){
			$this->success('删除成功！');
		}else{
			$this->success('删除失败！');
		}
        
	}
	
}
