<?php
//获取当前用户
$userinfo=$this->userinfo = service("Passport")->getInfo();
$sql = "username = ".$userinfo['username'];
?>
<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr">
    <table class="am-table">
        <thead>
            <tr>
              <th>#</th>
                <th>类型</th>
                <th>状态</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
            <content action="lists" catid="48" where="$sql" order="inputtime DESC">
        <volist name="data" id="vo">
        <tr>
                    <td style="width:1px">{$i}</td>                   
                    <td>{$vo.type}</td>
                    <td>{$vo.action}</td>
                    <td>{$vo.inputtime|date='Y-m-d H:i:s',###}</td>
                  </tr>
        </volist>
    </content>
        </tbody>    
        </table>
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
