<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<?php $back=urlencode(get_url());?>
<style>
	.nav-bg{
		background: transparent !important;
		position: absolute; 
		top: 0;
		z-index: 2;
		width: 100%;
	}
	.w-nav{
		background: transparent !important;
		box-shadow: none !important;
	}	
	#tuijian img{
		width:238px !important;	
	}
</style>
<ul class="am-gallery am-avg-sm-1 am-gallery-overlay" style="padding: 0">
  <li style="padding: 0">
    <div class="am-gallery-item">
        
      <img src="{:C('app_ui')}images/navbg.jpg"/>
      <!-- 首页搜索开始 -->
      <div class="am-gallery-title" style="height: 130px;background: none;">      	
      	<div class="am-tabs searchtab" data-am-tabs>
		  <ul class="am-tabs-nav am-nav am-nav-tabs index-tab-nav">
		    <li class="am-active"><a href="#tab1">二手房</a></li>
		    <li><a href="#tab2">新房</a></li>
		    <li><a href="#tab3">租房</a></li>
		  </ul>

		  <div class="am-tabs-bd index-tab-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="tab1" style="padding-left: 0;">
			    <div class="am-input-group">
			      <input onkeydown="if(event.keyCode==13){window.location.href='/index.php?a=lists&catid=6&kwds='+$('#kw_es').val();};" id="kw_es" type="text" class="am-form-field searchinput" placeholder="输入小区名开始搜索">
			      <span class="am-input-group-btn indexsearch">
			        <button onClick="window.location.href='/index.php?a=lists&catid=6&kwds='+$('#kw_es').val();" class="am-btn am-btn-primary" type="button">搜 索</button>
			      </span>
			    </div>
		    </div>
		    <div class="am-tab-panel am-fade" id="tab2" style="padding-left: 0;">
		      <div class="am-input-group">
			      <input onkeydown="if(event.keyCode==13){window.location.href='/index.php?a=lists&catid=3&kwds='+$('#kw_new').val();};" id="kw_new" type="text" class="am-form-field searchinput" placeholder="输入小区名开始搜索">
			      <span class="am-input-group-btn indexsearch">
			        <button onClick="window.location.href='/index.php?a=lists&catid=3&kwds='+$('#kw_new').val();" class="am-btn am-btn-primary" type="button">搜 索</button>
			      </span>
			    </div>
		    </div>
		    <div class="am-tab-panel am-fade" id="tab3" style="padding-left: 0;">
		      <div class="am-input-group">
			      <input onkeydown="if(event.keyCode==13){window.location.href='/index.php?a=lists&catid=8&kwds='+$('#kw_cz').val();};" id="kw_cz" type="text" class="am-form-field searchinput" placeholder="输入小区名开始搜索">
			      <span class="am-input-group-btn indexsearch">
			        <button onClick="window.location.href='/index.php?a=lists&catid=8&kwds='+$('#kw_cz').val();" class="am-btn am-btn-primary" type="button">搜 索</button>
			      </span>
			    </div>
		    </div>
		  </div>
		</div>
      </div>
      <!-- 首页搜索结束 --> 
      
    </div>
  </li>
</ul>
<div style="position: absolute;top:40px;text-align: right;left: 26%;top:130px;">
	<div style="font-size: 58px;color: #fff;font-weight:bold">{:cache('Config.zhubiaoti')}</div>
	<div style="font-size: 26px;color: #fff;">{:cache('Config.fubiaoti')}</div>
</div>
<!-- 推荐开始 -->
<div class="w-content" style="margin-bottom: 30px;" id="tuijian">
	<div id="tab1-con">
		<div class="w-title1">二手房推荐</div>
		<div style="margin: 0 10px;">{:cache('Config.ershou_desc')}
        <a href="/index.php?a=lists&catid=6" class="am-fr">查看更多>></a></div>		
        <position action="position" posid="1">
            <ul class="am-gallery am-avg-sm-4 am-gallery-overlay">
            <volist name="data" id="vo">
              <li>
              	<div class="am-gallery-item">
             		<a href="{$vo.data.url}" title="{$vo.data.title}">
                    	<img src="{$vo.data.thumb}">
                        <h3 class="am-gallery-title">{$vo.data.title}</h3>
                    </a>
                </div>
              </li>
            </volist>
            </ul>            
        </position>		  
	</div>
	<div id="tab2-con">
		<div class="w-title1">新房推荐</div>
		<div style="margin:0 10px;">{:cache('Config.new_desc')}
        <a href="/index.php?a=lists&catid=3" class="am-fr">查看更多>></a></div>
		<position action="position" posid="2">
            <ul class="am-gallery am-avg-sm-4 am-gallery-overlay">
            <volist name="data" id="vo">
              <li>
              	<div class="am-gallery-item">
             		<a href="{$vo.data.url}" title="{$vo.data.title}">
                    	<img src="{$vo.data.thumb}">
                        <h3 class="am-gallery-title">{$vo.data.title}</h3>
                    </a>
                </div>
              </li>
            </volist>
            </ul>            
        </position>
	</div>
	<div id="tab3-con">
		<div class="w-title1">租房推荐</div>
		<div style="margin:0 10px;">{:cache('Config.chuzu_desc')}
        <a href="/index.php?a=lists&catid=8" class="am-fr">查看更多>></a></div>
		<position action="position" posid="3">
            <ul class="am-gallery am-avg-sm-4 am-gallery-overlay">
            <volist name="data" id="vo">
              <li>
              	<div class="am-gallery-item">
             		<a href="{$vo.data.url}" title="{$vo.data.title}">
                    	<img src="{$vo.data.thumb}">
                        <h3 class="am-gallery-title">{$vo.data.title}</h3>
                    </a>
                </div>
              </li>
            </volist>
            </ul>            
        </position>
	</div>
