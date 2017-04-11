<?php

// +----------------------------------------------------------------------
// | 淘深房 获取当前登陆信息
// +----------------------------------------------------------------------

namespace Api\Controller;

use Common\Controller\Base;

class UserController extends Base {

    //用户id
    protected $userid = 0;
    //用户名
    protected $username = NULL;
    //用户信息
    protected $userinfo = array();

    protected function _initialize() {
        parent::_initialize();
        $this->userid = (int) service("Passport")->userid;
        $this->username = service("Passport")->username;
        $this->userinfo = service("Passport")->getInfo();
    }

    //jsonp/json的方式获取当前登陆信息
    public function getuser() {
        $data = array(
            'userid' => $this->userid,
            'username' => $this->username,
            //昵称
            'nickname' => $this->userinfo['nickname'],
            //头像地址
            'avatar' => $this->userid ? service("Passport")->getUserAvatar((int) $this->userid, 45) : '',
            //分享总数
            'dance_num' => $this->userinfo['share'],
            //状态
            'status' => $this->userid ? true : false,
        );
        $callback = I('request.callback', '');
        if (empty($callback)) {
            $type = 'JSON';
        } else {
            $type = 'JSONP';
            C('VAR_JSONP_HANDLER', 'callback');
        }
        $this->ajaxReturn($data, $type);
    }
	
	//保存基本信息
    public function api_doprofile() {
		if(IS_POST){
			if($_POST['realname']=="" && $_POST['sex']=="" && $_POST['about']=="" && $_POST['cardnumber']=="" && $_POST['worktime']==""&& $_POST['mainarea']=="" && $_POST['leixing']=="" && $_POST['coname']=="" && $_POST['sfzpic']==""){
				echo '{"success":60,"info":"至少修改一项"}';
			    exit;
				}
				
			$userid = $_POST['userid'];
			if($_POST['modelid']==35){
				$db = M('member_normal');	
			}else{
				$db = M('member_agent');
			}
			$find = $db->where('userid='.$userid)->find();
			if(!$find){
				$db->add(array("userid" => $userid));
			}
			//修改真实姓名
			if($_POST['realname']!=""){
				if($_POST['modelid']==""){
					echo '{"success":93,"info":"数据不完整"}';
			    	exit;	
				}else{
					
					$data['realname'] = $_POST['realname'];
				}
			   
			}
			//修改性别
            if($_POST['sex']!=""){
				$db = M('member');
			   $data['sex'] = (int)$_POST['sex'];
				}
			//修改个人介绍
			if($_POST['about']!=""){
				$db = M('member');
			   $data['about'] = $_POST['about'];
				}
			//修改身份证号码
			if($_POST['cardnumber']!=""){
				$db = M('member_agent');
			   $data['cardnumber'] = $_POST['cardnumber'];
				}
			//修改身份证照片		
			if($_POST['sfzpic']){
				//$_POST['sfzpic']=json_decode($_POST['sfzpic'],true);
				$data['sfzpic'] = $_POST['sfzpic'];//serialize($_POST['sfzpic']);
			}
			//修改从业年限
			if($_POST['worktime']!=""){
				$db = M('member_agent');
			   $data['worktime'] = $_POST['worktime'];
				}
			//修改主营区域
			if($_POST['mainarea']!=""){
				$db = M('member_agent');
			   $data['mainarea'] = $_POST['mainarea'];
				}
			//修改职业类型
			if($_POST['leixing']!=""){
				$db = M('member_agent');
			   $data['leixing'] = $_POST['leixing'];
				}				
			//修改公司名称
			if($_POST['coname']!=""){
				$db = M('member_agent');
			   $data['coname'] = $_POST['coname'];
				}
				
			
			$rs = $db->where(array("userid" => $userid))->save($data);
			if (isset($rs)) {
                echo '{"success":54,"info":"个人信息修改成功"}';
			    exit;
            } else {
                echo '{"success":55,"info":"个人信息修改失败"}';
			    exit;
            }
		}
	}
	
	//保存用户头像
    public function api_uploadavatar() {
		$userid = $_POST['userid'];
		
        //头像保存目录
        $dir = C("UPLOADFILEPATH") . service("Passport")->getAvatarPath($userid);
		 
        //实例化上传类
        $UploadFile = new \UploadFile(array(
            'allowExts' => array('jpg'),
            'uploadReplace' => true,
        ));
		
		$upList = array('__avatar1');
        //保存文件名
        $upNameList = array('180x180');
		
        foreach ($upList as $i => $key) {
            if (!isset($_FILES[$key])) {
                continue;
            }
            $_FILES[$key]['name'] .= '.jpg';
            //设置保存文件名
            $UploadFile->saveRule = $userid . '_' . $upNameList[$i];
            //上传头像
            $file = $UploadFile->uploadOne($_FILES[$key], $dir);
            if ($file === false) {
                exit(json_encode(array(
                    'success' => false,
                    'msg' => $UploadFile->getErrorMsg(),
                )));
                break;
            } else {
                service('Attachment')->movingFiles($file['savepath'] . $file['savename'], $file['savepath'] . $file['savename']);
            }
        }
	$u['userpic'] ="http://www.taoshenfang.com/d/file/avatar/000/00/00/".$userid."_180x180.jpg?".time() ;
	
		M('member')->where('userid='.$userid)->save($u);
			exit(json_encode(array(
				'success' => true,
				'avatarUrls' => $u['userpic'],
			)));
		
		
    }
	
	//上传单张图片
	public function uploadimg() {
        if (IS_POST) {
            //回调函数
            $Callback = false;
            //用户ID
            $upuserid = I('post.userid');
            //取得栏目ID
            $catid = I('post.catid');
            //取得模块名称
            $module = I('post.module');
            //获取附件服务
			
            $Attachment = service("Attachment", array('module' => $module, 'catid' => $catid, 'userid' => $upuserid));
			
            //缩略图宽度
            $thumb_width = I('post.thumb_width');
            $thumb_height = I('post.thumb_height');
            //图片裁减相关设置，如果开启，将不保留原图
            if ($thumb_width && $thumb_height) {
                $Attachment->thumb = true;
                $Attachment->thumbRemoveOrigin = true;
                //设置缩略图最大宽度
                $Attachment->thumbMaxWidth = $thumb_width;
                //设置缩略图最大高度
                $Attachment->thumbMaxHeight = $thumb_height;
            }
            //是否添加水印  post:watermark_enable 等于1也需要加水印
            if (I('post.watermark_enable')) {
                $Callback = array(
                    array("\\Attachment\\Controller\\AttachmentsController", "water"),
                );
            }

            //开始上传
            $info = $Attachment->upload($Callback);
            if ($info) {
                if (in_array(strtolower($info[0]['extension']), array("jpg", "png", "jpeg", "gif"))) {
                    // 附件ID 附件网站地址 图标(图片时为1) 文件名
                    //echo "{$info[0]['aid']}," . $info[0]['url'] . "," . str_replace(array("\\", "/"), "", $info[0]['name']);
					$arr['aid'] = $info[0]['aid'];
					$arr['url'] = $info[0]['url'];
					$arr['picname'] = $info[0]['name'];
					echo json_encode($arr,JSON_UNESCAPED_UNICODE);
                    exit;
                }
            } else {
                //上传失败，返回错误
                exit("0," . $Attachment->getErrorMsg());
            }
        } else {
            exit("0,上传失败！");
        }
    }
	
