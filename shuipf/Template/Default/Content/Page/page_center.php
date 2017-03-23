<template file="Content/header.php"/>
<template file="Content/nav.php"/>

<div class="user-main">
  <div class="main-left fl">
    <div class="name"> </div>
    <div class="user-name">欢迎你，wsting</div>
    <ul>
      <li><a href="/site/index/">首页</a></li>
      <li><a href="/site/favorHouse/">关注的房源</a></li>
      <li><a href="/site/favorCommunity/">关注的小区</a></li>
      <li><a href="/site/history/">看房记录</a></li>
      <li><a href="/site/delegation/">我的委托</a></li>
      <li><a href="/site/searchlist/">我的搜索</a></li>
      <li><a href="/site/myWenda/">我的问答</a></li>
      <li class="hover"><a href="/site/client/">编辑资料</a></li>
    </ul>
  </div>
  <div id="resetPwddom" class="main-right fr">
    <div class="title">我的账户信息</div>
    <div class="tab"><span tap-target="#updatePortrait" class="actTap hover">上传头像</span><span tap-target="#updatePerson" class="sitecms actTap">修改昵称</span><span tap-target="#updatePwd" class="actTap">修改密码</span><!-- <span class="actTap" tap-target="#updatePerson">个人资料</span> --></div>
    <div id="uploader-demo"></div>
    <div class="change-portrait" id="updatePortrait" style="display: block;"><!--用来存放item-->
      <div class="update">
        <div class="file">
          <div class="uploader-list" id="fileList"></div>
          <div id="filePicker" class="inp webuploader-container">
            <div class="webuploader-pick">选择图片</div>
            <div id="rt_rt_1anfgh7kh15lnmejvtokmv9li1" style="position: absolute; top: 0px; left: 0px; width: 78px; height: 39px; overflow: hidden; bottom: auto; right: auto;">
              <input type="file" name="file" class="webuploader-element-invisible" multiple accept="image/*">
              <label style="opacity: 0; width: 100%; height: 100%; display: block; cursor: pointer; background: rgb(255, 255, 255) none repeat scroll 0% 0%;"></label>
            </div>
          </div>
        </div>
        <div class="preview">
          <div id="label" class="fl">
            <div class="parcanvas">
              <canvas id="get_image"></canvas>
              <span>
              <canvas id="cover_box"></canvas>
              <canvas id="edit_pic"></canvas>
              </span></div>
            <div class="pic-box"><img class="pic" src=""></div>
            <label>只支持jpg、png格式，大小不能超过1M</label>
            <img class="null" src=""><img class="surl" src=""></div>
          <div class="fr">
            <p>预览</p>
            <div id="show_edit" class="preview-box">
              <div class="preview-3x"><img src=""></div>
              <div class="preview-2x"><img src=""></div>
              <div class="preview-1x"><img src=""></div>
              <span class="text-3">120px*120px</span><span class="text-2">80px*80px</span><span class="text-1">34px*34px</span></div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="suc"><span class="sucServer">确定</span></div>
      </div>
    </div>
    <form style="display: none;" id="updatePwd" method="post" action="/site/password/">
      <ul class="change-pwd">
        <li><span>输入旧密码：</span>
          <input type="password" validatename="密码" validatedata="minLength=6" validate="notNull,minLength" placeholder="请输入密码" id="password" name="password">
        </li>
        <li><span>设置新密码：</span>
          <input type="password" validatename="密码" validatedata="minLength=6" validate="notNull,minLength" placeholder="请输入新密码" id="password1" name="newPassword">
        </li>
        <li><span>确认新密码：</span>
          <input type="password" validatename="确认新密码" validatedata="isSame=#password1" validate="notNull,isSame" placeholder="请确认新密码">
        </li>
        <li><span></span><a class="actSubmit lj-btn">保存修改</a></li>
      </ul>
    </form>
    <form id="updatePerson" style="display: none;" method="post" action="/site/clientdata/">
      <ul class="change-pwd">
        <li><span>设置昵称：</span>
          <input type="text" validatedata="maxLength=14" validatename="昵称" class="nickName" validate="notNull,numberLetter,maxLength" name="nickName">
        </li>
        <li><span></span><a class="nameSubmit lj-btn">保存修改</a></li>
      </ul>
    </form>
  </div>
  <div class="clear"></div>
</div>

<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>