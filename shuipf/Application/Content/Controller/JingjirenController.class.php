<?php



// +----------------------------------------------------------------------

// | ShuipFCMS 网站前台

// +----------------------------------------------------------------------


namespace Content\Controller;



use Common\Controller\Base;

use Content\Model\ContentModel;



class JingjirenController extends Base {

  //获取经纪人列表
  public function list_jjr() {
	if($_GET['ct']){
		$sql .= "mainarea like '%".$_GET['ct']."%'"; 
	}
	if($_GET['bq']){
		//fix by tianhua on 2017,04-24
		$bq = explode(',', $_GET['bq']);
		foreach ($bq as $key => $value) {
			if($sql){
				$sql .= " and biaoqian like '%".$value."%'"; 
			}else{
				$sql .= "biaoqian like '%".$value."%'"; 
			}		
		}
		// if($sql){
		// 	$sql .= " and biaoqian like '%".$_GET['bq']."%'"; 
		// }else{
		// 	$sql .= "biaoqian like '%".$_GET['bq']."%'"; 
		// }
		//end fix
	}
	if($_GET['kw']){
		if($sql){
			$sql .= " and realname like '%".$_GET['kw']."%'"; 
		}else{
			$sql .= "realname like '%".$_GET['kw']."%'"; 
		}		
	}
    $db = M('member_agent');
	if($sql){
		$count = $db -> where($sql)-> count();
	}else{
		$count = $db -> count();
	}
    
	
    $page = $this->page($count, 20);
	if($sql){
		$data = $db->where($sql)->limit($page->firstRow . ',' . $page->listRows)->select();
	}else{
		$data = $db->limit($page->firstRow . ',' . $page->listRows)->select();
	}
	foreach($data as $k=>$v){
		 $t = M('member') -> where('userid='.$v['userid']) -> field('vtel,username') -> find();
		 if($t['vtel'] == ''){
			$data[$k]['username'] = $t['username']; 
		 }else{
			 $data[$k]['tel'] = $t['vtel'];
		 }	
		 //$x['comment_id'] = 'c-88-123';//'c-88-'.$v['userid'];	
		 $data[$k]['comm_count'] = M('comments')->where("comment_id='c-88-".$v['userid']."'")->count();

		 //fix by tianhua on 2017.03.31
		 $chenjiao_chuzu_count = M('chuzu')-> where("(username='".$t['username']."' OR jjr_id='".$v['userid']."') and zaizu=0")->count();
		 $chenjiao_ershou_count = M('ershou')-> where("(username='".$t['username']."' OR jjr_id='".$v['userid']."') and zaishou=0")->count();

		 $weituo_chuzu_count = M('chuzu')-> where("jjr_id='".$v['userid']."' and pub_type!=1")->count();
		 $weituo_ershou_count = M('ershou')-> where("jjr_id='".$v['userid']."' and pub_type!=1")->count();

		 $arr2 = M('yuyue') -> where("fromuser ='".$t['username']."' and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= FROM_UNIXTIME(inputtime)")
		 		 -> select();
	     $arr = Array();
	     foreach($arr2 as $x=>$value){
	        $ershoudata = M("ershou") -> where('id='.$value['fromid']) -> find();
	        if(count($ershoudata) >0){
	          array_push($arr, $value);
	        }
	     }
		 $data[$k]['chenjiao_count'] = $chenjiao_chuzu_count + $chenjiao_ershou_count;
		 $data[$k]['weituo_count'] = $weituo_chuzu_count + $weituo_ershou_count;
		 $data[$k]['kanfang_count'] = count($arr);
		 //end fix
	}

	foreach ($data as $key => $value) {
		$chenjiao[$key] = $value['chenjiao_count'];
		$kanfang[$key] = $value['kanfang_count'];
	}

	if($_GET['order']=="chenjiao_count_DESC")
	   array_multisort($chenjiao,SORT_DESC,$data);
	else if($_GET['order']=="kanfang_count_DESC")
	   array_multisort($kanfang,SORT_DESC,$data);

	$SEO['title']=cache('Config.sitename');
	$SEO['description']=cache('Config.siteinfo');
	$SEO['keyword']=cache('Config.sitekeywords');
	$this->assign("SEO", $SEO);
	$this->assign("count", $count);
    $this->assign("Page", $page->show('Admin'));

    $this->assign("jjrlist", $data);
	
    $this->display();

  }

function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC){ 
	if(is_array($multi_array)){ 
	foreach ($multi_array as $row_array){ 
	if(is_array($row_array)){ 
	$key_array[] = $row_array[$sort_key]; 
	}else{ 
	return false; 
	} 
	} 
	}else{ 
	return false; 
	} 
	array_multisort($key_array,$sort,$multi_array); 
	return $multi_array; 
} 
  

  //经纪人详情

  public function show_jjr()

  {

      $db = M('member');
      $info = $db -> where('userid='.$_GET['id']) -> find();
      $info['agent'] = M('member_agent')->where('userid='.$_GET['id']) -> find();


     //fix by tianhua on 2017.03.31
	 $chenjiao_chuzu_count = M('chuzu')-> where("(username='".$info['username']."' OR jjr_id='".$_GET['id']."') and zaizu=0")->count();
	 $chenjiao_ershou_count = M('ershou')-> where("(username='".$info['username']."' OR jjr_id='".$_GET['id']."') and zaishou=0")->count();

	 $weituo_chuzu_count = M('chuzu')-> where("jjr_id='".$_GET['id']."' and pub_type!=1")->count();
	 $weituo_ershou_count = M('ershou')-> where("jjr_id='".$_GET['id']."' and pub_type!=1")->count();

	 $arr2 = M('yuyue') -> where("fromuser ='".$info['username']."' and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= FROM_UNIXTIME(inputtime)")
	 		 -> select();
     $arr = Array();
     foreach($arr2 as $x=>$value){
        $ershoudata = M("ershou") -> where('id='.$value['fromid']) -> find();
        if(count($ershoudata) >0){
          array_push($arr, $value);
        }
     }
	 $info['chenjiao_count'] = $chenjiao_chuzu_count + $chenjiao_ershou_count;
	 $info['weituo_count'] = $weituo_chuzu_count + $weituo_ershou_count;
	 $info['kanfang_count'] = count($arr);
	 //end fix
	 $this->assign("info", $info);	  


	if($_GET['id'] && $_GET['t']){
		$u['username'] = M('member') -> where('userid='.$_GET['id']) -> getField('username');
		$list = M('ershou') -> where($u) -> select();
		//fixed by tianhua on 2017-04-10
		foreach($list as $x=>$value){
	        $guanzhu_count = M("guanzhu") -> where("fromtable='ershou' and fromid=".$value['id']) -> count();
	        $yuyue_count = M("yuyue") -> where("fromtable='ershou' and fromid=".$value['id']) -> count();
	        $list[$x]["guanzhu_count"] = $guanzhu_count;
	        $list[$x]["yuyue_count"] = $yuyue_count;
     	}
     	//end fix
		if($list){
			$this->assign("list", $list);
		}
	}
	$SEO['title']=cache('Config.sitename');
	$SEO['description']=cache('Config.siteinfo');
	$SEO['keyword']=cache('Config.sitekeywords');
	$this->assign("SEO", $SEO);
    $this->display();

  }

	//获取同一公司的经纪人
  public function show_com() {
	if($_GET['c'] != ""){
		$sql = "coname = '".$_GET['c']."'"; 
	}
    $db = M('member_agent');
	if($sql){
		$count = $db -> where($sql)-> count();
	}else{
		$count = $db -> count();
	}
    
	
    $page = $this->page($count, 20);
	if($sql){
		$data = $db->where($sql)->limit($page->firstRow . ',' . $page->listRows)->select();
	}else{
		$data = $db->limit($page->firstRow . ',' . $page->listRows)->select();
	}
	foreach($data as $k=>$v){
		 $t = M('member') -> where('userid='.$v['userid']) -> field('vtel,username') -> find();
		 if($t['vtel'] == ''){
			$data[$k]['username'] = $t['username']; 
		 }else{
			 $data[$k]['tel'] = $t['vtel'];
		 }	
	}
	$SEO['title']=cache('Config.sitename');
	$SEO['description']=cache('Config.siteinfo');
	$SEO['keyword']=cache('Config.sitekeywords');
	$this->assign("SEO", $SEO);
	$this->assign("count", $count);
    $this->assign("Page", $page->show('Admin'));
    $this->assign("jjrlist", $data);

    $this->display();

  }
}