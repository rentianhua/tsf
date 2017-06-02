<?php
namespace Api\Controller;

use Common\Controller\ShuipFCMS;
use Libs\Service\Sms;
class HouseController extends ShuipFCMS {
	
	//取得站点配置
    public function webconfig() {
		$db = M('config');	
		//取得主标题和副标题
		$result = $db -> where('id=51 or id=52')-> select();
		echo json_encode($result,JSON_UNESCAPED_UNICODE);		
	}
	//获取市场行情
 	public function tracy() {
		$db = M('tracy');	
		$result = $db -> order('id DESC')->limit(1)-> select();
		echo json_encode($result,JSON_UNESCAPED_UNICODE);			
	}

//取得地区数据
    public function diqu() {
		
		if( empty($_POST['pid']) && empty($_GET['pid']) ){
			exit;
		}
		
		$u['pid']=intval($_POST['pid']);
		if(!$u['pid']){
			$u['pid']=intval($_GET['pid']);
			}
		$db = M('area');
		
		$result = $db ->where($u)->field('id,pid,name,cid')-> select();// 查询指定字段
		
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		//echo json_encode($result);	
		
		//$this->ajaxReturn($data);	
	}
	
//取得所有地区数据
    public function diqu_all() {
		$db = M('area');
		$u['pid']=1;
		$result = $db ->where($u)->select();// 查询指定字段
		foreach($result as $k=>$v){
			$x['pid']=$v['id'];
			$result[$k]['area'] = $db ->where($x)->select();
		}
		
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		//echo json_encode($result);	
		
		//$this->ajaxReturn($data);	
	}

//获取推荐位列表
  public function position() {
			if( empty($_POST['posid']) && empty($_GET['posid']) ){
			exit;
		}
		
		$posid=intval($_POST['posid']);
		if(!$posid){
			$posid=$_GET['posid'];
			}
       $data=array(
	   "action" => "position",
	   "posid" =>$posid 
	   	   );
	//缓存时间
        $cache = (int) $data['cache'];
        $cacheID = to_guid_string($data);
        if ($cache && $return = S($cacheID)) {
            return $return;
        }
        $posid = (int) $data['posid'];
        if ($posid < 1) {
            return false;
        }
        $catid = (int) $data['catid'];
        $thumb = isset($data['thumb']) ? $data['thumb'] : 0;
        $order = empty($data['order']) ? array("listorder" => "DESC", "id" => "DESC") : $data['order'];
        $num = (int) $data['num'];

        $db = M('PositionData');
        $Position = cache('Position');
        if ($num == 0) {
            $num = $Position[$posid]['maxnum'];
        }
        $where = array();
        //设置SQL where 部分
        if (isset($data['where']) && $data['where']) {
            $where['_string'] = $data['where'];
        }
        $where['posid'] = array("EQ", $posid);
        if ($thumb) {
            $where['thumb'] = array("EQ", 1);
        }
        if ($catid > 0) {
            $cat = getCategory($catid);
            if ($cat) {
                //是否包含子栏目
                if ($cat['child']) {
                    $where['catid'] = array("IN", $cat['arrchildid']);
                } else {
                    $where['catid'] = array("EQ", $catid);
                }
            }
        }
        $data = $db->where($where)->order($order)->limit($num)->select();
	
        foreach ($data as $k => $v) {
            $data[$k]['data'] = unserialize($v['data']);
			$data[$k]['data']['shiarea'] = join(',',$data[$k]['data']['shiarea']);
            $data[$k]['data']['url'] = \Content\Model\ContentModel::getInstance($v['modelid'])->where(array("id" => $v['id']))->getField("url");
			
			$data[$k]['data']['province_name'] = M('area')->where('id='.$data[$k]['data']['province'])->getField('name');
			$data[$k]['data']['city_name'] = M('area')->where('id='.$data[$k]['data']['city'])->getField('name');
			$data[$k]['data']['area_name'] = M('area')->where('id='.$data[$k]['data']['area'])->getField('name');
        }
	
        if($data){
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo '{"success":12,"info":"查询不到数据"}';
        }


    }
	
//获取房源列表	
  public function lists() {
	if(!$_POST['catid']){
		echo '{"success":87,"info":"无栏目id"}';
		exit;
		}
	  $catid = $_POST['catid'];
	  $modelid = M('category')->where('catid='.$catid)->getfield('modelid');
	  $tablename = M('model')->where('modelid='.$modelid)->getfield('tablename');
	  $db = M($tablename); // 获取表明并实例化	 
	$arrlist = explode(',',$arr);
	$sql = "status=99 and catid=".$catid;
	  
	//新房搜索条件开始
    if($catid == 3){
		$order = "";
		if($_POST['ct']!=""){
			$sql.= " and city = '".$_POST['ct']."'"; 
			}
		if($_POST['ar']!=""){
			$sql.= " and area = '".$_POST['ar']."'"; 
			}	
		if($_POST['shi']!=""){
			$sql.= " and shiarea like '%".$_POST['shi']."%'"; 
			}
		if($_POST['zj']!=""){
			$zj = explode('-',$_POST['zj']);			
			$sql.= " and lowzongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and highzongjia <= '".intval($zj[1])."'";
			}	
		}
		if($_POST['zx']!=""){
			$sql.= " and zhuangxiu = '".$_POST['zx']."'"; 
			}
		if($_POST['yt']!=""){
			$sql.= " and fangwuyongtu = '".$_POST['yt']."'"; 
			}
		if($_POST['wy']!=""){
			$sql.= " and wuyeleixing = '".$_POST['wy']."'"; 
			}
		if($_POST['xq']!=""){
			$sql.= " and xiaoqutype = '".$_POST['xq']."'"; 
			}
		if($_POST['kwds']!=""){
			$sql.= " and title like '%".$_POST['kwds']."%'"; 
			}	
		if($_POST['order']!=""){
			$order.= str_replace('_',' ',$_POST['order']); 
		}else{
			$order.= "listorder DESC";
		}
		}
	//新房搜索条件结束
	
