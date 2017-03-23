<?php
	$back = urlencode(get_url());
	$userinfo = $this -> userinfo = service("Passport") -> getInfo();
	$u['userid']=$userinfo['userid'];
	$u['pay_status']=1;
	$u['house_id']=$id;
	$isgd=M('goudi')->where($u)->find();
?>
<style>
.overview .content .price .total{
	max-width:100% !important;
}
.mod-house-online .det-line-h{
	margin:0 !important;	
}
</style>
<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<link rel="stylesheet" href="{:C('app_ui')}css/common.css">
<link rel="stylesheet" href="{:C('app_ui')}css/detailV3.css">
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=qphEBA2YbUeePcowUS1ONiALbXLdGuGT"></script>
<div class="header">
  <div class="menu clear" style="padding-bottom: 15px">
    <div class="menuLeft"><a href="/" ><span class="logo"></span><span class="channelName">大宗交易</span></a>
    </div>
    <div class="search">
      <div log-mod="search" class="input">
        <form id="searchForm" action="/ershoufang/rs">
          <input type="text" autocomplete="off" placeholder="请输入关键词" id="searchInput">
          <button data-el="search" data-bl="search" class="searchButton" type="submit">&nbsp;<i class="am-icon-sm am-icon-search"></i>&nbsp;</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="intro clear" mod-id="lj-common-bread">
  <div class="container">
    <div class="l-txt"><a href="{$config_siteurl}">首页</a><span class="stp">&nbsp;>&nbsp;</span><navigate catid="$catid" space=" &gt; " /><span class="stp">&nbsp;>&nbsp;</span><span>当前房源</span>&nbsp;</div>
  </div>
