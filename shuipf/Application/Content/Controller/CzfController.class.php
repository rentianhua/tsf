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

class CzfController extends Base {
	
	protected function _initialize() {		
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if(!$userinfo['username']){
			$this->error('您还没有登录', U('Member/Index/login'));
			exit;
		}
		
	}
   	
    //新增出租房房源
    public function add()
    {
      if (IS_POST) {
        $userinfo = $this->userinfo = service("Passport")->getInfo();
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

        //插入房源到chuzu表
        $db = M('chuzu');
        $data = $db->create($_POST);
        $data['catid'] = 8;
        $data['username'] = $userinfo['username'];
		$data['zaizu'] = 1;
		if($userinfo['modelid'] == 35){
				$data['status'] = 1;	
		}else{
			$data['jjr_id'] = $userinfo['userid'];
			$data['status'] = 99;	
		}
		if(!$_POST['pub_type']){
			$data['pub_type'] = 1;
		}
		if($data['pub_type'] == 1){ 	//经纪人发布或自售
			$data['lock'] = 0;
		}else{	//委托给经纪人
			$data['lock'] = 1;
		}
		if($userinfo['modelid'] == 36){
			$data['jjr_id'] = $userinfo['userid'];
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
		if($_POST['pics_url'][0]){
			$data['thumb'] = $_POST['pics_url'][0];
		}
        $rs = $db->add($data);
        if ($rs) {
          //更新url地址
          $y['url'] = "/index.php?a=shows&catid=8&id=" . $rs;
		  //更新房源编号
			$y['bianhao'] = "Z".date("Ymd").($data['catid']*10000000+$rs);
          $db->where("id=" . $rs)->save($y);
          //插入一条数据到出租房附表中
          $u['id'] = $rs;
          $u['content'] = "";
          $u['relation'] = "";
          M('chuzu_data')->add($u);
        }
        if ($data['xiaoqu'] && $rs ) {
          $db1->commit();
          //发布成功，跳转到我的出租房页面
          $this->success('添加成功', U('Member/User/czf'));
        } else {
          $db1->rollback();
          $this->error('添加失败');
        }
      } else {
        $this->display("Czf:add");
      }
    }

	//编辑出租房房源
	public function edit() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$id = $_GET['id'];
		$db = M('chuzu');
		
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
			$data['updatetime']=time();
			
          $db -> where($x) -> save($data);
			if($data['xiaoqu']){
              $db1->commit();
				if($_GET['t']==1){
					$this->success('修改成功！', U('Member/User/weituo?t=2'));
				}else{
					$this->success('修改成功！', U('Member/User/czf'));
				}
              
            }else{
              $db1->rollback();
              $this->error('修改失败！');
            }
		}else{
			//取出数据
            $k['id'] = $id;
			$info = $db -> where($k) -> find();
			if($info){
			    //取出小区名称
                $info['xiaoquname'] = M('xiaoqu') -> where('id='.$info['xiaoqu']) -> getField('title');
				$this->assign('info', $info);
				$this->display("Czf:edit");
			}else{
				$this->error('非法操作！');
			}
		}
	}
	
	//删除出租房房源
	public function del() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$id = $_GET['id'];
		$x['id'] = $id;
		$x['username'] = $userinfo['username'];
	  	$rs = M('chuzu') -> where($x) -> delete();

        //插入一条记录到"history"表中
        $h['catid'] = 48;
        $h['status'] = 99;
        $h['inputtime'] = $h['updatetime'] = time();
        $h['type'] = "出租房";
        $h['fromid'] = $id;
        $h['fromtable'] = "chuzu";
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

		if($rs == 1 && $n){
			$this->success('删除成功！');
		}else{
			$this->error('删除失败！');
		}
	}	
}
