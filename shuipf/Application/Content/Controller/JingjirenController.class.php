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
		if($sql){
			$sql .= " and biaoqian like '%".$_GET['bq']."%'"; 
		}else{
			$sql .= "biaoqian like '%".$_GET['bq']."%'"; 
		}		
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
		 $x['comment_id'] = 'c-88-'.$v['userid'];	
		 $data[$k]['comm_count'] = M('comments')->where($x)->count();
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

  

  //经纪人详情

  public function show_jjr()

  {

      $db = M('member');
      $info = $db -> where('userid='.$_GET['id']) -> find();
      $info['agent'] = M('member_agent')->where('userid='.$_GET['id']) -> find();
      $this->assign("info", $info);	  


	if($_GET['id'] && $_GET['t']){
		$u['username'] = M('member') -> where('userid='.$_GET['id']) -> getField('username');
		$list = M('ershou') -> where($u) -> select();
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