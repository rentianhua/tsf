<?php



// +----------------------------------------------------------------------

// | ShuipFCMS URL规则管理

// +----------------------------------------------------------------------

// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.

// +----------------------------------------------------------------------

// | Author: 水平凡 <admin@abc3210.com>

// +----------------------------------------------------------------------



namespace Content\Controller;



use Common\Controller\Base;

use Content\Model\ContentModel;



class TestController extends Base {
  
  public function index(){
	  echo '<pre>';
			var_dump($_POST);
			exit;
	  $start=$_POST['orderperiodbegin'];
	  $sum=$_POST['count_sum'];
	  $w0=$_POST['week7'];
	  $w1=$_POST['week1'];
	  $w2=$_POST['week2'];
	  $w3=$_POST['week3'];
	  $w4=$_POST['week4'];
	  $w5=$_POST['week5'];
	  $w6=$_POST['week6'];
	  //1.判断start是周几
	  $date=new Date($start);
	  $millisceonds =date_timestamp_get($date);  //开始日期转为时间戳
  }
	
	
	
	
	function getworkday(date,itervalByDay, type){
				   date=new Date(date);
				   var millisceonds =date.getTime();  //开始日期转为时间戳
				   for(var i=0;i<itervalByDay;i++){  
					  
					  date.setTime(millisceonds);
					  
					  if( type == 1 ){
						  if( date.getDay()==0||date.getDay()==2 || date.getDay()==4||date.getDay()==6) i--;						 
					  }else if( type == 2 ){
						if(date.getDay()==0||date.getDay()==6) i--;  
					  }
					  if( i < (itervalByDay-1) )  millisceonds +=24*60*60*1000;  	//除了实际配送的最后一天外，其他都要I加一天
				   }
				   date = getDate(millisceonds);
				    
				   return date;  
				}

}