</div>
<div class="overview">
  <div class="img" id="topImg" style="width: 400px">
    <img style="width: 390px;height:260px;" src="<if condition="$thumb">{$thumb}<else />{$config_siteurl}statics/default/images/defaultpic.gif</if>">
  </div>
  <div class="content" style="width: 700px">
    <div class="price "> <span class="total" style="color:#000;font-size:30px;">{$title}</span></div>
    <div class="houseInfo" style="border: none;padding: 0">
      <div class="room">
        <div class="mainInfo">
          <span style="font-size: 12px;">勾地需付款</span>
          <span class="w-red am-text-xxl">{$goudijine}</span>
          <span style="font-size: 12px;">元</span>
        </div>
      </div>
      <if condition="($hasgd eq 1) AND ($goudijine gt 0) AND (!$isgd)">
      <div class="area">
        <div class="mainInfo" style="width: 225px;text-align: right">
        <if condition="$userinfo">
          <button class="am-btn am-btn-primary" data-am-modal="{target: '#my-popup'}"><span class="am-icon-paperclip"></span> 勾地</button>
        <else />
        <a class="am-btn am-btn-primary" href="/index.php?g=Member&a=login&back={$back}"><span class="am-icon-paperclip"></span> 勾地</a>
        </if>
        </div>
      </div>
      </if>
    </div>
    <div class="aroundInfo" style="border: none;margin-top: 20px">
      <span class="label" style="margin-right: 5px">更新时间</span>
      <span class="info" style="margin-right: 40px">{$updatetime|date="Y-m-d",###}</span>      &nbsp;&nbsp;&nbsp;&nbsp;
      <span class="label" style="margin-right: 5px">房源编号</span>
      <span class="info" style="margin-right: 40px">{$bianhao}</span>
    </div>
    <!-- Baidu Button BEGIN -->
    <style>#bdshare a{height:22px}#bdshare span{height:22px !important}.shareCount{width:42px !important;}</style>
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<span class="bds_more">更多</span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&uid=6478904" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
  </div>
</div>
</div>
<div class="tab-wrap">
  <div class="panel-tab">
    <ul class="clear">
      <li><a href="#introduction">基本信息</a></li>
      <li> <a href="#detailintro">详细介绍</a> </li>
       <if condition="$isgd">
      <li><a href="#renzheng">认证信息</a></li>
      <li><a href="#around">周边配套</a></li>
      </if>
    </ul>
    <div class="panel-bg">
      <!-- <span>&#9660</span> -->
    </div>
  </div>
</div>
<div class="agboxB" style="display: none;">
  <div class="agbox"></div>
</div>
<div class="newwrap">
  <div class="mod-wrap">
    <div id="introduction" class="mod-panel mod-details">
      <h2>基本信息</h2>
      <p class="mod-details-line"></p>
      <div class="box-loupan">
        <p class="desc-p"></p>
        <ul class="table-list clear">
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">所在地区：</span>
              <span class="label-val">{$city|getareaName=###} / {$area|getareaName=###}</span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">位置：</span>
              <span class="label-val">{$address}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">预算金额(万元)：</span>
              <span class="label-val">{$zongjia}</span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">合作方式：</span>
              <span class="label-val">{$hezuofangshi}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">使用年限(年)：</span>
              <span class="label-val"><if condition="$shiyongnianxian eq '999'">长期<else/>{$shiyongnianxian}</if></span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">物业类型：</span>
              <span class="label-val">{$wuyetype}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">建筑面积(㎡)：</span>
              <span class="label-val">{$zhandimianji}</span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">联系人：</span>
              <span class="label-val">{$contactname}</span>
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div id="detailintro">
    <div class="mod-wrap">
      <div id="house-online" class="clear mod-panel-houseonline mod-house-online">
        <div class="h2-flow">详细介绍</div>
        <p class="det-line-h"></p>
        <div class="list-item latercon" data-index="0">
          {$content}
        </div>
      </div>
    </div>
  </div>
</div>
<if condition="$isgd">
<div class="newwrap">
  <div id="renzheng">
    <div class="mod-wrap">
      <div id="house-online" class="clear mod-panel-houseonline mod-house-online">
        <div class="h2-flow">认证信息</div>
        <p class="det-line-h"></p>
        <div class="list-item latercon" data-index="0">
          {$renzheng}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div class="around" id="around" style="width:100%">
    <h2>
      <div class="title">周边配套</div>
    </h2>
    <div class="content" style="width:100%">
      <ul class="type">
        <li class="select">公交</li>
        <li>地铁</li>
        <li>教育</li>
        <li>医院</li>
        <li>银行</li>
        <li>休闲娱乐</li>
        <li>购物</li>
        <li>餐饮</li>
        <li>运动健身</li>
      </ul>
      <div class="container">
        <div class="map" id="l-map"> </div>
        <div class="list" id="r-result"> </div>
      </div>
    </div>
  </div>
</div>
</if>
<style>
.desc-p .label{width:110px}
.xuzhi{
	background-color: #ffffff;
    border: 1px solid #e5e5e6;	
	box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.16);
	color: #394043;
	overflow: auto;
	border-radius: 4px;
	height:400px;
	padding:20px;
}
</style>
<div class="am-popup" id="my-popup" style="height: 600px;background-color: #F8F8F8;">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">勾地须知</span></h4>
      <span data-am-modal-close class="am-close">&times;</span> </div>
    <div class="am-popup-bd" style="padding:15px 30px;">
      <div class="xuzhi">{$xuzhi}</div>
      <div><input id="gdagree" type="checkbox"> 我同意此协议</div>
      <div><button id="ljgd" type="submit" disabled class="am-btn am-btn-default am-btn-block w-submit" style="width: 120px;margin: auto;color:#fff;background:#ED1B24" onclick="return apply();">立即勾地</button></div>
    </div>
  </div>
</div>
<script src="{:C('app_ui')}js/fe.js"></script>
<script src="{:C('app_ui')}js/common.js"></script>
<script src="{:C('app_ui')}js/detailV3.js"></script>
<script>
  require(['ershoufang/sellDetail/detailV3'],function(init){
    init({});
  });
  $(document).ready(function () {
	  $("#gdagree").click(function(){
		  if($(this).is(":checked")){
			$("#ljgd").removeAttr("disabled");
			}else{
				$("#ljgd").attr("disabled",true);
			}
		});
	  //点击
	$.get("{$config_siteurl}api.php?m=Hits&catid={$catid}&id={$id}", function (data) {
	    $("#hits").html(data.views);
	}, "json");
	
  });
  function apply(){
	  //勾地
		<?php if($userinfo){?>
		$.ajax({
			type: "POST",
			global: false, // 禁用全局Ajax事件.
			url: "/index.php?g=api&m=house&a=goudi_add",
			data: {
				"house_id":'<?php echo $id;?>',
				"userid":'<?php echo $userinfo['userid'];?>',
				"title":'<?php echo $title;?>',
				"jine":'<?php echo $goudijine;?>'
			},
			dataType: "json",
			success: function (data) {
				if(data.success == 82){
					alert(data.info);
					window.location.href="/index.php?g=Api&m=Api&a=gd_pay&id="+data.result.id;				
				}else{
					alert(data.info);
				}
			}
		});
		<?php }?>
	}
	
	<if condition="$isgd">
	// 百度地图
    var map = new BMap.Map("l-map");            // 创建Map实例
    var mPoint = new BMap.Point({$jingweidu});
    map.enableScrollWheelZoom();
    map.centerAndZoom(mPoint,15);
	
	var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
	var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
	map.addControl(top_left_control);        
	map.addControl(top_left_navigation);

    // 复杂的自定义覆盖物
    function ComplexCustomOverlay(point, text){
      this._point = point;
      this._text = text;
    }
    ComplexCustomOverlay.prototype = new BMap.Overlay();
    ComplexCustomOverlay.prototype.initialize = function(map){
      this._map = map;
      var div = this._div = document.createElement("div");
      div.style.position = "absolute";
      div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
      div.style.backgroundColor = "#EE5D5B";
      div.style.border = "1px solid #BC3B3A";
      div.style.color = "white";
      div.style.height = "24px";
      div.style.padding = "2px";
      div.style.lineHeight = "18px";
      div.style.whiteSpace = "nowrap";
      div.style.MozUserSelect = "none";
      div.style.fontSize = "12px"
      var span = this._span = document.createElement("span");
      div.appendChild(span);
      span.appendChild(document.createTextNode(this._text));
      var that = this;

      var arrow = this._arrow = document.createElement("div");
      arrow.style.background = "url(http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png) no-repeat";
      arrow.style.position = "absolute";
      arrow.style.width = "11px";
      arrow.style.height = "10px";
      arrow.style.top = "22px";
      arrow.style.left = "10px";
      arrow.style.overflow = "hidden";
      div.appendChild(arrow);
      map.getPanes().labelPane.appendChild(div);

      return div;
    }
    ComplexCustomOverlay.prototype.draw = function(){
      var map = this._map;
      var pixel = map.pointToOverlayPixel(this._point);
      this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
      this._div.style.top  = pixel.y - 30 + "px";
    }
    var myCompOverlay = new ComplexCustomOverlay(mPoint, "{$title}");

    map.addOverlay(myCompOverlay);
	
	//全景控件
	var stCtrl = new BMap.PanoramaControl(); //构造全景控件
	stCtrl.setAnchor(BMAP_ANCHOR_BOTTOM_LEFT);
	stCtrl.setOffset(new BMap.Size(20, 50));
	map.addControl(stCtrl);//添加全景控
    //周边配套
    var local =  new BMap.LocalSearch(map, {renderOptions: {map: map, autoViewport: false, panel: "r-result"}});

    local.searchNearby('公交',mPoint,1000);

    $("#around li").click(function(){
		var txt = $(this).text();
		if(txt=="地铁"){
			txt="地铁站";	
			local.searchNearby(txt,mPoint,3000);
		}else{
			local.searchNearby(txt,mPoint,1000);
		}
      
      $(this).addClass("select").siblings().removeClass("select");
    });
	</if>
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>