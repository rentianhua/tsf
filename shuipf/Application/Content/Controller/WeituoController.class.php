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

class WeituoController extends Base {
	
	protected function _initialize() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if(!$userinfo['username']){
			$this->error('您还没有登录', U('Member/Index/login'));
			exit;
		}
		
	}
    
    //新增二手房委托
    public function add_es() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if($userinfo['modelid'] == 36){
			$this -> error("您没有委托权限");
			exit;	
		}
        if (IS_POST){			 
			 //将提交的POST数据提交到es_weituo表
             $data = M('es_weituo')->create($_POST);			 
			 $data['catid'] = 47;
			 $data['username'] = $userinfo['username'];
			 $data['status'] = 99;
			 $data['updatetime'] = $data['inputtime'] = time();
			 $rs = M('es_weituo')->add($data);
			 //更新url地址
			 $k['url'] = "/index.php?a=shows&catid=47&id=".$rs;
			 M('es_weituo')-> where("id=".$rs) -> save($k);
			 //插入一条数据到委托附表中
			 $u['id'] = $rs;
			 $u['content'] = "";
			 $u['relation'] = "";
			 M('es_weituo_data')->add($u);
			 //委托成功，跳转到我的委托页面
			 $this->success('添加成功', U('Member/User/weituo'));
         }else{
             $this->display("Weituo:add_es");
         }
    }
	
	//新增租房委托
    public function add_zf() {	
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if($userinfo['modelid'] == 36){
			$this -> error("您没有委托权限");
			exit;	
		}	
		if (IS_POST){			 
			 //将提交的POST数据提交到zf_weituo表
             $data = M('zf_weituo')->create($_POST);			 
			 $data['catid'] = 46;
			 $data['username'] = $userinfo['username'];
			 $data['status'] = 99;
			 $data['updatetime'] = $data['inputtime'] = time();
			 $rs = M('zf_weituo')->add($data);
			 //更新url地址
			 $k['url'] = "/index.php?a=shows&catid=46&id=".$rs;
			 M('zf_weituo')-> where("id=".$rs) -> save($k);
			 //插入一条数据到委托附表中
			 $u['id'] = $rs;
			 $u['content'] = "";
			 $u['relation'] = "";
			 M('zf_weituo_data')->add($u);
			 //委托成功，跳转到我的委托页面
			 $this->success('添加成功', U('Member/User/weituo?t=1'));
         }else{
             $this->display("Weituo:add_zf");
         }
    }
	
	//编辑租房委托
	public function edit_zf() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$zfid = $_GET['zfid'];
		$db = M('zf_weituo');
		if(IS_POST && $_POST['s']){
			//更新数据
			$data = M('zf_weituo')->create($_POST);	
			$rs = $db -> where('id='.$zfid.' and username='.$userinfo['username']) -> save($data);
			if($rs){
				$this->success('修改成功！', U('Member/User/weituo?t=1'));	
			}else{
				$this->error('修改失败！', U('Member/User/weituo?t=1'));	
			}
		}else{
			//取出数据
			$info = $db -> where('id='.$zfid.' and username='.$userinfo['username']) -> select();
			if($info){
				$this->assign('info', $info[0]);
				$this->display("Weituo:edit_zf");
			}else{
				$this->error('非法操作！', U('Member/User/weituo?t=1'));	
			}

		}
	}
	
	//编辑二手房委托
	public function edit_es() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$esid = $_GET['esid'];
		$db = M('es_weituo');

		if(IS_POST && $_POST['s']){
			//更新数据
			$data = M('es_weituo')->create($_POST);	
			$rs = $db -> where('id='.$esid.' and username='.$userinfo['username']) -> save($data);
			if($rs){
				$this->success('修改成功！', U('Member/User/weituo'));	
			}else{
				$this->error('修改失败！', U('Member/User/weituo'));	
			}
		}else{
			//取出数据
			$info = $db -> where('id='.$esid.' and username='.$userinfo['username']) -> select();
			if($info){
				$this->assign('info', $info[0]);
				$this->display("Weituo:edit_es");
			}else{
				$this->error('非法操作！', U('Member/User/weituo'));	
			}
		}
	}

  //查看二手房委托
  public function show_es() {
    $userinfo=$this->userinfo = service("Passport")->getInfo();
    $esid = $_GET['esid'];
    $db = M('es_weituo');

    //取出数据
    $info = $db -> where('id='.$esid.' and username='.$userinfo['username']) -> select();
    if($info){
      $this->assign('info', $info[0]);
      $this->display("Weituo:show_es");
    }else{
      $this->error('非法操作！', U('Member/User/weituo'));
    }
  }

  //查看出租房委托
  public function show_zf() {
    $userinfo=$this->userinfo = service("Passport")->getInfo();
    $zfid = $_GET['zfid'];
    $db = M('zf_weituo');

    //取出数据
    $info = $db -> where('id='.$zfid.' and username='.$userinfo['username']) -> select();
    if($info){
      $this->assign('info', $info[0]);
      $this->display("Weituo:show_zf");
    }else{
      $this->error('非法操作！', U('Member/User/weituo'));
    }
  }
	
	//删除二手房委托
	public function del_es() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$esid = $_GET['esid'];
		$db = M('es_weituo');

      //更新isfabu为"隐藏"
      $k['isfabu'] = "隐藏";
      $rs = $db -> where("id=".$esid) -> save($k);

      //插入一条记录到"history"表中
      $h['catid'] = 48;
      $h['status'] = 99;
      $h['inputtime'] = $h['updatetime'] = time();
      $h['type'] = "二手房委托";
      $h['fromid'] = $esid;
      $h['fromtable'] = "es_weituo";
      $h['userid'] = $userinfo['userid'];
      $h['username'] = $userinfo['username'];
      $h['fromwho'] = "业主";
      $h['title'] = $userinfo['nickname'];
      $h['action'] = "删除";
      $n = M('history')->add($h);

      //插入一条数据到history附表中
      $u['id'] = $n;
      $u['content'] = "";
      $u['relation'] = "";
      M('history_data')->add($u);
		if($rs == 1 && $n){
			$this->success('删除成功！', U('Member/User/weituo'));	
		}else{
			$this->error('删除失败！', U('Member/User/weituo'));	
		}
	}
	
	//删除租房委托
	public function del_zf() {
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		$zfid = $_GET['zfid'];
		$db = M('zf_weituo');

      //更新isfabu为"隐藏"
      $k['isfabu'] = "隐藏";
      $rs = $db -> where("id=".$zfid) -> save($k);

      //插入一条记录到"history"表中
      $h['catid'] = 48;
      $h['status'] = 99;
      $h['inputtime'] = $h['updatetime'] = time();
      $h['type'] = "租房委托";
      $h['fromid'] = $zfid;
      $h['fromtable'] = "zf_weituo";
      $h['userid'] = $userinfo['userid'];
      $h['username'] = $userinfo['username'];
      $h['fromwho'] = "业主";
      $h['title'] = $userinfo['nickname'];
      $h['action'] = "删除";
      $n = M('history')->add($h);

      //插入一条数据到history附表中
      $u['id'] = $n;
      $u['content'] = "";
      $u['relation'] = "";
      M('history_data')->add($u);
		if($rs == 1 && $n){
			$this->success('删除成功！', U('Member/User/weituo?t=1'));	
		}else{
			$this->error('删除失败！', U('Member/User/weituo?t=1'));	
		}
	}
}
