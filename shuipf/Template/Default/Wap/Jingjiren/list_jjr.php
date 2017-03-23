<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','bq','od','kw');
// 把上一次已筛选的值保存在Form的隐藏域中
foreach($fields as $f){
  if(isset($_GET[$f])){
    $fitervalue[$f] = $_GET[$f];
  }
}		
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="apple-mobile-web-app-title" content="掌上链家">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no">
<meta http-equiv="cleartype" content="on">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>淘深房-经纪人</title>
<link href="/favicon.ico" type="image/x-icon" rel="icon">
<link rel="stylesheet" href="{:C('wap_ui')}css/base.css">
<!--动态样式内容-->
<link rel="stylesheet" href="{:C('wap_ui')}css/jjr_index.css">
</head>
<body>
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page page_zufang"> 
      
      <!--头部-->
      <header class="header"> <a href="/" class="logo_wrap"> <img style="height:33px;" src="{:C('wap_ui')}images/login-logo.png" alt=""></a>
        <div class="opt_box box_col"><a href="/" class="my"><i class="icon_user"></i><span class="text">我的</span></a><a href="/" class="app"><i class="icon_download"></i><span class="text">APP</span></a></div>
      </header>
      <!--/头部-->
      <style>
      .icon_search,.icon_triangle_down{background-image: url("/statics/wap/images/mysprite.png")}
	  .tab_bar .tab_tit{width:33.3%}
      </style>
      <div class="content_area"> 
        <!--搜索框-->
        <div class="search_box search_a">
          <input type="text" id="ss" class="input" placeholder="请输经纪人姓名搜索">
          <span class="divide"></span><i class="icon_search"></i> </div>
        <!--/搜索框--> 
        
        <!--房源列表-->
        <div class="mod_box jingjiren_lists"> 
          <!--筛选条-->
        <form id="filterForm" action="" method="get">
        <input type="hidden" name="g" value="wap">
      	<input type="hidden" name="m" value="jingjiren">
        <input type="hidden" name="a" value="list_jjr">
        <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="bq" name="bq" value="<?php echo $fitervalue['bq']; ?>" />
        <input to="filter" type="hidden" id="od" name="od" value="<?php echo $fitervalue['od']; ?>" />
        <input to="filter" type="hidden" id="kw" name="kw" value="<?php echo $fitervalue['kw']; ?>" />   		</form> 
        <?php
		  $qulist = get_area_list(1);
		?>
          <div class="tab_bar flexbox" data-mark="booth">
            <div class="tab_tit box_col" data-mark="booth_area" >
              <h2 class="tit">
              <if condition="!$_GET['ct']">
              区域
              <else />
              	<if condition="$_GET['ct'] neq ''">
                  {$_GET['ct']}
                </if>
              </if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_price">
              <h2 class="tit"><if condition="!$_GET['bq']">筛选<else />{$_GET['bq']}</if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_model">
              <h2 class="tit">
              <if condition="!$_GET['od']">排序
              <elseif condition="$_GET['od'] eq 'inputtime_DESC'" />默认
              </if></h2>
              <i class="icon_triangle_down"></i></div>
          </div>
          <!--/筛选条-->          
          <div class="mod_cont">            
    		<ul class="lists q_agentlist" data-mark="list_container" data-info="total=5">
            <volist name="list" id="vo">
              <li class="pictext"> <a href="/index.php?g=Wap&m=Jingjiren&a=show_jjr&id={$vo.userid}" class="flexbox box_center_v">
                <div class="mod_media">
                  <div class="media_main"> <img origin-src="/d/file/avatar/000/00/00/{$vo.userid}_180x180.jpg" src="/statics/extres/member/images/noavatar.jpg" alt="陈华青" class="lazyload"> </div>
                </div>
                <div class="item_list">
                  <div class="item_main text_cut"><span class="name">{$vo.realname}</span><span class="info q_level">
                  <switch name="vo['dengji']">
                    <case value="1">普通经纪人</case>
                    <case value="2">优秀经纪人</case>
                    <case value="3">高级经纪人</case>
                    <case value="4">资深经纪人</case>
                    <default />普通经纪人
                    </switch>
                  </span></div>
                  <div class="item_other q_shop">主营区域：{$vo.mainarea}</div>
                  <div class="item_other"><span>好评率：</span><span class="red q_good">97% 29</span><span>人评价</span></div>
                  <div class="tag_box q_tag"> 
                  <?php
            $array = explode(",",$vo['biaoqian']);
            $i = 1;
            foreach ($array as $value) {
              if ($value != ''){
                echo '<span class="tag owner_trust_mark">' . $value . '</span> ';
              }
              $i++;
            }
            ?> </div>
                </div>
                </a> </li>
            </volist>
            </ul>           
          </div>
        </div>
        <!--/房源列表-->
        
      </div>
      
      <!--底部:导航当前页用h1着重强调-->
      <footer class="footer">
        <div class="nav"> <span class="location"><a href="/">首页</a></span> <span class="location"><i class="crumb"></i>
          <a href="/index.php?g=Wap&m=Jingjiren&a=list_jjr">经纪人</a> 
          </span> </div>
        <div class="info">
          <div class="icon_box"> <a style="float:left" href="" title="iPhone客户端" class="icon_iphone" rel="nofollow">iPhone客户端</a> <a href="" title="Android客户端" class="icon_android" rel="nofollow">Android客户端</a> </div>
          <div class="copyright">
            <p class="company">深圳市瑞安兴业房地产顾问有限公司</p>
            <p class="record">网络经营许可证 粤ICP备16061979号-1</p>
          </div>
        </div>
      </footer>
      <!--/底部-->
      
    </section>
    <section class="layer_fixed filter_box" style="display: none;" data-mark="panel_box"> 
      <!--头部筛选条-->
      <header class="tab_bar flexbox">
        <div class="tab_tit box_col" data-mark="button_area" ><span class="tit">区域</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_price"><span class="tit">筛选</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_model"><span class="tit">排序</span><i class="icon_triangle_down"></i></div>
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
              <li class="li" type="ct" value="{$vo.name}">{$vo.name}</li>              
              </volist>                
              </ul>
            </div>
          </div>
        </div>
        <!--/区域--> 
        
        <!--价格-->
        <div class="filter_item lists_price" data-mark="panel_price">
          <ul class="price_list zj_list">
            <li class="li" type="bq">不限</li>
            <li class="li" type="bq" value="带看活跃">带看活跃</li>
            <li class="li" type="bq" value="销售达人">销售达人</li>
            <li class="li" type="bq" value="客户热评">客户热评</li>
            <li class="li" type="bq" value="房东信赖">房东信赖</li>
            <li class="li" type="bq" value="学区专家">学区专家</li>
            <li class="li" type="bq" value="海外专家">海外专家</li>
          </ul>
        </div>
        <!--/价格--> 
        
        <!--房型-->
        <div class="filter_item lists_price"  data-mark="panel_model">
          <ul class="price_list q_roomlist">
            <li class="li" type="od">默认</li>
            <li class="li" type="od" value="inputtime_DESC">好评率从高到低</li>
            <li class="li" type="od" value="inputtime_DESC">成交量从高到低</li>
            <li class="li" type="od" value="inputtime_DESC">带看量从高到低</li>
          </ul>
        </div>
        <!--/房型--> 
        
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
  
  $(".q_roomlist li,.zj_list li,.qu_list li").on("tap",function(){
	if(typeof($(this).attr('value'))!="undefined"){		
		Filter($(this).attr('type'),$(this).attr('value')); 
	}else{
		Filter($(this).attr('type')); 
	}
  });  
  $(".icon_search").on("tap",function(){
	Filter('kw',$("#ss").val()); 
  });
</script>
</html>
