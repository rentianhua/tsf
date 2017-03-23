
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
				<ul>
					<li><input type="password" name="password" placeholder="请输入新密码" id="password"><i>*</i>
                    <div id="mpassword"></div></li>
					<li><input type="password" placeholder="请输入确认密码" name="password2" id="password2"><i>*</i>
                    <div id="mpassword2"></div></li>				
					<li><input type="submit" value="重置密码" class="am-btn-primary" id="submit"></li>
				</ul>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var $password = $("#password");
	var $password2 = $("#password2");
	var $mpassword = $("#mpassword");
	var $mpassword2 = $("#mpassword2");
	var $submit = $('#submit');

	//设置密码
	$password.blur(function () {
		$(this).removeClass('input_focus');
		$(this).triggerHandler('keyup');
	}).keyup(function () {
		if ($(this).val() == '') {
                $mpassword.html('<span class="icon">请输入新密码</span>');
                return false;
            } else if ($(this).val().length < 6) {
                $mpassword.html('<span class="icon">密码长度应在6位以上</span>');
                return false;
            } else {
                $mpassword.html('<span class="rightIcon">√ 通过验证</span>');
            }		
	});
		
	//确认密码
	$password2.blur(function () {
		$(this).removeClass('input_focus');
		$(this).triggerHandler('keyup');
	}).keyup(function () {
		if ($(this).val() == '') {
                $mpassword2.html('<span class="icon">请输入确认密码</span>');
                return false;
            } else if ($(this).val() != $password.val()) {
                $mpassword2.html('<span class="icon">两次输入密码不相同</span>')
                return false;
            } else {
                $mpassword2.html('<span class="rightIcon">√ 通过验证</span>');
            }		
	});
	$submit.click(function () {
		$('#regData :input').each(function(){
			var numRight = $(this).nextAll("div").children(".rightIcon").length;
			if( !numRight ){
				$(this).trigger('keyup');	
			}	
		});
		var numError = $('#regData .icon').length;
		if (!numError) {
			var href = window.location.href;
			var arr = href.split("&");
			var yzm1 = arr[arr.length-1].split("=")[1];
			var mob1 = arr[arr.length-2].split("=")[1];
			$.ajax({
				type: "POST",
				global: false, // 禁用全局Ajax事件.
				url: "/index.php?g=Member&m=Public&a=modpassword",
				data: {
					mob: mob1,
					yzm: yzm1,
					password:$password.val(),
					password2:$password2.val()					
				},
				dataType: "json",
				success: function (data) {
					if(data.status){
						//密码修改成功
						alert("密码修改成功");
						window.location.href = "/index.php?g=Member&a=login";
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
</script>
<template file="Content/footer.php"/>