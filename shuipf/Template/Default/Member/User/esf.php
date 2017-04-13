<?php
$userinfo = $this->userinfo = service("Passport")->getInfo(); 
?>
<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<script src="/statics/js/content_addtop.js"></script>
<script src="/statics/js/wind.js"></script>
<link rel="stylesheet" href="/statics/js/artDialog/skins/default.css">
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr" id="allList">
  <a class="am-btn am-btn-primary" href="/index.php?m=Esf&a=add">我要发布</a>
    <div id="ershoufang" style="display: block;" class="all-list selected fav-list">
      <ul class="list-bot">
      <?php 
	  $u['username']=$userinfo['username'];
      $list = M('ershou')->where($u)->order('inputtime DESC') -> select();
	  ?>
      <volist name="list" id="vo">
      <li>
          <div class="list">
            <div class="pic-panel"> 
            <a <if condition="$vo['status'] eq 99">href="{$vo.url}" target="_blank"<else />href="javascript:;"</if>> 
            <img src='<if condition="$vo['thumb']">{$vo.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>            
            '> </a> </div>
            <div class="info-panel">
              <h2><a <if condition="$vo['status'] eq 99">href="{$vo.url}" target="_blank"<else />href="javascript:;"</if>>{$vo.title}</a> </h2>
              <div class="col-1">
                <div class="where">
                <span class="region">{$vo.city|getareaName=###} / {$vo.area|getareaName=###} / {$vo.xiaoqu|getxiaoquName=###} / <if condition="$vo.loudong neq ''">{$vo.loudong}栋</if>{$vo.menpai}</span>
                </div>
                <div class="other">
                  <div class="con">{$vo.ceng}(共{$vo.zongceng}层)</div>
                </div>
                <div class="chanquan">
                  <div class="left agency">
                    <div class="view-label left">
                    称呼：{$vo.chenghu} / {$vo.username} / <if condition="$vo['pub_type'] eq 1">自售<elseif condition="$vo['pub_type'] eq 2" />委托给经纪人<else />委托给平台</if>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="price"> <span class="num">{$vo.zongjia}</span>万 </div>               
              </div>
            </div>
          </div>
          <if condition="$userinfo['modelid'] eq 35">
              <if condition="$vo['lock'] eq 0">
              <a style="right:100px;" href="/index.php?m=Esf&a=edit&id={$vo.id}" class="del-fav actDelFollow">编辑</a>
              <a href="/index.php?m=Esf&a=del&id={$vo.id}" class="del-fav actDelFollow">删除</a>
              </if>
          <else />
          <a style="right:100px;" href="/index.php?m=Esf&a=edit&id={$vo.id}" class="del-fav actDelFollow">编辑</a>
          <a href="javascript:if(confirm('确认删除吗')){window.location.href='/index.php?m=Esf&a=del&id={$vo.id}';};" class="del-fav actDelFollow">删除</a>
          </if>
          
          <div style="text-align:right">
          <if condition="($vo['contract'] neq '') and ($vo['contract'] neq 'a:0:{}')">
          <span class="am-badge am-badge-primary am-text-sm">合同已上传</span>
          </if> 
          <if condition="($vo['idcard'] neq '') and ($vo['idcard'] neq 'a:0:{}')">
          <span class="am-badge am-badge-primary am-text-sm">身份证已上传</span>
          </if> 
          <if condition="($vo['contract'] eq '') OR ($vo['idcard'] eq '')">  
          <button onClick="chg({$vo.id}<if condition="$vo['contract'] neq ''">,1,0</if><if condition="$vo['idcard'] neq ''">,0,1</if>);" type="button" class="am-btn am-btn-xs am-btn-default" data-am-modal="{target: '#my-popup'}">照片上传</button>
          </if>  
          <if condition="$vo['status'] eq 99">
			  <if condition="$vo['zaishou'] eq 1">
				  <if condition="$vo['apply_state'] eq 1">
				  <a class="am-btn am-btn-xs am-btn-default">已售出申请中</a>
				  <else/>
				  <a href="javascript:apply_shouchu('{$vo.id}');" class="am-btn am-btn-xs am-btn-default">申请已售出</a>
				  </if>
			 <else/>
				<a class="am-btn am-btn-xs am-btn-danger">已售出</a>
			  </if>
          </if>
          </div>
           </li>
      </volist>
      </ul>
    </div>
  </div>
</div>
<div class="am-popup" id="my-popup" style="height:540px;">
  <div class="am-popup-inner" style="background: #f8f8f8">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">照片上传</h4>
      <span data-am-modal-close
            class="am-close">&times;</span>
    </div>
    <div class="am-popup-bd">
    <form action="/index.php?m=Esf&a=edit1" method="post">
    <input type="hidden" id="id" name="id">
    <div id="contract_con">
    <div>
      
         合同照片 
        <input value="1" name="contract" type="hidden">
          <fieldset class="blue pad-10">
            <center>
              <div id="nameTip" class="onShow">您最多每次可以同时上传 <font color="red">10</font> 张</div>
            </center>
            <div class="picList" id="contract"></div>
          </fieldset>
          <div class="bk10"></div>
          <a class="btn am-btn am-btn-danger am-round" onclick="javascript:flashupload1('pics_images', '图片上传','contract',change_images,'10,gif|jpg|jpeg|png|bmp,1,,,0','Content','6')" herf="javascript:void(0);"><span class="add"></span>选择图片 </a> <span></span>      
    </div>

    </div>
          <br><br>
      <div id="idcard_con">
       <div>
      
         身份证照片 
        <input value="1" name="idcard" type="hidden">
          <fieldset class="blue pad-10">
            <center>
              <div id="nameTip" class="onShow">您最多每次可以同时上传 <font color="red">3</font> 张</div>
            </center>
            <div class="picList" id="idcard"></div>
          </fieldset>
          <div class="bk10"></div>
          <a class="btn am-btn am-btn-danger am-round" onclick="javascript:flashupload1('pics_images', '图片上传','idcard',change_images,'3,gif|jpg|jpeg|png|bmp,1,,,0','Content','6')" herf="javascript:void(0);"><span class="add"></span>选择图片 </a> <span></span>
      
    </div>
     </div>
     <br><br>
     <div style="text-align:center"><button type="submit" class="am-btn am-btn-primary">立即上传</button></div>
     </form>
    </div>
  </div>
</div>
<script>
function chg(id,a,b){
	$("#id").val(id);
	//if(a){
		if(a == 1){
			$("#contract_con").hide();
			$("#contract").removeAttr('name');
		}else{
			$("#contract_con").show();
			$("#contract").attr('name','contract');
		}
	// }
	// if(b){
		if(b == 1){
			$("#idcard_con").hide();
			$("#idcard").removeAttr('name');
		}else{
			$("#idcard_con").show();
			$("#idcard").attr('name','idcard');
		}
	//}
}
function apply_shouchu(id){	
	$.ajax({

          type: "POST",

          global: false, // 禁用全局Ajax事件.

          url: "/index.php?g=api&m=house&a=apply_shouchu",

          dataType: "json",

          data: {

            username: "{$userinfo.username}",

        	id: id,

    		table: "ershou"

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
