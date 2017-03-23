<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="apple-mobile-web-app-title" content="掌上链家">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no">
<meta http-equiv="cleartype" content="on">
<meta name="location" content="province=广东;city=深圳;coord=114.051845,22.556468">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>【深圳房产网】买房、卖房、租房(淘深房)</title>
<link href="/favicon.ico" type="image/x-icon" rel="icon">
<link rel="stylesheet" href="{:C('wap_ui')}css/base.css">
<!--动态样式内容-->
<link rel="stylesheet" href="{:C('wap_ui')}css/site_index.css">
<link rel="stylesheet" href="{:C('wap_ui')}css/article_index.css">
</head>
<body>
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    
    <section class="page page_home">
      <header class="home_header">
        <div class="top">
          <div class="box_col"> <span class="switch_city"><em class="city">深圳</em></span> </div>
          <div class="opt_box"><a  class="my" rel="nofollow"><i class="icon_user"></i><span class="text">我的</span></a><a class="app" rel="nofollow"><i class="icon_download"></i><span class="text">APP</span></a></div>
        </div>
        <div class="content">
          <div class="slogan" title="聚焦深圳总价300万以下房源 永久免费 深圳不动产自主交易中心">聚焦深圳总价300万以下房源 永久免费 深圳不动产自主交易中心</div>
          <a href="/index.php?g=wap&m=other&a=search">
          <div class="search_box"><i class="icon_search_gray"></i>
            <input type="text" class="input" disabled="" placeholder="输入小区或商圈开始找房咯~">
          </div>
          </a> </div>
      </header>
      
      <!--/头部-->
      <style>
      .article_box{padding:0;}
      </style>
      <div class="content_area"> 
        <!--频道导航-->
        <div class="mod_box channel_nav">
          <div class="gridbox col_4">
          <content action="category" catid="0"  order="listorder ASC" num="7">
          <volist name="data" id="vo">          
            <h2 class="box_col"> 
            <a href="{:caturl($vo['catid'])}<if condition="$vo['catid'] eq 3">&tt=new</if>" class="inner">
              <div class="icon_ershoufang">
              <img src="/statics/wap/images/l{$i}.png">
              </div>
              <div class="name">{$vo.catname}</div>
              </a> </h2>
           </volist>
           </content>
           
              <h2 class="box_col"> 
            <a href="/index.php?g=Wap&a=lists&catid=37" class="inner">
              <div class="icon_ershoufang">
              <img src="/statics/wap/images/l8.png">
              </div>
              <div class="name">购房指南</div>
              </a> </h2>
          </div>
        </div>
        <!--/频道导航--> 
        
        <!--数据频道入口-->
        <div class="mod_box data_channel">
          <dl class="channel_box">
            <dt class="title"><a href="/index.php?g=wap&m=other&a=chart" class="arrow">二手房市场行情</a></dt>
            <dd class="data"> <a href="/index.php?g=wap&m=other&a=chart" class="link price_link ">
              <h4>最新参考均价</h4>
              <div class="unit_price"><strong>49969</strong><small>元/平</small></div>
              </a> <a href="/index.php?g=wap&m=other&a=chart" class="link amount_link">
              <h4>上月成交量</h4>
              <div class="amount"><strong>7465</strong><small>套</small></div>
              </a> </dd>
          </dl>
        </div>
        
        <!--房源列表-->
        <div class="mod_box house_lists">
          <h3 class="mod_tit">购房指南</h3>
          <!--文章列表-->
		<div class="mod_box article_box" data-mark="container">
        	
			<ul class="article_lists" data-mark="list_container">
            <position action="position" posid="12">
      <volist name="data" id="vo">
      <li class="article_item">
    <a href="{$vo.data.url}" class="pictext flexbox">
        <div class="item_list">
            <div class="item_main">{$vo.data.title}</div>
            <div class="item_minor twoline">{$vo.data.description}</div>
            <div class="item_other">
                <span class="tag haskey">热点</span>
            </div>
        </div>
        <div class="mod_media">
            <img origin-src="{$vo.data.thumb}" src="/statics/default/images/defaultpic.gif" class="lazyload">
        </div>
    </a>
</li>
      </volist>
    </position>
			</ul>
		</div>
		<!--/文章列表-->
          <div class="mod_cont">
            
          </div>
        </div>
        <!--/房源列表--> 
      </div>
      
      <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部--> 
      
    </section>
    <!--/页面--> 
  </div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/site_index.js"></script>
<script>
$LMB.start('main_start','m_pages_siteCityIndex');
</script>
</html>
