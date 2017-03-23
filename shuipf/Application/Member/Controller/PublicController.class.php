<?php
// +----------------------------------------------------------------------
// | taoshenfang 会员中心
// +----------------------------------------------------------------------
namespace Member\Controller;
class PublicController extends MemberbaseController {
//修改密码
public function modpassword() {
	if (IS_POST) {
		$mob = I('post.mob', '', 'trim');
		$yzm = I('post.yzm', '', 'trim');
		$password = I('post.password', '', 'trim');
		$password2 = I('post.password2', '', 'trim');
		if (!$mob || !$yzm) {
			$this->error('非法请求！');
		}
		if (empty($password) || empty($password2)) {
			$this->error('请正确输入密码！');
		}
		//密码确认
		if ($password != $password2) {
			$this->message(array('error' => 1014, 'info' => '两次输入密码不相同，请重新输入！',));
		}
		$member = M('member');
		$u['username'] = $mob;
		$rq = $member->where($u)->find();
		if (!$rq) {
			$this->error('非法请求！');
			exit;
		}
		$map['mob'] = $mob;
		$map['yzm'] = $yzm;
		$map['uptime'] = array('gt', time() - 300);
		$rq2 = M('mob_yzm')->where($map)->select();
		if ($rq2) {
			$status = service("Passport")->userEdit($mob, '', $password, '', 1);
			if ($status) {
				$this->success("密码修改成功", U('Member/Index/login'));
			} else {
				$this->error('密码修改失败！');
			}
		}
	} else {
		$this->display();
	}
}
//修改密码
public function mod_pwd() {
	//首先判断传值是否正确
	$mob = $k['username'] = $u['username'] = I('post.mob', '', 'trim');
	$yzm = $k['yzm'] = I('post.yzm', '', 'trim');
	$pwd1 = I('post.pwd1', '', 'trim');
	$pwd2 = I('post.pwd2', '', 'trim');
	if (!$mob || !$yzm || !$pwd1 || !$pwd2) {
		echo '{"success":47,"info":"数据错误"}';
		exit;
	}
	$db = M('member');
	$res = $db->where($u)->find();
	if (!$res) {
		echo '{"success":48,"info":"非法的手机号码"}';
		exit;
	}
	if (!preg_match("/^1[34578]{1}\d{9}$/", $mob)) {
		echo '{"success":48,"info":"非法的手机号码"}';
		exit;
	}
	if ($pwd1 != $pwd2) {
		echo '{"success":49,"info":"输入的两个密码不一致"}';
		exit;
	}
	$url = "http://www.taoshenfang.com/index.php?g=api&m=sms&a=check_yzm&mob=" . $mob . "&yzm=" . $yzm;
	$rs = file_get_contents($url);
	$rs = json_decode($rs, true);
	if ($rs['success'] != 7) {
		echo '{"success":50,"info":"手机验证码验证不通过"}';
		exit;
	} else {
		$userid = $db->where($u)->getField('userid');
		if ($userid > 0) {
			$status = service("Passport")->userEdit($mob, '', $pwd1, '', 1);
			if ($status) {
				echo '{"success":51,"info":"密码修改成功"}';
				exit;
			} else {
				echo '{"success":52,"info":"密码修改失败"}';
				exit;
			}
		} else {
			echo '{"success":53,"info":"非法请求"}';
			exit;
		}
	}
}
//api直接修改密码
public function mod_pwd2() {
	if (IS_POST) {
		if ($_POST['username'] == '' || $_POST['userid'] == '' || $_POST['oldpwd'] == '' || $_POST['pwd1'] == '' ||$_POST['pwd2'] == '') {
			echo '{"success":151,"info":"数据不完整"}';
			exit;
		}
		//旧密码
		$oldPassword = $_POST['oldpwd'];
		//根据当前密码取得用户资料
		$userInfo = service("Passport")->getLocalUser(intval($_POST['userid']), $oldPassword);
		if (false == $userInfo) {
			echo '{"success":152,"info":"旧密码错误"}';
			exit;
		}
		//设置密码
		$password = $_POST['pwd1'];
		if (empty($password)) {
			echo '{"success":153,"info":"请输入密码"}';
			exit;
		}
		if (false == isMin($password, 6)) {
			echo '{"success":154,"info":"密码长度不能小于6位"}';
			exit;
		}
		//再次密码确认
		$password2 = $_POST['pwd2'];
		if ($password != $password2) {
			echo '{"success":155,"info":"两次密码输入不一致"}';
			exit;
		}
		$edit = service("Passport")->userEdit($_POST['username'], '', $password, '', 1);
		if ($edit) {
			echo '{"success":156,"info":"密码修改成功"}';
			exit;
		} else {
			echo '{"success":157,"info":"密码修改失败"}';
			exit;
		}
	}
}
//QQ空间登录框
public function logindialog() {
	$forward = $_REQUEST['forward'] ? $_REQUEST['forward'] : cookie("forward");
	cookie("forward", null);
	$this->assign('forward', U('Index/index'));
	$this->display();
}
//检查是否有新的消息通知 jsonp
public function checkNewNotification() {
}
//验证登陆
public function doLogin() {
	//是否需要 进行 js escape 解码
	$escape = I('request.escape', 0, 'intval');
	//用户名
	$loginName = I('request.loginName', null, 'trim');
	//密码
	$password = I('request.password');
	//下次自动登陆
	$cookieTime = I('request.cookieTime', 0, 'intval');
	//验证码
	$vCode = I('request.vCode');
	if ($escape) {
		$loginName = unescape($loginName);
		$password = unescape($password);
		$cookieTime = unescape($cookieTime);
		$vCode = unescape($vCode);
	}
	if (empty($loginName)) {
		$this->message(10005, array(), 'error');
	}
	if (empty($password)) {
		$this->message(20023, array(), 'error');
	}
	if (empty($vCode) && $this->memberConfig['openverification']) {
		$this->message(20031, array(), 'error');
	}
	if ($this->memberConfig['openverification'] && !$this->verify($vCode, "userlogin")) {
		$this->message(20031, array(), 'error');
	}
	$userid = service('Passport')->loginLocal($loginName, $password, $cookieTime ? 86400 * 180 : 86400);
	if ($userid > 0) {
		$userInfo = service("Passport")->getLocalUser((int)$userid);
		//待审核
		if ($userInfo['checked'] == 0) {
			service("Passport")->logoutLocal();
			$this->message(20014, array(), 'error');
		}
		//注册在线状态
		D('Online')->registerOnlineStatus($userid);
		//tag 行为点
		tag('action_member_loginend', $userInfo);
		if (cookie('uc_user_synlogin')) {
			$script = uc_user_synlogin($userid);
			cookie('uc_user_synlogin', NULL);
		} else {
			$script = '';
		}
		
		if($userInfo['modelid'] == 35){
			if($_GET['back'] && $_GET['back']!=""){
				redirect($_GET['back']);
			}else{
				redirect('/index.php?g=member&m=user&a=guanzhu&t=1');
			}
			
		}else{
			if($_GET['back'] && $_GET['back']!=""){
				redirect($_GET['back']);
			}else{
				$this->redirect('User/esf');
			}
			
		}		
	} else {
		//登陆失败
		$this->message(20023, array(), 'error');
	}
}
//API验证登陆(账号密码)
public function api_dologin() {
	//用户名
	$loginName = I('post.username', null, 'trim');
	//密码
	$password = I('post.password');
	if (empty($loginName)) {
		echo '{"success":34,"info":"用户名为空"}';
		exit;
	}
	if (empty($password)) {
		echo '{"success":35,"info":"密码为空"}';
		exit;
	}
	$userid = service('Passport')->loginLocal($loginName, $password, $cookieTime ? 86400 * 180 : 86400);
	if ($userid > 0) {
		$userInfo = service("Passport")->getLocalUser((int)$userid);
		//待审核
		if ($userInfo['checked'] == 0) {
			service("Passport")->logoutLocal();
			echo '{"success":36,"info":"账号待审核"}';
			exit;
		}
		//注册在线状态
		D('Online')->registerOnlineStatus($userid);
		//tag 行为点
		tag('action_member_loginend', $userInfo);
		echo '{"success":37,"info":"登录成功","userid":' . $userid . '}';
		exit;
	} else {
		//登陆失败
		echo '{"success":38,"info":"登录失败"}';
		exit;
	}
}


//API验证登陆(手机验证码)
public function api_dologin2() {
	//首先判断传值是否正确
        $mob = $k['username'] = $u['username'] = I('post.username', '', 'trim');
        $yzm = $k['yzm'] = I('post.yzm', '', 'trim');
        if(!$mob || !$yzm ){
            echo '{"success":42,"info":"数据错误"}';
            exit;
        }
        $db = M('member');
        $res  =  $db ->where($u)->find();
        if(!$res){
            echo '{"success":43,"info":"非法的手机号码"}';
            exit;
        }
        if(!preg_match("/^1[34578]{1}\d{9}$/",$mob)){
            echo '{"success":43,"info":"手机号码格式无效"}';
            exit;
        }

        $url = "http://www.taoshenfang.com/index.php?g=api&m=sms&a=check_yzm&mob=".$mob."&yzm=".$yzm;
        $rs = file_get_contents($url);
        $rs = json_decode($rs,true);
        if($rs['success'] != 7){
            echo '{"success":44,"info":"手机验证码验证不通过"}';
            exit;
        }else{
            $userid = $db ->where($u)->getField('userid');
		
		
        if ($userid > 0) {
		$info = service("Passport")->getLocalUser((int)$userid);
		$rs = service("Passport")->registerLogin($info);
	
		//待审核
		if ($info['checked'] == 0) {
			service("Passport")->logoutLocal();
			echo '{"success":36,"info":"账号待审核"}';
			exit;
		}
		//注册在线状态
		D('Online')->registerOnlineStatus($userid);
		//tag 行为点
		tag('action_member_loginend', $userInfo);
		if($_GET['back']){
			$back = $_GET['back'];
		}
		echo '{"success":37,"info":"登录成功","userid":' . $userid . ',"back":"'.$back.'"}';
		exit;
		} else {
			//登陆失败
			echo '{"success":38,"info":"登录失败"}';
			exit;
		}
        }

}


//根据userid获取用户的基本信息
public function api_getuserinfo() {
	if (IS_POST) {
		$userid = I('post.userid', 0, 'intval');
		if($userid==""){
			$userid = I('get.userid', 0, 'intval');
			}
		if (!$userid) {
			echo '{"success":40,"info":"传入参数无效"}';
			exit;
		}
		//主表
		$data = M('member')->where(array("userid" => $userid))->find();
		if (empty($data)) {
			echo '{"success":41,"info":"无此用户"}';
			exit;
		}
		//附表
		if($data['modelid'] == 35){
			$data['info'] = M('member_normal')->where('userid='.$userid)->find();
		}else{
			$data['info'] = M('member_agent')->where('userid='.$userid)->find();
		}		
		foreach ($this->groupCache as $g) {
			$groupCache[$g['groupid']] = $g['name'];
		}
		if ($data['userpic']=="") {
			$data['userpic'] =       "http://www.taoshenfang.com/statics/extres/member/images/noavatar.jpg";
		}
		
		if($data['vtel'] != '' && $data['zhuanjie']){
			    $data['ctel'] = cache('Config.tel400').','.$data['vtel'];
				$data['vtel'] = cache('Config.tel400').'转'.$data['vtel']; 
			 }else{
				 $info['ctel'] =  $data['username'];
				 $info['vtel'] =  $data['username'];
			 }
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	
	} else {
		echo '{"success":39,"info":"错误的请求方式"}';
		exit;
	}
}
//验证注册
public function doRegister() {
	if (empty($this->memberConfig['allowregister'])) {
		$this->error("系统不允许新会员注册！");
	}
	$post = I('post.');
	//用户名
	$post['username'] = I('post.username');
	//设置密码
	$post['password'] = I('post.password');
	if (empty($post['password'])) {
		$this->error('请输入您的密码！');
	}
	if (false == isMin($post['password'], 6)) {
		$this->error('密码不能小于6位！');
	}
	//确认密码
	$password2 = I('post.password2');
	if ($post['password'] != $password2) {
		$this->error('两次输入密码不相同！');
	}
	if ($post['modelid'] == 35) {
		$post['nickname'] = "淘深房用户";
	} else {
		$post['nickname'] = "淘深房经纪人";
	}
	$info = $this->memberDb->token(false)->create($post);
	if ($info) {
		//模型选择,如果是关闭模型选择，直接赋值默认模型
		if ((int)$this->memberConfig['choosemodel']) {
			if (!isset($info['modelid']) || empty($info['modelid'])) {
				$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
			} else {
				//检查模型id是否合法
				if (!isset($this->memberModel[$info['modelid']])) {
					$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
				}
			}
		} else {
			$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
		}
		if (empty($info['modelid'])) {
			$this->error('请选择会员模型！');
		}
		$userid = service("Passport")->userRegister($info['username'], $info['password']);
		if ($userid > 0) {
			//写入真实姓名
			if ($post['modelid'] == 36) {
				$x['realname'] = $post['realname'];
				$x['userid']=$userid;
				M('member_agent')->add($x);
			}
			//获取用户信息
			$memberinfo = service("Passport")->getLocalUser((int)$userid);
			$info['username'] = $memberinfo['username'];
			$info['password'] = $memberinfo['password'];
			//新注册用户积分
			$info['point'] = $this->memberConfig['defualtpoint'] ? $this->memberConfig['defualtpoint'] : 0;
			//新会员注册默认赠送资金
			$info['amount'] = $this->memberConfig['defualtamount'] ? $this->memberConfig['defualtamount'] : 0;
	
				//计算用户组
				$info['groupid'] = $this->memberDb->get_usergroup_bypoint($info['point']);
			 //新会员注册需要管理员审核
                if ($this->memberConfig['registerverify']) {
                    $info['checked'] = 0;
                } else {
                    $info['checked'] = 1;
                }
			if (false !== $this->memberDb->where(array('userid' => $memberinfo['userid']))->save($info)) {
				//注册登陆状态
				service("Passport")->loginLocal($post['username'], $post['password']);
				//tag 行为
				tag('action_member_registerend', $memberinfo);
				$aaa['back'] = $_GET['back'];
				if($aaa['back']=="undefined"){
					$aaa['back']="http://www.taoshenfang.com/index.php?g=Member&m=User&a=profile";
				}
				$aaa['success']=1;
				$this->ajaxReturn($aaa);
				
			} else {
				//删除
				
				service("Passport")->userDelete($memberinfo['userid']);
				$this->error("会员注册失败！");
			}
		} else {
			$this->error(service("Passport")->getError() ? : '帐号注册失败！');
		}
	} else {
		$this->error($this->memberDb->getError() ? : '帐号注册失败！');
	}
} 
//验证注册
public function api_register() {
	if (IS_POST) {
		if (empty($this->memberConfig['allowregister'])) {
			echo '{"success":15,"info":"系统当前不允许注册"}';
		}
		$post = I('post.');
		//用户名
		$post['username'] = I('post.username');
		//设置密码
		$post['password'] = I('post.password');
		//确认密码
		$post['password2'] = I('post.password2');
		//昵称
		$post['modelid'] = I('post.modelid');
		//验证码
		$post['yzm'] = I('post.yzm');
		
		if ($post['modelid'] == 35) {
		$post['nickname'] = "淘深房用户";
		} else {
			$post['nickname'] = "淘深房经纪人";
		}
		//确认密码
		$password2 = I('post.password2');
		$mob = $post['username'];
		$nickname = I('post.nickname');
		$yzm = I('post.yzm');
		if (empty($post['username']) || empty($post['password']) || empty($post['password2']) || empty($post['modelid']) || empty($post['yzm'])) {
			echo '{"success":16,"info":"数据格式不完整"}';
			exit;
		}
		if (!preg_match("/^1[34578]{1}\d{9}$/", $mob)) {
			echo '{"success":2,"info":"手机号码格式无效"}';
			exit;
		}
		if ($post['password'] != $password2) {
			echo '{"success":17,"info":"两次输入的密码不一致"}';
			exit;
		}
		//判断手机号码是否已经注册
		$db = M('member');
		$u['username'] = $mob;
		$cmob = $db->where($u)->find();
		if ($cmob) {
			echo '{"success":25,"info":"手机号码已经存在"}';
			exit;
		}
		//验证手机号码
		$url = "http://www.taoshenfang.com/index.php?g=api&m=sms&a=check_yzm&mob=" . $mob . "&yzm=" . $yzm;
		$res = file_get_contents($url);
		$res = json_decode($res, true);
		if ($res['success'] != 7) {
			echo '{"success":18,"info":"手机验证码验证不通过"}';
			exit;
		}
		$info = $this->memberDb->token(false)->create($post);
		if ($info) {
			//模型选择,如果是关闭模型选择，直接赋值默认模型
			if ((int)$this->memberConfig['choosemodel']) {
				if (!isset($info['modelid']) || empty($info['modelid'])) {
					$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
				} else {
					//检查模型id是否合法
					if (!isset($this->memberModel[$info['modelid']])) {
						$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
					}
				}
			} else {
				$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
			}
			if (empty($info['modelid'])) {
				echo '{"success":16,"info":"数据格式不完整"}';
				exit;
			}
			$userid = service("Passport")->userRegister($info['username'], $info['password']);
			if ($userid > 0) {
				//获取用户信息
				$memberinfo = service("Passport")->getLocalUser((int)$userid);
				$info['username'] = $memberinfo['username'];
				$info['password'] = $memberinfo['password'];
				//新注册用户积分
				$info['point'] = $this->memberConfig['defualtpoint'] ? $this->memberConfig['defualtpoint'] : 0;
				//新会员注册默认赠送资金
				$info['amount'] = $this->memberConfig['defualtamount'] ? $this->memberConfig['defualtamount'] : 0;
				//计算用户组
				$info['groupid'] = $this->memberDb->get_usergroup_bypoint($info['point']);
				//新会员注册需要管理员审核
                if ($this->memberConfig['registerverify']) {
                    $info['checked'] = 0;
                } else {
                    $info['checked'] = 1;
                }
				if (false !== $this->memberDb->where(array('userid' => $memberinfo['userid']))->save($info)) {
					//注册登陆状态
					service("Passport")->loginLocal($post['username'], $post['password']);
					//tag 行为
					tag('action_member_registerend', $memberinfo);
					echo '{"success":20,"info":"会员注册成功","userid":' . $userid . '}';
					exit;
				} else {
					//删除
					service("Passport")->userDelete($memberinfo['userid']);
					echo '{"success":21,"info":"会员注册失败"}';
					exit;
				}
			} else {
				$this->error(service("Passport")->getError() ? : '帐号注册失败！');
			}
		} else {
			echo '{"success":22,"info":"会员注册失败"}';
			exit;
		}
	} else {
		echo '{"success":23,"info":"非法请求"}';
		exit;
	}
}
//ajax验证用户名是否可用
public function checkUsername() {
	$username = I('request.username');
	$status = service("Passport")->userCheckUsername($username);
	if ($status > 0) {
		$this->success('用户名可以使用！');
	} else {
		$this->error(service('Passport')->getError() ? : '用户名验证有误！');
	}
}
//ajax验证用户名是否存在
public function checkUsername2() {
	$username = I('request.username');
	$status = service("Passport")->userCheckUsername($username);
	if ($status == 0) {
		echo '{"status":1}';
	} else {
		echo '{"status":0}';
	}
}
//检查昵称
public function checkNickname() {
	$nickname = I('request.nickname');
	if (false == isMax($nickname, 12)) {
		$this->error('不能超过12个字母或6个汉字！');
	}
	if ($this->memberDb->where(array('nickname' => $nickname))->getField('nickname')) {
		$this->error('该昵称已经存在！');
	}
	$this->success('该昵称可以使用！');
}
//执行密码重置
public function resetPassword() {
	$postKey = I('post.key');
	$key = \Libs\Util\Encrypt::authcode($postKey);
	if (empty($key)) {
		$this->message(array('error' => 1100, 'info' => '本次请求已经失效，请从新提交密码找回申请。',));
	}
	$userinfo = explode('|', $key);
	//密码
	$password = I('post.password', '', 'trim');
	$password2 = I('post.password2', '', 'trim');
	if (empty($password)) {
		$this->error('请输入新密码！');
	}
	//密码确认
	if ($password != $password2) {
		$this->message(array('error' => 1014, 'info' => '两次输入密码不相同，请从新输入！',));
	}
	$status = service("Passport")->userEdit($userinfo[1], '', $password, '', 1);
	if ($status > 0) {
		$this->message(10000, array(), true);
	} else {
		switch ($status) {
			case -1:
				$this->error('旧密码不正确！');
			break;
			case -7:
				$this->error('没有做任何修改！');
			break;
			case -8:
				$this->error('该用户受保护无权限更改！');
			break;
			default:
				$this->error('密码重置失败！');
			break;
		}
	}
}
//connect登陆注册
public function connectregister() {
	//获取应用类型
	$connect_app = session('connect_app');
	//授权过期时间
	$connect_expires = session('connect_expires');
	//oppid
	$connect_openid = session('connect_openid');
	//授权码
	$access_token = session('access_token');
	$curl = new \Curl();
	//授权的相关信息
	$connect = array();
	switch ($connect_app) {
		case "qq":
			$this->qq_akey = $this->memberConfig['qq_akey'];
			$this->qq_skey = $this->memberConfig['qq_skey'];
			$connect['name'] = "QQ授权登陆";
			//取得授权用户基本信息
			$sUrl = "https://graph.qq.com/user/get_user_info?";
			$aGetParam = array("access_token" => $access_token, "oauth_consumer_key" => $this->qq_akey, "openid" => $connect_openid, "format" => "json");
			$user_info = $curl->get($sUrl . http_build_query($aGetParam));
			//把json数据转换为数组
			$user_info = json_decode($user_info, true);
			$connect['userinfo'] = $user_info;
			$connect['userinfo']['name'] = $user_info['nickname'];
		break;
		case "sina_weibo":
			$connect['name'] = "新浪微博授权登陆";
			//取得授权用户基本信息
			$sUrl = "https://api.weibo.com/2/users/show.json?";
			$aGetParam = array("access_token" => $access_token, "uid" => $connect_openid,);
			$user_info = $curl->get($sUrl . http_build_query($aGetParam));
			//把json数据转换为数组
			$user_info = json_decode($user_info, true);
			$connect['userinfo'] = $user_info;
		break;
		default:
			$this->error('授权类型不存在！');
		break;
	}
	//提交注册
	if (IS_POST) {
		$post = I('post.');
		//用户名
		$post['username'] = I('post.username');
		//设置密码
		$post['password'] = I('post.password');
		if (empty($post['password'])) {
			$this->message(20024, array(), 'error');
		}
		if (false == isMin($post['password'], 6)) {
			$this->message(20025, array(), 'error');
		}
		//确认密码
		$password2 = I('post.password2');
		if ($post['password'] != $password2) {
			$this->message(20021, array(), 'error');
		}
		//昵称
		$post['nickname'] = I('post.nickname');
	
		$info = $this->memberDb->token(false)->create($post);
		if ($info) {
			//默认模型
			$info['modelid'] = (int)$this->memberConfig['defaultmodelid'];
			//新会员注册需要管理员审核
			$info['checked'] = 1;
			if (empty($info['modelid'])) {
				$this->error('请选择会员模型！');
			}
			$userid = service("Passport")->userRegister($info['username'], $info['password']);
			if ($userid > 0) {
				//获取用户信息
				$memberinfo = service("Passport")->getLocalUser((int)$userid);
				$info['username'] = $memberinfo['username'];
				$info['password'] = $memberinfo['password'];
				//新注册用户积分
				$info['point'] = $this->memberConfig['defualtpoint'] ? $this->memberConfig['defualtpoint'] : 0;
				//新会员注册默认赠送资金
				$info['amount'] = $this->memberConfig['defualtamount'] ? $this->memberConfig['defualtamount'] : 0;
				//计算用户组
				$info['groupid'] = $this->memberDb->get_usergroup_bypoint($info['point']);
				if (false !== $this->memberDb->where(array('userid' => $memberinfo['userid']))->save($info)) {
					//进行帐号绑定
					$data = array('openid' => $connect_openid, 'uid' => $memberinfo['userid'], 'app' => $connect_app, 'accesstoken' => $access_token, 'expires' => $connect_expires,);
					$Connect = D('Member/Connect');
					if ($Connect->isUserAuthorize($access_token, $connect_app)) {
						//绑定过，无需绑定
						
					} else {
						//绑定
						$Connect->connectAdd($data);
					}
					//注册登陆状态
					service("Passport")->loginLocal($post['username'], $post['password'], 86400);
					$this->message(array('info' => '会员注册成功！', 'error' => 10000,));
				} else {
					//删除
					service("Passport")->userDelete($memberinfo['userid']);
					$this->error("会员注册失败！");
				}
			} else {
				switch ($userid) {
					case -1:
						$this->message(array('info' => '用户名不合法', 'error' => - 1,), array(), 'error');
					break;
					case -2:
						$this->message(array('info' => '包含不允许注册的词语', 'error' => - 2,), array(), 'error');
					break;
					case -3:
						$this->message(1011, array(), 'error');
					break;
					case -4:
						$this->message(4, array(), 'error');
					break;
					case -6:
						$this->message(20011, array(), 'error');
					break;
					default:
					break;
				}
			}
		} else {
			$this->error($this->memberDb->getError());
		}
	} else {
		$count = $this->memberDb->where(array('checked' => 1))->count('userid');
		//取出人气高的8位会员
		$heat = $this->memberDb->where(array('checked' => 1))->order(array('heat' => 'DESC'))->field('userid,username,heat')->limit(12)->select();
		$this->assign('heat', $heat);
		$this->assign('count', $count);
		$this->assign("connect", $connect);
		$this->display("Connect:" . $connect_app);
	}
}
//帐号绑定
public function connectbinding() {
	//获取应用类型
	$connect_app = session('connect_app');
	//授权过期时间
	$connect_expires = session('connect_expires');
	//oppid
	$connect_openid = session('connect_openid');
	//授权码
	$access_token = session('access_token');
	//登陆用户名
	$loginName = I('post.loginName', '', 'trim');
	//登陆密码
	$password = I('post.password', '', 'trim');
	if (empty($connect_app) || empty($access_token) || empty($connect_openid)) {
		$this->error("请先授权！");
	}
	if (empty($loginName) || empty($password)) {
		$this->error('请输入需要绑定的帐号密码！');
	}
	//获取需要帮的用户信息，同时验证密码
	$userInfo = service("Passport")->getLocalUser($loginName, $password);
	if (false == $userInfo || empty($userInfo)) {
		$this->error('帐号不存在或者帐号密码错误！');
	}
	//检查帐号状态
	if (!$userInfo['checked']) {
		$this->error('该帐号还未通过审核，无法进行绑定！');
	}
	$Connect = D('Member/Connect');
	if ($Connect->isUserAuthorize($access_token, $connect_app)) {
		$this->error("该帐号已经绑定过，无法重新绑定！");
	}
	//进行绑定
	$data = array('openid' => $connect_openid, 'uid' => $userInfo['userid'], 'app' => $connect_app, 'accesstoken' => $access_token, 'expires' => $connect_expires,);
	if ($Connect->connectAdd($data)) {
		service("Passport")->loginLocal($loginName, $password, 86400);
		session('connect_app', NULL);
		$this->success('帐号绑定成功！', U("Member/Index/index"));
	} else {
		$this->error($Connect->getError());
	}
}
//执行找回密码生成对应邮件发送KEY
public function doLostPassword() {
	//登陆用户名
	$loginName = I('post.loginName', '', 'trim');
	if (empty($loginName)) {
		$this->error('登陆用户名不能为空！');
	}
	//验证码
	$vCode = I('post.vCode', '', 'trim');
	if (false == $this->verify($vCode, 'lostpassword')) {
		$this->message(20031);
	}
	//取得用户资料
	$userInfo = $this->memberDb->getUserInfo($loginName, 'userid,username');
	if (empty($userInfo)) {
		$this->message(array('error' => 1012, 'info' => '该用户不存在！',));
	}
	
	$this->message(1000, $userInfo, true);
}

}