	//二手房搜索条件开始
	if($catid == 6){
	    $order = "";
		if($_POST['ct']!=""){
			$sql.= " and city = '".$_POST['ct']."'"; 
			}
		if($_POST['ar']!=""){
			$sql.= " and area = '".$_POST['ar']."'"; 
			}	
		if($_POST['dt']!=""){
			$sql.= " and ditiexian like '%".$_POST['dt']."%'"; 
			}	
		if($_POST['zj']!=""){
			$zj = explode('-',$_POST['zj']);			
			$sql.= " and zongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zongjia <= '".intval($zj[1])."'";
			}
		}
		if($_POST['mj']!=""){
			$mj = explode('-',$_POST['mj']);			
			$sql.= " and jianzhumianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and jianzhumianji <= '".intval($mj[1])."'";
			}
		}
		if($_POST['shi']!=""){
			$sql.= " and shi = '".$_POST['shi']."'"; 
			}
		if($_POST['qs']!=""){
			$sql.= " and jiaoyiquanshu = '".$_POST['qs']."'"; 
			}
		if($_POST['ly']!=""){
			if($_POST['ly']=='yz'){
				$sql.= " and jjr_id = ''"; 
			}elseif($_POST['ly']=='jjr'){
				$sql.= " and jjr_id != ''"; 
			}
			}
		if($_POST['yt']!=""){
			$sql.= " and fangwuyongtu = '".$_POST['yt']."'"; 
			}
		if($_POST['cx']!=""){
			$sql.= " and chaoxiang = '".$_POST['cx']."'"; 
			}
		if($_POST['lc']!=""){
			$sql.= " and ceng = '".$_POST['lc']."'"; 
			}
		if($_POST['zx']!=""){
			$sql.= " and zhuangxiu = '".$_POST['zx']."'"; 
			}
		if($_POST['wy']!=""){
			$sql.= " and isweiyi = '".$_POST['wy']."'"; 
			}
		if($_POST['kwds']!=""){
			$sql.= " and title like '%".$_POST['kwds']."%'"; 
			}	
		if($_POST['order']!=""){
			$order.= str_replace('_',' ',$_POST['order']); 
			}	
		}
	//二手房搜索条件结束
	
	//出租房搜索条件开始
	if($catid == 8){
		$order = "";
		if($_POST['ct']!=""){
			$sql.= " and city = '".$_POST['ct']."'"; 
			}
		if($_POST['ar']!=""){
			$sql.= " and area = '".$_POST['ar']."'"; 
			}	
		if($_POST['dt']!=""){
			$sql.= " and ditiexian like '%".$_POST['dt']."%'"; 
			}	
		if($_POST['zj']!=""){
			$zj = explode('-',$_POST['zj']);			
			$sql.= " and zujin >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zujin <= '".intval($zj[1])."'";
			}
		}
		if($_POST['mj']!=""){
			$mj = explode('-',$_POST['mj']);
			$sql.= " and mianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and mianji <= '".intval($mj[1])."'";
			}
		}
		if($_POST['shi']!=""){
			$sql.= " and shi = '".$_POST['shi']."'"; 
			}
		if($_POST['qs']!=""){
			$sql.= " and wuyetype = '".$_POST['qs']."'"; 
			}
		if($_POST['yt']!=""){
			$sql.= " and leixing = '".$_POST['yt']."'"; 
			}
		if($_POST['xq']!=""){
			$sql.= " and xiaoqutype = '".$_POST['xq']."'"; 
			}
		
		if($_POST['cx']!=""){
			$sql.= " and chaoxiang = '".$_POST['cx']."'"; 
			}
		if($_POST['lc']!=""){
			$sql.= " and ceng = '".$_POST['lc']."'"; 
			}
		if($_POST['zl']!=""){
			$sql.= " and zulin = '".$_POST['zl']."'"; 
			}
		if($_POST['zx']!=""){
			$sql.= " and zhuangxiu = '".$_POST['zx']."'"; 
			}
		if($_POST['kf']!=""){
			$sql.= " and biaoqian like '%".$_POST['kf']."%'"; 
			}
		if($_POST['kwds']!=""){
			$sql.= " and title like '%".$_POST['kwds']."%'"; 
			}	
		if($_POST['order']!=""){
			$order.= str_replace('_',' ',$_POST['order']); 
		}else{
			$order.= "listorder DESC";
		}
		}
	//出租房搜索条件结束
	
	//大宗交易搜索条件开始
	if($catid == 7){
		$order = "";
		if($_POST['ct']!=""){
			$sql.= " and city = '".$_POST['ct']."'"; 
			}
		if($_POST['ar']!=""){
			$sql.= " and area = '".$_POST['ar']."'"; 
			}
		if($_POST['zj']!=""){
			$zj = explode('-',$_POST['zj']);			
			$sql.= " and zongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zongjia <= '".intval($zj[1])."'";
			}	
		}
		if($_POST['mj']!=""){
			$mj = explode('-',$_POST['mj']);			
			$sql.= " and zhandimianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and zhandimianji <= '".intval($mj[1])."'";
			}	
		}
		if($_POST['sx']!=""){
			$sql.= " and tudishuxing = '".$_POST['sx']."'"; 
			}
		if($_POST['lx']!=""){
			$sql.= " and wuyetype = '".$_POST['lx']."'"; 
			}
		if($_POST['fs']!=""){
			$sql.= " and hezuofangshi = '".$_POST['fs']."'"; 
			}
		if($_POST['kwds']!=""){
			$sql.= " and title like '%".$_POST['kwds']."%'"; 
			}	
		if($_POST['order']!=""){
			$order.= str_replace('_',' ',$_POST['order']); 
		}else{
			$order.= "listorder DESC";
		}
		}
	//大宗交易搜索条件结束
	
	if($sql){
		$count = $db -> where($sql)-> count();
	}else{
		$count = $db -> count();
	}
	
	if (!isset($_POST['page'])) {
		$_POST['page'] = 1;
	}
	
	$limit = (($_POST['page']-1) * 20).',20';	
		
	//排序
	if (empty($order)) {
		$order = array('updatetime' => 'DESC', 'id' => 'DESC');
	}
	if($sql){
		$data = $db->where($sql)->order($order)->limit($limit)->select();
	}else{
		$data = $db->order($order)->limit($limit)->select();
	}
	 
	foreach($data as $k=>$v){
		$data[$k]['zonghe'] = $count;
		$data[$k]['cityname'] = M('area')->where('id='.$data[$k]['city'])->getfield('name');
		$data[$k]['areaname'] = M('area')->where('id='.$data[$k]['area'])->getfield('name');
		if($catid == 6 || $catid == 8 ){
			    if($v['jjr_id']){
					$t = M('member')->where('userid='.$v['jjr_id'])->find();
					$data[$k]['realname'] =  $t['realname'];
					if($t['zhuanjie'] == 1 && $t['vtel'] != ''){
						$data[$k]['vtel'] = cache('Config.tel400').'转'.$t['vtel'];
					}else{
						$data[$k]['vtel'] = $t['username'];
					}
					$data[$k]['userid'] =  $t['userid'];	
				}else{
					
					 $t = M('member') -> where('username='.$v['username']) -> field('userid,vtel,zhuanjie,username') -> find();
					 $data[$k]['userid'] = $t['userid'];
					 if($t['zhuanjie'] == 1 && $t['vtel'] != ''){						
						 $data[$k]['vtel'] =  cache('Config.tel400').'转'.$t['vtel'];
					 }else{
						if($t['zhuanjie'] == 1 && $t['vtel'] != ''){
							$data[$k]['vtel'] = cache('Config.tel400').'转'.$t['vtel'];
						}else{
							$data[$k]['vtel'] = $t['username'];
						}
					 }	
			   }	
		}else{
			$t = M('member') -> where('username='.$v['username']) -> field('userid,vtel,username') -> find();	 
			$data[$k]['userid'] = $t['userid'];
			 if($t['zhuanjie'] == 1 && $t['vtel'] != ''){
						$data[$k]['vtel'] = cache('Config.tel400').'转'.$t['vtel'];
					}else{
						$data[$k]['vtel'] = $t['username'];
					}
	   }
		
	}
    echo json_encode($data);

  }
  
