<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 会员设置管理
// +----------------------------------------------------------------------

namespace Member\Controller;

use Admin\Service\User;

class UserController extends MemberbaseController {

    //会员设置界面
    public function profile() {
        //====基本资料表单======
        $modelid = $this->userinfo['modelid'];
        //会员模型数据表名
        $tablename = $this->memberModel[$modelid]['tablename'];
        //相应会员模型数据
        $modeldata = M(ucwords($tablename))->where(array("userid" => $this->userid))->find();
       if (!is_array($modeldata)) {
            $modeldata = array();
        }
        $data = array_merge($this->userinfo, $modeldata);
        $content_form = new \content_form($modelid);
        $data['modelid'] = $modelid;
        //字段内容
        $forminfos = $content_form->get($data);

        //====头像======
        $user_avatar = service("Passport")->getUploadPhotosHtml($this->userid);
        $this->assign('user_avatar', $user_avatar);
        $this->assign("forminfos", $forminfos);
        $this->assign('type', I('get.type', 'profile'));
        $this->assign("userinfo", $data);
        $this->display();
    }

	//我的关注
    public function guanzhu() {  
		if(IS_GET){
			if($_GET[t]){
				$t = $_GET['t'];
				if($t==1){
				 	$u['fromtable'] = "ershou";
				}else if($t==2){
					$u['fromtable'] = "new";
				}
				$u['username'] = $this->userinfo['username'];
				$arr = M('guanzhu') -> where($u) -> select();

				foreach($arr as $k=>$value){
										
					$arr[$k]['house'] = M($value['fromtable']) -> where('id='.$value['fromid']) -> find();											
					$arr[$k]['house']['xiaoquname'] = M('xiaoqu')->where('id='.$arr[$k]['house']['xiaoqu'])->getfield('title');			
				}				
				$count = count($arr);
				$this->assign("arr", $arr);
				$this->assign("count",$count);
				$this->display();
			}else{
				$this->error("非法操作");
			}
		}else{
			$this->error("非法操作");
		}
        
    }
	//委托管理
    public function weituo() {
		$userinfo = $this -> userinfo = service("Passport") -> getInfo();
		$t = $_GET['t'];
		if($t==1){
			$db = M('ershou');
		}else{
			$db = M('chuzu');
		}
		$list = $db->where('jjr_id='.$userinfo['userid'].' and pub_type!=1')->order('updatetime DESC')->select();
		$this->assign("arr",$list);
        $this->display();
    }
	//我的二手房
    public function esf() {      
        $this->display();
    }
  
	//我的出租房
    public function czf() {
        $this->display();
    }

    //添加关注
    public function addguanzhu()
    {
      if(IS_POST){
        $userinfo = $this -> userinfo = service("Passport") -> getInfo();
        $db = M('guanzhu');
        $data = $db -> create($_POST);
        $data['catid'] = 49;
        $data['username'] = $userinfo['username'];
        $data['status'] = 99;
        $data['updatetime'] = $data['inputtime'] = time();
        //添加guanzhu表
        $rs = $db->add($data);
        //添加附表
        $u['id'] = $rs;
        $u['content'] = "";
        $u['relation'] = "";
        $rs1 = M('guanzhu_data') -> add($u);
        if($rs && $rs1){
          echo '{"success":1}';
          exit;
        }else{
          echo '{"success":0}';
          exit;
        }
      }
    }
    //取消关注
  public function delguanzhu()
  {
    $rs = M("guanzhu") -> where("id=".$_GET["id"]) -> delete();
    $rs1 = M("guanzhu_data") -> where("id=".$_GET["id"]) -> delete();
    if($rs && $rs1){
      $this->success('取消成功');
    }else{
      $this->error('取消失败');
    }

  }
  
  //成交房源
  public function chengjiao(){
    if(IS_GET){
			if($_GET[t]){
				$t = $_GET['t'];
				$userinfo = $this -> userinfo = service("Passport") -> getInfo();
				$sql = "(username='".$userinfo['username']."' OR jjr_id='".$userinfo['userid']."') and ";
				if($t==1){
				 	$db = M('ershou');
					$sql .= 'zaishou=0';
				}else if($t==2){
					$db = M('chuzu');
					$sql .= 'zaizu=0';
				}
				$arr = $db -> where($sql) ->select();
				foreach($arr as $k=>$v){
					$arr[$k]['xiaoquname'] = M('xiaoqu')->where('id='.$v['xiaoqu'])->getfield('title');
				}
				$count = count($arr);
				$this->assign("arr", $arr);
				$this->assign("count",$count);
				$this->display();
			}else{
				$this->error("非法操作");
			}
		}else{
			$this->error("非法操作");
		}
  }
  
  //历史记录
  public function history(){
    $this->display();
  }

  //我的预约
  public function yuyue(){
    $this->display();
  }
  //求租
  public function qiuzu(){
    $this->display();
  }
  //求购
  public function qiugou(){
    $this->display();
  }
  //我的优惠券
  public function yhq(){
	  $userinfo = $this -> userinfo = service("Passport") -> getInfo();
	  $u['userid'] = $userinfo['userid'];
	  $list = M('coupon')->where($u)->select();
	  $this->assign("list",$list);
      $this->display();
  }
  //勾地订单
  public function gd(){
	  $userinfo = $this -> userinfo = service("Passport") -> getInfo();
	  $u['userid'] = $userinfo['userid'];
	  $list = M('goudi')->where($u)->select();
	  $this->assign("list",$list);
      $this->display();
  }
  
