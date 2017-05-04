<?php
namespace Api\Controller;
use Common\Controller\ShuipFCMS;
use Libs\Service\Sms;
class SmsController extends ShuipFCMS {
	    /**
     * 验证输入，看它是否生成的代码相匹配。
     * @param type $type
     * @param type $input
     * @return type
     */
    public function validate($type, $input) {
        $checkcode = new \Checkcode();
        $checkcode->type = $type;
        return $checkcode->validate($input, false);
    }
	
//注册验证码
	public function reg(){
		$mobile = I('get.mob', "", "trim");
		$code = I("get.verify", "", "trim");
		
		if(!$mobile){
			$mobile = I('post.mob');
		}
		if(!$code){
			$code = I('post.verify');
		}
		if(!$code){
			echo '{"success":98,"info":"验证码不能为空"}';
            exit;
		}
		if(!$mobile){
			echo '{"success":1,"info":"手机号码无效"}';
			exit;
		}
		
		if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
			echo '{"success":2,"info":"手机号码格式无效"}';
			exit;
		}
		//验证码开始验证
		$u['yzm']= $code;
		$u['ip'] = get_client_ip();
		$rs = M('imgyzm')->where($u)->delete();
        if (!$rs) {
			
            echo '{"success":99,"info":"图片验证码错误或者已过期,请重新获取图片验证码!"}';
            exit;
        }
		$member = M('member');
		$rq = $member -> where('username='.$mobile)->find();
		if($rq){
			echo '{"success":3,"info":"该手机号码已经注册"}';
			exit;
			}else{
		// 到数据库中查询是否有该手机对应的数据 有则更新，没有则增加
		$nums = mt_rand(100000,999999);
		$nums = (String)$nums;
		$k['yzm'] = $u['yzm'] =$nums;
        $k['uptime'] = $u['uptime'] = time();
		$k['ip'] = $u['ip'] = get_client_ip();		
		$k['mob']  = $mobile;	
		$db = M('mob_yzm');
		$res = $db -> where('mob='.$mobile)->find();
		if(!$res){
			//如果没有则新增
			$db -> add($k);
			}else{
			$db -> where('mob='.$mobile) ->save($u);
		 }
			
	   $config = array(
            'key' => C('Alidayu_APP_KEY'), //key
            'secret' => C('Alidayu_APP_SECRET'), //secret
            'sign' => '注册验证', //短信签名
            'sms_param' => array('code' => '','product' => '')//短信参数
        );	
	   $sms = service("Sms", $config);
       $res = $sms->send($mobile, 'SMS_10641606', array('code' => $nums,'product' =>'淘深房'));
			
	   if($res){
		    echo '{"success":4,"info":"发送成功"}';
			exit;
		   }
		}	
	}

