<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','zj','lx','mj','fs','od','kw');
// 把上一次已筛选的值保存在Form的隐藏域中
foreach($fields as $f){
  if(isset($_GET[$f])){
    $fitervalue[$f] = $_GET[$f];
  }
}		
?>
<template file="Wap/header.php"/>
<link rel="stylesheet" href="{:C('wap_ui')}css/index.css">
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page page_zufang"> 
      <style>
      .icon_search,.icon_triangle_down{background-image: url("/statics/wap/images/mysprite.png")};
      </style>
      <div class="content_area"> 
        <!--搜索框-->
        <div class="search_box search_a">
          <input type="text" id="ss" class="input" placeholder="请输入关键词搜索">
          <span class="divide"></span><i class="icon_search"></i> </div>
        <!--/搜索框--> 
        
        <!--房源列表-->
        <div class="mod_box house_lists"> 
          <!--筛选条-->
          <form id="filterForm" action="" method="get">
      	<input type="hidden" name="a" value="lists">
        <input type="hidden" name="catid" value="7">
        <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="zj" name="zj" value="<?php echo $fitervalue['zj']; ?>" />
        <input to="filter" type="hidden" id="lx" name="lx" value="<?php echo $fitervalue['lx']; ?>" />
        <input to="filter" type="hidden" id="mj" name="mj" value="<?php echo $fitervalue['mj']; ?>" />
		<input to="filter" type="hidden" id="fs" name="fs" value="<?php echo $fitervalue['fs']; ?>" />        
        <input to="filter" type="hidden" id="od" name="od" value="<?php echo $fitervalue['od']; ?>" />
        <input to="filter" type="hidden" id="kw" name="kw" value="<?php echo $fitervalue['kw']; ?>" />   
        </form> 
        <?php
		  $qulist = get_area_list(1);
		?>
          <div class="tab_bar flexbox" data-mark="booth">
            <div class="tab_tit box_col" data-mark="booth_area" >
              <h2 class="tit">
              <if condition="!$_GET['ct']">
              区域
              <else />
              	<foreach name="qulist" item="voq" >
                <if condition="$voq['id'] eq $_GET['ct']">
                {$voq.name}
                </if>
              </foreach>
              </if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_price">
              <h2 class="tit"><if condition="!$_GET['zj']">价格<else />{$_GET['zj']}</if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_model">
              <h2 class="tit"><if condition="!$_GET['lx']">类型<else />
              <switch name="_GET['lx']">
                <case value="商业用房">商业用房</case>
                <case value="住宅用房">住宅用房</case>
                <case value="写字楼">写字楼</case>
                <case value="工业厂房">工业厂房</case>
                <case value="酒店">酒店</case>
                <case value="集体">集体</case>
                <case value="军产房">军产房</case>
        		<default />类型
    		 </switch>
              </if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_more" >
              <h3 class="tit">更多</h3>
              <i class="icon_triangle_down"></i></div>
          </div>
          <!--/筛选条-->
          
          <div class="sort_bar" data-mark="btn_sort"><i class="icon_sort"></i><span>排序</span></div>
          <div class="mod_cont">
            
            <?php
        $sql = " province = 1";
		$order = "";
		if($_GET['ct']!=""){
			$sql.= " and city = '".$_GET['ct']."'"; 
			}	
		if($_GET['zj']!=""){
			$zj = explode('-',$_GET['zj']);			
			$sql.= " and zongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zongjia <= '".intval($zj[1])."'";
			}
		}
		if($_GET['mj']!=""){
			$mj = explode('-',$_GET['mj']);			
			$sql.= " and mianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and mianji <= '".intval($mj[1])."'";
			}
		}
		if($_GET['lx']!=""){
			$sql.= " and wuyetype = '".$_GET['lx']."'";
			}
		if($_GET['cx']!=""){
			$sql.= " and chaoxiang = '".$_GET['cx']."'"; 
			}
		if($_GET['kw']!=""){
			$sql.= " and title like '%".$_GET['kw']."%'"; 
			}	
		if($_GET['od']!=""){
			$order.= str_replace('_',' ',$_GET['od']); 
		}else{
			$order.= "listorder DESC";
		}
		?> 
            <content action="lists" catid="$catid" where="$sql" order="$order" num="20" page="$pages">
    		<ul class="lists" data-mark="list_container" data-info="total=
			<?php 
	     $count=reset($data);echo $count['datanum'];
	  	?>">
            <volist name="data" id="vo">
              <li class="pictext"> <a href="{$vo.url}" class="a_mask"></a>
                <div class="flexbox">
                  <div class="mod_media">
                    <div class="media_main"> <img origin-src="{$vo.thumb}" src="/statics/default/images/defaultpic.gif" alt="{$vo.title}" class="lazyload"> </div>
                  </div>
                  <div class="item_list">
                    <div class="item_main text_cut">{$vo.title}</div>
                    <div class="item_minor">
                      <div class="info">{$vo.city|getareaName=###} {$vo.area|getareaName=###} {$vo.zhandimianji}m²</div>
                      <div class="price_total q_rentprice">{$vo.zongjia}万</div>
                    </div>
                    <div class="item_other"><span class="location">{$vo.hezuofangshi} / {$vo.wuyetype}</span></div>
                    <div class="tag_box"> <span class="tag xue_qu_fang">身份上传</span>
                    <span class="tag haskey">合同上传</span>
                    <span class="tag haskey">上门实勘</span>
                    </div>
                  </div>
                </div>
              </li>
            </volist>
            <div class="w-page">{$pages}</div>
            </ul>
            </content>            
          </div>
        </div>
        <!--/房源列表-->
        
        <div class="layer_fixed b" style="display: none" data-mark="sort_layer">
          <div class="content">
            <ul class="lists q_sortlist">
              <li class="li <if condition="!$_GET['od']">active</if>" type="od">默认</li>
              <li class="li <if condition="$_GET['od'] eq 'zongjia_ASC'">active</if>" type="od" value="zongjia_ASC">总价从低到高</li>
              <li class="li <if condition="$_GET['od'] eq 'zongjia_DESC'">active</if>" type="od" value="zongjia_DESC">总价从高到低</li>
            </ul>
          </div>
        </div>
      </div>
      
      <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部--> 
      
    </section>
    <section class="layer_fixed filter_box" style="display: none;" data-mark="panel_box"> 
      <!--头部筛选条-->
      <header class="tab_bar flexbox">
        <div class="tab_tit box_col" data-mark="button_area" ><span class="tit">区域</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_price"><span class="tit">价格</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_model"><span class="tit">类型</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_more" ><span class="tit">更多</span><i class="icon_triangle_down"></i></div>
      </header>
      <!--/头部筛选条-->
      
      <div class="content"> 
        <!--区域-->
        <div class="filter_item lists_area" data-mark="panel_area">
          <div class="area_list">
            <div class="nav" data-mark="level1">
              <ul class="level1">
                <li class="li active" name="district">区域</li>
              </ul>
            </div>
            <div class="guide" data-mark="level2">
              <ul name="district" class="level2 qu_list active">
                <li class="li" type="ct">不限</li>                
              <volist name="qulist" id="vo">
              <li class="li" type="ct" value="{$vo.id}">{$vo.name}</li>              
              </volist>                
              </ul>
            </div>
          </div>
        </div>
        <!--/区域--> 
        
        <!--价格-->
        <div class="filter_item lists_price" data-mark="panel_price">
          <ul class="price_list zj_list">
            <li class="li" type="zj">不限</li>
            <li class="li" type="zj" value="0-1000">1000万以下</li>
            <li class="li" type="zj" value="1000-2000">1000-2000万</li>
            <li class="li" type="zj" value="2000-5000">2000-5000万</li>
            <li class="li" type="zj" value="5000-10000">5000万-1亿</li>
            <li class="li" type="zj" value="10000-">1亿以上</li>
          </ul>
        </div>
        <!--/价格--> 
        
        <!--房型-->
        <div class="filter_item lists_price"  data-mark="panel_model">
          <ul class="price_list q_roomlist">
            <li class="li" type="lx">不限</li>
            <li class="li" type="lx" value="商业用房">商业用房</li>
            <li class="li" type="lx" value="住宅用房">住宅用房</li>
            <li class="li" type="lx" value="写字楼">写字楼</li>
            <li class="li" type="lx" value="工业厂房">工业厂房</li>
            <li class="li" type="lx" value="酒店">酒店</li>
            <li class="li" type="lx" value="集体">集体</li>
            <li class="li" type="lx" value="军产房">军产房</li>
          </ul>
        </div>
        <!--/房型--> 
        
        <!--更多-->
        <div class="filter_item lists_more" data-mark="panel_more">
          <div class="more_list">
            <dl class="item">
              <dt class="item_tit">方式</dt>
              <dd class="item_cont">
                <ul class="inline value_lists cx_list">
                  <li class="val <if condition="!$_GET['lx']">active</if>" type="lx"><a href="javascript:;">不限</a></li>
                  <li class="val <if condition="$_GET['lx'] eq '整体转让'">active</if>" type="lx" value="整体转让"><a href="javascript:;">整体转让</a></li>
                  <li class="val <if condition="$_GET['lx'] eq '控股权转让'">active</if>" type="lx" value="控股权转让"><a href="javascript:;">控股权转让</a></li>
                  <li class="val <if condition="$_GET['lx'] eq '部分转让'">active</if>" type="lx" value="部分转让"><a href="javascript:;">部分转让</a></li>
                  <li class="val <if condition="$_GET['lx'] eq '股权融资'">active</if>" type="lx" value="股权融资"><a href="javascript:;">股权融资</a></li>
                  <li class="val <if condition="$_GET['lx'] eq '债权融资'">active</if>" type="lx" value="债权融资"><a href="javascript:;">债权融资</a></li>
                  <li class="val <if condition="$_GET['lx'] eq '租赁融资'">active</if>" type="lx" value="租赁融资"><a href="javascript:;">租赁融资</a></li>
                </ul>
              </dd>
            </dl>
            <dl class="item">
              <dt class="item_tit">面积</dt>
              <dd class="item_cont">
                <ul class="inline value_lists mj_list">
                  <li class="val <if condition="!$_GET['mj']">active</if>" type="mj"><a href="javascript:;">不限</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '0-50'">active</if>" type="mj" value="0-50"><a href="javascript:;">50平以下</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '50-70'">active</if>" type="mj" value="50-70"><a href="javascript:;">50-70平</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '70-90'">active</if>" type="mj" value="70-90"><a href="javascript:;">70-90平</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '90-110'">active</if>" type="mj" value="90-110"><a href="javascript:;">90-110平</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '110-140'">active</if>" type="mj" value="110-140"><a href="javascript:;">110-140平</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '140-170'">active</if>" type="mj" value="140-170"><a href="javascript:;">140-170平</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '170-200'">active</if>" type="mj" value="170-200"><a href="javascript:;">170-200平</a></li>
                  <li class="val <if condition="$_GET['mj'] eq '200-'">active</if>" type="mj" value="200-"><a href="javascript:;">200平以上</a></li>
                </ul>
              </dd>
            </dl>
          </div>
          <div class="opt_box"><a href="javascript:;" class="btn btn_green q_button" id="sure">确定</a> </div>
        </div>
        <!--/更多--> 
      </div>
    </section>
    <!--/页面--> 
  </div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/search_index.js"></script>
<script>
$LMB.start('main_start','m_pages_zufangSearch',{ 
    "selected": {}
});
function Filter(field,value){
    var $ = function(ele){return document.getElementById(ele);}
    var ipts = $('filterForm').getElementsByTagName('input'),result=[];
    for(var i=0,l=ipts.length;i<l;i++){
      if(ipts[i].getAttribute('to')=='filter'){
        result.push(ipts[i]);
      }
    }
    if($(field)){
      value = value || '';
      $(field).value = value;
      for(var j=0,len=result.length;j<len;j++){
        if(result[j].value==''){
          result[j].parentNode.removeChild(result[j]);
        }
      }
      document.forms['filterForm'].submit();
    }
    return false;
  }
  
  $(".q_roomlist li,.zj_list li,.qu_list li,.subway_list li,.q_sortlist li").on("tap",function(){
	if(typeof($(this).attr('value'))!="undefined"){		
		Filter($(this).attr('type'),$(this).attr('value')); 
	}else{
		Filter($(this).attr('type')); 
	}
  });
  $(".cx_list li,.mj_list li").on("tap",function(){
	$(this).addClass("active").siblings().removeClass("active");
	if(typeof($(this).attr('value'))!="undefined"){		
		if($(this).attr('value') == 0){
			$("#"+$(this).attr('type')).val("");
		}else{
			$("#"+$(this).attr('type')).val($(this).attr('value'));			
		}		
	}
  });
  $("#sure").on("tap",function(){
	Filter('ct');
  });
  $(".icon_search").on("tap",function(){
	Filter('kw',$("#ss").val()); 
  });
</script>
</html>
