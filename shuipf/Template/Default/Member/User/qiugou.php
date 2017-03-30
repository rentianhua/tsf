<?php
//获取当前用户
$userinfo=$this->userinfo = service("Passport")->getInfo();
?>
<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr">
  <if condition="$userinfo['modelid'] eq 35">
  	<a class="am-btn am-btn-primary" href="/index.php?m=qiugou&a=add">我要发布</a>
    </if>
    <table class="am-table">
            <thead>
                <tr>
                  <th>序号</th>
                  <th>求购信息</th>
                  <if condition="$userinfo['modelid'] eq 36">
                  <th>称呼</th>
                  <th>手机号</th>
                  </if>
                  <th>发布时间</th>
                  <if condition="$userinfo['modelid'] eq 35"><th>操作</th></if>
                </tr>
            </thead>
            <tbody>
            <?php 
			if($userinfo['modelid'] == 35){
				$u['username']=$userinfo['username'];				
			}else{
				$u['jjrid'] = $userinfo['userid'];
			}
			$list=M('userqiugou')->where($u)->order('inputtime DESC')->select();
			?>
        	<volist name="list" id="vo">
            <tr>
                      <td>{$i}</td>
                      <td>{$vo.title}</td>
                      <if condition="$userinfo['modelid'] eq 36">
                  <th>{$vo.chenghu}</th>
                  <th>{$vo.username}</th>
                  </if>
                      <td>{$vo.inputtime|date='Y-m-d H:i:s',###}</td>
                      <if condition="$userinfo['modelid'] eq 35">
                      <td>
                    <if condition="$vo['lock'] eq 0">               
                	<a href="javascript:;" value="/index.php?m=qiugou&a=del&id={$vo.id}" class="del">
                	<img src="{:C('app_ui')}images/delete.png" title="删除" style="width:20px;height:20px;">
                    </a>
                    </if>
                      </td>
                      </if>
                    </tr>
            </volist>
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
