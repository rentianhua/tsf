<?php
namespace Content\Controller;
use Common\Controller\Base;
use Content\Model\ContentModel;
class MapController extends Base {
  //出租房地图找房
  public function index() {
	  $db = M('chuzu');
	  $db1 = M('area');	
	  $sql = 'status=99';
	  	if($_GET['ct']!=""){
			$sql.= " and city = '".$_GET['ct']."'";
			}
		if($_GET['ar']!=""){
			$sql.= " and area = '".$_GET['ar']."'";
			}
		if($_GET['xq']!=""){
			$sql.= " and xiaoqu = '".$_GET['xq']."'"; 
			}
		if($_GET['zj'] && $_GET['zj']!=""){
			$zj = explode('-',$_GET['zj']);
			$sql.= " and zujin >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zujin <= '".intval($zj[1])."'";
			}
		}
		if($_GET['mj'] && $_GET['mj']!=""){
			
			$mj = explode('-',$_GET['mj']);			
			$sql.= " and mianji >= '".intval($mj[0])."'"; 
			
			if(intval($mj[1]) != 0){
				 $sql.= " and mianji <= '".intval($mj[1])."'";
			}
		}
		if($_GET['shi'] && $_GET['shi']!=""){
			$sql.= " and shi = '".$_GET['shi']."'"; 
			}
		if($_GET['cx']!=""){
			$sql.= " and chaoxiang = '".$_GET['cx']."'"; 
			}
		if($_GET['lc']!=""){
			$sql.= " and ceng = '".$_GET['lc']."'"; 
			}
		if($_GET['zl']!=""){
			$sql.= " and zulin = '".$_GET['zl']."'"; 
			}
		if($_GET['bq']!=""){
			$sql.= " and biaoqian like '%".$_GET['bq']."%'"; 
			}	
		if($_GET['kw']!=""){
			$sql.= " and title like '%".$_GET['kw']."%'"; 
			}
		if($_GET['od']!=""){
			$order= str_replace('_',' ',$_GET['od']); 
		}else{
			$order= "listorder DESC";
		}
	  $city = $db1 -> where('pid != -1') -> field('id,pid') -> select();
	  //每个区域下的计数	  
	  foreach( $city as $value ){
		  if($value['pid'] == 1){
			  $a = $sql;
			  $a.=" and city=".$value['id'];
			  $hscount[$value['id']] = $db -> where($a) -> count();  
			}else{
				$a = $sql;
				$a.=" and area=".$value['id'];
				$hscount[$value['id']] = $db -> where($a) -> count();
			}
		  		  
		}
		//总计数,房源列表				
		$list = $db -> where($sql) -> order($order)-> limit(10) -> select();
		$count = $db -> where($sql) -> count();
		$this -> assign('hscount',  $hscount);
		$this -> assign('list',  $list);
		$this -> assign('count',  $count);
		
		
		if($_GET['ar'] && $_GET['ar'] != ''){
			$x = intval($_GET['ar']);
			//取出该area下的所有小区id
			$xq = M('xiaoqu') -> where('area='.$x) -> field('id,jingweidu,title') -> select();
			
			//获取每个小区的房子套数,经纬度
			foreach( $xq as $k=>$value1 ){
				$q=$sql;
				$q.=" and xiaoqu=".$value1['id'];
				$xq[$k]['hscount'] = $db -> where($q) -> count();
			}
			$this -> assign('xq',  $xq);
		}
	  
    $this -> display();

  }
  
  //二手房地图找房
  public function es()
  
  {
	  $db = M('ershou');
	  $db1 = M('area');	
	  $sql = 'status=99';
	  	if($_GET['ct']!=""){
			$sql.= " and city = '".$_GET['ct']."'";
			}
		if($_GET['ar']!=""){
			$sql.= " and area = '".$_GET['ar']."'";
			}
		if($_GET['xq']!=""){
			$sql.= " and xiaoqu = '".$_GET['xq']."'"; 
			}
		if($_GET['zj'] && $_GET['zj']!=""){
			$zj = explode('-',$_GET['zj']);
			$sql.= " and zongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zongjia <= '".intval($zj[1])."'";
			}
		}
		if($_GET['mj'] && $_GET['mj']!=""){
			$mj = explode('-',$_GET['mj']);			
			$sql.= " and jianzhumianji >= ".intval($mj[0]); 
			if(intval($mj[1]) != 0){
				 $sql.= " and jianzhumianji <= ".intval($mj[1]);
			}
			
		}
		if($_GET['shi'] && $_GET['shi']!=""){
			$sql.= " and shi = '".$_GET['shi']."'"; 
			}
		if($_GET['cx']!=""){
			$sql.= " and chaoxiang = '".$_GET['cx']."'"; 
			}
		if($_GET['lc']!=""){
			$sql.= " and ceng = '".$_GET['lc']."'"; 
			}
		if($_GET['zx']!=""){
			$sql.= " and zhuangxiu = '".$_GET['zx']."'"; 
			}
		//Bug, fixed by Tianhua, on 2017.3.28
		//when jjr_id is empyty in table tsf_ershou, it is belong to yz
		// if($_GET['ly']!=""){
		// 	print $_GET['ly'];
		// 	if($_GET['ly']=='yz'){
		// 		$sql.= " and jjr_id = ''";
		// 	}elseif($_GET['ly']=='jjr'){
		// 		$sql.= " and jjr_id != ''"; 
		// 	}
		// }
		if($_GET['ly']!=""){
			if($_GET['ly']=='业主'){
				$sql.= " and jjr_id = ''";
			}elseif($_GET['ly']=='经纪人'){
				$sql.= " and jjr_id != ''"; 
			}
		}
		//fix end
		if($_GET['kw']!=""){
			$sql.= " and title like '%".$_GET['kw']."%'"; 
			}
		if($_GET['od']!=""){
			$order= str_replace('_',' ',$_GET['od']); 
		}else{
			$order= "listorder DESC";
		}	
	  $city = $db1 -> where('pid != -1') -> field('id,pid') -> select();
	  //每个区域下的计数	  
	  foreach( $city as $value ){
		  if($value['pid'] == 1){
			  $a = $sql;
			  $a.=" and city=".$value['id'];
			  $hscount[$value['id']] = $db -> where($a) -> count();  
			}else{
				$a = $sql;
				$a.=" and area=".$value['id'];
				$hscount[$value['id']] = $db -> where($a) -> count();
			}
		  		  
		}
		//总计数,房源列表				
		$list = $db -> where($sql) -> order($order)-> limit(10) -> select();
		$count = $db -> where($sql) -> count();
		$this -> assign('hscount',  $hscount);
		$this -> assign('list',  $list);
		$this -> assign('count',  $count);
		
		
		if($_GET['ar'] && $_GET['ar'] != ''){
			$x = intval($_GET['ar']);
			//取出该area下的所有小区id			
			$xq = M('xiaoqu') -> where('area='.$x) -> field('id,jingweidu,title') -> select();
			
			//获取每个小区的房子套数,经纬度
			foreach( $xq as $k=>$value1 ){
				$q=$sql;
				$q.=" and xiaoqu=".$value1['id'];
				$xq[$k]['hscount'] = $db -> where($q) -> count();
			}
			$this -> assign('xq',  $xq);
		}
	  
    $this -> display();

  }

}