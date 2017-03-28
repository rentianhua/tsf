<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 后台首页
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Common\Controller\AdminBase;
use Admin\Service\User;

class OrderController extends AdminBase {
	//优惠券列表
	public function index(){
		$search = I("get.search", null);
        $where = array(
            'checked' => 1,
        );
        if ($search) {
			//关键字
            $keyword = I('get.keyword');
            if ($keyword) {
                $type = I('get.type', 0, 'intval');
                switch ($type) {
                    case 1:
                        $where['buyname'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 2:
                        $where['buytel'] = array("LIKE", '%' . $keyword . '%');
                        break;
                    case 3:
                    	$r = M('new') -> where("title like '%" .$keyword ."%'") -> field('id') -> find();
                        $where['house_id'] = $r['id'];
                        break;
                    case 4:
                        $where['order_no'] = array("LIKE", '%' . $keyword . '%');
                        break;                     
                    default:
                        $where['buyname'] = array("LIKE", '%' . $keyword . '%');
                        break;
                }
            }
		}
		$data = M('coupon') -> where($where) -> select();
		foreach($data as $k=>$value){
			$data[$k]['username'] = M('member') -> where('userid='.$value['userid']) -> getfield('username');
			$data[$k]['desc'] = M('yhquan') -> where('id='.$value['coupon_id']) -> getfield('description');
			$r = M('new') -> where('id='.$value['house_id']) -> field('title,url') -> find();
			$data[$k]['house_url'] = $r['url'];
			$data[$k]['house_title'] = $r['title'];
		}
		$this->assign('data',$data);
		$this->display();
	}
	
	//删除优惠券
	public function coupon_del(){
		if(IS_GET)	{
			$rs = M('coupon')->where('id='.$_GET['id'])->delete();
			if($rs){
				$this -> success("删除成功");	
			}else{
				$this -> success("删除失败");	
			}
		}
	}
	
	//勾地订单列表
	public function goudi(){
		$search = I("get.search", null);
        $where = array(
            'checked' => 1,
        );
        if ($search) {
			//关键字
            $keyword = I('get.keyword');
            if ($keyword) {
               $where['order_no'] = array("LIKE", '%' . $keyword . '%');                      
            }
		}
		$data = M('goudi') -> where($where) -> select();
		foreach($data as $k=>$value){
			$data[$k]['username'] = M('member') -> where('userid='.$value['userid']) -> getfield('username');
			$r = M('dadazong') -> where('id='.$value['house_id']) -> field('title,url') -> find();
			$data[$k]['house_url'] = $r['url'];
			$data[$k]['house_title'] = $r['title'];
		}
		$this->assign('data',$data);
		$this->display();
	}
	
	//删除勾地订单
	public function goudi_del(){
		if(IS_GET)	{
			$rs = M('goudi')->where('id='.$_GET['id'])->delete();
			if($rs){
				$this -> success("删除成功");	
			}else{
				$this -> success("删除失败");	
			}
		}
	}
}