	//获取经纪人列表
	public function jjrlist(){
		$db = M('member_agent');
		if($_POST['ct'] != ""){
			$sql .= "mainarea like '%".$_POST['ct']."%'"; 
		}
		if($_POST['bq'] != ""){
			if($sql){
				$sql .= " and biaoqian like '%".$_POST['bq']."%'"; 
			}else{
				$sql .= "biaoqian like '%".$_POST['bq']."%'"; 
			}		
		}
		if($_POST['kw'] != ""){
			if($sql){
				$sql .= " and realname like '%".$_POST['kw']."%'"; 
			}else{
				$sql .= "realname like '%".$_POST['kw']."%'"; 
			}		
		}
		if($sql){
			$list = $db->where($sql)->select();
		}else{
			$list = $db ->select();
		}
		
		foreach($list as $k => $v){
			$list[$k]['info'] = M('member')->where('userid='.$v['userid'])->find();
			if ($list[$k]['info']['userpic']=="") {
			$list[$k]['info']['userpic'] =       "http://www.taoshenfang.com/statics/extres/member/images/noavatar.jpg";
		}
			if($list[$k]['info']['vtel'] != ''){
			    $list[$k]['info']['ctel'] = cache('Config.tel400').','.$list[$k]['info']['vtel'];
				$list[$k]['info']['vtel'] = cache('Config.tel400').'转'.$list[$k]['info']['vtel']; 
			 }else{
				 $data[$k]['ctel'] =  cache('Config.tel400');
				 $data[$k]['vtel'] =  cache('Config.tel400');
			 }
			 $x['comment_id'] = 'c-88-'.$v['userid'];	
			 $list[$k]['comm_count'] = M('comments')->where($x)->count();
		 }
		echo json_encode($list);
		exit;
		}
		
//经纪人详情api		
public function jjrshow()
  {
    if(IS_GET){
      $db = M('member_agent');
      $info = $db -> where('userid='.$_GET['id']) -> find();
	  $info['sfzpic'] = 'http://www.taoshenfang.com'.$info['sfzpic'];
      $info['base'] = M('member')->where('userid='.$_GET['id']) -> Field('username,sex,about,regdate,vtel,userpic')->find();
	  		if($info['base']['vtel'] != ''){
			    $info['base']['ctel'] = cache('Config.tel400').','.$info['base']['vtel'];
				$info['base']['vtel'] = cache('Config.tel400').'转'.$info['base']['vtel']; 
			 }else{
				 $info['base']['ctel'] =  cache('Config.tel400');
				 $info['base']['vtel'] =  cache('Config.tel400');
			 }
			if ($info['base']['userpic']=="") {
			$info['base']['userpic'] =       "http://www.taoshenfang.com/statics/extres/member/images/noavatar.jpg";
		    } 
		
	$info['mainareaids'] = $info['mainarea'];		
	 if($info['mainarea']){
		 $mainarea = explode(',',$info['mainarea']);
		 $area = "";
		 foreach($mainarea as $v){
			 $area .= M('area')->where('id='.$v)->getField('name').',';
			 }
				$var = trim($area);
				$len = strlen($var)-1;
				$char = $var{$len};
				if($char==','){
				$info['mainarea'] = substr($area,0,strlen($area)-1);	
				}else{
				$info['mainarea'] = $area;		
				}	 
			 
		 }

		//fix by tianhua on 2017.03.31
		 $chenjiao_chuzu_count = M('chuzu')-> where("(username='".$info['base']['username']."' OR jjr_id='".$_GET['id']."') and zaizu=0")->count();
		 $chenjiao_ershou_count = M('ershou')-> where("(username='".$info['base']['username']."' OR jjr_id='".$_GET['id']."') and zaishou=0")->count();

		 $weituo_chuzu_count = M('chuzu')-> where("jjr_id='".$_GET['id']."' and pub_type!=1")->count();
		 $weituo_ershou_count = M('ershou')-> where("jjr_id='".$_GET['id']."' and pub_type!=1")->count();

		 $arr2 = M('yuyue') -> where("fromuser ='".$info['base']['username']."' and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= FROM_UNIXTIME(inputtime)")
		 		 -> select();
	     $arr = Array();
	     foreach($arr2 as $x=>$value){
	        $ershoudata = M("ershou") -> where('id='.$value['fromid']) -> find();
	        if(count($ershoudata) >0){
	          array_push($arr, $value);
	        }
	     }
		 
		$info['chengjiao_count']=$chenjiao_chuzu_count + $chenjiao_ershou_count;
		$info['weituo_count']=$weituo_chuzu_count + $weituo_ershou_count;
		$info['daikan_count']=count($arr);
		//end fix
        echo json_encode($info);
    }

  }	
  
  //我的预约
  public function yuyue(){
	  if(IS_POST){
		  if(!$_POST['username'] || $_POST['username']==''){
			  echo '{"success":98,"info":"非法操作"}';
				exit;
			 }
		 //update by tianhua on 2017.03.31
		 //  if($_POST['t'] == 1){
			//   $u['fromuser'] = $_POST['username'];
			// }else{
			// 	$u['username'] = $_POST['username'];
			// }
			// //$rs = M('yuyue')->where($u)->order('inputtime DESC')->select();	

			// $arr2 = M('yuyue') -> where($sql)->order('inputtime DESC') ->select();
   //      	$rs = Array();

	  //       foreach($arr2 as $k=>$value){
	  //         $data = M("ershou") -> where('id='.$value['fromid']) -> find();
	  //         if(count($data) >0){
	  //           array_push($rs, $value);
	  //         }
	  //       }

			// foreach($rs as $k=>$v){
			// 	$rs[$k]['house'] = M($v['fromtable'])->where('id='.$v['fromid'])->field('title,id')->find();	
			// }
			 $userinfo = M('member') -> where('username='.$_POST['username']) -> select();
			 if($userinfo['modelid'] == 36){
		        $sql = "fromuser=".$_POST['username'];
		      }
		      else{
		        if($_POST[t]){
		        //手机端的和客户端反了
		          if($_POST['t'] == 1){
		            $sql = "fromuser= ".$_POST['username'];
		          }else{
		            $sql = "username= ".$_POST['username'];
		          }
		        }
		      }
		      $arr2 = M('yuyue') -> where($sql) -> order('inputtime DESC')->select();
		      $arr = Array();

		      foreach($arr2 as $k=>$value){
		        $data = M("ershou") -> where('id='.$value['fromid']) -> find();
		        if(count($data) >0){
		          array_push($arr, $value);
		        }
		      }

		      foreach($arr as $k=>$v){
				$arr[$k]['house'] = M($v['fromtable'])->where('id='.$v['fromid'])->field('title,id')->find();	
			  }
			//end fix
			if($arr){				
				echo json_encode($arr);
				exit;
			}else{
				echo '{"success":99,"info":"没有预约"}';
				exit;	
			}
			
		 }
	  }
	  
