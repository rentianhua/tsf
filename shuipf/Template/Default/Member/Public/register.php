<template file="Content/header.php"/>
<template file="Member/Public/global_js.php"/>
<link href="/statics/icheck/skins/square/red.css" rel="stylesheet">
<script src="/statics/icheck/icheck.js"></script>
<img style="width:100%" src="{:C('app_ui')}images/login-bg.jpg" class="am-img-responsive w-img-responsive" />
<div class="wapper">
	<div class="user-login">
		<div class="back">
			<a href="index.php">返回首页</a>
			<span class="am-fr">已有账号？<a class="lgbiao" href="/index.php?g=Member&a=login<?php 
			$back=urlencode($_GET['back']);
			if($back && $back!=''){
				echo '&back='.$back;
			} ?>">马上登录</a></span>
		</div>
		<div class="user-con" id="regData">
          <input type="text" style="display: none">
  <input type="password" style="display: none">
			<div class="logo am-text-center"><img src="{:C('app_ui')}images/login-logo.png"></div>
			<form class="registerForm" onSubmit="return false;" id="myform">
             <input type="text" style="display: none">
             <input type="password" style="display: none">
				<ul>
					<li><input type="text" class="phonecode" placeholder="请输入验证码" name="verify" id="verify" autocomplete="off" style="width:130px;"><img style="margin: 0 10px;" class="yanzheng_img" id="code_img" alt="" src="{:U('Api/Checkcode/index','code_len=4&font_size=20&width=130&height=45&font_color=&background=')}"><a href="javascript:;;" onClick="refreshs()" class="change_img">刷新验证码</a>
                    <div id="mverify"></div>
					</li>
					<li><input type="text" class="phonecode" placeholder="请输入您的手机号" name="username" id="username" autocomplete="off" ><i>*</i>
					<button id="sendcode" type="button" class="am-btn yzm">发送验证码</button>
                    <div id="musername"></div>
					</li>
					<li><input id="yzm" type="text" validate="notNull" validatename="短信验证码" class="actCheckVerify" name="yzm" placeholder="请输入短信验证码"><i>*</i>
                    <div id="myzm"></div></li>
					<li id="zclx"><span style="font-size:14px;">注册类型</span>：<input type="radio" name="modelid" class="reg_type" value="35"> <span style="font-size:14px;">普通用户</span>&nbsp;&nbsp;&nbsp;
 <input type="radio"  name="modelid" class="reg_type" value="36"> <span style="font-size:14px;">经纪人</span>
 					<div id="mtype"></div>
                    </li>


					<li><input type="password" id="rpassword" placeholder="请输入密码" name="rpassword"><i>*</i>
                    <div id="mpassword"></div></li>
					<li><input type="password" id="rpassword2" name="rpassword2" placeholder="请确认密码"><i>*</i>
                    <div id="mpassword2"></div></li>
                    <li class="for36" style="display:none"><input type="text" id="realname" name="realname" placeholder="请输入真实姓名"><i>*</i>
                    <div id="mrealname"></div></li>				
					<li><input type="submit" id="submit" class="am-btn-primary" value="立即注册"></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="{$model_extresdir}js/register.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
          document.getElementById('myform').reset();
		   $('.reg_type').iCheck({
			radioClass: 'iradio_square-red',
			increaseArea: '20%' // optional
		  });
	  $(".iCheck-helper").click(function(){
		  $("#mtype").html("");
		var id = $(this).prev().val();  
		if(id == 36){
			$(".for36").show();
		}else{
			$(".for36").hide();
			$(".for36 div").html("");
			}
		});
	});
	register.init();
//刷新广告
function refreshs(){
	document.getElementById('code_img').src='{:U('Api/Checkcode/index','code_len=4&font_size=20&width=130&height=50&font_color=&background=&refresh=1')}&time='+Math.random();void(0);
}

</script>
<template file="Content/footer.php"/>