  //添加预约
  public function addyuyue()
  {
    if(IS_POST){
      $userinfo = $this -> userinfo = service("Passport") -> getInfo();
      $db = M('yuyue');
      $data = $db -> create($_POST);
      $data['catid'] = 50;
      $data['username'] = $userinfo['username'];
      $data['userid'] = $userinfo['userid'];
      $data['usernickname'] = $userinfo['nickname'];
      $data['status'] = 99;
      $data['updatetime'] = $data['inputtime'] = time();
      //添加yuyue表
      $rs = $db->add($data);
      //添加附表
      $u['id'] = $rs;
      $u['content'] = "";
      $u['relation'] = "";
      $rs1 = M('yuyue_data') -> add($u);
      if($rs && $rs1){
        echo '{"success":1}';
        exit;
      }else{
        echo '{"success":0}';
        exit;
      }
    }
  }
  //取消预约
  public function delyuyue()
  {
	  $userinfo=$this->userinfo = service("Passport")->getInfo();
    $id = $_GET["id"];
	$k['id']=$id;
	$k['username']=$userinfo['username'];
    //删除预约
    $rs = M('yuyue')-> where("id=".$id) -> delete();
	M('yuyue_data')-> where("id=".$id) -> delete();
	if($rs){
		//插入数据到history表中
		$h['catid'] = 48;
		$h['status'] = 99;
		$h['inputtime'] = $h['updatetime'] = time();
		$h['type'] = "预约";
		$h['fromid'] = $id;
		$h['fromtable'] = "yuyue";
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
	}

    if($rs == 1 && $n){
      $this->success('删除成功！');
    }else{
      $this->error('删除失败！');
    }

  }
  //经纪人确认预约
  public function confirmyuyue(){
	 	$userinfo=$this->userinfo = service("Passport")->getInfo();
		$db = M('yuyue');
		$k['id']=$_GET['id'];
		$k['fromuser']=$userinfo['username'];
		$u['lock'] = 1;
		$u['zhuangtai'] = "预约成功";
		$rs = $db -> where($k) -> save($u);
		if($rs){
			$this->success("确认成功");
		}else{
			$this->error('确认失败！');	
		} 
	}
    //保存基本信息
    public function doprofile() {
        if (IS_POST) {
			$userinfo = $this -> userinfo = service("Passport") -> getInfo();
			$u['sex'] = $_POST['sex'];
			$u['about'] = $_POST['about'];
			$r = M('member') -> where('userid='.$userinfo['userid']) -> save($u);
			if($userinfo['modelid'] == 35){
				$x['realname'] = $_POST['realname'];
				$f = M('member_normal')->where('userid='.$userinfo['userid'])->find();
				if($f){
					$rs = M('member_normal') -> where('userid='.$userinfo['userid']) -> save($x);
				}else{
					$x['userid']=$userinfo['userid'];
					$rs = M('member_normal') -> add($x); 
				}
			}else{
				$y['realname'] = $_POST['realname'];
				if($_POST['cardnumber']){
					$y['cardnumber'] = $_POST['cardnumber'];
				}
				if($_POST['sfzpic']){
					$y['sfzpic'] = $_POST['sfzpic'];
				}
				if($_POST['mainarea']){
					$y['mainarea'] = $_POST['mainarea'];
				}
				if($_POST['leixing']){
					$y['leixing'] = $_POST['leixing'];
				}
				if($_POST['coname']){
					$y['coname'] = $_POST['coname'];
				}
				if($_POST['worktime']){
					$y['worktime'] = $_POST['worktime'];
				}
				$f = M('member_agent')->where('userid='.$userinfo['userid'])->find();
				if($f){
					$rs = M('member_agent') -> where('userid='.$userinfo['userid']) -> save($y);
				}else{
					$y['userid']=$userinfo['userid'];
					$rs = M('member_agent') -> add($y); 
				}
			}
			$this->success('保存成功！');
		} else {
            $this->error('修改失败！');
        }
    }

    //修改密码
    public function dopassword() {
        if (IS_POST) {
            $post = I('post.');
            //旧密码
            $oldPassword = $post['oldPassword'];
            //根据当前密码取得用户资料
            $userInfo = service("Passport")->getLocalUser($this->userid, $oldPassword);
			if (false == $userInfo) {
                $this->error('旧密码错误，请重新输入！');
            }
            //设置密码
            $password = $post['password'];
            if (empty($password)) {
                $this->error('请输入你的密码！');
            }
            if (false == isMin($password, 6)) {
                $this->error('密码长度不能小于6位！');
            }
            //再次密码确认
            $password2 = $post['password2'];
            if ($password != $password2) {
                $this->error('两次密码输入不一致！');
            }
            $edit = service("Passport")->userEdit($this->username, '', $password, '', 1);
            if ($edit) {
                //注销当前登陆
                service("Passport")->logoutLocal();
                $this->success('密码修改成功！');
            } else {
                $this->error(service("Passport")->getError()? : '密码修改失败！');
            }
        } else {
            $this->error('修改失败！');
        }
    }

}
