<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','dt','zj','shi','cx','mj','od','kw');
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
        <input type="hidden" name="catid" value="6">
        <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="dt" name="dt" value="<?php echo $fitervalue['dt']; ?>" />
        <input to="filter" type="hidden" id="zj" name="zj" value="<?php echo $fitervalue['zj']; ?>" />
        <input to="filter" type="hidden" id="shi" name="shi" value="<?php echo $fitervalue['shi']; ?>" />
        <input to="filter" type="hidden" id="mj" name="mj" value="<?php echo $fitervalue['mj']; ?>" />
		<input to="filter" type="hidden" id="cx" name="cx" value="<?php echo $fitervalue['cx']; ?>" />        
        <input to="filter" type="hidden" id="od" name="od" value="<?php echo $fitervalue['od']; ?>" />
        <input to="filter" type="hidden" id="kw" name="kw" value="<?php echo $fitervalue['kw']; ?>" />   
        </form> 
        <?php
		  $qulist = get_area_list(1);
		?>
          <div class="tab_bar flexbox" data-mark="booth">
            <div class="tab_tit box_col" data-mark="booth_area" >
              <h2 class="tit">
              <if condition="!$_GET['ct'] && !$_GET['dt']">
              区域
              <else />
              	<if condition="$_GET['ct'] neq ''">
                  <foreach name="qulist" item="voq">
                    <if condition="$voq['id'] eq $_GET['ct']">
                    {$voq.name}
                    </if>
                  </foreach>
                </if>
                <if condition="$_GET['dt'] neq ''">
                    {$_GET.dt|substr=###,1,-1}号线
                </if>
              </if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_price">
              <h2 class="tit"><if condition="!$_GET['zj']">价格<else />{$_GET['zj']}</if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_model">
              <h2 class="tit"><if condition="!$_GET['shi']">房型<else />
              <switch name="_GET['shi']">
                <case value="1">一室</case>
                <case value="2">二室</case>
                <case value="3">三室</case>
                <case value="4">四室</case>
                <case value="5">五室</case>
                <case value="6">五室以上</case>
        		<default />房型
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
		if($_GET['dt']!=""){
			$sql.= " and ditiexian like '%".$_GET['dt']."%'";
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
			$sql.= " and jianzhumianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and jianzhumianji <= '".intval($mj[1])."'";
			}
		}
		if($_GET['shi']!=""){
			$sql.= " and shi = '".$_GET['shi']."'";
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
                      <div class="info">{$vo.shi}室{$vo.ting}厅 {$vo.jianzhumianji}m²  {$vo.chaoxiang}</div>
                      <div class="price_total q_rentprice">{$vo.zongjia}万</div>
                    </div>
                    <div class="item_other"><a href="/sz/xiaoqu/2411063416168/" class="location" title="西城品阁.'租房'">{$vo.xiaoqu|getxiaoquName=###}</a><span class="unit_price"><?php  echo ceil($vo['zongjia']*10000/$vo['jianzhumianji'])?>元/平</span></div>
                    <div class="tag_box"> 
                    <span class="tag xue_qu_fang">身份上传</span>
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
        <div class="tab_tit box_col" data-mark="button_model"><span class="tit">房型</span><i class="icon_triangle_down"></i></div>
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
                <li class="li" name="subway">地铁</li>
              </ul>
            </div>
            <div class="guide" data-mark="level2">
              <ul name="district" class="level2 qu_list active">
                <li class="li" type="ct">不限</li>                
              <volist name="qulist" id="vo">
              <li class="li" type="ct" value="{$vo.id}">{$vo.name}</li>              
              </volist>                
              </ul>
              <ul name="subway" class="level2 subway_list" style="display:none">
              	<li class="li" type="dt">不限</li>
              	<li class="li" type="dt" value="[1]">1号线</li>
                <li class="li" type="dt" value="[2]">2号线</li>
                <li class="li" type="dt" value="[3]">3号线</li>
                <li class="li" type="dt" value="[4]">4号线</li>
                <li class="li" type="dt" value="[5]">5号线</li>
                <li class="li" type="dt" value="[11]">11号线</li>
              </ul>
            </div>
            <div class="cont" data-mark="level3" style="display: none;">
              <ul class="level3">
              </ul>
            </div>
          </div>
        </div>
        <!--/区域--> 
        
        <!--价格-->
        <div class="filter_item lists_price" data-mark="panel_price">
          <ul class="price_list zj_list">
            <li class="li" type="zj">不限</li>
            <li class="li" type="zj" value="0-200">200万以下</li>
            <li class="li" type="zj" value="200-300">200-300万</li>
            <li class="li" type="zj" value="300-400">300-400万</li>
            <li class="li" type="zj" value="400-500">400-500万</li>
            <li class="li" type="zj" value="500-800">500-800万</li>
            <li class="li" type="zj" value="800-1000">800-1000元</li>
            <li class="li" type="zj" value="1000-">1000万以上</li>
          </ul>
        </div>
        <!--/价格--> 
        
        <!--房型-->
        <div class="filter_item lists_price"  data-mark="panel_model">
          <ul class="price_list q_roomlist">
            <li class="li" type="shi">不限</li>
            <li class="li" type="shi" value="1">一室</li>
            <li class="li" type="shi" value="2">二室</li>
            <li class="li" type="shi" value="3">三室</li>
            <li class="li" type="shi" value="4">四室</li>
            <li class="li" type="shi" value="5">五室</li>
            <li class="li" type="shi" value="6">五室以上</li>
          </ul>
        </div>
        <!--/房型--> 
        
        <!--更多-->
        <div class="filter_item lists_more" data-mark="panel_more">
          <div class="more_list">
            <dl class="item">
              <dt class="item_tit">朝向</dt>
              <dd class="item_cont">
                <ul class="inline value_lists cx_list">
                  <li class="val <if condition="!$_GET['cx']">active</if>" type="cx"><a href="javascript:;">不限</a></li>
                  <li class="val <if condition="$_GET['cx'] eq '东'">active</if>" type="cx" value="东"><a href="javascript:;">朝东</a></li>
                  <li class="val <if condition="$_GET['cx'] eq '南'">active</if>" type="cx" value="南"><a href="javascript:;">朝南</a></li>
                  <li class="val <if condition="$_GET['cx'] eq '西'">active</if>" type="cx" value="西"><a href="javascript:;">朝西</a></li>
                  <li class="val <if condition="$_GET['cx'] eq '北'">active</if>" type="cx" value="北"><a href="javascript:;">朝北</a></li>
                  <li class="val <if condition="$_GET['cx'] eq '南北'">active</if>" type="cx" value="南北"><a href="javascript:;">南北</a></li>
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
	if(field == "ct"){
		$("dt").value = '';	
	}
	if(field == "dt"){
		$("ct").value = '';	
	}
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
  $(".level1 li").on("tap",function(){
	var type = $(this).attr('name'); 	
	$(".guide ul[name='"+type+"']").show().siblings().hide();	
	$(this).addClass("active").siblings().removeClass('active');
  });
</script>
</html>
