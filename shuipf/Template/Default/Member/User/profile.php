<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<script src="/statics/js/content_addtop.js"></script>
<script src="/statics/js/wind.js"></script>
<script src="/statics/js/common.js"></script>
<link rel="stylesheet" href="/statics/js/artDialog/skins/default.css">
<script type="text/javascript" src="{$config_siteurl}statics/js/wind.js"></script>
<script type="text/javascript" src="{$config_siteurl}statics/js/common.js"></script>
<script type="text/javascript" src="{$model_extresdir}js/profile.js"></script>
<script type="text/javascript" src="{$config_siteurl}statics/js/ajaxForm.js"></script>
<style>
.ib input {
	height: 16px;
	margin: 9px 0 0 0;
}
.user-main .main-right li {
	padding: 0 !important;
}
</style>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr" id="allList">
    <div class="main_nav2">
      <ul id="aa">
        <li  
        
        <if condition="$type eq 'profile' ">class="current"</if>
        id="cprofile"> <a href="javascript:;"><span>基本资料</span></a>
        </li>
        <li  
        
        <if condition="$type eq 'avatar' ">class="current"</if>
        id="cavatar"> <a href="javascript:;"><span>修改头像</span></a>
        </li>
        <li  id="cpassword"> <a href="javascript:;"><span>修改密码</span></a> </li>
      </ul>
    </div>
    <div>
    <!--修改基本资料-->    
    <?php
	 $agent=M('member_agent')->where('userid='.$userinfo['userid'])->find();
	$normal=M('member_normal')->where('userid='.$userinfo['userid'])->find();?>
    <form id="doprofile" action="{:U('User/doprofile')}" method="post">
      <div id="modifyProfile" class="profile"  
      
      <if condition="$type neq 'profile' ">style="display: none;"</if>
      >
      <ul>
        <li>
          <div class="name"><span></span>手机号码：</div>
          <div class="input92cc"> <span style="display: inline-block; margin-top:5px">{$userinfo.username}</span></div>
        </li>
        <li>
          <div class="name"><span></span>转接号码：</div>
          <div class="input92cc">
            <if condition="$userinfo['zhuanjie'] eq 0">
              <button class="am-btn am-btn-danger am-btn-xs" type="button" data-am-loading="{spinner: 'circle-o-notch', loadingText: '申请中...'}" id="applytel" onclick="addvtel();$(this).button('loading');">立即申请</button>
            <else />
              <span style="margin-top:6px;display:inline-block">{:cache('Config.tel400')} 转 {$userinfo.vtel}</span>
              <button class="am-btn am-btn-danger am-btn-xs" type="button" id="jiebang" onclick="disbind();$(this).button('loading');" data-am-loading="{spinner: 'circle-o-notch', loadingText: '正在解绑...'}">解绑</button>
            </if>
          </div>
        </li>
        <li>
          <div class="name"><span></span>会员类型：</div>
          <div class="input92cc"> <span style="display: inline-block; margin-top:5px">
            <if condition="$userinfo.modelid eq 35">普通用户
              <else/>
              经纪人</if>
            </span></div>
        </li>
        <li>
          <div class="name">真实姓名<span class="red">*</span>：</div>
          <div class="input92cc">
          <if condition="$userinfo['modelid'] eq 35">
          <input class="input" type="text" value="{$normal.realname}" name="realname" style="width:190px;">
          <else />
            <input id="realname" class="input" type="text" value="{$agent.realname}" name="realname" style="width:190px;"><div id="mrealname" class="input_msg"></div>
            </if>
          </div>
          <div id="mrealname" class="input_msg"></div>
        </li>
        <li>
          <div class="name">性　　别：</div>
          <div class="input92cc">
            <select id="rsex" class="select_normal" name="sex" style="width:70px;">
              <option 
              
              <if condition="$userinfo['sex'] eq 0 ">selected="selected"</if>
              
               value="0">未知
              
              </option>
              <option 
              
              <if condition="$userinfo['sex'] eq 1 ">selected="selected"</if>
              
               value="1">男
              
              </option>
              <option 
              
              <if condition="$userinfo['sex'] eq 2 ">selected="selected"</if>
              
               value="2">女
              
              </option>
            </select>
          </div>
        </li>
        <li>
          <div class="name">个人介绍：</div>
          <div class="input92cc">
            <textarea name="about" cols="30" rows="7" id="rselfIntroduce" class="input"  style=" height:100px;width: 280px;">{$userinfo.about}</textarea>
          </div>
          <div id="mselfIntroduce" class="input_msg"></div>
        </li>
        <if condition="$userinfo.modelid eq 36">
          <li>
            <div class="name">主营区域：</div>
            <?php $arr=explode(',',$agent['mainarea']);?>
            <div id="mainarea">
              <input type="hidden" value="" name="mainarea">
              <label style="width:80px" class="ib">
                <input type="checkbox" value="罗湖区" <?php if(in_array("罗湖区", $arr)){echo "checked";}?>>
                罗湖区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="福田区" <?php if(in_array("福田区", $arr)){echo "checked";}?>>
                福田区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="南山区" <?php if(in_array("南山区", $arr)){echo "checked";}?>>
                南山区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="盐田区" <?php if(in_array("盐田区", $arr)){echo "checked";}?>>
                盐田区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="宝安区" <?php if(in_array("宝安区", $arr)){echo "checked";}?>>
                宝安区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="龙岗新区" <?php if(in_array("龙岗新区", $arr)){echo "checked";}?>>
                龙岗新区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="龙华新区" <?php if(in_array("龙华新区", $arr)){echo "checked";}?>>
                龙华新区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="光明新区" <?php if(in_array("光明新区", $arr)){echo "checked";}?>>
                光明新区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="坪山新区" <?php if(in_array("坪山新区", $arr)){echo "checked";}?>>
                坪山新区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="大鹏新区" <?php if(in_array("大鹏新区", $arr)){echo "checked";}?>>
                大鹏新区</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="东莞" <?php if(in_array("东莞", $arr)){echo "checked";}?>>
                东莞</label>
              <label style="width:80px" class="ib">
                <input type="checkbox" value="惠州" <?php if(in_array("惠州", $arr)){echo "checked";}?>>
                惠州</label>
            </div>
          </li>
          
          <li>
            <div class="name">身份证号码<span class="red">*</span>：</div>
            <div>
              <if condition="$agent['cardnumber'] eq ''">
                <input type="text" class="input" style="width:300px;" id="cardnumber" name="cardnumber">
                <div id="mcardnumber" class="input_msg"></div>
                <else />
                {$agent.cardnumber}
                </if>
            </div>
          </li>
          <li>
            <div class="name">身份证照片：</div>
            <div>
              <if condition="$agent['sfzpic'] eq ''">
                <input type="text" class="input" style="width:300px;" id="sfzpic" name="sfzpic">
                <input type="button" value="上传图片" onclick="flashupload1('sfzpic_images', '附件上传','sfzpic',submit_images,'1,jpg|jpeg|gif|png|bmp,0,,,1','Content','6')" class="button">
                <else />
                <img width="90" height="90" src="{$agent.sfzpic}"> </if>
            </div>
          </li>
          <li>
            <div class="name">职业类型：</div>
            <div> <input type="radio" value="个人" 
              <if condition="($agent['leixing'] eq '') OR ($agent['leixing'] eq '个人')">checked</if>
              id="leixing_个人" name="leixing">
              个人 <input type="radio" value="公司" 
              <if condition="$agent['leixing'] eq '公司'">checked</if>
              id="leixing_公司" name="leixing">
              公司 </div>
          </li>
          <li 
          <if condition="($agent['leixing'] eq '') OR ($agent['leixing'] eq '个人')">style="display: none;"</if>
          >
          <div class="name">公司名称：</div>
          <div>
            <input type="text" class="input" value="{$agent.coname}" style="width:200px;" id="coname" name="coname">
          </div>
          </li>
          <li>
            <div class="name">从业时间：</div>
            <div>
              <select id="worktime" name="worktime">
                <option value="1-2" <if condition="$agent['worktime'] eq '1-2'">selected</if>>1-2年</option>
                <option value="2-5" <if condition="$agent['worktime'] eq '2-5'">selected</if>>2-5年</option>
                <option value="6" <if condition="$agent['worktime'] eq '6'">selected</if>>5年以上</option>
              </select>
            </div>
          </li>
        </if>
        <li>
          <div style="margin:10px 100px;">
            <button id="seveProfile" type="button" class="am-btn am-btn-danger">保存修改</button>
          </div>
        </li>
      </ul>
      </div>
    </form>
    <!--修改头像--> 
    <div id="modifyAvatar" class="profile"  
    
    <if condition="$type neq 'avatar' ">style="display: none;"</if>
    >
    <div class="avatar_box">
      <div class="myAvatarUpload" style="border: 0 solid #E7E7E7;display: inline;float: left; height:450px;margin-bottom: 10px;padding-left: 10px;width: 432px;">
        <div id="myContent"></div>
        {$user_avatar} </div>
    </div>
  </div>
  <!--修改密码-->
  <div id="modifyPassword" class="profile"  style="display: none;" >
    <ul>
      <li>
        <div class="name">当前密码：</div>
        <div class="input92cc">
          <input id="roldpassword" class="input_normal input" type="password" maxlength="20" name="roldpassword" style="width:190px;" />
        </div>
        <div id="moldpassword" class="input_msg">请输入您当前使用的密码。</div>
      </li>
      <li>
        <div class="name">设置新密码：</div>
        <div class="input92cc">
          <input id="rpassword" class="input_normal input" type="password" maxlength="20" name="rpassword" style="width:190px;" />
        </div>
        <div id="mpassword" class="input_msg">6到20个字符，请使用英文字母（区分大小写）、符号或数字。</div>
      </li>
      <li>
        <div class="name">确认新密码：</div>
        <div class="input92cc">
          <input id="rpassword2" class="input_normal input" type="password" maxlength="20" name="rpassword" style="width:190px;" />
        </div>
        <div id="mpassword2" class="input_msg">再次输入您所设置的密码，以确认密码无误。</div>
      </li>
      <li>
        <div class="name"></div>
        <div class="input92cc"> <span class="button-main"> <span>
          <button id="sevePassword" type="button">保存修改</button>
          </span> </span> </div>
      </li>
    </ul>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