	//删除预约
	public function yuyue_del(){
		if(IS_POST){
			$k['id']=$_POST['id'];
			$k['userid'] = $_POST['userid'];
			$k['username']=$_POST['username'];
			$f = M('yuyue') -> where($k)->find();
			if(!$f){
				echo '{"success":100,"info":"没有该预约"}';
				exit;	
			}else{
				if($f['lock'] == 1){
					echo '{"success":113,"info":"已锁定，不能删除"}';
					exit;
				}
			}
			$rs = M('yuyue') -> where($k)->delete();
			M('yuyue_data') -> where('id='.$_POST['id'])->delete();
			//插入history
			if($rs){
				//插入数据到history表中
				$h['catid'] = 48;
				$h['status'] = 99;
				$h['inputtime'] = $h['updatetime'] = time();
				$h['type'] = "预约";
				$h['fromid'] = $_POST['id'];
				$h['fromtable'] = "yuyue";
				$h['userid'] = $_POST['userid'];
				$h['username'] = $_POST['username'];
				$h['title'] = $_POST['username'];
				$h['action'] = "删除";
				$n = M('history')->add($h);
			
				//插入一条数据到history附表中
				$u['id'] = $n;
				$u['content'] = "";
				$u['relation'] = "";
				M('history_data')->add($u);
			}
			
			if($rs == 1 && $n){
			  echo '{"success":101,"info":"预约删除成功"}';
				exit;
			}else{
			  echo '{"success":102,"info":"预约删除失败"}';
				exit;
			}
		}
	}
	
	//确认预约
	public function yuyue_confirm(){
		if(IS_POST){
			if($_POST['username']=='' || $_POST['id']==''){
				echo '{"success":184,"info":"数据不完整"}';
				exit;
			}
			$u['fromuser'] = $_POST['username'];
			$u['id'] = $_POST['id'];
			$x['lock']=1;
			M('yuyue')->where($u)->save($x);
			echo '{"success":185,"info":"确认成功"}';
				exit;
		}
	}
	//我的关注
	public function guanzhu(){
		if(IS_POST){
		  if($_POST['username']=='' || $_POST['table']==''){
			  echo '{"success":105,"info":"数据不完整"}';
				exit;
			 }
			 $u['username'] = $_POST['username'];
			 $u['fromtable'] = $_POST['table'];
			//$rs = M('guanzhu')->where($u)->select();

			//fix by tianhua on 2017.3.29 for deleted ershou fang disply empty issue
	        $arr2 = M('guanzhu') -> where($u) ->order('updatetime DESC')-> select();
	        $rs = Array();

	        foreach($arr2 as $k=>$value){
	          $data = M($value['fromtable']) -> where('id='.$value['fromid']) -> find();
	          if(count($data) >0){
	            array_push($rs, $value);
	          }
	        }
	        //end fix
	        
			foreach($rs as $k=>$v){
				$rs[$k]['house'] = M($v['fromtable'])->where('id='.$v['fromid'])->find();
				$rs[$k]['house']['xiaoquname'] = M('xiaoqu')->where('area='.$rs[$k]['house']['area'].' and id='.$rs[$k]['house']['xiaoqu'])->getfield('title');
				$rs[$k]['house']['weizhitu'] = unserialize($rs[$k]['house']['weizhitu']);
				$rs[$k]['house']['yangbantu'] = unserialize($rs[$k]['house']['yangbantu']);
				$rs[$k]['house']['shijingtu'] = unserialize($rs[$k]['house']['shijingtu']);
				$rs[$k]['house']['loupantupian'] = unserialize($rs[$k]['house']['loupantupian']);
				$rs[$k]['house']['xiaoqutu'] = unserialize($rs[$k]['house']['xiaoqutu']);
			}
			if($rs){
				echo json_encode($rs,JSON_UNESCAPED_UNICODE);
				exit;
			}else{
				echo '{"success":106,"info":"没有关注"}';
				exit;	
			}
			
		 }
	}
	
	//取消关注
	public function guanzhu_del(){
		if(IS_POST){
			$k['id']=$_POST['id'];
			$k['userid'] = $_POST['userid'];
			$k['username']=$_POST['username'];
			$f = M('guanzhu') -> where($k)->find();
			if(!$f){
				echo '{"success":107,"info":"没有该关注"}';
				exit;	
			}
			$rs = M('guanzhu') -> where($k)->delete();
			$rs1 = M('guanzhu_data') -> where('id='.$_POST['id'])->delete();
			if($rs && $rs1){
			  echo '{"success":108,"info":"取消关注成功"}';
				exit;
			}else{
			  echo '{"success":109,"info":"取消关注失败"}';
				exit;
			}
		}
	}
	
	//根据房子id和房子表名获取对应的标题和url
	public function get_house_bt(){
		if(IS_POST){
			if($_POST['id'] == '' || $_POST['table'] == ''){
				echo '{"success":103,"info":"数据不完整"}';
				exit;
			}	
			$rs = M($_POST['table'])->where('id='.$_POST['id'])->field('title,url')->find();
			if($rs){
				echo json_encode($rs);
				exit;
			}else{
				echo '{"success":104,"info":"没有此房源数据"}';
				exit;
			}
		}	
	}
	
