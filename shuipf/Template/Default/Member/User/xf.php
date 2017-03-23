<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<style>
  .w_page{text-align:center;font-size:16px;color:#7b5502;}
  .w_page .current{
    border:1px solid #EA6400;margin:0 5px;
    background:none !important;
    position:static;
  }
  .w_page a{padding:5px 10px;border:1px solid #7b5502;margin:0 5px}
  .w_page span{padding:5px 10px}
</style>
<?php
//获取当前用户
$userinfo=$this->userinfo = service("Passport")->getInfo();
$sql = "username = ".$userinfo['username']." and isfabu != '隐藏'";
?>
<div class="user">
  <div class="user_center">
    <template file="Member/Public/homeUserMenu.php"/>
    <div class="user_main">
      <div class="uMain_content">
        <div class="main_nav2">
          <ul>
            <li><div class="tit">我的新房</div></li>
          </ul>
        </div>
        <div class="minHeight500">
          <a href="/index.php?m=Xf&a=add" class="am-btn am-btn-primary" style="margin-left:70px;border:1px solid #ED1B24">我要发布</a>
          <div id="modifyAvatar" class="profile">
            <table class="am-table w-table">
              <thead>
              <tr>
                <th>#</th>
                <th>标题</th>
                <th>发布时间</th>
                <th>状态</th>
                <th>操作</th>
              </tr>
              </thead>
              <tbody>
              <content action="lists" catid="3" where="$sql" order="inputtime ASC" num="8" page="$page">
                <volist name="data" id="vo">
              <tr>
                <td>{$i}</td>
                <td><div class="am-text-truncate" style="width: 550px;">{$vo.title}</div></td>
                <td>{$vo.inputtime|date='Y-m-d H:m:s',###}</td>
                <td><if condition="$vo['isfabu'] eq '发布'">已发布<else />未发布</if></td>
                <td>
                  <a href="/index.php?m=Xf&a=show&id={$vo.id}">
                    <img src="{:C('app_ui')}images/search.png" title="查看" style="width:20px;height:20px;">
                  </a>
                  <a href="/index.php?m=Xf&a=edit&id={$vo.id}">
                    <img src="{:C('app_ui')}images/edit.png" title="编辑" style="width:32px;height:32px;">
                  </a>
                  <a href="javascript:;" value="/index.php?m=Xf&a=del&id={$vo.id}" class="del">
                    <img src="{:C('app_ui')}images/delete.png" title="删除" style="width:20px;height:20px;">
                  </a>
                </td>
              </tr>
                </volist>
              </content>
              </tbody>
            </table>
            <br>
            <p class="w_page">{$pages}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  profile.init();
  $(".del").click(function(){
    var href = $(this).attr("value");
    if(confirm("确认删除吗？")){
      window.location.href = href;
    }
  });
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>