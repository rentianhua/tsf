<?php

// +----------------------------------------------------------------------
// | 淘深房 获取当前登陆信息
// +----------------------------------------------------------------------

namespace Api\Controller;

use Common\Controller\Base;

class MapController extends Base {

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
	
	//小区数据
	public function xiaoqu(){		
		if(IS_POST){
			if($_POST['area']=='' || $_POST['fromtable']==''){
				echo '{"success":136,"info":"数据不完整"}';
				exit;	
			}			
			$db = M('xiaoqu');
			$xiaoqu = $db->where('area='.$_POST['area'])->select();
			if($xiaoqu){
				foreach($xiaoqu as $k=>$v){
					$cnt = M($_POST['fromtable'])->where('xiaoqu='.$v['id'])->count();
					$xiaoqu[$k]['house_count'] = $cnt;
				}
				echo json_encode($xiaoqu);
				exit;
			}else{
				echo '{"success":137,"info":"该区域没有小区"}';
				exit;
			}			
		}	
	}
	
	//每个行政区房源套数
	public function city_house(){				
		if(IS_POST){
			if($_POST['fromtable']==''){
				echo '{"success":138,"info":"数据不完整"}';
				exit;	
			}
			$city = M('area')->where('pid=1')->select();
			foreach($city as $k=>$v){
				$cnt = M($_POST['fromtable'])->where('status=99 and city='.$v['id'])->count();
				$city[$k]['house_count'] = $cnt;
			}
			echo json_encode($city);
			exit;					
		}	
	}
	
	//所有区域的房源套数
	public function area_house(){				
		if(IS_POST){
			if($_POST['fromtable']==''){
				echo '{"success":139,"info":"数据不完整"}';
				exit;	
			}
			$area = M('area')->select();
			foreach($area as $k=>$v){
				$cnt = M($_POST['fromtable'])->where('area='.$v['id'])->count();
				$area[$k]['house_count'] = $cnt;
			}
			echo json_encode($area);
			exit;					
		}	
	}
	
	//指定小区下的所有房源
	public function house(){			
		if(IS_POST){
			if($_POST['xiaoqu']=='' || $_POST['fromtable']==''){
				echo '{"success":140,"info":"数据不完整"}';
				exit;	
			}
			$house = M($_POST['fromtable'])->where('xiaoqu='.$_POST['xiaoqu'])->select();			
			echo json_encode($house);
			exit;					
		}	
	}

}
