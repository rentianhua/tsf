<template file="Content/header.php"/>
<template file="Member/Public/global_js.php"/>
<img style="width:100%" src="{:C('app_ui')}images/login-bg.jpg" class="am-img-responsive w-img-responsive" />
<div class="wapper">
	<div class="user-login">
		<div class="back">
			<a href="index.php">返回首页</a>
			<span class="am-fr">还没有账号？<a class="lgbiao" href="/index.php?g=Member&a=register<?php 
			$back=urlencode($_GET['back']);
			if($back && $back!=''){
				echo '&back='.$back;
			} ?>">马上注册</a></span>
		</div>
		<div class="user-con">
			<div class="logo am-text-center"><img src="{:C('app_ui')}images/login-logo.png"></div>
			<div style="width: 390px;margin:auto; text-align: right; ">
            <a id="typetxt" href="javascript:chg();">手机验证登录 <span class="am-icon-arrow-right"></span></a>
            </div>
            <?php $back=urlencode($_GET['back']);?>
            <form id="myform" class="registerForm loginpage" action="/index.php?g=Member&m=Public&a=doLogin&back={$back}" onClick="return false;" method="post">
				<ul>
					<li>
					<span class="am-icon-mobile tip mobile"></span>
					<input autocomplete="off" id="loginName" type="text" class="phonecode"  placeholder="请输入手机号" name="loginName">
                    <div id="mloginName"></div>
                    </li>
					<li>
					<span class="am-icon-lock tip"></span>
					<input type="password" validatename="密码" validate="notNull,passwordRule" placeholder="请输入登录密码" id="password" name="password">				
                    <div id="mpassword"></div>
                    </li>	                
					<li><input id="tijiao" style="text-align:center" type="submit" class="am-btn-primary" value="立即登录"></li>
				</ul>
			</form>
            <div style="display:none;" id="myform2" class="registerForm loginpage">
                <ul>
					<li>
                    <span class="am-icon-mobile tip mobile"></span>
                    <input type="text" class="phonecode" placeholder="请输入手机号" name="username" id="username" autocomplete="off" >
					<button id="sendcode" type="button" class="am-btn yzm">发送验证码</button>
                    <div id="musername"></div>
					</li>
					<li>
                    <span class="am-icon-lock tip"></span>
                    <input id="yzm" type="text" validate="notNull" validatename="短信验证码" class="actCheckVerify" name="yzm" placeholder="请输短信验证码">
                    <div id="myzm"></div>
                    </li>
                                     
					<li><input id="tijiao2" style="text-align:center" type="submit" class="am-btn-primary" value="立即登录"></li>
				</ul>
			</div>
            <ul class="registerForm">
            	<li>
                    <input type="checkbox" name="cookieTime"> 自动登录
                    <a href="{:U('Member/Index/lostpassword')}" class="am-fr forgetpwd">忘记密码?</a>
                </li>
            </ul>
		</div>
	</div>
