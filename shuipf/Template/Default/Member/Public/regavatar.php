<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link rel="stylesheet" type="text/css" href="{$model_extresdir}css/passport.css" />
<!--修改头像-->
<div id="modifyAvatar" class="profile" style="width:100%">
  <div class="avatar_box" style="width:1098px;margin:80px 243px;">
    <div class="avatarTitle"> 当前头像<span>设置头像</span> </div>
    <div class="myAvatar" style="margin-left: 0;"> <img class="avatar-160" id="my-avatar" width="160" height="160" src="{:U('Api/Avatar/index',array('uid'=>$uid,'size'=>180))}" onerror="this.src='{$model_extresdir}images/noavatar.jpg'"/> </div>
    <div class="myAvatarUpload">
    	<div id="myContent"></div>
        {$user_avatar}
    </div>
    <div class="style" id="next"> <a style="margin-top:60px;" href="{:U("Member/Index/home")}" id="next">下一步</a> </div>
  </div>
</div>

<script type="text/javascript">
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
            $('#my-avatar').attr('src',"{:U('Api/Avatar/index',array('uid'=>$uid,'size'=>180))}");
        } else {
			alert(msg.content.msg);
		}
        break;
    }
}
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>