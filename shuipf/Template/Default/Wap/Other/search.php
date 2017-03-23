<template file="Wap/header.php"/>
</head>
<body>
<style>
@charset "UTF-8";

.page_search {
	background-color: #fff;
	height: 100%
}

.page_search .li_item>a,.page_search .li_item>div {
	width: auto
}

.page_search .search_box.search_a .divide {
	height: 100%
}

.page_search .search_form {
	background-color: #fff;
	border-bottom: 1px solid #e5e5e5
}

.page_search .search_box.search_a {
	margin: 0;
	border: 0
}

.page_search .search_form .back {
	display: block;
	width: 2.5rem;
	height: 2.5rem;
	line-height: 2.5rem;
	text-align: center;
	padding: 0
}

.page_search .search_form .tab_tit {
	position: relative;
	line-height: 2.5625rem;
	padding: 0 .5rem;
	border-right: 1px solid #c9c9c9;
	border-left: 1px solid #c9c9c9
}

.page_search .mod_box {
	margin-top: 0;
	border-top: 0
}

.page_search .mod_box .detail_more {
	margin: 0 -1.25rem;
	background-color: #f0f0f0;
	border-radius: .00625rem;
	box-shadow: 0 1px 1px #b9b9b9;
	border-top: 1px solid #e2e2e2
}

.page_search .mod_box .detail_more a {
	color: #626262;
	font-size: .8125em;
	height: 2.75em;
	line-height: 2.75em
}

.page_search .mod_box .detail_more a>i,.page_search .mod_box .detail_more a>span {
	vertical-align: middle
}

.page_search .mod_box .detail_more a>span {
	padding-left: .3125rem
}

.page_search .dropdown {
	background-color: #fff;
	position: absolute;
	color: #000;
	top: 3rem;
	left: 0;
	width: 5rem;
	border: 1px solid #c5c5c5;
	border-radius: .3125rem;
	z-index: 1;
	-webkit-animation: ani-fadeIn .3s ease;
	-moz-animation: ani-fadeIn .3s ease;
	-ms-animation: ani-fadeIn .3s ease;
	animation: ani-fadeIn .3s ease
}

.page_search .dropdown:before {
	content: "";
	display: inline-block;
	width: .5rem;
	height: .5rem;
	background-color: #FFF;
	border: solid #e2e2e2;
	border-width: 1px 0 0 1px;
	position: absolute;
	top: -.3125rem;
	left: 50%;
	margin-left: -.25rem;
	-webkit-transform: rotate(45deg);
	-moz-transform: rotate(45deg);
	-ms-transform: rotate(45deg);
	transform: rotate(45deg)
}

.page_search .dropdown li {
	text-align: center;
	border-bottom: 1px solid #c5c5c5
}

.page_search .dropdown li:last-child {
	border-bottom: 0
}

.page_search .count {
	padding-left: 2rem;
	text-align: right;
	margin-right: 1.25rem;
	color: #a8a8a8;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap
}
.icon_search,.icon_fanhui{background-image:url('/statics/wap/images/mysprite.png')}
</style>
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page page_search">
      <div class="content_area">
        <div class="search_form flexbox"> <a class="back" href="javascript:history.back();"><span class="icon_fanhui"></span></a>
          <div class="tab_tit" style=""> <span class="tit" data-mark="search_type">二手房</span> <i class="icon_triangle_down"></i>
            <ul class="dropdown" data-mark="dropdown_panel" style="display: none;">
              <li data-act="action_select" value="6" data-query="channel_id=ershoufang&city_id=440300">二手房</li>
              <li data-act="action_select" value="8" data-query="channel_id=zufang&city_id=440300">出租房</li>
              <li data-act="action_select" value="7" data-query="channel_id=zufang&city_id=440300">大宗交易</li>
              <li data-act="action_select" value="3" data-query="channel_id=xinfang&city_id=440300">新房</li>
              <li data-act="action_select" value="99" data-query="channel_id=jingjiren&city_id=440300">经纪人</li>
            </ul>
          </div>
          <div class="search_box search_a box_col">
              <input type="text" id="kw" class="input" placeholder="输入关键词开始找房咯~">
              <input type="hidden" id="catid" value="6">
              <span class="divide"></span><i class="icon_search" onclick="search();"></i>
          </div>
        </div>
        <div class="mod_box ">
          <ul class="item_lists" data-mark="history_list">
          </ul>
          <div style="display: none;" class="detail_more" data-mark="clearHistory_panel"><a href="javascript:void(0);" data-act="action_clearHistory"><i class="icon_delete"></i><span>清空搜索历史</span></a></div>
        </div>
      </div>
    </section>
    <!--/页面--> 
  </div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/sitesearch.js"></script>
<script>
$LMB.start('main_start','m_pages_siteSearch',
{
    "fe_root": "", 
    "version": "", 
    "nation": {}, 
    "js_ns": "m_pages_siteSearch", 
    "cur_city_id": 440300, 
    "cur_city_name": "深圳", 
    "cur_city_short": "sz", 
    "cur_channel_id": "ershoufang", 
    "rs": ""
}
);
function search(){
	var catid = $("#catid").val();
	if(catid == 99){
		window.location.href="/index.php?g=Wap&m=Jingjiren&a=list_jjr&kw="+$("#kw").val();
	}else{
		window.location.href="/index.php?g=wap&a=lists&catid="+catid+"&kw="+$("#kw").val();	
	}	
}
$(".dropdown li").on("tap",function(){	
	var catid = $(this).attr('value');
	$("#catid").val(catid);
	if(catid == 99){
		$("#kw").attr('placeholder','输入经纪人姓名开始搜索');
	}else{
		$("#kw").attr('placeholder','输入关键词开始找房咯~');
	}
	
});
</script>
</html>