</div>
<!-- 推荐结束 -->
<!-- app下载开始 -->
<div style="background-image: url('{:C('app_ui')}images/bg1.jpg');position: relative;">
	<div class="w-content">
		<div class="w-title2">
			<div style="font-size: 48px;">
				淘深房产，精彩人生！
			</div>
			<div style="font-size: 24px">
				精彩房产APP全新登场
			</div>
		</div>
		<div class="am-g">
			<div class="am-u-sm-6">
				<img src="{:C('app_ui')}images/phonebg.png">
			</div>
			<div class="am-u-sm-3" style="padding:170px 0 0 40px;">
				<div class="am-g appdown">
					<a href="#">
						<div class="am-u-sm-2">
							<span class="am-icon-android am-icon-md"></span>
						</div>
						<div class="am-u-sm-9">
							<div>Android版下载</div>
							<div>当前版本:1.0</div>
						</div>
					</a>
				</div>
				<div class="am-g appdown">
					<a href="#">
						<div class="am-u-sm-2">
							<span class="am-icon-apple am-icon-md"></span>
						</div>
						<div class="am-u-sm-9">
							<div>iPhone版下载</div>
							<div>当前版本:1.0</div>
						</div>
					</a>
				</div>
			</div>
			<div class="am-u-sm-3" style="padding-top: 190px;">
				<img style="width:163px;" src="{:C('app_ui')}images/ewm.jpg">
			</div>
		</div>
	</div>
</div>
<!-- app下载结束 -->
<!-- 行情开始 -->
<?php $tracy=M('tracy')->order('id desc')->limit(1)->find();?>
<div class="w-content am-text-center" style="padding: 40px;">
	<div class="am-container w-title1">深圳市{$tracy.month}月二手房市场行情</div>
	<div class="am-g">
		<div class="am-u-sm-6">
			<div>
				<span class="w-data1">{$tracy.avg_price}</span>
				<i class="am-icon-long-arrow-<if condition="$tracy['avg_price_o'] eq 1">up<else />down</if> w-data3"></i>
			</div>
			<div>二手房源全市均价(元/㎡)</div>
		</div>
		<div class="am-u-sm-6">
			<span class="w-data1">{$tracy.avg_percent}%</span>
            <i class="am-icon-long-arrow-<if condition="$tracy['avg_percent_o'] eq 1">up<else />down</if> w-data3"></i>
			<div>全市均价环比上月</div>
		</div>
	</div>
	<br>
	<div class="am-g">
		<div class="am-u-sm-4">
			<div class="w-data4">
				<div>
					<span class="w-data2">{$tracy.house_percent}%</span>
					<i class="am-icon-long-arrow-<if condition="$tracy['house_percent_o'] eq 1">up<else />down</if> w-data3"></i>
				</div>
				<div>昨日新增客房比</div>
			</div>
		</div>
		<div class="am-u-sm-4">
			<div class="w-data4">
				<span class="w-data2">{$tracy.comp_count}</span>
				<i class="am-icon-long-arrow-<if condition="$tracy['comp_count_o'] eq 1">up<else />down</if> w-data3"></i>
				<div>上月成交量(套)</div>
			</div>
		</div>
		<div class="am-u-sm-4">
			<div class="w-data4">
				<span class="w-data2">{$tracy.view_count}</span>
				<i class="am-icon-long-arrow-<if condition="$tracy['view_count_o'] eq 1">up<else />down</if> w-data3"></i>
				<div>昨日房源带看次数(次)</div>
			</div>
		</div>
	</div>
</div>
<!-- 行情结束 -->
<!-- 委托开始 -->
<div style="background-image: url('{:C('app_ui')}images/bg1.jpg');padding: 40px 0;">
	<div class="w-content">
		<div class="w-data2" style="padding: 30px 20px">业主网站委托</div>
		<div class="am-g">
			<div class="am-u-sm-6" style="text-align: right;">
				<a href="<if condition="!$userinfo">/index.php?g=Member&a=login&back={$back}<elseif condition="$userinfo['modelid'] eq 35" />{:U('Esf/add?t=1')}<else />javascript:alert('经纪人不可委托');</if>" class="am-btn am-btn-lg am-btn-primary" class="am-btn am-btn-lg am-btn-success" type="button">二手房一键委托</a>
			</div>
			<div class="am-u-sm-6">
				<a href="<if condition="!$userinfo">/index.php?g=Member&a=login&back={$back}<elseif condition="$userinfo['modelid'] eq 35" />{:U('Czf/add?t=1')}<else />javascript:alert('经纪人不可委托');</if>" class="am-btn am-btn-lg am-btn-primary" class="am-btn am-btn-lg am-btn-primary" type="button">出租房一键委托</a>
			</div>
		</div>
		<p class="am-text-center">如有疑问请拨打客服热线：{:cache('Config.hottel')}</p>
	</div>
</div>
<!-- 委托结束 -->
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>