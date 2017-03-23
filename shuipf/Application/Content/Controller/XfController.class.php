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

class XfController extends Base {

  protected function _initialize() {
    $userinfo=$this->userinfo = service("Passport")->getInfo();
    if(!$userinfo['username']){
      $this->error('您还没有登录', U('Member/Index/login'));
      exit;
    }

  }

  //新增新房房源
  public function add() {
    if (IS_POST){
      $userinfo=$this->userinfo = service("Passport")->getInfo();
      //将提交的POST数据提交到ershou表
      $data = M('new')->create($_POST);
      $data['catid'] = 3;
      $data['username'] = $userinfo['username'];
      $data['status'] = 99;
      $data['updatetime'] = $data['inputtime'] = time();
      $rs = M('new')->add($data);
      //更新url地址
      $k['url'] = "/index.php?a=shows&catid=3&id=".$rs;
      M('new')-> where("id=".$rs) -> save($k);
      //插入一条数据到新房附表中
      $u['id'] = $rs;
      $u['content'] = "";
      $u['relation'] = "";
      M('new_data')->add($u);
      //发布成功，跳转到我的新房页面
      $this->success('添加成功', U('Member/User/xf'));
    }else{
      $this->display("Xf:add");
    }
  }

  //编辑新房房源
  public function edit() {
    $userinfo=$this->userinfo = service("Passport")->getInfo();
    $id = $_GET['id'];
    $db = M('new');

    if(IS_POST && $_POST['s']){
      //更新数据
      $data = $db -> create($_POST);

      $rs = $db -> where('id='.$id.' and username='.$userinfo['username']) -> save($data);
      if($rs){
        $this->success('修改成功！', U('Member/User/xf'));
      }else{
        $this->error('修改失败！', U('Member/User/xf'));
      }
    }else{
      //取出数据
      $info = $db -> where('id='.$id.' and username='.$userinfo['username']) -> select();
      if($info){
        $this->assign('info', $info[0]);
        $this->display("Xf:edit");
      }else{
        $this->error('非法操作！', U('Member/User/xf'));
      }
    }
  }

  //删除新房房源
  public function del() {
    $userinfo=$this->userinfo = service("Passport")->getInfo();
    $id = $_GET['id'];
    $ly = $_GET['ly'];
    if($ly == "yz"){
      $l = "业主";
    }else if($ly == "jjr"){
      $l = "经纪人";
    }else if($ly == "u"){
      $l = "普通用户";
    }

    //更新isfabu为"隐藏"
    $k['isfabu'] = "隐藏";
    $rs = M('new')-> where("id=".$id) -> save($k);

    //插入一条记录到"history"表中
    $h['catid'] = 48;
    $h['status'] = 99;
    $h['inputtime'] = $h['updatetime'] = time();
    $h['type'] = "新房";
    $h['fromid'] = $id;
    $h['fromtable'] = "new";
    $h['userid'] = $userinfo['userid'];
    $h['username'] = $userinfo['username'];
    $h['fromwho'] = "经纪人";
    $h['title'] = $userinfo['nickname'];
    $h['action'] = "删除";
    $n = M('history')->add($h);

    //插入一条数据到history附表中
    $u['id'] = $n;
    $u['content'] = "";
    $u['relation'] = "";
    M('history_data')->add($u);

    if($rs == 1 && $n){
      $this->success('删除成功！', U('Member/User/xf'));
    }else{
      $this->error('删除失败！', U('Member/User/xf'));
    }
  }

  //查看新房房源
  public function show() {
    $userinfo=$this->userinfo = service("Passport")->getInfo();
    $id = $_GET['id'];
    $db = M('new');
    //取出数据
    $info = $db -> where('id='.$id.' and username='.$userinfo['username']) -> select();
    if($info){
      $this->assign('info', $info[0]);
      $this->display("Xf:show");
    }else{
      $this->error('非法操作！', U('Member/User/xf'));
    }
  }
}
