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

class EsfController extends Base {
	
	protected function _initialize() {		
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if(!$userinfo['username']){
			$this->error('您还没有登录', U('Member/Index/login'));
			exit;
		}
		
	}
   	
    //新增二手房房源
    public function add() {
		
        if (IS_POST){
		  $userinfo=$this->userinfo = service("Passport")->getInfo();
          $db1 = M('xiaoqu');
          // 启动事务
          $db1->startTrans();
          //判断小区是否存在
          $k['area'] = $_POST['area'];
          $k['title'] = $_POST['xiaoquname'];
          $r1 = $db1->where($k)->find();
          if (!$r1) {
            //插入小区
            $k['catid'] = 54;
            $k['username'] = $userinfo['username'];
			$k['status'] = 99;           
            $k['updatetime'] = $k['inputtime'] = time();
            $k['province'] = $_POST['province'];
            $k['city'] = $_POST['city'];
            $k['jingweidu'] = $_POST['jingweidu'];
            $r2 = $db1->add($k);
            if ($r2) {
              //插入小区附表
              $u['id'] = $r2;
              $u['content'] = "";
              $u['relation'] = "";
              M('xiaoqu_data')->add($u);
            }
          }
		  
			 //插入房源到ershou表
             $db = M('ershou');
             $data = $db->create($_POST);
			 
			 $data['catid'] = 6;
			 $data['username'] = $userinfo['username'];
			 $data['zaishou'] = 1;
			 if(!$_POST['pub_type']){
				 $data['pub_type'] = 1;
				}
			 if($userinfo['modelid'] == 35){
				$data['status'] = 1;	
			}else{
				$data['jjr_id'] = $userinfo['userid'];
				$data['status'] = 99;	
			}
			 $data['updatetime'] = $data['inputtime'] = time();
          //如果小区存在，取返回的小区id
          if ($r1) {
            $data['xiaoqu'] = $r1['id'];
          }
          //如果小区插入成功，取返回的id
          if ($r2) {
            $data['xiaoqu'] = $r2;
          }
		     $data['pics'] = images("pics");
			 $data['thumb'] = $_POST['pics_url'][0];
			 if($data['pub_type'] == 1){
				 $data['lock'] = 0;
			 }else{
				 $data['lock'] = 1;
			 }
			 
			 $rs = $db->add($data);
          if($rs){
            //更新url地址
            $y['url'] = "/index.php?a=shows&catid=6&id=".$rs;
			//更新房源编号
			$y['bianhao'] = "S".date("Ymd").($data['catid']*10000000+$rs);
            $db-> where("id=".$rs) -> save($y);
            //插入一条数据到二手房附表中
            $u['id'] = $rs;
            $u['content'] = "";
            $u['relation'] = "";
			
            M('ershou_data')->add($u);
          }
          if ($data['xiaoqu'] && $rs ) {
            $db1->commit();
            //发布成功，跳转到我的二手房页面            
            $this->success('添加成功', U('Member/User/esf'));
          }else{
            $db1->rollback();
            $this->error('添加失败');
          }
       }else{
           $this->display("Esf:add");
       }
    }

	//普通会员上传合同和身份证
	public function edit1() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$db = M('ershou');
		if($_POST['contract'] && $_POST['contract'] != ''){
			$data['contract'] = images("contract");

      if($data['contract']=="a:0:{}"){
        $data['contract']="";
        unset($data['contract']);
      }
		}
		if($_POST['idcard'] && $_POST['idcard'] != ''){
			$data['idcard'] = images("idcard");

      if($data['idcard']=="a:0:{}")
      {
        $data['idcard']="";
        unset($data['idcard']);
      } 
		}
          $x['id'] = $_POST['id'];
			$rs = $db -> where($x) -> save($data);
          if($rs){
            $this->success('修改成功！');
          }else{
            $this->error('修改失败！');
          }
	}
	
	//经纪人编辑二手房房源
	public function edit() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$id = $_GET['id'];
		$db = M('ershou');
		
		if(IS_POST && $_POST['s']){
          $db1 = M('xiaoqu');
          // 启动事务
          $db1->startTrans();
          //判断小区是否存在
          $k['area'] = $_POST['area'];
          $k['title'] = $_POST['xiaoquname'];
          $r1 = $db1->where($k)->find();
          if (!$r1) {
            //插入小区
            $k['catid'] = 54;
            $k['username'] = $userinfo['username'];
            $k['status'] = 99;
            $k['updatetime'] = $k['inputtime'] = time();
            $k['province'] = $_POST['province'];
            $k['city'] = $_POST['city'];
            $k['jingweidu'] = $_POST['jingweidu'];
            $r2 = $db1->add($k);
            if ($r2) {
              //插入小区附表
              $u['id'] = $r2;
              $u['content'] = "";
              $u['relation'] = "";
              M('xiaoqu_data')->add($u);
            }
          }
          $data = $db -> create($_POST);
          //如果小区存在，取返回的小区id
          if ($r1) {
            $data['xiaoqu'] = $r1['id'];
          }
          //如果小区插入成功，取返回的id
          if ($r2) {
            $data['xiaoqu'] = $r2;
          }

          $x['id'] = $id;
		  $data['pics'] = images("pics");
		  $data['thumb'] = $_POST['pics_url'][0];
		  if($_POST['pub_type'] !=1){
			  $data['lock']=1;
			 }
			$data['updatetime']=time();
			$db -> where($x) -> save($data);
          if($data['xiaoqu']){
            $db1->commit();
			  if($_GET['t']==1){
				  $this->success('修改成功！', U('Member/User/weituo?t=1'));
			  }else{
				  $this->success('修改成功！', U('Member/User/esf'));
			  }
            
          }else{
            $db1->rollback();
            $this->error('修改失败！');
          }
		}else{
			//取出数据
            $u['id'] = $id;
			$info = $db -> where($u) -> find();
			if($info){
              //取出小区名称
              $info['xiaoquname'] = M('xiaoqu') -> where('id='.$info['xiaoqu']) -> getField('title');
				$this->assign('info', $info);
				$this->display("Esf:edit");
			}else{
				$this->error('非法操作！');
			}
		}
	}
	
	//删除二手房房源
	public function del() {
      $userinfo=$this->userinfo = service("Passport")->getInfo();
	  $id = $_GET['id'];
      $x['id'] = $id;
      $x['username'] = $userinfo['username'];
	  $rs = M('ershou') -> where($x) -> delete();

      //插入一条记录到"history"表中
      $h['catid'] = 48;
      $h['status'] = 99;
      $h['inputtime'] = $h['updatetime'] = time();
      $h['type'] = "二手房";
      $h['fromid'] = $id;
      $h['fromtable'] = "ershou";
      $h['userid'] = $userinfo['userid'];
      $h['title'] = $userinfo['username'];
      $h['action'] = "删除";
      $n = M('history')->add($h);

      //插入一条数据到history附表中
      $u['id'] = $n;
      $u['content'] = "";
      $u['relation'] = "";
      M('history_data')->add($u);

      if($rs && $n){
        $this->success('删除成功！');
      }else{
        $this->error('删除失败！');
      }
	}	
	
	/*public function test(){
		//1.获取ticket
		$access_token = "111";
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
		//{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
		$postArr = array(
			'action_name'=>"QR_LIMIT_SCENE",
			'action_info'=>array(
				'scene'=>array(
					'scene_id'=>123
				)
			)			
		);
		$postJson = json_encode($postArr);
	}*/
}