profile.init();
//头像上传回调
function fullAvatarCallback(msg) {
    switch (msg.code) {
    case 1:
        
        break;
    case 2:
        
        break;
    case 3:
        if (msg.type == 0) {
            
        } else if (msg.type == 1) {
            alert("摄像头已准备就绪但用户未允许使用！");
        } else {
            alert("摄像头被占用！");
        }
        break;
    case 4:
        alert("图像文件过大！");
        break;
    case 5:
        if (msg.type == 0) {
		    $.tipMessage("头像已经修改，刷新后可见最新头像！", 0, 3000);
        } else {
			alert(msg.content.msg);
		}
        break;
    }
}
$('#mainarea input[type=checkbox]').change(function(){
		$('input[name="mainarea"]').val($('#mainarea input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
})
$("#leixing_个人").click(function(){
	$("#coname").parents("li").hide(); 	
});
$("#leixing_公司").click(function(){
	$("#coname").parents("li").show(); 	
});
$("#applytel").removeAttr("disabled");
$("#jiebang").removeAttr("disabled");
function addvtel(){
	$.get("/index.php?g=api&m=api&a=add_vtel",{tel:"{$userinfo.username}",userid:"{$userinfo.userid}"},function(data){
		if(data.success == 57){
			alert("申请成功");
			window.location.reload();
		}else{
			alert("申请失败");	
			$("#applytel").removeAttr("disabled");
		}
	},"json")
}
function disbind(){
	$.get("/index.php?g=api&m=api&a=remove_vtel",{tel:"{$userinfo.username}", userid:"{$userinfo.userid}"},function(data){
		if(data.success == 64){
			alert("解绑成功");
			window.location.reload();
		}else{
			alert("解绑失败");	
			$("#jiebang").removeAttr("disabled");
		}
	},"json")
}
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>