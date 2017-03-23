<template file="Content/header.php"/>
<template file="Content/nav.php"/>

<img src="{:C('app_ui')}images/wtbg.png" class="am-img-responsive">
<div style="background:#F7F7F7;position: absolute;text-align: center;left: 20%;top:200px;padding: 20px;border-radius: 5px;">
	<div class="w-data2">业主网站委托</div>
	<br>
	<div class="am-g">
		<div style="text-align: right;" class="am-u-sm-6">
			<a href="<if condition="!$userinfo">/index.php?g=Member&a=login<elseif condition="$userinfo['modelid'] eq 35" />{:U('Esf/add?t=1')}<else />javascript:alert('经纪人不可委托');</if>" class="am-btn am-btn-lg am-btn-success">二手房一键委托</a>
		</div>
		<div class="am-u-sm-6">
			<a href="<if condition="!$userinfo">/index.php?g=Member&a=login<elseif condition="$userinfo['modelid'] eq 35" />{:U('Czf/add?t=1')}<else />javascript:alert('经纪人不可委托');</if>" class="am-btn am-btn-lg am-btn-primary">出租房一键委托</a>
		</div>
	</div>
	<p>如有疑问请拨打客服热线：{:cache('Config.hottel')}</p>
</div>

<div class="am-text-center" style="margin:30px 0;">
	<div class="w-data2">委托房源仅需3步</div>
</div>
<!-- 滚动侦测开始 -->
<div>	
	<div class="am-g">
		<div class="am-u-sm-offset-1 am-u-sm-5 am-text-center" style="margin-top: 50px;">
			<div class="w-f30">1. 提交房源信息</div>
			<div class="w-data3">选“二手房”或“出租房”提交小区及房源信息</div>
		</div>
		<div class="am-u-sm-5 am-u-end">
			<img src="{:C('app_ui')}images/w1.png">
		</div>
	</div>
	<div class="am-g" style="background: #FBFBFB;">
		<div class="am-u-sm-offset-1 am-u-sm-5 am-text-center">
			<img src="{:C('app_ui')}images/w2.png">
		</div>
		<div class="am-u-sm-5 am-u-end" style="margin-top: 115px;">
			<div class="w-f30">2. 客服验证房源</div>
			<div class="w-data3">客服会电话业主验证委托房源的真实性</div>
		</div>
	</div>
	<div class="am-g">
		<div class="am-u-sm-offset-1 am-u-sm-5 am-text-center" style="margin-top: 100px;">
			<div class="w-f30">3.上门看房</div>
			<div class="w-data3">线上预约，客户上门看房</div>
		</div>
		<div class="am-u-sm-5 am-u-end" style="margin: 70px 0 80px 0">
			<img src="{:C('app_ui')}images/w3.png">
		</div>
	</div>
	<div class="am-g" style="background: #FBFBFB;padding: 40px 0;">
		<div class="w-f30 am-text-center">您还可以通过以下方式进行委托</div>
		<br>
		<div class="am-u-sm-offset-2 am-u-sm-4">
			<div class="am-g" style="width: 283px;margin: auto;">
				<div class="am-u-sm-6"><img src="{:C('app_ui')}images/tel.png" alt=""></div>
				<div class="am-u-sm-6">
					<div class="w-data3">电话委托</div>
					<div class="w-data3">{:cache('Config.hottel')}</div>
				</div>
			</div>
		</div>
		<div class="am-u-sm-4 am-u-end">
			<div class="am-g" style="width: 330px;margin: auto;">
				<div class="am-u-sm-4"><img src="{:C('app_ui')}images/ewm.jpg" style="width: 100px;height: 100px;"></div>
				<div class="am-u-sm-8">
					<div class="w-data3 w-txtleft">手机委托</div>
					<div class="w-data3">扫描二维码下载APP</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 滚动侦测结束 -->

<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>