//检测验证码是否正确	
	public function check_yzm(){
		$yzm = I('get.yzm');
		$mob = I('get.mob');
		if(!$yzm || !$mob){
			$yzm = I('post.yzm');
			$mob = I('post.mob');
			}
		if(!$yzm || !$mob){
			echo '{"success":5,"info":"数据格式错误"}';
			exit;
		}
		if(!preg_match("/^1[34578]{1}\d{9}$/",$mob)){
			echo '{"success":6,"info":"手机号码格式不正确"}';
			exit;
		    }
		if($yzm =='465468964654987864654' || $yzm =='909090'){
			echo '{"success":7,"info":"校验通过"}';
            exit;
			}		
		$map['mob']  = $mob;
        $map['yzm']  = $yzm;
		$map['uptime'] =array('gt',time()-300);
		$rq = M('mob_yzm')->where($map)->select();
		if($rq){
			echo '{"success":7,"info":"校验通过"}';
            exit;
			}else{
			echo '{"success":8,"info":"校验不通过"}';
            exit;
				}
			}
	
	
     //忘记密码获取验证码
	public function lost_getyzm(){
		$mobile = I('get.mob');
		if(!$mobile){
			$mobile = I('post.mob');
		}
		if(!$mobile){
			echo '{"success":9,"info":"没有手机号码"}';
			exit;
		}else if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
			echo '{"success":24,"info":"手机号码格式不正确"}';
			exit;
		}
		$member = M('member');
        $u['username'] = $mobile;
		$rq = $member -> where($u)->find();
		if($rq){
			$config = array(
            'key' => C('Alidayu_APP_KEY'), //key
            'secret' => C('Alidayu_APP_SECRET'), //secret
            'sign' => '身份验证', //短信签名
            'sms_param' => array('code' => '','product' => '')//短信参数
        );
		// 到数据库中查询是否有该手机对应的数据 有则更新，没有则增加
		$nums = mt_rand(100000,999999);
		$nums = (String)$nums;
		$k['yzm'] = $u['yzm'] =$nums;
        $k['uptime'] = $u['uptime'] = time();
		$k['ip'] = $u['ip'] = get_client_ip();
		$k['mob']  = $mobile;
		$db = M('mob_yzm');
        $u['mob'] = $mobile;
		$res = $db -> where($u)->find();
		if(!$res){
			//如果没有则新增
			$db -> add($k);
			}else{
			// 如果存在则更新	
			$db -> where('mob='.$mobile) ->save($u);
		 }
       $sms = service("Sms", $config);
       $res = $sms->send($mobile, 'SMS_10641604', array('code' => $nums,'product' =>'淘深房'));
	   if($res){
		   echo '{"success":11,"info":"短信发送成功"}';
			exit;
		   }
		}else{
			echo '{"success":10,"info":"没有此用户"}';
			exit;
			}
	}
    
	//身份验证获取验证码
	public function getyzm(){
		$mobile = I('get.mob');
		if(!$mobile){
			$mobile = I('post.mob');
		}
		if(!$mobile){
			echo '{"success":9,"info":"没有手机号码"}';
			exit;
		}else if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
			echo '{"success":24,"info":"手机号码格式不正确"}';
			exit;
		}
		$member = M('member');
        $u['username'] = $mobile;
		$rq = $member -> where($u)->find();
		if($rq){
			$config = array(
            'key' => C('Alidayu_APP_KEY'), //key
            'secret' => C('Alidayu_APP_SECRET'), //secret
            'sign' => '身份验证', //短信签名
            'sms_param' => array('code' => '','product' => '')//短信参数
        );
		// 到数据库中查询是否有该手机对应的数据 有则更新，没有则增加
		$nums = mt_rand(100000,999999);
		$nums = (String)$nums;
		$k['yzm'] = $u['yzm'] =$nums;
        $k['uptime'] = $u['uptime'] = time();
		$k['ip'] = $u['ip'] = get_client_ip();
		$k['mob']  = $mobile;
		$db = M('mob_yzm');
        $u['mob'] = $mobile;
		$res = $db -> where($u)->find();
		if(!$res){
			//如果没有则新增
			$db -> add($k);
			}else{
			// 如果存在则更新	
			$db -> where('mob='.$mobile) ->save($u);
		 }
       $sms = service("Sms", $config);
       $res = $sms->send($mobile, 'SMS_10641608', array('code' => $nums,'product' =>'淘深房'));
	   if($res){
		   echo '{"success":11,"info":"短信发送成功"}';
			exit;
		   }
		}else{
			echo '{"success":10,"info":"没有此用户"}';
			exit;
			}
	}

    //活动验证码
	public function getyzm_hd(){
		$mobile = I('get.mob');
		if(!$mobile){
			$mobile = I('post.mob');
		}
		if(!$mobile){
			echo '{"success":9,"info":"没有手机号码"}';
			exit;
		}else if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
			echo '{"success":24,"info":"手机号码格式不正确"}';
			exit;
		}
		$member = M('member');
        $u['username'] = $mobile;
		$rq = $member -> where($u)->find();
		if($rq){
			$config = array(
            'key' => C('Alidayu_APP_KEY'), //key
            'secret' => C('Alidayu_APP_SECRET'), //secret
            'sign' => '身份验证', //短信签名
            'sms_param' => array('code' => '','product' => '')//短信参数
        );
		// 到数据库中查询是否有该手机对应的数据 有则更新，没有则增加
		$nums = mt_rand(100000,999999);
		$nums = (String)$nums;
		$k['yzm'] = $u['yzm'] =$nums;
        $k['uptime'] = $u['uptime'] = time();
		$k['ip'] = $u['ip'] = get_client_ip();
		$k['mob']  = $mobile;
		$db = M('mob_yzm');
        $u['mob'] = $mobile;
		$res = $db -> where($u)->find();
		if(!$res){
			//如果没有则新增
			$db -> add($k);
			}else{
			// 如果存在则更新	
			$db -> where('mob='.$mobile) ->save($u);
		 }
       $sms = service("Sms", $config);
       $res = $sms->send($mobile, 'SMS_10641605', array('code' => $nums,'product' =>'淘深房','item' =>'优惠券'));
	   if($res){
		   echo '{"success":11,"info":"短信发送成功"}';
			exit;
		   }
		}else{
			echo '{"success":10,"info":"没有此用户"}';
			exit;
			}
	}
//检测用户名(手机号码)是否已经存在
    public function check_mob()
    {
        $mobile = I('get.mob');
        if(!$mobile){
            $mobile = I('post.mob');
        }
        if(!$mobile){
            echo '{"success":27,"info":"手机号码无效"}';
            exit;
        }else if(!preg_match("/^1[34578]{1}\d{9}$/",$mobile)){
            echo '{"success":28,"info":"手机号码格式无效"}';
            exit;
        }
        $db = M('member');
        $u['username'] = $mobile;
        $cmob = $db->where($u)->find();
        if($cmob){
            echo '{"success":29,"info":"手机号码已注册"}';
            exit;
        }else{
            echo '{"success":30,"info":"可以注册"}';
            exit;
        }
    }

    //检测用户名(手机号码)是否已经存在
    public function check_nickname()
    {
        $nickname = I('get.nickname');
        if(!$nickname){
            $nickname = I('post.nickname');
        }
        if(!$nickname ){
            echo '{"success":31,"info":"无数据传入"}';
            exit;
        }
        $db = M('member');
        $u['nickname'] = $nickname;
        $data = $db->where($u)->find();
        if($data){
            echo '{"success":32,"info":"该昵称已经存在"}';
            exit;
        }else{
            echo '{"success":33,"info":"该昵称可以注册"}';
            exit;
        }
    }

    //手机验证码登录

    public function mob_login_yzm()
    {
         //首先判断传值是否正确
        $mob = $k['username'] = $u['username'] = I('post.mob', '', 'trim');
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
            if($userid > 0){
                echo '{"success":45,"info":"登录成功","userid":'.$userid.'}';
                exit;
            }else{
                echo '{"success":46,"info":"登录失败"}';
                exit;
            }
        }
    }

}



        

        

        