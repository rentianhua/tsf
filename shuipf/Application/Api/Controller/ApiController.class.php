<?php
namespace Api\Controller;
use Common\Controller\ShuipFCMS;
use Libs\Service\Sms;
class ApiController extends ShuipFCMS {
	//获取“猜你喜欢”房源列表
	public function love() {
		$db = M('area');
		$result = $db->where($u)->field('id,cid,name')->select(); // 查询指定字段
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
	}
	//新增虚拟号码
	public function add_vtel() {
		$s['username'] = $_GET['tel'];
		$s['userid'] = $_GET['userid'];
		$rt = M('member')->where($s)->find();
		if (!$rt) {
			echo '{"success":58,"info":"手机号码错误"}';
			exit;
		}
		if (!preg_match("/^1[34578]{1}\d{9}$/", $_GET['tel'])) {
			echo '{"success":59,"info":"手机号码格式无效"}';
			exit;
		}
		$apiurl = "http://210.14.79.50/platform/iface";
		$num = "4008560008";
		$data['num'] = $num;
		$data['parentDeptId'] = $num;
		$data['deptName'] = $_GET['tel'];
		$data['colorRingLsh'] = '116992972';
		$data['isChild'] = '0';
		$data['childinType'] = '0';
		//计算vtel
		$rs = M('member')->where('username=' . $data['deptName'])->Field('vtel,nickname,username,zhuanjie')->find();
		if ($rs['vtel'] && $rs['zhuanjie']) {
			echo '{"success":64,"info":"该用户已经存在转接号码"}';
			exit;
		}
		if ($rs['zhuanjie'] == "0" && $rs['vtel'] == "") {
			//计算出vtel 按键号码
			$newtel = M('member')->max('vtel');
			if (intval($newtel)) {
				$newtel = intval($newtel) + 1;
			} else {
				$newtel = "20001";
			}
		}
		if ($rs['vtel'] && $rs['zhuanjie'] == 0) {
			$newtel = $rs['vtel'];
		}
		$data['ivrKey'] = $newtel;
		$url = $apiurl . "/saveDept.do";
		$data = http_build_query($data);
		$opts = array('http' => array('method' => 'POST', 'header' => "application/x-www-form-urlencoded" . "Content-Length: " . strlen($data) . "\r\n", 'content' => $data));
		$context = stream_context_create($opts);
		$html = file_get_contents($url, false, $context);
		$html = json_decode($html, true);
		//获得deptid
		$deptId = $html['data']['deptId'];
		//echo $deptId;
		//在该导航下增加坐席开始
		$arr['num'] = $num;
		$arr['deptId'] = $deptId;
		$arr['password'] = "9" . $newtel;
		$arr['reportNum'] = $newtel;
		$arr['userName'] = $newtel;
		$arr['bindPhone'] = $rs['username'];
		$arr['agentType'] = "1";
		$url = $apiurl . "/saveUserAgentBindIvr.do";
		$arr = http_build_query($arr);
		$opts = array('http' => array('method' => 'POST', 'header' => "application/x-www-form-urlencoded" . "Content-Length: " . strlen($arr) . "\r\n", 'content' => $arr));
		$context = stream_context_create($opts);
		$html2 = file_get_contents($url, false, $context);
		$html2 = json_decode($html2, true);
		$agentId = $html2['data']['agentId'];
		//在该导航下增加坐席结束
		//echo var_dump($html2);exit;
		if ($html2['result']) {
			$u['vtel'] = $newtel;
			$p['username'] = $_GET['tel'];
			$u['deptId'] = $deptId; //导航ID
			$u['agentId'] = $agentId; //坐席ID
			$u['zhuanjie'] = 1;
			$rst = M('member')->where($p)->save($u);
			echo '{"success":57,"info":"申请成功","vtel":"' . $newtel . '"}';
			exit;
		}
	}
	//移除电话转接
	public function remove_vtel() {
		//获取当前用户的400系统中的 userid
		$s['username'] = $_GET['tel'];
		$s['userid'] = $_GET['userid'];
		$rt = M('member')->where($s)->find();
		if (!$rt) {
			echo '{"success":66,"info":"数据错误"}';
			exit;
		}
		$apiurl = "http://210.14.79.50/platform/iface";
		$url = $apiurl . "/getAgentList.do"; //9．获取某个导航的坐席列表
		$num = "4008560008";
		$data['num'] = $num;
		$data['deptId'] = $rt['deptid'];
		$data = http_build_query($data);
		$opts = array('http' => array('method' => 'POST', 'header' => "application/x-www-form-urlencoded" . "Content-Length: " . strlen($data) . "\r\n", 'content' => $data));
		$context = stream_context_create($opts);
		$arr = file_get_contents($url, false, $context);
		$arr = json_decode($arr, true);
		//如果返回成功则取userid
		if ($arr['result']) {
			$userid = $arr['data'][0]['userId'];
		} else {
			echo '{"success":61,"info":"获取信息错误"}';
			exit;
		}
		//////////////////////////////////////////////////////////////
		//导航下移除坐席
		$url = $apiurl . "/deleteUserAgent.do"; //9．获取某个导航的坐席列表
		$data1['num'] = $num;
		$data1['agentId'] = $rt['agentid'];
		$data1 = http_build_query($data1);
		$opts1 = array('http' => array('method' => 'POST', 'header' => "application/x-www-form-urlencoded" . "Content-Length: " . strlen($data1) . "\r\n", 'content' => $data1));
		$context = stream_context_create($opts1);
		$arr1 = file_get_contents($url, false, $context);
		$arr1 = json_decode($arr1, true);
		//echo var_dump($arr1);exit;
		if ($arr1['result'] == false) {
			echo '{"success":62,"info":"移除坐席失败"}';
			exit;
		}
		//删除导航/////////////////////////////////////////////////////
		$url = $apiurl . "/delDept.do"; //17．删除导航
		$data2['num'] = $num;
		$data2['deptId'] = $rt['deptid'];
		$data2 = http_build_query($data2);
		$opts2 = array('http' => array('method' => 'POST', 'header' => "application/x-www-form-urlencoded" . "Content-Length: " . strlen($data2) . "\r\n", 'content' => $data2));
		$context = stream_context_create($opts2);
		$arr2 = file_get_contents($url, false, $context);
		$arr2 = json_decode($arr2, true);
		if ($arr2['result'] == false) {
			echo '{"success":63,"info":"删除转接失败"}';
			exit;
		} else {
			$d['zhuanjie'] = 0;
			$d['deptId'] = "";
			$d['agentId'] = "";
			M('member')->where('username=' . $_GET['tel'])->save($d);
			echo '{"success":64,"info":"删除转接成功"}';
			exit;
		}
	}
	//优惠券支付
	public function yhq_pay() {
		//获取优惠券订单id
		$id = $_GET['id'];
		$order = M('coupon')->where('id=' . $id)->find();
		if ($order['status'] == 1) {
			$this->error("该订单已经支付，请勿重新支付", U("member/user/yhq"));
		}
		$data['WIDout_trade_no'] = $order['order_no'];
		$data['WIDsubject'] = $order['coupon_name'];
		$data['WIDtotal_fee'] = $order['shifu'];
		$data['WIDbody'] = $order['buyname'] . "/" . $order['buytel'] . "/" . $order['difu'] . "/" . $order['shifu'] . "/" . $order['userid'] . "/" . $order['house_id'] . "/" . $order['coupon_id'];
		$apiurl = "http://www.taoshenfang.com";
		$url = $apiurl . "/alipay/alipayapi.php";
		echo "<form style='display:none;' id='form1' name='form1' method='post' action='" . $url . "'>
              <input name='WIDout_trade_no' type='text' value='" . $data['WIDout_trade_no'] . "' />
              <input name='WIDsubject' type='text' value='" . $data['WIDsubject'] . "'/>
              <input name='WIDtotal_fee' type='text' value='" . $data['WIDtotal_fee'] . "'/>
              <input name='WIDbody' type='text' value='" . $data['WIDbody'] . "'/>            </form>
              <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
	}
	//支付信息处理
	public function return_url() {
		$order_no = $_POST['order_no'];
		$trade_no = $_POST['trade_no'];
		$trade_status = $_POST['trade_status'];
		$buyer_email = $_POST['buyer_email'];
		if ($order_no == "" || $trade_no == "" || $trade_status == "") {
			$this->error("非法请求");
		}
		//首先进入优惠券订单开始查询
		$db = M('coupon');
		$u['order_no'] = $order_no;
		$rs = $db->where($u)->find();
		if ($rs) {
			$data['trade_no'] = $trade_no;
			$data['trade_status'] = $trade_status;
			$data['pay_status'] = 1;
			$data['buyer_email'] = $buyer_email;
			$data['paytime'] = time();
			$rst = $db->where($u)->save($data);
			if ($rst) {
				if($rs['sms_status']==0){
					//发送短信开始
					$config = array(
					'key' => C('Alidayu_APP_KEY'), //key
					'secret' => C('Alidayu_APP_SECRET'), //secret
					'sign' => '身份验证', //短信签名
					'sms_param' => array('name' => '','product' => '')//短信参数
					 );
					 $sms = service("Sms", $config);
					 //fix by tianhua 2017.03.28
					 //$sms->send($rs[buytel],'SMS_43490001', array('name' => $rs[buytel],'product' =>'淘深房','cardno'=>$rs[yhq_no]));
					 $sms->send($rs[buytel],'SMS_43490001', array('name' => $rs[buytel],'product' =>'淘深房','cardno'=>$rs[order_no]));
					 //end fix
					//发送短信结束
					M('coupon')->where($u)->setInc('sms_status',1);
				}

				
				$this->success("支付成功", U("member/user/yhq"));
			}
		} else {
			$db = M('goudi');
			$u['order_no'] = $order_no;
			$rs = $db->where($u)->find();
			if ($rs) {
				$data['trade_no'] = $trade_no;
				$data['trade_status'] = $trade_status;
				$data['pay_status'] = 1;
				$data['buyer_email'] = $buyer_email;
				$data['paytime'] = time();
				$rst = $db->where($u)->save($data);
				if ($rst) {
					$this->success("支付成功", U("member/user/gd"));
				}
			}
		}
	}
	//app端支付状态返回 BY_KOLOOR
	public function app_return_url() {
		// if (IS_POST) {
		// 	    $arr['note'] =  json_encode($_POST);
		// 	    $arr['type'] = 'POST';
		// 	    $arr['addtime'] = date('Y-m-d H:i:s',time());
		// 	 	M('test')->add($arr);
		// }else{
		// 		$arrs['note'] = json_encode($_GET);
		// 		$arrs['type'] = 'GET';
		// 		$arrs['addtime'] = date('Y-m-d H:i:s',time());
		// 		M('test')->add($arrs);
		// }
		if (IS_POST) {
			$order_no = I('post.out_trade_no', '', 'htmlspecialchars');
			$trade_no = I('post.trade_no', '', 'htmlspecialchars');
			$trade_status = I('post.resultStatus', '', 'htmlspecialchars');
			$jine = I('post.total_amount', '', 'htmlspecialchars');
			if ($order_no == "" || $trade_no == "" || $trade_status == "" || $jine == "") {
				echo '{"success":0,"info":"参数不完整"}';
				exit;
			}
			//首先进入优惠券订单开始查询
			$db = M('coupon');
			$u['order_no'] = $order_no;
			$rs = $db->where($u)->find();
			if ($rs) {
				$data['trade_no'] = $trade_no;
				$data['trade_status'] = $trade_status;
				$data['pay_status'] = 1;
				$data['buyer_email'] = "***";
				$data['paytime'] = time();
				$rst = $db->where($u)->save($data);
				if ($rst) {
					if($rs['sms_status']==0){
					//发送短信开始
					$config = array(
					'key' => C('Alidayu_APP_KEY'), //key
					'secret' => C('Alidayu_APP_SECRET'), //secret
					'sign' => '淘深房', //短信签名
					'sms_param' => array('name' => '','product' => '')//短信参数
					 );
					 $sms = service("Sms", $config);
					 //fix by tianhua 2017.04.12
					 //$sms->send($rs[buytel],'SMS_43490001', array('name' => $rs[buytel],'product' =>'淘深房','cardno'=>$rs[yhq_no]));
					 $sms->send($rs[buytel],'SMS_43490001', array('name' => $rs[buytel],'product' =>'淘深房','cardno'=>$rs[order_no]));
					 //end fix
					//发送短信结束
					M('coupon')->where($u)->setInc('sms_status',1);
				}
					echo '{"success":1,"info":"更新成功"}';
					exit;
				} else {
					echo '{"success":0,"info":"未更新"}';
					exit;
				}
			} else {
				$db = M('goudi');
				$u['order_no'] = $order_no;
				$rs = $db->where($u)->find();
				if ($rs) {
					$data['trade_no'] = $trade_no;
					$data['trade_status'] = $trade_status;
					$data['pay_status'] = 1;
					$data['buyer_email'] = "***";
					$data['paytime'] = time();
					$rst = $db->where($u)->save($data);
					if ($rst) {
						echo '{"success":1,"info":"更新成功"}';
						exit;
					} else {
						echo '{"success":0,"info":"未更新"}';
						exit;
					}
				}
			}
		}
	}
	//勾地支付
	public function gd_pay() {
		//获取优惠券订单id
		$id = $_GET['id'];
		$order = M('goudi')->where('id=' . $id)->find();
		if ($order['status'] == 1) {
			$this->error("该订单已经支付，请勿重新支付", U("member/user/gd"));
		}
		$data['WIDout_trade_no'] = $order['order_no'];
		$data['WIDsubject'] = $order['title'];
		$data['WIDtotal_fee'] = $order['jine'];
		$data['WIDbody'] = $order['userid'] . "/" . $order['house_id'];
		$apiurl = "http://www.taoshenfang.com";
		$url = $apiurl . "/alipay/alipayapi.php";
		echo "<form style='display:none;' id='form1' name='form1' method='post' action='" . $url . "'>
              <input name='WIDout_trade_no' type='text' value='" . $data['WIDout_trade_no'] . "' />
              <input name='WIDsubject' type='text' value='" . $data['WIDsubject'] . "'/>
              <input name='WIDtotal_fee' type='text' value='" . $data['WIDtotal_fee'] . "'/>
              <input name='WIDbody' type='text' value='" . $data['WIDbody'] . "'/>            </form>
            <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
	}
}
?>



        

        