	//用户发布求租
	public function qiuzu_add(){
		if(IS_POST)	{
			if($_POST['province'] == '' || $_POST['city'] == '' || $_POST['area'] == '' || $_POST['zulin'] == '' || $_POST['shi'] == '' || $_POST['zujinrange'] == '' || $_POST['chenghu'] == '' || $_POST['username'] == ''){
				echo '{"success":110,"info":"数据不完整"}';
				exit;
			}
			
			$db = M('userqiuzu');
			$data = $db->create($_POST);
			$data['catid'] = 55;
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
			  echo '{"success":111,"info":"发布求租成功"}';
				exit;
			} else {
			  echo '{"success":112,"info":"发布求租失败"}';
				exit;
			}
		}
	}
	
	//我要租房/求租管理
	public function qiu_list(){
		if(IS_POST){
			if($_POST['username'] != ''){
				$k['username'] = $_POST['username'];
				
			}
			if($_POST['jjrid'] != ''){
				$k['jjrid'] = $_POST['jjrid'];				
			}
			if(!$k || !$_POST['table']){
				echo '{"success":114,"info":"非法操作"}';
				exit;
			}
			
			$rs = M($_POST['table'])->where($k)->order('updatetime DESC')->select();
			foreach($rs as $a=>$v){
				$rs[$a]['province_name'] = M('area')->where('id='.$v['province'])->getField('name');
			$rs[$a]['city_name'] = M('area')->where('id='.$v['city'])->getField('name');
			$rs[$a]['area_name'] = M('area')->where('id='.$v['area'])->getField('name');
			}
			if($rs){
				echo json_encode($rs);
				exit;
			}else{
				echo '{"success":115,"info":"无信息"}';
				exit;
			}
		}
	}
	
	//删除求租
	public function qiuzu_del(){
		if(IS_POST){
			$k['id']=$_POST['id'];
			$k['username']=$_POST['username'];
			$f = M('userqiuzu') -> where($k)->find();
			if(!$f){
				echo '{"success":116,"info":"没有该求租信息"}';
				exit;	
			}else{
				if($f['lock'] == 1){
					echo '{"success":117,"info":"已锁定，不能删除"}';
					exit;
				}
			}
			$rs = M('userqiuzu') -> where($k)->delete();
			M('userqiuzu_data') -> where('id='.$_POST['id'])->delete();
			//插入history
			if($rs){
				//插入数据到history表中
				$h['catid'] = 48;
				$h['status'] = 99;
				$h['inputtime'] = $h['updatetime'] = time();
				$h['type'] = "求租";
				$h['fromid'] = $_POST['id'];
				$h['fromtable'] = "userqiuzu";
				$h['userid'] = $_POST['userid'];
				$h['username'] = $_POST['username'];
				$h['title'] = $_POST['username'];
				$h['action'] = "删除";
				$n = M('history')->add($h);
			
				//插入一条数据到history附表中
				$u['id'] = $n;
				$u['content'] = "";
				$u['relation'] = "";
				M('history_data')->add($u);
			}
			
			if($rs == 1 && $n){
			  echo '{"success":118,"info":"删除成功"}';
				exit;
			}else{
			  echo '{"success":119,"info":"删除失败"}';
				exit;
			}
		}	
	}
	
	//用户发布求购
	public function qiugou_add(){
		if(IS_POST)	{
			if($_POST['province'] == '' || $_POST['city'] == '' || $_POST['area'] == '' || $_POST['shi'] == '' || $_POST['zongjiarange'] == '' || $_POST['chenghu'] == '' || $_POST['username'] == ''){
				echo '{"success":120,"info":"数据不完整"}';
				exit;
			}
			
			$db = M('userqiugou');
			$data = $db->create($_POST);
			$data['catid'] = 56;
			$data['status'] = 1;
			$data['updatetime'] = $data['inputtime'] = time();
			$data['lock'] = 0;
			$rs = $db->add($data);
			if ($rs) {          
			  //插入一条数据到附表中
			  $u['id'] = $rs;
			  $u['content'] = "";
			  $u['relation'] = "";
			  $rs1 = M('userqiugou_data')->add($u);
			}
			if ($rs && $rs1 ) {
			  echo '{"success":121,"info":"发布求购成功"}';
				exit;
			} else {
			  echo '{"success":122,"info":"发布求购失败"}';
				exit;
			}
		}
	}
	
	//我要卖房/求购列表
	public function qiugou(){
		if(IS_POST){
			if($_POST['username'] == ''){
				echo '{"success":123,"info":"非法操作"}';
				exit;
			}
			$k['username'] = $_POST['username'];
			$rs = M('userqiugou')->where($k)->order('updatetime DESC')->select();
			if($rs){
				echo json_encode($rs);
				exit;
			}else{
				echo '{"success":124,"info":"获取列表失败"}';
				exit;
			}
		}
	}
	
	//删除求购
	public function qiugou_del(){
		if(IS_POST){
			$k['id']=$_POST['id'];
			$k['username']=$_POST['username'];
			$f = M('userqiugou') -> where($k)->find();
			if(!$f){
				echo '{"success":125,"info":"没有该求租信息"}';
				exit;	
			}else{
				if($f['lock'] == 1){
					echo '{"success":126,"info":"已锁定，不能删除"}';
					exit;
				}
			}
			$rs = M('userqiugou') -> where($k)->delete();
			M('userqiugou_data') -> where('id='.$_POST['id'])->delete();
			//插入history
			if($rs){
				//插入数据到history表中
				$h['catid'] = 48;
				$h['status'] = 99;
				$h['inputtime'] = $h['updatetime'] = time();
				$h['type'] = "求购";
				$h['fromid'] = $_POST['id'];
				$h['fromtable'] = "userqiugou";
				$h['userid'] = $_POST['userid'];
				$h['username'] = $_POST['username'];
				$h['title'] = $_POST['username'];
				$h['action'] = "删除";
				$n = M('history')->add($h);
			
				//插入一条数据到history附表中
				$u['id'] = $n;
				$u['content'] = "";
				$u['relation'] = "";
				M('history_data')->add($u);
			}
			
			if($rs == 1 && $n){
			  echo '{"success":127,"info":"删除成功"}';
				exit;
			}else{
			  echo '{"success":128,"info":"删除失败"}';
				exit;
			}
		}	
	}
	
	//小区搜索
	public function xiaoqu_search(){
		if(IS_POST){
			if($_POST['area']=='' && $_POST['key'] == ''){
				echo '{"success":129,"info":"数据不完整"}';
				exit;	
			}
			$db = M('xiaoqu');
			$rs = $db -> where('area='.$_POST['area'].' and title like "%'.$_POST['key'].'%"') -> field('id,title') -> select();
			if($rs){
				echo json_encode($rs);
				exit;
			}else{
				echo '{"success":130,"info":"没有此小区数据"}';
				exit;	
			}
		}	
	}
	
	//发布二手房
	public function add_ershou(){
		if(IS_POST){
			if($_POST['username']=='' || $_POST['userid']=='' ||$_POST['modelid']=='' ||$_POST['title']=='' || $_POST['province']=='' || $_POST['city']=='' || $_POST['area']=='' || $_POST['xiaoquname']=='' || $_POST['jingweidu']=='' || $_POST['zongjia']==''){
				echo '{"success":133,"info":"数据不完整"}';
				exit;
			}
			if($_POST['modelid'] == 35){
				if($_POST['chenghu'] == ''||$_POST['pub_type']=='' || $_POST['hidetel']==''){
					echo '{"success":133,"info":"数据不完整"}';
					exit;
				}
			}
			if($_POST['modelid'] == 36){
				if($_POST['fangling']=='' || $_POST['jianzhumianji']=='' || $_POST['desc']==''){
					echo '{"success":133,"info":"数据不完整"}';
					exit;
				}
			}
			//图片转换			
			if($_POST['pics']){
				$_POST['pics']=json_decode($_POST['pics'],true);
				$_POST['thumb'] = $_POST['pics'][0]['url'];
				$_POST['pics'] = serialize($_POST['pics']);
			}			
			//判断小区是否存在
          $k['area'] = $_POST['area'];
          $k['title'] = $_POST['xiaoquname'];
          $r1 = M('xiaoqu')->where($k)->find();
		 
          if (!$r1) {
            //插入小区
            $k['catid'] = 54;
            $k['username'] = $_POST['username'];
			$k['status'] = 99;           
            $k['updatetime'] = $k['inputtime'] = time();
            $k['province'] = $_POST['province'];
            $k['city'] = $_POST['city'];
            $k['jingweidu'] = $_POST['jingweidu'];
            $r2 = M('xiaoqu')->add($k);
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
			 $data['username'] = $_POST['username'];
			 $data['zaishou'] = 1;
			 $data['apply_state'] = 0;
			 if($_POST['modelid'] == 35){
				$data['status'] = 1;	
			}else{
				$data['pub_type'] = 1;
				$data['jjr_id'] = $_POST['userid'];
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
		  if($_POST['modelid'] == 35){
			  if($data['pub_type'] == 1){
					 $data['lock'] = 0;
				 }else{
					 $data['lock'] = 1;
				 }
		  }else{
			  $data['lock'] = 0;
			 }
			//产权所属
			if(!$_POST['chanquansuoshu'] || $_POST['chanquansuoshu']==''){
				$data['chanquansuoshu']="共有";
			}
			//房屋用途
			if(!$_POST['fangwuyongtu'] || $_POST['fangwuyongtu']==''){
				$data['fangwuyongtu']="住宅";
			}
			//梯户比例
			if(!$_POST['tihubili'] || $_POST['tihubili']==''){
				$data['tihubili']="三梯六户";
			}
			//建筑结构
			if(!$_POST['jianzhujiegou'] || $_POST['jianzhujiegou']==''){
				$data['jianzhujiegou']="钢混结构";
			}
			//建筑类型
			if(!$_POST['jianzhutype'] || $_POST['jianzhutype']==''){
				$data['jianzhutype']="板塔结合";
			}
			//抵押信息
			if(!$_POST['diyaxinxi'] || $_POST['diyaxinxi']==''){
				$data['diyaxinxi']="无抵押";
			}
			//物业性质
			if(!$_POST['jiaoyiquanshu'] || $_POST['jiaoyiquanshu']==''){
				$data['jiaoyiquanshu']="商品房";
			}
			//房屋属性
			if(!$_POST['jiegou'] || $_POST['jiegou']==''){
				$data['jiegou']="平层";
			}
			if(!$_POST['zhuangxiu'] || $_POST['zhuangxiu']==''){
				$data['zhuangxiu']="毛坯";
			}
			if(!$_POST['chaoxiang'] || $_POST['chaoxiang']==''){
				$data['chaoxiang']="南";
			}
			//户型
			if(!$_POST['shi'] || $_POST['shi']==''){
				$data['shi']="1";
			}
			if(!$_POST['ting'] || $_POST['ting']==''){
				$data['ting']="1";
			}
			if(!$_POST['wei'] || $_POST['wei']==''){
				$data['wei']="1";
			}
			//楼层
			if(!$_POST['ceng'] || $_POST['ceng']==''){
				$data['ceng']="低层";
			}
			
			$rs = $db->add($data);
			if($rs){
            //更新url地址
            $y['url'] = "/index.php?a=shows&catid=6&id=".$rs;
			//更新房源编号
			$y['bianhao'] = "S".date("Ymd").(6*10000000+$rs);
            $db-> where("id=".$rs) -> save($y);
            //插入一条数据到二手房附表中
            $u['id'] = $rs;
            $u['content'] = "";
            $u['relation'] = "";
			
            M('ershou_data')->add($u);
          }
          if ($data['xiaoqu'] && $rs ) {
            //发布成功，跳转到我的二手房页面            
            echo '{"success":134,"info":"发布成功"}';
					exit;
          }else{
            echo '{"success":135,"info":"发布失败"}';
					exit;
          }
			
		}	
	}
	
	//编辑二手房
	public function edit_ershou(){
		if(IS_POST){
			$db = M('ershou');
			//合同上传
			if($_POST['id']!='' && $_POST['contract']!=''){
				$aa['id']=$_POST['id'];
				$_POST['contract']=json_decode($_POST['contract'],true);
				$_POST['contract'] = serialize($_POST['contract']);
				$bb['contract'] = $_POST['contract'];
				$ss1 = $db->where($aa)->save($bb);
				if($ss1){
					echo '{"success":186,"info":"合同上传成功"}';
					exit;
				}
			}
			//身份证上传			
			if($_POST['id']!='' && $_POST['idcard']!=''){
				$aa['id']=$_POST['id'];
				$_POST['idcard'] = json_decode($_POST['idcard'],true);
				$_POST['idcard'] = serialize($_POST['idcard']);
				$bb['idcard'] = $_POST['idcard'];
				$ss1 = $db->where($aa)->save($bb);
				if($ss1){
					echo '{"success":187,"info":"身份证上传成功"}';
					exit;
				}
			}
			
			if($_POST['id']=='' || $_POST['username']=='' || $_POST['userid']=='' ||$_POST['modelid']=='' ||$_POST['title']=='' || $_POST['province']=='' || $_POST['city']=='' || $_POST['area']=='' || $_POST['xiaoquname']=='' || $_POST['jingweidu']=='' || $_POST['zongjia']==''){
				echo '{"success":141,"info":"数据不完整"}';
				exit;
			}
			if($_POST['modelid'] == 35){
				if($_POST['chenghu'] == ''||$_POST['pub_type']=='' || $_POST['hidetel']==''){
					echo '{"success":141,"info":"数据不完整"}';
					exit;
				}
			}
			if($_POST['modelid'] == 36){
				if($_POST['fangling']=='' || $_POST['jianzhumianji']=='' || $_POST['desc']==''){
					echo '{"success":141,"info":"数据不完整"}';
					exit;
				}
			}			
			
			$f = $db -> where($aa) -> find();
			if(!$f){
				echo '{"success":142,"info":"没有该房源"}';
				exit;
			}else{
				//fix by tianhua on 2017-04-11
				$_POST['username'] = $f["username"];
				//end fix
			}

			if($_POST['modelid'] == 35 && $f['lock'] == 1){
				echo '{"success":143,"info":"该房源已锁定"}';
				exit;
			}
			//图片转换			
			if($_POST['pics']){
				$_POST['pics']=json_decode($_POST['pics'],true);
				$_POST['thumb'] = $_POST['pics'][0]['url'];
				$_POST['pics'] = serialize($_POST['pics']);				
			}			
			//判断小区是否存在
          $k['area'] = $_POST['area'];
          $k['title'] = $_POST['xiaoquname'];
          $r1 = M('xiaoqu')->where($k)->find();
		 
          if (!$r1) {
            //插入小区
            $k['catid'] = 54;
            $k['username'] = $_POST['username'];
			$k['status'] = 99;           
            $k['updatetime'] = $k['inputtime'] = time();
            $k['province'] = $_POST['province'];
            $k['city'] = $_POST['city'];
            $k['jingweidu'] = $_POST['jingweidu'];
            $r2 = M('xiaoqu')->add($k);
            if ($r2) {
              //插入小区附表
              $u['id'] = $r2;
              $u['content'] = "";
              $u['relation'] = "";
              M('xiaoqu_data')->add($u);
            }
          }
		  		  
          $data = $db->create($_POST);
			unset($data['idcard']);
			unset($data['contract']);
		  //如果小区存在，取返回的小区id
          if ($r1) {
            $data['xiaoqu'] = $r1['id'];
          }
          //如果小区插入成功，取返回的id
          if ($r2) {
            $data['xiaoqu'] = $r2;
          }
			if($_POST['pub_type'] !=1){
			  $data['lock']=1;
			 }
			$data['updatetime']=time();
		  //更新ershou表
		  $db->where($aa)->save($data);
		  echo '{"success":144,"info":"修改成功"}';
					exit;
		}else if(IS_GET && $_GET['id'] != ''){
			$info = $db->where('id='.$_GET['id'])->find();
			echo json_decode($info);
			exit;
		}	
	}
	
	//发布的二手房/出租房列表
	public function house_list(){
		if(IS_POST){
			if($_POST['username']=='' || $_POST['userid']=='' || $_POST['table']==''){
				echo '{"success":145,"info":"数据不完整"}';
					exit;
			}
			$f = M('member')->where($_POST)->find();
			if(!$f){
				echo '{"success":146,"info":"非法操作"}';
					exit;
			}	
			$db = M($_POST['table']);
			$u['username'] = $_POST['username'];
			$list = $db->where($u)->order("inputtime DESC")->select();
			foreach($list as $k=>$v){
				if($v['pics']!='' && $v['pics']!='a:0:{}'){
				 $list[$k]['pics'] = unserialize($v['pics']);
			 	}	
				$list[$k]['xiaoquname'] = M('xiaoqu')->where('id='.$v['xiaoqu'])->getfield('title');
				$list[$k]['cityname'] = M('area')->where('id='.$v['city'])->getfield('name');
				$list[$k]['areaname'] = M('area')->where('id='.$v['area'])->getfield('name');
			}
			if($list){
				echo json_encode($list,JSON_UNESCAPED_UNICODE);
				exit;
					 			
			}else{
				echo '{"success":147,"info":"该用户没有发布房源"}';
				exit;
			}
			
		}
	}
	
	//发布出租房
	public function add_chuzu(){
		if(IS_POST){
			if($_POST['username']=='' || $_POST['userid']=='' ||$_POST['modelid']=='' ||$_POST['title']=='' || $_POST['province']=='' || $_POST['city']=='' || $_POST['area']=='' || $_POST['xiaoquname']=='' || $_POST['jingweidu']=='' || $_POST['zujin']=='' || $_POST['mianji']=='' || $_POST['shi']=='' || $_POST['ting']=='' || $_POST['wei']==''){
				echo '{"success":148,"info":"数据不完整"}';
				exit;
			}
			if($_POST['modelid'] == 35){
				if($_POST['pub_type']=='' || $_POST['hidetel']==''){
					echo '{"success":148,"info":"数据不完整"}';
					exit;
				}
			}
			if($_POST['modelid'] == 36){
				if($_POST['fangling']=='' || $_POST['desc']=='' || $_POST['address']=='' || $_POST['ceng']=='' || $_POST['zongceng']==''){
					echo '{"success":148,"info":"数据不完整"}';
					exit;
				}
			}
			//图片转换			
			if($_POST['pics']){
				$_POST['pics']=json_decode($_POST['pics'],true);
				$_POST['thumb'] = $_POST['pics'][0]['url'];
				$_POST['pics'] = serialize($_POST['pics']);				
			}			
			//判断小区是否存在
          $k['area'] = $_POST['area'];
          $k['title'] = $_POST['xiaoquname'];
          $r1 = M('xiaoqu')->where($k)->find();
		 
          if (!$r1) {
            //插入小区
            $k['catid'] = 54;
            $k['username'] = $_POST['username'];
			$k['status'] = 99;           
            $k['updatetime'] = $k['inputtime'] = time();
            $k['province'] = $_POST['province'];
            $k['city'] = $_POST['city'];
            $k['jingweidu'] = $_POST['jingweidu'];
            $r2 = M('xiaoqu')->add($k);
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
			 $data['username'] = $_POST['username'];
			 $data['zaizu'] = 1;
			 if($_POST['modelid'] == 35){
				$data['status'] = 1;	
			}else{
				$data['jjr_id'] = $_POST['userid'];
				$data['status'] = 99;	
				$data['pub_type'] = 1;
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
		  if($_POST['modelid'] == 35){
			  if($data['pub_type'] == 1){
					 $data['lock'] = 0;
				 }else{
					 $data['lock'] = 1;
				 }
		  }else{
			  $data['lock'] = 0;
			 }
			$rs = $db->add($data);
			if($rs){
            //更新url地址
            $y['url'] = "/index.php?a=shows&catid=8&id=".$rs;
			//更新房源编号
			$y['bianhao'] = "Z".date("Ymd").(8*10000000+$rs);
            $db-> where("id=".$rs) -> save($y);
            //插入一条数据到附表中
            $u['id'] = $rs;
            $u['content'] = "";
            $u['relation'] = "";
			
            M('chuzu_data')->add($u);
          }
          if ($data['xiaoqu'] && $rs ) {
            //发布成功，跳转到我的二手房页面            
            echo '{"success":149,"info":"发布成功"}';
					exit;
          }else{
            echo '{"success":150,"info":"发布失败"}';
					exit;
          }
			
		}	
	}
	
	//编辑出租房
	public function edit_chuzu(){
		if(IS_POST){
			if($_POST['id']=='' || $_POST['username']=='' || $_POST['userid']=='' ||$_POST['modelid']=='' ||$_POST['title']=='' || $_POST['province']=='' || $_POST['city']=='' || $_POST['area']=='' || $_POST['xiaoquname']=='' || $_POST['jingweidu']=='' || $_POST['zujin']=='' || $_POST['mianji']=='' || $_POST['shi']=='' || $_POST['ting']=='' || $_POST['wei']==''){
				echo '{"success":158,"info":"数据不完整"}';
				exit;
			}
			if($_POST['modelid'] == 35){
				if($_POST['pub_type']=='' || $_POST['hidetel']==''){
					echo '{"success":158,"info":"数据不完整"}';
					exit;
				}
			}
			if($_POST['modelid'] == 36){
				if($_POST['fangling']=='' || $_POST['desc']=='' || $_POST['address']=='' || $_POST['ceng']=='' || $_POST['zongceng']==''){
					echo '{"success":158,"info":"数据不完整"}';
					exit;
				}
			}
			$db = M('chuzu');
			$aa['id']=$_POST['id'];
			$f = $db -> where($aa) -> find();
			if(!$f){
				echo '{"success":159,"info":"没有该房源"}';
				exit;
			}else{
				//fix by tianhua on 2017-04-11
				$_POST['username'] = $f["username"];
				//end fix
			}
			if($_POST['modelid'] == 35 && $f['lock'] == 1){
				echo '{"success":160,"info":"该房源已锁定"}';
				exit;
			}
			//图片转换			
			if($_POST['pics']){
				$_POST['pics']=json_decode($_POST['pics'],true);
				$_POST['thumb'] = $_POST['pics'][0]['url'];
				$_POST['pics'] = serialize($_POST['pics']);				
			}			
			//判断小区是否存在
          $k['area'] = $_POST['area'];
          $k['title'] = $_POST['xiaoquname'];
          $r1 = M('xiaoqu')->where($k)->find();
		 
          if (!$r1) {
            //插入小区
            $k['catid'] = 54;
            $k['username'] = $_POST['username'];
			$k['status'] = 99;           
            $k['updatetime'] = $k['inputtime'] = time();
            $k['province'] = $_POST['province'];
            $k['city'] = $_POST['city'];
            $k['jingweidu'] = $_POST['jingweidu'];
            $r2 = M('xiaoqu')->add($k);
            if ($r2) {
              //插入小区附表
              $u['id'] = $r2;
              $u['content'] = "";
              $u['relation'] = "";
              M('xiaoqu_data')->add($u);
            }
          }
		  
          $data = $db->create($_POST);
		  //如果小区存在，取返回的小区id
          if ($r1) {
            $data['xiaoqu'] = $r1['id'];
          }
          //如果小区插入成功，取返回的id
          if ($r2) {
            $data['xiaoqu'] = $r2;
          }
		  if($_POST['pub_type'] !=1){
			  $data['lock']=1;
			 }
			$data['updatetime']=time();
			//更新chuzu表
		  $db->where($aa)->save($data);
		  echo '{"success":161,"info":"修改成功"}';
					exit;
		}else if(IS_GET && $_GET['id'] != ''){
			$info = $db->where('id='.$_GET['id'])->find();
			echo json_decode($info);
			exit;
		}	
	}
	
	//二手房/出租房删除
	public function house_del(){
		if(IS_POST){
			if($_POST['table']=='' || $_POST['username']=='' || $_POST['userid']==''|| $_POST['id']==''){
				echo '{"success":163,"info":"数据不完整"}';
				exit;
			}
			$u['username'] = $_POST['username'];
			$u['userid'] = $_POST['userid'];
			$f = M('member')->where($u)->find();
			if(!$f){
				echo '{"success":164,"info":"非法操作"}';
				exit;
			}
			$db = M($_POST['table']);
			$r = $db->where('id='.$_POST['id'])->find();
			if(!$r){
				echo '{"success":165,"info":"没有此房源"}';
				exit;
			}
			if($r['lock'] == 1){
				echo '{"success":166,"info":"此房源已锁定"}';
				exit;
			}
			$rs = $db->where('id='.$_POST['id'])->delete();
			if($rs){
				echo '{"success":167,"info":"删除成功"}';
				exit;
			}else{
				echo '{"success":168,"info":"删除失败"}';
				exit;
			}
		}
	}
	
	//成交房源
	public function chengjiao(){
		if(IS_POST){
			if($_POST['table']=='' || $_POST['username']=='' || $_POST['userid']==''){
				echo '{"success":162,"info":"数据不完整"}';
				exit;
			}
			// $db = M($_POST['table']);
			// $sql = "(username='".$_POST['username']."' OR jjr_id='".$_POST['userid']."') and ";
			// if($_POST['table'] == "ershou"){
			// 	$sql .= 'zaishou=0';
			// }else{
			// 	$sql .= 'zaizu=0';
			// }
			//$arr = $db -> where($sql) -> select();
			//fix by tianhua on 2017.03.31
			$arry1 = M('ershou')->where("(username='".$_POST['username']."' OR jjr_id='".$_POST['userid']."') and zaishou=0")->select();
        	$arry2 = M('chuzu')->where("(username='".$_POST['username']."' OR jjr_id='".$_POST['userid']."') and zaizu=0")->select();
			$arr = array_merge( $arry1,$arry2);
			//end fix
			foreach($arr as $k=>$v){
				$arr[$k]['xiaoquname'] = M('xiaoqu')->where('id='.$v['xiaoqu'])->getfield('title');
			}
			echo json_encode($arr,JSON_UNESCAPED_UNICODE);
			exit;
				
		}
	}
	
	//经纪人评论列表
	public function jjr_comment(){
		if(IS_GET){
			if($_GET['id'] == ''){
				echo '{"success":169,"info":"非法操作"}';
			    exit;
			}
			$u['comment_id'] = "c-88-".$_GET['id'];
			$list = M('comments')->where($u)->order('date DESC')->select();
			foreach($list as $k=>$v){
				$list[$k]['content'] = M('comments_data_1')->where('id='.$v['id'])->getfield('content');
				$list[$k]['userpic'] = M('member')->where('username='.$v['author'])->getfield('userpic');
				
				$list[$k]['date'] = date('Y-m-d H:i:s',$v['date']);
			}
			if($list){
				echo json_encode($list,JSON_UNESCAPED_UNICODE);
				exit;
			}else{
				echo '{"success":170,"info":"没有评论"}';
				exit;
			}
		}
	}
	
	//发表评论
	public function jjr_comm_add(){
		if(IS_POST){
			if($_POST['id'] == '' || $_POST['content'] == '' || $_POST['author'] == '' || $_POST['user_id'] == ''|| $_POST['agent'] == ''){
				echo '{"success":171,"info":"数据不完整"}';
			    exit;
			}
			
			$data['comment_id'] = "c-88-".$_POST['id'];			
			$data['author'] = $_POST['author'];
			$data['user_id'] = $_POST['user_id'];
			$data['agent'] = $_POST['agent'];
			/*默认值*/
			$data['date'] = time();
			$data['approved'] = 1;
			$data['parent'] = 0;
			$data['stb'] = 1;
			/*副表*/
			$u['content'] = $_POST['content'];
			$u['comment_id'] = "c-88-".$_POST['id'];
			/*插入主表*/
			$rs = M('comments')->add($data);
			$u['id'] = $rs;
			/*插入副表*/
			$rs1 = M('comments_data_1')->add($u);
			if($rs && $rs1){
				echo '{"success":172,"info":"评论成功"}';
			    exit;
			}else{
				echo '{"success":173,"info":"评论失败"}';
			    exit;
			}
			
		}
	}
	
	//历史记录
	public function history(){
		if(IS_POST){
			$u['username']=$_POST['username'];
			$list = M('history')->where($u)->order('inputtime DESC')->select();
			if($list){
				foreach($list as $k=>$v){
					$list[$k]['inputtime'] = date('Y-m-d H:i:s',$v['inputtime']);
				}
				echo json_encode($list,JSON_UNESCAPED_UNICODE);
			}else{
				echo '{"success":183,"info":"无历史记录"}';
			}
			
		}
	}
	
	//添加留言 
	public function liuyan_add(){
		if(IS_POST){
			if($_POST['from_uid']=='' || $_POST['to_uid']=='' || $_POST['content']==''){
				echo '{"success":188,"info":"数据不完整"}';
				exit;
			}
			$data['from_uid'] = $_POST['from_uid'];
			$data['from_status'] = 2;
			$data['to_uid'] = $_POST['to_uid'];
			$data['to_status'] = 1;
			$data['content'] = $_POST['content'];
			$data['inputtime'] = time();
			$rs = M('message')->add($data);			
			if($rs){
				echo '{"success":189,"info":"留言成功"}';
				exit;
				
			}else{
				echo '{"success":190,"info":"留言失败"}';
				exit;
			}
		}
	}
	
	//留言列表
	public function liuyan_list(){
		if(IS_POST){
			if($_POST['userid']==''){
				echo '{"success":191,"info":"非法操作"}';
				exit;
			}
			$userid = $_POST['userid'];
			$list = M('message')->where('from_uid='.$userid.' or to_uid='.$userid)->group('from_uid,to_uid,id')->order('id DESC')->select();
			
			//判断是否被用户删除
			foreach($list as $k=>$v){
				
				if($userid==$list[$k]['from_uid'] && $list[$k]['from_status']==4){
					unset($list[$k]);
				}
				if($userid==$list[$k]['to_uid'] && $list[$k]['to_status']==4){
					unset($list[$k]);
				}
			}
			
			//判断用户是否已读
			$weidu=0;
			foreach($list as $k=>$v){
				$list[$k]['yidu']=0;
				if($userid==$list[$k]['from_uid'] && $list[$k]['from_status']==2){
					$list[$k]['yidu']=1;
				}
				if($userid==$list[$k]['from_uid'] && $list[$k]['from_status']==1){
					$weidu++;
				}
				if($userid==$list[$k]['to_uid'] && $list[$k]['to_status']==2){
					$list[$k]['yidu']=1;
				}
				if($userid==$list[$k]['to_uid'] && $list[$k]['to_status']==1){
					$weidu++;
				}
			}
			
			foreach($list as $k=>$v){
				$list[$k]['weidu_sum']=$weidu;
			}
			
			$array=array();
			foreach($list as $x=>$y){
				 $list[$x]['ids']= $list[$x]['from_uid']+$list[$x]['to_uid'];
				if(in_array($list[$x]['ids'],$array)){
					unset($list[$x]);
				}else{
				    $array[]=$list[$x]['ids'];
				}
				
			}
			
			
			
			foreach($list as $k=>$v){
				
				if($userid == $v['from_uid']){
					$xx['userid']=$v['to_uid'];
				}else{
					$xx['userid']=$v['from_uid'];
				}
				
				$base = M('member')->where($xx)->field('userpic,modelid,username')->find();	
				
				$list[$k]['userpic'] = $base['userpic'];
				if($base['modelid']==35){
					$db = M('member_normal');
				}else{
					$db = M('member_agent');
				}
				$rname = $db -> where($xx)->getField('realname');
				if($rname && $rname!=''){
					$list[$k]['realname'] = $rname;
				}else{
					$list[$k]['realname'] = $base['username'];
				}
			}

			if($list){
				$this->ajaxReturn($list);
			}else{
				echo '{"success":192,"info":"没有留言"}';
				exit;
			}
		}
	}
	
	//留言详情
	public function liuyan_detail(){
		if(IS_POST){
			if($_POST['userid']=='' || $_POST['towho']==''){
				echo '{"success":193,"info":"数据不完整"}';
				exit;
			}
			$list = M('message')->where('(from_uid='.$_POST['userid'].' and to_uid='.$_POST['towho'].') or (to_uid='.$_POST['userid'].' and from_uid='.$_POST['towho'].')')->order('inputtime ASC')->select();			
			foreach($list as $k=>$v){
				$list[$k]['userpic'] = M('member')->where('userid='.$v['from_uid'])->getfield('userpic');
			}
			
			echo json_encode($list,JSON_UNESCAPED_UNICODE);
		}
	}
	
	//留言删除
	public function liuyan_del(){
		if(IS_POST){
			if($_POST['id']=='' || $_POST['userid']==''){
				echo '{"success":194,"info":"数据不完整"}';
				exit;
			}
			$db=M('message');
			$userid = $_POST['userid'];
			$info=$db->where('id='.$_POST['id'])->find();	
			//当前用户是发送者
			if($userid==$info['from_uid']){
				$fa=$userid;
				$shou=$info['to_uid'];
				$x1['from_status']=4;
				$x2['to_status']=4;
				$db->where('from_uid='.$fa.' and to_uid='.$shou)->save($x1);
				$db->where('from_uid='.$shou.' and to_uid='.$fa)->save($x2);
			}
			//当前用户时接收者
			if($userid==$info['to_uid']){
				$shou=$userid;
				$fa=$info['from_uid'];
				$x1['to_status']=4;
				$x2['from_status']=4;
				$db->where('from_uid='.$fa.' and to_uid='.$shou)->save($x1);
				$db->where('from_uid='.$shou.' and to_uid='.$fa)->save($x2);
			}
			
			echo '{"success":195,"info":"删除成功"}';
		}
	}
	
	//留言设为已读	
	public function liuyan_yidu(){
		if(IS_POST){
			if($_POST['id']=='' || $_POST['userid']==''){
				echo '{"success":196,"info":"数据不完整"}';
				exit;
			}
			$db=M('message');
			$userid = $_POST['userid'];
			$info=$db->where('id='.$_POST['id'])->find();	
			//当前用户是发送者
			if($userid==$info['from_uid']){
				$fa=$userid;
				$shou=$info['to_uid'];
				$x1['from_status']=2;
				$x2['to_status']=2;
				$db->where('from_uid='.$fa.' and to_uid='.$shou.' and from_status=1')->save($x1);
				$db->where('from_uid='.$shou.' and to_uid='.$fa.' and to_status=1')->save($x2);
			}
			//当前用户时接收者
			if($userid==$info['to_uid']){
				$shou=$userid;
				$fa=$info['from_uid'];
				$x1['to_status']=2;
				$x2['from_status']=2;
				$db->where('from_uid='.$fa.' and to_uid='.$shou.' and to_status=1')->save($x1);
				$db->where('from_uid='.$shou.' and to_uid='.$fa.' and from_status=1')->save($x2);
			}
		}
	}
	
	//委托管理
	public function weituo(){
		if(IS_POST){
			if($_POST['userid']=='' || $_POST['table']==''){
				echo '{"success":197,"info":"数据不完整"}';
				exit;
			}
			$list = M($_POST['table'])->where('jjr_id='.$_POST['userid'].' and pub_type!=1')->order('updatetime DESC')->select();
			foreach($list as $k=>$v){				
				$list[$k]['pics'] = unserialize($v['pics']);
				$list[$k]['xiaoquname'] = M('xiaoqu')->where('id='.$v['xiaoqu'])->getfield('title');
				$list[$k]['cityname'] = M('area')->where('id='.$v['city'])->getfield('name');
				$list[$k]['areaname'] = M('area')->where('id='.$v['area'])->getfield('name');
			}
			if($list){
				echo json_encode($list,JSON_UNESCAPED_UNICODE);
			}else{
				echo '{"success":198,"info":"没有委托"}';
				exit;
			}
		}
	}
}
