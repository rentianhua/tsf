<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 会员组管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Member\Controller;

use Common\Controller\AdminBase;

class MemberController extends AdminBase {

    //会员用户组缓存
    protected $groupCache = array();
    //会员模型
    protected $groupsModel = array();
    //会员数据模型
    protected $member = NULL;

    //初始化
    protected function _initialize() {
        parent::_initialize();
        $this->groupCache = cache("Member_group");
        $this->groupsModel = cache("Model_Member");
        $this->member = D('Member/Member');
    }

    //会员管理首页
    public function index() {
        $search = I("get.search", null);
        $where = array(
            'checked' => 1,
        );
        if ($search) {
            //注册时间段
            $start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '';
            $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : date('Y-m-d', time());
            //开始时间
            $where_start_time = strtotime($start_time) ? strtotime($start_time) : 0;
            //结束时间
            $where_end_time = strtotime($end_time) ? (strtotime($end_time) + 86400) : 0;
            //开始时间大于结束时间，置换变量
            if ($where_start_time > $where_end_time) {
                $tmp = $where_start_time;
                $where_start_time = $where_end_time;
                $where_end_time = $tmp;
                $tmptime = $start_time;
                $start_time = $end_time;
                $end_time = $tmptime;
                unset($tmp, $tmptime);
            }
            //时间范围
            if ($where_start_time) {
                $where['regdate'] = array('between', array($where_start_time, $where_end_time));
            }
            //状态
            $status = I('get.status', 0, 'intval');
            if ($status > 0) {
                $islock = $status == 1 ? 1 : 0;
                $where['islock'] = array("EQ", $islock);
            }
            //会员模型
            $modelid = I('get.modelid', 0, 'intval');
            if ($modelid > 0) {
                $where['modelid'] = array("EQ", $modelid);
            }
            //会员组
            $groupid = I('get.groupid', 0, 'intval');
            if ($groupid > 0) {
                $where['groupid'] = array("EQ", $groupid);
            }
            //关键字
            $keyword = I('get.keyword');
            if ($keyword) {
                $type = I('get.type', 0, 'intval');
                switch ($type) {
                    case 1:
                        $where['username'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 2:
                        $where['userid'] = array("EQ", $keyword);
                        break;
                    case 3:
                        $where['email'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 4:
                        $where['regip'] = array("EQ", $keyword);
                        break;
                    case 5:
                        $info = M('member_normal')-> where("realname like '%" .$keyword ."%'") -> field('userid') -> find();
                        $where['userid'] = array("EQ", $info['userid']);
                        break;
                    default:
                        $where['username'] = array("LIKE", '%' . $keyword . '%');
                        break;
                }
            }
        }
		$where['modelid'] = 35;
        $count = $this->member->where($where)->count();
        $page = $this->page($count, 20);
        $data = $this->member->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("userid" => "DESC"))->select();
		
		foreach ($data as $k=>$q) {
			$data[$k]['normal'] = M('member_normal')->where('userid='.$q['userid'])->find();
		}
        foreach ($this->groupCache as $g) {
            $groupCache[$g['groupid']] = $g['name'];
        }
        foreach ($this->groupsModel as $m) {
            $groupsModel[$m['modelid']] = $m['name'];
        }
        $this->assign('groupCache', $groupCache);
        $this->assign('groupsModel', $groupsModel);
        $this->assign("Page", $page->show('Admin'));
        $this->assign("data", $data);
        $this->display();
    }
	
	//导出用户数据
    public function userlist(){

        //如果没有选中任何，则导出所有数据
        $where['modelid']=35;
        $user=M('member')->where($where)->order('userid asc')->select();
        foreach ($user as $kk=>$vv){
			$user[$kk]['regdate'] = date("Y-m-d H:m:s",$vv['regdate']);
            $info = M('member_normal')->where('userid='.$vv['userid'])->find();	
			if($info){
				$user[$kk]['realname'] = $info['realname'];
				if($info['jiav'] == 1){
					$user[$kk]['jiav'] = "加V";
				}else{
					$user[$kk]['jiav'] = "不加V";
				}
			}
        }
        $OrdersData=$user;

        //$OrdersData=M('user')->where("tid='".$this->user['username']."'")
        import("Vendor.PHPExcel.PHPExcel");
        import("Vendor.PHPExcel.PHPExcel.Writer.Excel5");
        import("Vendor.PHPExcel.PHPExcel.IOFactory.php");

        //vendor("PHPExcel180.PHPExcel");

        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        //set width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);


        //设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //set font size bold
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //设置水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //合并cell
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

        // set table header content
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '客户数据  时间:'.date('Y-m-d H:i:s',time()))
            ->setCellValue('A2', '用户ID')
            ->setCellValue('B2', '用户名')
            ->setCellValue('C2', '姓名')
            ->setCellValue('D2', '分机号')
            ->setCellValue('E2', '注册时间')
            ->setCellValue('F2', '是否加V');

        foreach ($OrdersData as $k => $v) {
            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.($k+3), $v['userid']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.($k+3), $v['username']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.($k+3), $v['realname']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.($k+3), $v['vtel']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.($k+3), $v['regdate']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.($k+3), $v['jiav']);


            $objPHPExcel->getActiveSheet()->getStyle('A'.($k+3).':K'.($k+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.($k+3).':K'.($k+3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getRowDimension($k+3)->setRowHeight(16);
        }

        //  sheet命名
        $objPHPExcel->getActiveSheet()->setTitle('客户数据');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // excel头参数
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="客户数据('.date('Ymd-His').').xls"');  //日期为文件名后缀
        header('Cache-Control: max-age=0');

        ob_clean();//关键
        flush();//关键
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
        $objWriter->save('php://output');

    }
	
	//经纪人管理
    public function jjrlist() {
        $search = I("get.search", null);
        $where = array(
            'tsf_member.checked' => 1,
        );
        if ($search) {
            //注册时间段
            $start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '';
            $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : date('Y-m-d', time());
            //开始时间
            $where_start_time = strtotime($start_time) ? strtotime($start_time) : 0;
            //结束时间
            $where_end_time = strtotime($end_time) ? (strtotime($end_time) + 86400) : 0;
            //开始时间大于结束时间，置换变量
            if ($where_start_time > $where_end_time) {
                $tmp = $where_start_time;
                $where_start_time = $where_end_time;
                $where_end_time = $tmp;
                $tmptime = $start_time;
                $start_time = $end_time;
                $end_time = $tmptime;
                unset($tmp, $tmptime);
            }
            //时间范围
            if ($where_start_time) {
                $where['tsf_member.regdate'] = array('between', array($where_start_time, $where_end_time));
            }
            //状态
            $status = I('get.status', 0, 'intval');
            if ($status > 0) {
                $islock = $status == 1 ? 1 : 0;
                $where['tsf_member.islock'] = array("EQ", $islock);
            }
            //会员模型
            $modelid = I('get.modelid', 0, 'intval');
            if ($modelid > 0) {
                $where['tsf_member.modelid'] = array("EQ", $modelid);
            }
            //会员组
            $groupid = I('get.groupid', 0, 'intval');
            if ($groupid > 0) {
                $where['tsf_member.groupid'] = array("EQ", $groupid);
            }
            //关键字
            $keyword = I('get.keyword');
            if ($keyword) {
                $type = I('get.type', 0, 'intval');
                switch ($type) {
                    case 1:
                        $where['tsf_member.username'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 2:
                        $where['tsf_member.userid'] = array("EQ", $keyword);
                        break;
                    case 3:
                        $where['tsf_member.email'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 4:
                        $where['tsf_member_agent.realname'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 5:
                        $where['tsf_member.nickname'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    default:
                        $where['tsf_member.username'] = array("LIKE", '%' . $keyword . '%');
                        break;
                }
            }
        }
		$where['tsf_member.modelid'] = 36;

        $count = M('member')->join('tsf_member_agent on tsf_member.userid=tsf_member_agent.userid')->where($where)->count();
        $page = $this->page($count, 20);
        $data = M('member')->join('tsf_member_agent on tsf_member.userid=tsf_member_agent.userid')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("tsf_member.userid" => "DESC"))->select();

//		foreach ($data as $k=>$q) {
//			$data[$k]['agent'] = M('member_agent')->where('userid='.$q['userid'])->find();
//		}

        foreach ($this->groupCache as $g) {
            $groupCache[$g['groupid']] = $g['name'];
        }
        foreach ($this->groupsModel as $m) {
            $groupsModel[$m['modelid']] = $m['name'];
        }
        $this->assign('groupCache', $groupCache);
        $this->assign('groupsModel', $groupsModel);
        $this->assign("Page", $page->show('Admin'));
        $this->assign("data", $data);
        $this->display();
    }
	//导出经纪人数据
    public function jjrdata(){

        //如果没有选中任何，则导出所有数据
        $where['modelid']=36;
        $user=M('member')->where($where)->order('userid asc')->select();
        foreach ($user as $kk=>$vv){
			$user[$kk]['regdate'] = date("Y-m-d H:m:s",$vv['regdate']);
            $agent = M('member_agent')->where('userid='.$vv['userid'])->find();							
			if($agent['jiav'] == 1){
				$agent['jiav'] = "加V";			
			}else{
				$agent['jiav'] = "不加V";
			}
			if($agent['dengji'] == 1){
				$agent['dengji'] = "普通经纪人";			
			}else if($agent['dengji'] == 2){
				$agent['dengji'] = "优秀经纪人";
			}else if($agent['dengji'] == 3){
				$agent['dengji'] = "高级经纪人";
			}else if($agent['dengji'] == 4){
				$agent['dengji'] = "资深经纪人";
			}
			if($agent['worktime'] == 6){
				$agent['worktime'] = "5年以上";			
			}else{
				$agent['worktime'] = $agent['worktime']."年";
			}
			$user[$kk]['agent'] = $agent;
        }
        $OrdersData=$user;

        //$OrdersData=M('user')->where("tid='".$this->user['username']."'")
        import("Vendor.PHPExcel.PHPExcel");
        import("Vendor.PHPExcel.PHPExcel.Writer.Excel5");
        import("Vendor.PHPExcel.PHPExcel.IOFactory.php");

        //vendor("PHPExcel180.PHPExcel");

        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        //set width
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);


        //设置行高度
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

        //set font size bold
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //设置水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //合并cell
        $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

        // set table header content
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '经纪人数据  时间:'.date('Y-m-d H:i:s',time()))
            ->setCellValue('A2', '用户ID')
            ->setCellValue('B2', '用户名')
            ->setCellValue('C2', '姓名')
            ->setCellValue('D2', '分机号')
            ->setCellValue('E2', '注册时间')
            ->setCellValue('F2', '是否加V')
            ->setCellValue('G2', '身份证号码')
            ->setCellValue('H2', '类型')
            ->setCellValue('I2', '公司名称')
            ->setCellValue('J2', '等级')
            ->setCellValue('K2', '从业年限')
            ->setCellValue('L2', '主营区域')
            ->setCellValue('M2', '标签');

        foreach ($OrdersData as $k => $v) {
            $objPHPExcel->getActiveSheet(0)->setCellValue('A'.($k+3), $v['userid']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B'.($k+3), $v['username']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('C'.($k+3), $v['agent']['realname']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('D'.($k+3), $v['vtel']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('E'.($k+3), $v['regdate']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F'.($k+3), $v['agent']['jiav']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('G'.($k+3), ' '.$v['agent']['cardnumber']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('H'.($k+3), $v['agent']['leixing']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('I'.($k+3), $v['agent']['coname']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('J'.($k+3), $v['agent']['dengji']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('K'.($k+3), $v['agent']['worktime']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('L'.($k+3), $v['agent']['mainarea']);
			$objPHPExcel->getActiveSheet(0)->setCellValue('M'.($k+3), $v['agent']['biaoqian']);
			


            $objPHPExcel->getActiveSheet()->getStyle('A'.($k+3).':K'.($k+3))->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.($k+3).':K'.($k+3))->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getRowDimension($k+3)->setRowHeight(16);
        }

        //  sheet命名
        $objPHPExcel->getActiveSheet()->setTitle('经纪人数据');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // excel头参数
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="经纪人数据('.date('Ymd-His').').xls"');  //日期为文件名后缀
        header('Cache-Control: max-age=0');

        ob_clean();//关键
        flush();//关键
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
        $objWriter->save('php://output');

    }
	
    //添加会员
    public function add() {
        if (IS_POST) {
            $post = I('post.');
            $info = $this->member->token(false)->create($post);
            if ($info) {
                //vip过期时间
                $info['overduedate'] = strtotime($post['overduedate']);
                $userid = service("Passport")->userRegister($info['username'], $info['password'], $info['email']);
                if ($userid > 0) {
                    $memberinfo = service("Passport")->getLocalUser((int) $userid);
                    $info['username'] = $memberinfo['username'];
                    $info['password'] = $memberinfo['password'];
                    $info['email'] = $memberinfo['email'];
                    if (false !== $this->member->where(array('userid' => $memberinfo['userid']))->save($info)) {
                        $this->success("添加会员成功！", U("Member/index"));
                    } else {
                        service("Passport")->userDelete($memberinfo['userid']);
                        $this->error("添加会员失败！");
                    }
                } else {
                    $this->error($this->member->getError($userid));
                }
            } else {
                $this->error($this->member->getError());
            }
        } else {
            foreach ($this->groupCache as $g) {
                if (in_array($g['groupid'], array(8, 1, 7))) {
                    continue;
                }
                $groupCache[$g['groupid']] = $g['name'];
            }
            foreach ($this->groupsModel as $m) {
                $groupsModel[$m['modelid']] = $m['name'];
            }
            $this->assign('groupCache', $groupCache);
            $this->assign('groupsModel', $groupsModel);
            $this->display();
        }
    }

    //修改会员 
    public function edit() {
        if (IS_POST) {
            $userid = I('post.userid', 0, 'intval');
            $post = I('post.');
            $info = I('post.info');
            $modelid = I('post.modelid', 0, 'intval');
            $data = $this->member->create($post);
            if ($data) {
                $data['overduedate'] = strtotime($data['overduedate']);
                //获取用户信息
                $userinfo = service("Passport")->getLocalUser($userid);
                if (empty($userinfo)) {
                    $this->error('该会员不存在！');
                }
                $ContentModel = \Content\Model\ContentModel::getInstance($modelid);
                if ($userinfo['modelid'] == $modelid && $info) {
                    //详细信息验证
                    $content_input = new \content_input($modelid);
                    $inputinfo = $content_input->get($info, 2);
                    if ($inputinfo) {
                        //数据验证
                        $inputinfo = $ContentModel->token(false)->create($inputinfo, 2);
                        if (false == $inputinfo) {
                            $ContentModel->tokenRecovery($post);
                            $this->error($ContentModel->getError());
                        }
                    } else {
                        $ContentModel->tokenRecovery($post);
                        $this->error($content_input->getError());
                    }
                    //检查详细信息是否已经添加过
                    if ($ContentModel->where(array("userid" => $userid))->find()) {
                        $ContentModel->where(array("userid" => $userid))->save($inputinfo);
                    } else {
                        $inputinfo['userid'] = $userid;
                        $ContentModel->add($inputinfo);
                    }
                }
                //判断是否需要删除头像
                if (I('post.delavatar')) {
                    service("Passport")->userDeleteAvatar($userinfo['userid']);
                }
                //修改基本资料
                if ($userinfo['username'] != $data['username'] || !empty($data['password']) || $userinfo['email'] != $data['email']) {
                    $edit = service("Passport")->userEdit($data['username'], '', $data['password'], $data['email'], 1);
                    if ($edit < 0) {
                        $this->error($this->member->getError($edit));
                    }
                }
                unset($data['username'], $data['password'], $data['email']);
                //更新除基本资料外的其他信息
                if (false === $this->member->where(array('userid' => $userid))->save($data)) {
                    $this->error('更新失败！');
                }
                $this->success("更新成功！", U("Member/index"));
            } else {
                $this->error($this->member->getError());
            }
        } else {
            $userid = I('get.userid', 0, 'intval');
            $modelid = I('get.modelid', 0, 'intval');
            //主表
            $data = $this->member->where(array("userid" => $userid))->find();
            if (empty($data)) {
                $this->error("该会员不存在！");
            }
            if ($modelid) {
                if (!$this->groupsModel[$modelid]) {
                    $this->error("该模型不存在！");
                }
            } else {
                $modelid = $data['modelid'];
            }
            //会员模型数据表名
            $tablename = $this->groupsModel[$modelid]['tablename'];
            //相应会员模型数据
            $modeldata = M(ucwords($tablename))->where(array("userid" => $userid))->find();
            if (!is_array($modeldata)) {
                $modeldata = array();
            }
            $data = array_merge($data, $modeldata);
            $content_form = new \content_form($modelid);
            $data['modelid'] = $modelid;
            //字段内容
            $forminfos = $content_form->get($data);
            //js提示
            $formValidator = $content_form->formValidator;

            foreach ($this->groupCache as $g) {
                if (in_array($g['groupid'], array(8, 1, 7))) {
                    continue;
                }
                $groupCache[$g['groupid']] = $g['name'];
            }
            foreach ($this->groupsModel as $m) {
                $groupsModel[$m['modelid']] = $m['name'];
            }
            $this->assign('groupCache', $groupCache);
            $this->assign('groupsModel', $groupsModel);
            $this->assign("forminfos", $forminfos);
            $this->assign("formValidator", $formValidator);
            $this->assign("data", $data);
            $this->display();
        }
    }

    //删除会员
    public function delete() {
        if ($_GET['userid'] != '') {
            $uid = I('get.userid');			   			
            $connect = M("Connect");
            $kk['username'] = M('member')->where('userid='.$uid)->getfield('username');
			$con = 0;
			$rs = M('chuzu')->where($kk)->find();
			if($rs){
				$con = 1;
			}else{
				$rs1 = M('ershou')->where($kk)->find();
				if($rs1){
					$con = 1;
				}
			}
			if($con){
				$this->error("请先删除该会员发布的所有房源信息");
			}else{
				$info = $this->member->where(array("userid" => $uid))->find();				
				if (!empty($info)) {
					//删除会员信息，且删除投稿相关
					if (service("Passport")->userDelete($uid)) {
						$connect->where(array("uid" => $uid))->delete();
					}

                    if (M("member_agent")->where(array("userid" => $uid))->find()) 
                    {
                        M("member_agent")->where(array("userid" => $uid))->delete();
                    }
				}
			}
            $this->success("删除成功！");
        }
    }

    //锁定会员 
    public function lock() {
        if (IS_POST) {
            $userid = I('post.userid');
            if (!$userid) {
                $this->error("请选择需要锁定的会员！");
            }
            $this->member->where(array("userid" => array('IN', $userid)))->save(array("islock" => 1));
            $this->success("锁定成功！");
        }
    }

    //解除锁定会员 
    public function unlock() {
        if (IS_POST) {
            $userid = I('post.userid');
            if (!$userid) {
                $this->error("请选择需要解锁的会员！");
            }
            $this->member->where(array("userid" => array('IN', $userid)))->save(array("islock" => 0));
            $this->success("解锁成功！");
        }
    }

    //会员资料查看 
    public function memberinfo() {
        $userid = I('get.userid', 0, 'intval');
        //主表
        $data = $this->member->where(array("userid" => $userid))->find();
        if (empty($data)) {
            $this->error("该会员不存在！");
        }
        $modelid = $data['modelid'];
        //相应会员模型数据
        $modeldata = \Content\Model\ContentModel::getInstance($modelid)->where(array("userid" => $userid))->find();
        $content_output = new \content_output($modelid);
        $output_data = $content_output->get($modeldata);
        $modelField = cache('ModelField');
        $Model_field = $modelField[$modelid];
        foreach ($this->groupCache as $g) {
            $groupCache[$g['groupid']] = $g['name'];
        }
        foreach ($this->groupsModel as $m) {
            $groupsModel[$m['modelid']] = $m['name'];
        }
        $this->assign('groupCache', $groupCache);
        $this->assign('groupsModel', $groupsModel);
        $this->assign("output_data", $output_data);
        $this->assign("Model_field", $Model_field);
        $this->assign($data);
        $this->display();
    }

    //审核会员 
    public function userverify() {
        if (IS_POST) {
            $userid = $_POST['userid'];
            if (!$userid) {
                $this->error("请选择需要审核的会员！");
            }
            $this->member->where(array("userid" => array('IN', $userid)))->save(array("checked" => 1));
            $this->success("审核成功！");
        } else {
            $where = array();
            $search = I("get.search", null);
            $where['checked'] = array("EQ", 0);
            if ($search) {
                //注册时间段
                $start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '';
                $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : date('Y-m-d', time());
                //开始时间
                $where_start_time = strtotime($start_time) ? strtotime($start_time) : 0;
                //结束时间
                $where_end_time = strtotime($end_time) + 86400;
                //开始时间大于结束时间，置换变量
                if ($where_start_time > $where_end_time) {
                    $tmp = $where_start_time;
                    $where_start_time = $where_end_time;
                    $where_end_time = $tmp;
                    $tmptime = $start_time;

                    $start_time = $end_time;
                    $end_time = $tmptime;
                    unset($tmp, $tmptime);
                }
                $where['regdate'] = array('between', array($where_start_time, $where_end_time));
                //会员模型
                $modelid = I('get.modelid', 0, 'intval');
                if ($modelid > 0) {
                    $where['modelid'] = array("EQ", $modelid);
                }
                //会员组
                $groupid = I('get.groupid', 0, 'intval');
                if ($groupid > 0) {
                    $where['groupid'] = array("EQ", $groupid);
                }
                //关键字
                $keyword = I('get.keyword');
                if ($keyword) {
                    $type = I('get.type', 0, 'intval');
                    switch ($type) {
                        case 1:
                            $where['username'] = array("LIKE", '%' . $keyword . '%');
                            break;
                        case 2:
                            $where['userid'] = array("EQ", $keyword);
                            break;
                        case 3:
                            $where['email'] = array("LIKE", '%' . $keyword . '%');
                            break;
                        case 4:
                            $where['regip'] = array("EQ", $keyword);
                            break;
                        case 5:
                            $where['nickname'] = array("LIKE", '%' . $keyword . '%');
                            break;
                        default:
                            $where['username'] = array("LIKE", '%' . $keyword . '%');
                            break;
                    }
                }
            }

            $count = $this->member->where($where)->count();
            $page = $this->page($count, 20);
            $data = $this->member->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array("userid" => "DESC"))->select();
            foreach ($this->groupCache as $g) {
                $groupCache[$g['groupid']] = $g['name'];
            }
            foreach ($this->groupsModel as $m) {
                $groupsModel[$m['modelid']] = $m['name'];
            }
            $this->assign('groupCache', $groupCache);
            $this->assign('groupsModel', $groupsModel);
            $this->assign("Page", $page->show('Admin'));
            $this->assign("data", $data);
            $this->display();
        }
    }

    //用户授权管理
    public function connect() {
        $db = D("Member/Connect");
        if (IS_POST) {
            //批量删除
            $connectid = I('post.connectid');
            if ($db->connectDel($connectid)) {
                $this->success("操作成功！");
            } else {
                $this->error($db->getError());
            }
        } else {
            $connectid = I('get.connectid', 0, 'intval');
            if ($connectid) {
                //单个删除
                if ($db->connectDel($connectid)) {
                    $this->success("取消绑定成功！");
                } else {
                    $this->error($db->getError());
                }
            } else {
                $count = $db->count();
                $page = $this->page($count, 20);
                $data = $db->limit($page->firstRow . ',' . $page->listRows)->order(array('connectid' => 'DESC'))->select();
                foreach ($data as $k => $r) {
                    $data[$k]['username'] = $this->member->where(array("userid" => $r['uid']))->getField("username");
                    $data[$k]['userid'] = $r['uid'];
                }
                $this->assign("Page", $page->show('Admin'));
                $this->assign("data", $data);
                $this->display();
            }
        }
    }
	
	//经纪人中心
	public function jjrcenter(){
		if (IS_GET) {			
			$t = I('get.t');	
			$u['username'] = I('get.username');
			$k['userid'] = I('get.userid');
			$x['jjrid'] = I('get.userid');
			$s['username'] = I('get.username');
			$s['zaishou'] = 0;
			
			if(!$t || $t == 1){	//发布的二手房
				$info = M('ershou') -> where($u) -> select();
			}elseif($t == 2){	//发布的出租房
				$info = M('chuzu') -> where($u) -> select();
			}elseif($t == 3){	//成交房源
				$info = M('ershou') -> where($s) -> select();
			}elseif($t == 4){	//预约管理
				$info = M('yuyue') -> where($x) -> field('id,yuyuedate,yuyuetime,fromid') -> select();
				
				if($info){
					foreach($info as $k=>$v){
						$info[$k]['house'] = M('ershou') -> where('id='.$v['fromid']) -> field('url,title') -> find();
						
					}				
				}
			}elseif($t == 5){	//求租管理
				$info = M('userqiuzu') -> where($x) -> select();
			}elseif($t == 7){	//优惠券订单
				$info = M('coupon') -> where($k) -> select();
				if($info){
					foreach($info as $k=>$v){
						$info[$k]['house'] = M('new') -> where('id='.$v['house_id']) -> field('url,title') -> find();	
						$info[$k]['desc'] = M('yhquan') -> where('id='.$v['coupon_id']) -> getfield('description');
					}
				}
			}elseif($t == 8){	//勾地订单
				$info = M('goudi') -> where($k) -> select();
				if($info){
					foreach($info as $k=>$v){
						$info[$k]['house'] = M('dadazong') -> where('id='.$v['house_id']) -> field('url,title') -> find();	
					}
				}
			}elseif($t == 9){	//历史记录
				$info = M('history') -> where($u) -> select();
			}
			$this -> assign('info', $info);
			$this -> display();
		
		}
	}
	
	//用户中心
	public function usercenter(){
		if (IS_GET) {
			$t = I('get.t');	
			$u['username'] = I('get.username');
			$k['userid'] = I('get.userid');				
			if(!$t || $t == 1){ //关注的二手房
				$u['fromtable'] = 'ershou';
				$fid = M('guanzhu') -> where($u) -> getfield('fromid');	
				if($fid){
					$info = M('ershou') -> where('id='.$fid) -> select(); 
				}			
			}elseif($t == 2){	//关注的新房
				$u['fromtable'] = 'new';				
				$fid = M('guanzhu') -> where($u) -> getfield('fromid');				
				if($fid){
					$info = M('new') -> where('id='.$fid) -> select(); 
				}
			}elseif($t == 3){	//发布的二手房
				$info = M('ershou') -> where($u) -> select();
			}elseif($t == 4){	//发布的出租房
				$info = M('chuzu') -> where($u) -> select();
			}elseif($t == 5){	//求租房
				$info = M('userqiuzu') -> where($u) -> select();
			}elseif($t == 6){	//预约
				$info = M('yuyue') -> where($u) -> field('id,yuyuedate,yuyuetime,fromid') -> select();
				
				if($info){
					foreach($info as $k=>$v){
						$info[$k]['house'] = M('ershou') -> where('id='.$v['fromid']) -> field('url,title') -> find();
						
					}				
				}
			}elseif($t == 7){	//优惠券订单
				$info = M('coupon') -> where($k) -> select();
				if($info){
					foreach($info as $k=>$v){
						$info[$k]['house'] = M('new') -> where('id='.$v['house_id']) -> field('url,title') -> find();	
						$info[$k]['desc'] = M('yhquan') -> where('id='.$v['coupon_id']) -> getfield('description');
					}
				}
			}elseif($t == 8){	//勾地订单
				$info = M('goudi') -> where($k) -> select();
				if($info){
					foreach($info as $k=>$v){
						$info[$k]['house'] = M('dadazong') -> where('id='.$v['house_id']) -> field('url,title') -> find();	
					}
				}
			}elseif($t == 9){	//历史记录
				$info = M('history') -> where($u) -> select();
			}
			$this -> assign('info', $info);
			$this -> display();
		}
	}

}
