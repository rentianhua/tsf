var register = {
    init: function () {
        var $username = $("#username");
        var $rpassword = $("#rpassword");
        var $mpassword = $("#mpassword");
        var $rpassword2 = $("#rpassword2");
        var $mpassword2 = $("#mpassword2");
        var $rnickname = $("#rnickname");
        var $mnickname = $("#mnickname");
		var $musername = $("#musername");
		// var $rtruename = $("#realname");
		//var $mtruename = $("#mrealname");
		var $mtype = $("#mtype");

        var $submit = $('#submit');
		var $yzm = $("#yzm");
		var $verify = $("#verify");
		var $mverify = $("#mverify");
		var $myzm = $("#myzm");
		var $sendcode = $("#sendcode");
		    
		
		//网页验证码检查
		$verify.blur(function () {
            $(this).removeClass('input_focus');
            $(this).triggerHandler('keyup');
        }).keyup(function () {
            if ($(this).val() == '') {
                $mverify.html('<span class="icon">请输入图形证码</span>');
                return false;
            }else{
				$mverify.html('<span class="rightIcon">√ 已填写</span>');
			}
        });
		
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
						url: "/index.php?g=Member&m=Public&a=checkUsername",
						data: {
							username: $username.val()
						},
						dataType: "json",
						success: function (data) {					
							if(data.status){
								$musername.html('<span class="rightIcon">√ 通过验证</span>');
							}else{
								$musername.html('<span class="icon">'+data.info+'</span>');
								return false;
							}
						},
						error: function () {
							alert("数据执行错误。");
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
                    url: "/index.php?g=api&m=sms&a=reg",
                    data: {
						mob: $username.val(),
						verify:$verify.val()
                    },
					dataType: "json",
					success: function (data) {
						if(data.success == 98 || data.success == 99 ){
							$mverify.html('<div><span class="icon">'+data.info+'</span></div>');
							return false;
						}
						
						if(data.success == 4){
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
		
		
		//手机验证码检查
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
                },
                error: function () {
                    alert("数据执行错误！");
                    return false;
                }
            });
            
        });
		
		//设置密码
        $rpassword.blur(function () {
            $(this).removeClass('input_focus');
            $(this).triggerHandler('keyup');
        }).keyup(function () {
            if ($(this).val() == '') {
                $mpassword.html('<span class="icon">请输入您的登录密码</span>');
                return false;
            } else if ($(this).val().length < 6) {
                $mpassword.html('<span class="icon">密码长度应在6位以上</span>');
                return false;
            } else {
                $mpassword.html('<span class="rightIcon">√ 通过验证</span>');
            }
        });
		//确认密码
        $rpassword2.blur(function () {
            $(this).removeClass('input_focus');
            $(this).triggerHandler('keyup');
        }).keyup(function () {
            if ($(this).val() == '') {
                $mpassword2.html('<span class="icon">请输入确认密码</span>');
                return false;
            } else if ($(this).val() != $rpassword.val()) {
                $mpassword2.html('<span class="icon">两次输入密码不相同</span>')
                return false;
            } else {
                $mpassword2.html('<span class="rightIcon">√ 通过验证</span>');
            }
        });
		//真实姓名
        // $rtruename.blur(function () {
        //     $(this).removeClass('input_focus');
        //     $(this).triggerHandler('keyup');
        // }).keyup(function () {
        //     if ($(this).val() == '') {
        //         $mtruename.html('<span class="icon">请输入真实姓名</span>');
        //         return false;
        //     } else {
        //         $mtruename.html('<span class="rightIcon">√ 通过验证</span>');
        //     }
        // });
		$submit.click(function () {			
			//注册类型检查
			var zclxcheck = false;
			$(".iradio_square-red").each(function(){
				if($(this).hasClass('checked')){
					zclxcheck = true;
					return false;
				}	
			});
			if(!zclxcheck){
				$mtype.html('<span class="icon">请选择注册类型</span>');
			}
			$('#regData input[type!="radio"]:visible').trigger('keyup');
			
            var numError = $('#myform .icon').length; 
            if (!numError) {
				var back=window.location.href.split("back=")[1];
                $.ajax({
                    type: "POST",
                    global: false, // 禁用全局Ajax事件.
                    url: "/index.php?g=Member&m=Public&a=doRegister&back="+back,
                    data: {
						username: $username.val(),
                        password: $rpassword.val(),
                        password2: $rpassword2.val(),
						// realname: $rtruename.val(),
                        modelid: $(".checked input").attr("value")
                    },
                    dataType: "json",
                    success: function (data) {
						if(data.success){
                            $("#submit").attr('disabled', 'disabled');
                            $.tipMessage('帐号注册成功！', 0, 1000,0,function(){
                                libs.redirect(data.back);
                            });
						}else{							
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
        return false;
    }
}