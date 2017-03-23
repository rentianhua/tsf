
<template file="Member/Public/head_user.php"/>
<img class="am-img-responsive w-img-responsive" src="{:C('app_ui')}images/login-bg.jpg">
<div class="wapper">
	<div class="user-login">
		<div class="back">
			<a href="index.php">返回首页</a>			
		</div>
		<div id="regData" class="user-con">
			<div class="logo am-text-center"><img src="/statics/taosf/images/login-logo.png"></div>
			<form onsubmit="return false;" class="registerForm">
            <input type="text" style="display: none">
             <input type="password" style="display: none">
				<ul>
					<li><input type="text" autocomplete="off" id="username" name="username" placeholder="请输入手机号" class="phonecode"><i>*</i>
					<button class="am-btn yzm" type="button" id="sendcode">发送验证码</button>
                    <div id="musername"></div>
					</li>
					<li><input type="text" placeholder="请输短信验证码" name="yzm" class="actCheckVerify" validatename="短信验证码" validate="notNull" id="yzm"><i>*</i>
                    <div id="myzm"></div></li>				
					<li><input type="submit" value="找回密码" class="am-btn-primary" id="l_submit"></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var $username = $("#username");
	var $musername = $("#musername");
	var $yzm = $("#yzm");
	var $myzm = $("#myzm");
	var $sendcode = $("#sendcode");
	var $l_submit = $('#l_submit');
	//手机号检查
	$username.blur(function () {
		$(this).removeClass('input_focus');
		$(this).triggerHandler('keyup');
	}).keyup(function () {
		if ($(this).val() == '') {
			$musername.html('<span class="icon">请输入手机号码</span>');
			return false;
		} else {
			var patrn = /(^1[3|4|5|7|8][0-9]{9}$)/;
			if (!patrn.exec($(this).val())) {
			$musername.html('<span class="icon">请输入正确的手机号码</span>');
			return false;
			}else{
				$.ajax({
					type: "POST",
					global: false, // 禁用全局Ajax事件.
					url: "/index.php?g=Member&m=Public&a=checkUsername2",
					data: {
						username: $username.val()
					},
					dataType: "json",
					success: function (data) {					
						if(data.status){
							$musername.html('<span class="rightIcon">√ 通过验证</span>');
						}else{
							$musername.html('<span class="icon">该手机号码未注册</span>');
							return false;
						}
					},
					error: function () {
						//alert("数据执行错误。");
						return false;
					}
				});
			}
		}
		
	});
	
	//发送验证码
	var countdown=60;
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
				url: "/index.php?g=api&m=sms&a=lost_getyzm",
				data: {
					mob: $username.val()
				},
				dataType: "json",
				success: function (data) {
					if(data.success == 11){
						//倒计时
						$(this).attr("disabled", true);
						settime();
					}else{
						$musername.html('<div><span class="icon">'+data.info+'</span></div>');
						return false;
					}
				},
				error: function () {
					alert("数据执行错误！");
					return false;
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
	$l_submit.click(function () {		
		$('#regData :input').each(function(){
			var numRight = $(this).nextAll("div").children(".rightIcon").length
			if( !numRight ){
				$(this).trigger('keyup');	
			}	
		});
		var numError = $('#regData .icon').length;
		if (!numError) {;
			window.location.href="/index.php?g=Member&m=Public&a=modpassword&mob="+$username.val()+"&yzm="+$yzm.val();
		}
	});
</script>
<template file="Content/footer.php"/>