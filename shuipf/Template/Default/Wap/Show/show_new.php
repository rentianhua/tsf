<template file="Wap/header.php"/>
<link rel="stylesheet" href="{:C('wap_ui')}css/index.css">
<style>
    .info_box .house_title{margin-top:1.25rem;}
	.house_price {
    color: #de6843;
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.625rem;
	}
	.xinfang_tag_box {
    height: 1.5rem;
    overflow: hidden;
    text-align: left;
	}
	.house_head .mod_cont {
    border-top: 1px solid #e5e5e5;
    padding: 0;
	}
	.info_box{padding-bottom:0}
	.frame_intro .mod_cont{padding:10px 0 !important;}
	.house_detail .li_item .tit {
    display: inline-block;
    min-width: 5rem;
    width: 5rem;
	}
	.recom {
    padding-bottom: 0.625rem;
    padding-right: 1.25rem;
	}
	.recom .box_col:nth-of-type(1) {
    padding-right: 0.5rem;
	}
	.recom h3.mod_tit {
    border-bottom: medium none;
	}
	.recom .pictext .unit_price {
    background-color: #ff6000;
    bottom: 6px;
    color: #fff;
    line-height: 1.3125rem;
    padding-left: 0.3125rem;
    padding-right: 0.3125rem;
    position: absolute;
    right: 0;
	}
	.recom .name {
    color: #333;
    font-weight: 700;
    text-align: left;
	}
	.recom img{height:110px;width:160px;}
	.tag {
    background-color: #fff;
    border: 1px solid #e1e1e1;
    border-radius: 1.25rem;
    color: #999;
    font-size: 0.8125rem;
    line-height: 1em;
    margin-bottom: 0.2rem;
    margin-right: 0.1375rem;
    padding: 0.25rem 0.5625rem;
    vertical-align: top;
	}	
	.house_title .status {
    color: #666;
    font-size: 0.875rem;
    font-weight: 700;
	}
	.fixed_opt{padding:0.5rem 0 0 0;}
	.icon_weizhi,.icon_time,.icon_zixun,.icon_fenxiang{
	background-image: url("/statics/wap/images/sprite1.svg");
    background-repeat: no-repeat;
    background-size: 2rem 54.5rem;
    display: inline-block;
    height: 2rem;
    margin-bottom: -0.35rem; 
    transform: scale(0.5);
    width: 2rem;
	display: inline-flex;
    margin-right: 0.1rem;	
	margin-left:-0.5rem;
	vertical-align: bottom;
	}
	.icon_weizhi{background-position: 0 -36.75rem;}
	.icon_time{background-position: 0 -34.125rem;}
	.icon_zixun {background-position: 0 -44.625rem;transform: scale(1)}
	.icon_fenxiang{background-position: 0 -13.125rem;transform: scale(1);margin:0.7rem 0 0 0}
	.plus{border:none}
    </style>
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page  page_xinfang has_fixbar page_xinfang_detail">       
      <div class="content_area"> 
        <!-- 经纪人简介 --> 
        <!--房源简介-->
        <?php
				$str='';
				$i=0;
			foreach ($loupantupian as $k=>$value) {	
				$i++;		
				if($str == ''){
					$str.='{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				
				}else{
					$str.=',{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				}
			 }
			 foreach ($weizhitu as $k=>$value) {
				$i++;			
				if($str == ''){
					$str.='{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				
				}else{
					$str.=',{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				}
			 }
			 foreach ($xiaoqutu as $k=>$value) {
				 $i++;			
				if($str == ''){
					$str.='{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				
				}else{
					$str.=',{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				}
			 }
			 foreach ($yangbantu as $k=>$value) {	
			 $i++;		
				if($str == ''){
					$str.='{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				
				}else{
					$str.=',{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				}
			 }
			 foreach ($shijingtu as $k=>$value) {	
			 $i++;		
				if($str == ''){
					$str.='{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				
				}else{
					$str.=',{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				}
			 }
			 ?> 
        <div class="mod_box house_head">
          <div class="pic_box">
            <ul class="pic_lists flexbox" style="width:<?php echo $i*100?>%" data-act="viewImage" 
                data-info='[{$str}]'>
              <?php
			foreach ($loupantupian as $value) {		
			echo '<li class="box_col"><img origin-src="'.$value["url"].'" src="/statics/default/images/defaultpic.gif" class="lazyload" alt="'.$value["alt"].'" /></li>';
			 }
			 foreach ($weizhitu as $value) {		
			echo '<li class="box_col"><img origin-src="'.$value["url"].'" src="/statics/default/images/defaultpic.gif" class="lazyload" alt="'.$value["alt"].'" /></li>';
			 }
			 foreach ($xiaoqutu as $value) {		
			echo '<li class="box_col"><img origin-src="'.$value["url"].'" src="/statics/default/images/defaultpic.gif" class="lazyload" alt="'.$value["alt"].'" /></li>';
			 }
			 foreach ($yangbantu as $value) {	
			echo '<li class="box_col"><img origin-src="'.$value["url"].'" src="/statics/default/images/defaultpic.gif" class="lazyload" alt="'.$value["alt"].'" /></li>';
			 }
			 foreach ($shijingtu as $value) {
			echo '<li class="box_col"><img origin-src="'.$value["url"].'" src="/statics/default/images/defaultpic.gif" class="lazyload" alt="'.$value["alt"].'" /></li>';
			 }
			 ?>
            </ul>
            <div class="opt_bar"><a href="javascript:;" class="count"><span data-mark="img_index">1</span>/{$i}</a></div>
          </div>
          <div class="info_box">
            <h1 class="house_title"><span class="title">{$title}</span><em class="icon_line"></em><span class="status"> <if condition="$zaishou eq 1">在售<else />售罄</if></span></h1>
            <div class="house_price"> <span class="title">均价：</span><span class="num"><if condition="$junjia eq 0">待定<else />{$junjia}</if></span>
            <if condition="$junjia neq 0"><span class="unit">元/m²</span></if> </div>
            <div class="xinfang_tag_box"> <span class="tag">{$wuyeleixing}</span> <span class="tag">{$fangwuyongtu}</span> </div>
            <div class="mod_cont">
              <ul class="lists">
                <span class="li_item"> <span class="box_col value text_cut"><em class="icon_weizhi"></em><span>{$loupandizhi}</span></span> </span>
                <li class="li_item"> <span class="box_col value"><em class="icon_time"></em><span>开盘日期：{$kaipandate}</span></span> </li>
              </ul>
            </div>
          </div>
        </div>
        <!--/房源简介-->
        <div class="mod_box house_lists frame_intro">
          <h3 class="mod_tit">户型介绍</h3>
          <div class="mod_cont">{$huxingintro}</div>
        </div>
        <!--楼盘信息-->
        <div class="mod_box house_detail">
          <h3 class="mod_tit">楼盘信息</h3>
          <div class="mod_cont">
            <ul class="lists">
              <li class="li_item"> <span class="tit">开发商</span><span class="value box_col">{$kaifashang}</span> </li>
              <li class="li_item"> <span class="tit">开盘日期</span><span class="value box_col">{$kaipandate}</span> </li>
              <li class="li_item"> <span class="tit">交房日期</span><span class="value box_col">{$jiaofangdate}</span> </li>
              <li class="li_item"> <span class="tit">产权年限</span><span class="value box_col">{$chanquannianxian}年</span> </li>
            </ul>
          </div>
        </div>
        <div class="mod_box house_detail">
          <div class="mod_cont">
            <ul class="lists">
              <li class="li_item"> <span class="tit">区域位置</span><span class="value box_col">{$city|getareaName=###} {$area|getareaName=###}</span> </li>
              <li class="li_item"> <span class="tit">楼盘地址</span><span class="value box_col">{$loupandizhi}</span> </li>
              <li class="li_item"> <span class="tit">售楼处地址</span><span class="value box_col">{$shouloudizhi}</span> </li>
            </ul>
          </div>
        </div>
        <div class="mod_box house_detail">
          <div class="mod_cont">
            <ul class="lists">
              <li class="li_item"> <span class="tit">建筑类型</span><span class="value box_col">{$fangwuyongtu}</span> </li>
              <li class="li_item"> <span class="tit">装修</span><span class="value box_col">{$zhuangxiu}</span> </li>
              <li class="li_item"> <span class="tit">容积率</span><span class="value box_col">{$rongjilv}</span> </li>
              <li class="li_item"> <span class="tit">绿化率</span><span class="value box_col">{$lvhualv}</span> </li>
              <li class="li_item"> <span class="tit">规划户数</span><span class="value box_col">{$chanquannianxian}</span> </li>
              <li class="li_item"> <span class="tit">车位规划</span><span class="value box_col">{$guihuachewei}</span> </li>
            </ul>
          </div>
        </div>
        <div class="mod_box house_detail">
          <div class="mod_cont">
            <ul class="lists">
              <li class="li_item"> <span class="tit">物业类型</span><span class="value box_col">{$wuyeleixing}</span> </li>
              <li class="li_item"> <span class="tit">物业公司</span><span class="value box_col">{$wuyegongsi}</span> </li>
              <li class="li_item"> <span class="tit">物业费</span><span class="value box_col">{$wuyefei}</span> </li>
              <li class="li_item"> <span class="tit">水电燃气</span><span class="value box_col">{$shuidianranqi}</span> </li>
            </ul>
          </div>
        </div>
        <!--/楼盘信息--> 
        
        <!--位置及周边-->
        <div class="mod_box location">
          <h3 class="mod_tit"><a href="/index.php?g=wap&m=map&jwd={$jingweidu}" class="arrow">位置及周边</a></h3>
          <div class="mod_cont"> <a href="/index.php?g=wap&m=map&jwd={$jingweidu}"><img src="//api.map.baidu.com/staticimage?center={$jingweidu}&amp;width=334&amp;height=253&amp;markers={$jingweidu}&amp;zoom=15"></a> </div>
          <ul class="item_lists" data-mark="map_data_container" data-info="coord=114.310167,22.72659">
          </ul>
        </div>
        <!--/位置及周边--> 
        
        <!--周边推荐-->
        <div class="mod_box recom">
          <h3 class="mod_tit"><span>周边推荐</span></h3>
          <div class="gridbox col_2"> 
          <position action="position" posid="13">
              <volist name="data" id="vo">
                <a class="box_col" href="{$vo.data.url}"> 
                  <span class="pictext"> <img origin-src="{$vo.data.thumb}" src="/statics/default/images/defaultpic.gif" alter="{$vo.data.title}" class="lazyload"> 
                  <span class="unit_price">{$vo.data.junjia}元/m²</span> </span> 
                  <span class="flexbox"> 
                  <span class="name text_cut box_col">{$vo.data.title}</span> </span> 
                </a> 
              </volist>
          </position>
          </div>
        </div>
        <!--/周边推荐--> 
      </div>
      
      <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部-->
      
      <div class="fixed_bar fixed_opt flexbox">
        <div class="pictext flexbox box_center_v">
          <div class="mod_media"> <a href="javascript:;" data-act="telphone" data-query="tel={$contacttel}"> <i class="icon_zixun"></i> </a> </div>
          <div class="box_col item_list"> <a href="javascript:;" data-act="telphone" data-query="tel={$contacttel}">
            <div class="item_main text_cut">免费咨询</div>
            </a> </div>
          <a href="javascript:;" class="plus" data-act="sendSMS" data-query="hasUrl=1&tel=&content=这个新房楼盘不错，{$title},{$junjia}元/m²。快来看看吧：">
          <div class="icon_con"><i class="icon_fenxiang"></i></div>
          </a> </div>
      </div>
    </section>
    <!--/页面--> 
  </div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/index.js"></script>
<script>
$LMB.start('main_start','m_pages_ershoufangDetail');
</script>
</html>