//获取新房对应的楼盘动态
  public function getlpdt(){
    if(IS_POST){
      $info = M('loupandongtai') -> where("new_id=".$_POST['new_id']) -> order('inputtime desc') -> select();
      foreach ($info as $k=>$value){
        $info[$k]['inputtime'] = date("Y-m-d H:m:s", $info[$k]['inputtime']);
      }
      $this->ajaxReturn($info);
    }
  }
  
  //获取区域对应的小区列表
  public function getxq(){
    if(IS_POST){
		$where = "area=".$_POST['area'];
		if($_POST['kw'] != ''){
			$where .= " and title like '%".$_POST['kw']."%'";
		}
      $info = M('xiaoqu') -> where($where) -> select();
      $this->ajaxReturn($info);
    }
  }
  
  //获取新房对应的优惠券
  public function getyhq(){
	if(IS_POST){
		if($_POST['new_id'] == '' || $_POST['new_catid'] == ''){
			echo '{"success":131,"info":"数据不完整"}';
			exit;
		}
	  $u['new_id'] = $_POST['new_id'];
      $u['new_catid'] = $_POST['new_catid'];
	  $rs = M('yhquan') -> where($u) -> order('inputtime desc') -> select();
	  if($rs){
		 echo json_encode($rs);
		 exit;
		}else{
			echo '{"success":132,"info":"此新房没有优惠券"}';
			exit;
		}
      
	}
  }
  
  //添加优惠券接口
  public function coupon_add(){
  if(IS_POST){
        $db = M('coupon');
        $data['order_no'] = 'D'.date('YmdHis',time()).rand(100,999);
		//echo var_dump($_POST);exit;
	
		if($_POST['house_id'] == "" || $_POST['coupon_id'] == "" || $_POST['userid'] == "" || $_POST['buyname'] == "" || $_POST['buytel'] == "" || $_POST['username'] == ""){
		   echo '{"success":69,"info":"数据不完整"}';
		   exit;
			}
		//验证手机号码是否正确
		if(!preg_match("/^1[34578]{1}\d{9}$/",$_POST['buytel'])){
			echo '{"success":71,"info":"手机号码格式错误"}';
			exit;
		}	
		//检验验证码
	    $mob = $_POST['username'];
		$yzm = $_POST['yzm'];
		$url = "http://www.taoshenfang.com/index.php?g=api&m=sms&a=check_yzm&mob=" . $mob . "&yzm=" . $yzm;
		$res = file_get_contents($url);
		$res = json_decode($res, true);
		if ($res['success'] != 7) {
			echo '{"success":72,"info":"手机验证码验证不通过"}';
			exit;
		}
		//检验当前购房人姓名和手机号码 在数据库中已经存在
//		$g['buyname'] = $_POST['buyname'];
//		$g['buytel'] = $_POST['buytel'];
//		$g['house_id'] = $_POST['house_id'];
//		$rt = $db ->where($g)->select();
//		if($rt){
//			echo '{"success":73,"info":"同一购房人每个楼盘限购一张"}';
//			exit;
//			}
		
		
        $data['house_id'] = $_POST['house_id'];  
        $data['coupon_id'] = $_POST['coupon_id'];
		$coupon = M('yhquan')->where('id='.$_POST['coupon_id'])->find();
		if(!$coupon){
			echo '{"success":70,"info":"该优惠券不存在"}';
		    exit;
		}else{
			//fix by tianhua on 2017-04-12
			if($coupon['yigou']+1 > $coupon['maxnum']){
				echo '{"success":68,"info":"购买失败,此优惠券已经售完"}';
		   		exit;
			}
			//end fix
		
		//fix by tianhua on 2017-04-13
		$house= M('new')->where('id='.$_POST['house_id'])->find();
		if(strtotime($house['yhq_enddate'])<strtotime(date("y-m-d"))){
			echo '{"success":68,"info":"购买失败,优惠活动已结束"}';
		   	exit;
		}
		//end fix
		$data['coupon_name'] = $coupon['title'];
        $data['difu'] = $coupon['vmoney'];
        $data['shifu'] = $coupon['pay'];		
		$data['yhq_no'] = $coupon['yhq_no'];	
        $data['userid'] = $_POST['userid'];
        $data['buyname'] = $_POST['buyname'];
        $data['buytel'] = $_POST['buytel'];
        $data['inputtime'] = time();
		    }	  
        //开始添加数据
        $rst = $db -> add($data);
        if($rst){
			$data['id']=$rst;
		    M('yhquan')->where('id='.$coupon['id'])->setInc('yigou',1);
			$arr['success']=67;
			$arr['info']='购买成功';
			$arr['id']=$rst;
			$arr['result']=$data;
			//发送短信开始
			$config = array(
            'key' => C('Alidayu_APP_KEY'), //key
            'secret' => C('Alidayu_APP_SECRET'), //secret
            'sign' => '淘深房', //短信签名
            'sms_param' => array('name' => '','product' => '')//短信参数
			 );
			 $sms = service("Sms", $config);
             $rss=$sms->send($_POST[buytel], 'SMS_43430002', array('name' => $_POST[buytel],'product' =>'淘深房'));
			//发送短信结束
			$this->ajaxReturn($arr);
		   exit;
        }else{
		   echo '{"success":68,"info":"购买失败"}';
		   exit;
			}
    }
  }
  
  //删除优惠券接口--koloor
  public function coupon_del(){
	  if(IS_POST){
		  $db = M('coupon');
		  $u['id'] = $_POST['id'];
		  $u['userid'] = $_POST['userid'];
		  //删除优惠券需要校验手机验证码
	$mob = $_POST['username'];
	$yzm = $_POST['yzm'];
	$url = "http://www.taoshenfang.com/index.php?g=api&m=sms&a=check_yzm&mob=".$mob."&yzm=".$yzm;
	$res = file_get_contents($url);
	$res = json_decode($res, true);
	if ($res['success'] != 7) {
	echo '{"success":77,"info":"手机验证码验证不通过"}';
	exit;
	}
		  //////////
		  $od = $db->where($u)->find();
		  
		  if(!$od){
			  echo '{"success":74,"info":"该订单不存在"}';
		   	  exit;
			}else{
				
			 if($od['pay_status']){
			  echo '{"success":75,"info":"已付款订单不能删除"}';
		   	  exit;
			  }
				
				$rs = M('coupon')->where($u)->delete();
				if($rs){
					M('yhquan')->where('id='.$_POST['id'])->setDec('yigou'); //减一
					echo '{"success":76,"info":"订单删除成功"}';
		   	        exit;
				}
			}
		}
	}
	
	//优惠券订单列表
	public function coupon_orderlist(){
		if(IS_GET){
			if($_GET['userid'] == ""){
				echo '{"success":174,"info":"非法操作"}';
		   		exit;
			}
			$list = M('coupon')->where('userid='.$_GET['userid'])->order('inputtime DESC')->select();
			foreach($list as $k=>$v){
				$list[$k]['house_title'] = M('new')->where('id='.$v['house_id'])->getfield('title');
				$list[$k]['description'] = M('yhquan')->where('id='.$v['coupon_id'])->getfield('description');
			}
			if($list){
				echo json_encode($list,JSON_UNESCAPED_UNICODE);
				exit;
			}else{
				echo '{"success":175,"info":"无优惠券订单"}';
		   		exit;
			}
		}
	}
	
	//添加勾地接口
  public function goudi_add(){
  if(IS_POST){
        $db = M('goudi');
        $data['order_no'] = 'GD'.date('YmdHis',time()).rand(100,999);
		//echo var_dump($_POST);exit;
	
		if($_POST['house_id'] == "" || $_POST['userid'] == ""){
		   echo '{"success":78,"info":"数据不完整"}';
		   exit;
			}		
		//检验当前购房人姓名和手机号码 在数据库中已经存在
		$g['userid'] = $_POST['userid'];
		$g['house_id'] = $_POST['house_id'];
		$rt = $db ->where($g)->select();
		if($rt){
			echo '{"success":79,"info":"同一房源同一人只能勾一次地"}';
			exit;
			}
		
		
        $data['house_id'] = $_POST['house_id'];
		$house = M('dadazong')->where('id='.$_POST['house_id'])->find();
		if(!$house['hasgd']){
			echo '{"success":80,"info":"此地不需要勾"}';
		    exit;
			}
		if($house['goudijine'] <= 0){ 
			echo '{"success":81,"info":"此地不需要勾"}';
		    exit;
			}
        $data['userid'] = $_POST['userid'];
        $data['house_id'] = $_POST['house_id'];
		$data['jine'] = $_POST['jine'];
		$data['title'] = $_POST['title'];
        $data['addtime'] = time();
        //开始添加数据
        $rst = $db -> add($data);
        if($rst){
			$data['id']=$rst;
			echo '{"success":82,"info":"勾地成功","result":'.json_encode($data,JSON_UNESCAPED_UNICODE).'}';
			exit;
        }else{
		   echo '{"success":83,"info":"勾地失败"}';
			exit;
			}
    }
  }
  
  //勾地订单列表
	public function goudi_orderlist(){
		if(IS_GET){
			if($_GET['userid'] == ""){
				echo '{"success":176,"info":"非法操作"}';
		   		exit;
			}
			$list = M('goudi')->where('userid='.$_GET['userid'])->order('addtime DESC')->select();
			if($list){
				echo json_encode($list,JSON_UNESCAPED_UNICODE);
				exit;
			}else{
				echo '{"success":177,"info":"无勾地订单"}';
		   		exit;
			}
		}
	}
  
  //删除勾地接口--wst
  public function goudi_del(){
	  if(IS_POST){
		  $db = M('goudi');
		  $u['id'] = $_POST['id'];
		  $u['userid'] = $_POST['userid'];
		  
		  //////////
		  $od = $db->where($u)->find();
		  
		  if(!$od){
			  echo '{"success":84,"info":"该订单不存在"}';
		   	  exit;
			}else{
				
			 if($od['pay_status']){
			  echo '{"success":85,"info":"已付款订单不能删除"}';
		   	  exit;
			  }
				
				$rs = $db->where($u)->delete();
				if($rs){
					echo '{"success":86,"info":"订单删除成功"}';
		   	        exit;
				}
			}
		}
	}
	
	//判断是否勾地
	public function has_goudi(){
		if(IS_POST){
			if($_POST['userid']=='' || $_POST['house_id']==''){				
				echo '{"success":180,"info":"数据不完整"}';
		   		exit;
			}
			$u['userid'] = $_POST['userid'];
			$u['house_id'] = $_POST['house_id'];
			$u['pay_status'] = 1;
			$res = M('goudi')->where($u)->find();
				if($res){
					echo '{"success":181,"info":"已勾地"}';
		   			exit;
				}else{
					echo '{"success":182,"info":"未勾地"}';
		   			exit;
				}
		}
	}
	//添加房源关注 -- by wst
	public function guanzhu_add(){
		if(IS_POST){
			
			$a['userid'] = $_POST['userid'];
			$a['username'] = $_POST['username'];
			$res = M('member') -> where($a) -> find();
			if(!$res){
				echo '{"success":92,"info":"非法操作"}';
				exit;
			}
			$a['fromid'] = $_POST['fromid'];
			$a['fromtable'] = $_POST['fromtable'];
			
			$r = M('guanzhu') -> where($a)->find();
			if($r){
				echo '{"success":89,"info":"该房源已经关注"}';
				exit;
			}else{
				if(!$_POST['t'] || $_POST['t'] == '' || $_POST['t'] != 1){
					echo '{"success":178,"info":"该房源没有关注"}';
				}				
			}
			//t=1表示新增关注
			if(!$_POST['t'] || $_POST['t'] == '' || $_POST['t'] != 1){
				exit;
			}
			if($_POST['username'] == '' || $_POST['userid'] == '' || $_POST['fromid'] == '' || $_POST['fromtable'] == '' || $_POST['type'] == ''){
				echo '{"success":88,"info":"数据不完整"}';
				exit;
			}
			$a['title'] = $a['username'] = $_POST['username'];
			$a['type'] = $_POST['type'];
			$a['inputtime'] = $a['updatetime'] = time();
			$a['status'] = 99;
			$a['catid'] = 49;
			$rs = M('guanzhu') -> add($a);
			//插入附表
			$u['id'] = $rs;
            $u['content'] = "";
            $u['relation'] = "";
			$rs1 = M('guanzhu_data')->add($u);
			if($rs && $rs1){
				echo '{"success":90,"info":"关注成功"}';
				exit;
			}else{
				echo '{"success":91,"info":"关注失败"}';
				exit;
			}
		}
	}
	
	//添加预约
	public function yuyue_add(){
		if(IS_POST){						
			$db = M('yuyue');
			$k['username'] = $_POST['username'];
			$k['fromid'] = $_POST['fromid'];
			$k['fromtable'] = $_POST['fromtable'];
			$k["_string"] = "CONCAT(yuyuedate,' ',SPLIT_STR(yuyuetime,'-',2)) >= NOW() and zhuangtai<>'已取消'";		
			$f = M('yuyue') -> where($k) -> find();
			
			if($f){
				echo '{"success":95,"info":"已预约"}';
				exit;
			}else{
				if(!$_POST['t'] || $_POST['t'] == '' || $_POST['t'] != 1){
					echo '{"success":179,"info":"没有预约"}';
				}
			}

			//t=1表示新增预约
			if(!$_POST['t'] || $_POST['t'] == '' || $_POST['t'] != 1){
				exit;
			}
			if($_POST['fromid'] == '' || $_POST['fromtable'] == '' || $_POST['fromuserid'] == '' || $_POST['username'] == '' || $_POST['type'] == '' || $_POST['yuyuedate'] == '' || $_POST['yuyuetime'] == ''){
				echo '{"success":94,"info":"数据不完整"}';
				exit;
			}
			$data = $db->create($_POST);
			$data['fromuser'] = M('member')->where('userid='.$_POST['fromuserid'])->getfield('username');
			$data['zhuangtai'] = '新预约';
			$data['lock'] = 0;
			$data['catid'] = 50;
			$data['status'] = 99;
			$data['inputtime'] = $data['updatetime'] = time();
			$rs = $db->add($data);
			//插入附表
			$u['id'] = $rs;
            $u['content'] = "";
            $u['relation'] = "";
			$rs1 = M('yuyue_data')->add($u);
			if($rs && $rs1){
				echo '{"success":96,"info":"预约成功"}';
				exit;
			}else{
				echo '{"success":97,"info":"预约失败"}';
				exit;
			}
		}	
	}
	
	//api 获取房源详情
	 public function api_shows() {
        $catid = I('get.catid', 0, 'intval');
        $id = I('get.id', 0, 'intval');
		if(!$catid && !$id){
		 $catid = I('post.catid', 0, 'intval');
         $id = I('post.id', 0, 'intval');
			}
 		 $category = getCategory($catid);
        //模型ID
		$tablename = M('model')->where('modelid='.$category['modelid'])->getfield('tablename');
		
		$info = M($tablename)->where('id='.$id)->find();
		$info['cityname'] = M('area')->where('id='.$info['city'])->getfield('name');
		$info['areaname'] = M('area')->where('id='.$info['area'])->getfield('name');
		 if($info['pics']!='' && $info['pics']!='a:0:{}'){
			 $info['pics'] = unserialize($info['pics']);
		 }		
		$info['xiaoquname'] = M('xiaoqu')->where('id='.$info['xiaoqu'])->getfield('title');
		if($catid==3){
			$info['loupantupian'] = unserialize($info['loupantupian']);
			$info['yangbantu'] = unserialize($info['yangbantu']);
			$info['weizhitu'] = unserialize($info['weizhitu']);
			$info['shijingtu'] = unserialize($info['shijingtu']);
			$info['xiaoqutu'] = unserialize($info['xiaoqutu']);
			$info['html'] = M('new_data')->where('id='.$id)->find();
			/*优惠券*/
			$u['new_id'] = $id;
			$u['new_catid'] = $catid;
			$rs = M('yhquan') -> where($u) -> order('inputtime desc') -> select();
			if($rs){
			  $info['yhq'] = $rs;
			 /*获取优惠券购买人数和购买者信息*/
			 $info['yhq_buyer'] = M('coupon') -> where('house_id='.$id.' and pay_status=1') -> order('inputtime desc') -> select();
			 $info['yhq_buyer_count'] = M('coupon') -> where('house_id='.$id.' and pay_status=1') -> count();
			}
			
			/*楼盘动态*/
			$info['dongtai'] = M('loupandongtai')->where('new_id='.$id)->select();
						
		}
		if($catid==6){
			/*带看记录*/
			$aa['fromtable'] = "ershou";
			$aa['fromid'] = $id;
			$aa['lock'] = 1;
			$info['daikan'] = M('yuyue')->where($aa)->select();
			foreach($info['daikan'] as $k=>$v){
				$aa['username']=$v['username'];
				$uid=M('member')->where($aa)->getfield('userid');
				$uname=M('member_normal')->where('userid='.$uid)->getfield('realname');
				if($uname){
					$info['daikan'][$k]['realname'] = substr_replace($uname,'*',3,3);
			 	}else{
					$info['daikan'][$k]['realname']="***";
				}
				$info['daikan'][$k]['username'] = substr_replace($v['username'],'****',3,4);
			}
		}
		if($catid==6||$catid==8){
			/*同小区成交*/
			if($tablename=="ershou")
			{
				$info['tongqu'] = M($tablename)->where('xiaoqu='.$info['xiaoqu'].' and zaishou=0 and area='.$info['area'].' and id <> '.$info['id'])->select();
			}else{
				$info['tongqu'] = M($tablename)->where('xiaoqu='.$info['xiaoqu'].' and zaizu=0 and area='.$info['area'].' and id <> '.$info['id'])->select();
			}
		}
		if($catid==7){
			$info['fubiao'] = M($tablename.'_data')->where('id='.$id)->find();
		}
		 if($catid==6||$catid==8){
			 $aa['username'] = $info['username'];
			 $info['userid'] = M('member')->where($aa)->getfield('userid');
		 }
        echo json_encode($info,JSON_UNESCAPED_UNICODE);
    }
	
	//api 申请已售出/出租
	public function apply_shouchu(){
		if(IS_POST){
			if($_POST['id']=="" || $_POST['table']==""){
				echo '{"success":180,"info":"数据不完整"}';
				exit;
			}
			$table = $_POST['table'];
			$a1['id'] = $_POST['id'];
			$rs1 = M($table)->where($a1)->find();
			if(!$rs1){
				echo '{"success":181,"info":"非法操作"}';
				exit;
			}
			$a2['apply_state'] = 1;
			M($table)->where('id='.$_POST['id'])->save($a2);
			echo '{"success":182,"info":"申请成功"}';
		}
	}
	
	//api 购房须知列表
	public function house_xuzhi(){
		$db = M('article');
		$list = $db->where('catid=38 or catid=39 or catid=40 and status=99')->select();
		echo json_encode($list,JSON_UNESCAPED_UNICODE);
	}
		
}

?>