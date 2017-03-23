<?php
$userinfo = $this->userinfo = service("Passport")->getInfo();
?>
<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr">
  	<a class="am-btn am-btn-primary" href="/index.php?m=Czf&a=add">我要发布</a>
    <div style="display: block;" class="all-list selected fav-list">
      <ul class="list-bot">
      <?php 
	  $u['username']=$userinfo['username'];
      $list = M('chuzu')->where($u)->order('inputtime DESC') -> select();
	  ?>
      <volist name="list" id="vo">
      <li>
          <div class="list">
            <div class="pic-panel"> <a <if condition="$vo['status'] eq 99">href="{$vo.url}" target="_blank"<else />href="javascript:;"</if>> 
            <img src='<if condition="$vo['thumb']">{$vo.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>            
            '> </a> </div>
            <div class="info-panel">
              <h2> <a <if condition="$vo['status'] eq 99">href="{$vo.url}" target="_blank"<else />href="javascript:;"</if>>{$vo.title}</a> </h2>
              <div class="col-1">
                <div class="where"> <span class="region">
                {$vo.city|getareaName=###} / {$vo.area|getareaName=###} / {$vo.xiaoqu|getxiaoquName=###}&nbsp;&nbsp;</span>
                </div>
                <div class="other">
                  <div class="con">{$vo.shi}室{$vo.ting}厅 / {$vo.mianji}平米<span></div>
                </div>
                <div class="chanquan">
                  <div class="left agency">
                    <div class="view-label left"> 
                    	<if condition="$vo['pub_type'] eq 1">直接出租<elseif condition="$vo['pub_type'] eq 2" />委托给经纪人<else />委托给平台</if>           
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="price"> <span class="num">{$vo.zujin}</span>元/月 </div>               
              </div>
            </div>
          </div>
          <div>
          </div>
          <if condition="$userinfo['modelid'] eq 35">
			  <if condition="$vo['lock'] eq 0">
			  <a style="right:100px;" href="/index.php?m=Czf&a=edit&id={$vo.id}" class="del-fav actDelFollow">编辑</a>
			  <a href="/index.php?m=Czf&a=del&id={$vo.id}" class="del-fav actDelFollow">删除</a>
			  </if>
          <else />
          <a style="right:100px;" href="/index.php?m=Czf&a=edit&id={$vo.id}" class="del-fav actDelFollow">编辑</a>
			  <a href="/index.php?m=Czf&a=del&id={$vo.id}" class="del-fav actDelFollow">删除</a>
          </if>
          <div style="text-align:right">
          <if condition="$vo['status'] eq 99">
			  <if condition="$vo['zaizu'] eq 1">
				  <if condition="$vo['apply_state'] eq 1">
				  <a class="am-btn am-btn-xs am-btn-default">已出租申请中</a>
				  <else/>
				  <a href="javascript:apply_shouchu('{$vo.id}');" class="am-btn am-btn-xs am-btn-default">申请已出租</a>
				  </if>
			 <else/>
				<a class="am-btn am-btn-xs am-btn-danger">已出租</a>
			  </if>
          </if>
          </div>
          </li>
      </volist>
      </ul>
    </div>
  </div>
</div>
<script>
function apply_shouchu(id){	
	$.ajax({

          type: "POST",

          global: false, // 禁用全局Ajax事件.

          url: "/index.php?g=api&m=house&a=apply_shouchu",

          dataType: "json",

          data: {

            username: "{$userinfo.username}",

        	id: id,

    		table: "chuzu"

  		  },

		success: function (data) {

		  if(data.success == 182){

			alert("申请成功");
			  window.location.reload();

		  }else{

			alert("申请失败");

		  }

		}

    });
}
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