</div>
<script>
	//普通方式登录
	$("#loginName").keyup(function(){
		if($.trim($(this).val()) == "")	{
			$("#mloginName").html("<span class='icon'>请输入手机号</span>");	
			return false;
		}else{
			var patrn = /(^1[3|4|5|7|8][0-9]{9}$)/;
			if (!patrn.exec($.trim($(this).val()))) {
				$("#mloginName").html('<span class="icon">请输入正确的手机号码</span>');
				return false;
			}else{
				$("#mloginName").html('<span class="rightIcon">√ 验证通过</span>');
			}
		}
	});
	$("#password").keyup(function(){
		if($.trim($(this).val()) == "")	{
			$("#mpassword").html("<span class='icon'>请输入密码</span>");
			return false;	
		}else{
			$("#mpassword").html('<span class="rightIcon">√ 验证通过</span>');
		}
	});
	
	//手机验证码登录	
	$("#username").keyup(function(){
		if($.trim($(this).val()) == "")	{
			$("#musername").html("<span class='icon'>请输入手机号</span>");	
			return false;
		}else{
			var patrn = /(^1[3|4|5|7|8][0-9]{9}$)/;
			if (!patrn.exec($.trim($(this).val()))) {
				$("#musername").html('<span class="icon">请输入正确的手机号码</span>');
				return false;
			}else{
				$("#musername").html('<span class="rightIcon">√ 验证通过</span>');
			}
		}
	});
	//发送验证码
	var countdown=60;
	var $sendcode=$("#sendcode");
	var $yzm=$("#yzm");
	var $myzm=$("#myzm");
	var $username=$("#username");
	$sendcode.removeAttr("disabled");
	function settime() { 			
		if (countdown == 0) { 
			$sendcode.removeAttr("disabled");    
			$sendcode.html("发送验证码"); 
			countdown = 60; 
			return;
		} else { 
			$sendcode.attr("disabled", true); 
			$sendcode.html("已发送(" + countdown + ")"); 
			countdown--; 
		}			
		setTimeout(function(){settime();},1000);			 
	}
	$sendcode.click(function(){
		$username.trigger('keyup');
		var numError = $('#musername .icon').length;
		if(!numError){			
			$.ajax({
				type: "POST",
				global: false, // 禁用全局Ajax事件.
				url: "/index.php?g=api&m=sms&a=getyzm",
				data: {
					mob: $("#username").val()
				},
				dataType: "json",
				success: function (data) {
					if(data.success == 11){
						//倒计时
						$(this).attr("disabled", true);
						settime();
					}else{
						$("#musername").html('<div><span class="icon">'+data.info+'</span></div>');
						return false;
					}
				}				
			});	
		}
	});
	
	//验证码检查
	$yzm.blur(function () {
		$(this).removeClass('input_focus');
		$(this).triggerHandler('keyup');
	}).keyup(function () {
		if ($(this).val() == '') {
			$myzm.html('<span class="icon">请输入短信验证码</span>');
			return false;
		} else {
			var patrn = /(^\d{6}$)/;
			if (!patrn.exec($(this).val())) {
			$myzm.html('<span class="icon">验证码错误</span>');
			return false;
			}				
		}
		
		$.ajax({
			type: "POST",
			global: false, // 禁用全局Ajax事件.
			url: "/index.php?g=api&m=sms&a=check_yzm",
			data: {
				mob: $username.val(),
				yzm: $yzm.val()
			},
			dataType: "json",
			success: function (data) {
				if(data.success == 7){
					$myzm.html('<div><span class="rightIcon">√ 通过验证</span></div>');
				}else{
					$myzm.html('<div><span class="icon">验证码错误</span></div>');
					return false;
				}
			}
		});
		
	});
	$("#yzm").keyup(function(){
		if($.trim($(this).val()) == "")	{
			$("#myzm").html("<span class='icon'>请输入验证码</span>");	
			return false;
		}else{
			var patrn = /(^\d{6}$)/;
			if (!patrn.exec($.trim($(this).val()))) {
				$("#myzm").html('<span class="icon">验证码错误</span>');
				return false;
			}else{
				$("#yzm").html('<span class="rightIcon">√ 验证通过</span>');
			}
		}
	});
	$("#tijiao").click(function () {	
		$('#myform :input').trigger("keyup");
		var numError = $('#myform .icon').length;
		if (!numError) {
			document.getElementById("myform").submit();
		}
	});
	$("#tijiao2").click(function () {	
		$('#myform2 :input').trigger("keyup");
		var numError = $('#myform2 .icon').length;
		var back=window.location.href.split("back=")[1];
		if (!numError) {
			$.ajax({
			type: "POST",
			global: false, // 禁用全局Ajax事件.
			url: "/index.php?g=Member&m=Public&a=api_dologin2&back="+back,
			data: {
				username: $username.val(),
				yzm: $yzm.val()
			},
			dataType: "json",
			success: function (data) {
				if(data.success == 37){
					if(data.back == 'undefined'){
						window.location.href="/index.php?g=Member&m=User&a=profile";
					}else{
						window.location.href=data.back;
					}
				}else{
					alert(data.info);
					return false;
				}
			}
		});
		}
	});
	function chg(){
		if($('#myform').is(':visible')){
			$('#myform').hide();
			$('#myform2').show();
			$("#typetxt").html('普通方式登录 <span class="am-icon-arrow-right"></span>');
		}else{
			$('#myform').show();
			$('#myform2').hide();
			$("#typetxt").html('手机验证登录 <span class="am-icon-arrow-right"></span>');
		};	
	}
</script>
<template file="Content/footer.php"/>