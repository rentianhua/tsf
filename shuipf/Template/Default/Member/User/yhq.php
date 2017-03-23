<?php
//获取当前用户
$userinfo=$this->userinfo = service("Passport")->getInfo();
	$sql = "username = ".$userinfo['username'];
?>
<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet"> 
<style>
.moreinfo{border: 1px dashed #eee603;border-radius: 5px;}
.moreinfo li{list-style: none;padding:2px 0 2px 10px !important;}
</style>
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr">
    <table class="am-table">
        <thead>
            <tr>
              <th>#</th>
              <th>订单号</th>
              <th>优惠券名称</th>
              <th>楼盘</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <volist name="list" id="vo">
        <tr>
                  <td><span class="am-icon-caret-down" onClick="showhide({$vo.id})"></span> {$i}</td>
                  <td>{$vo.order_no}</td>
                  <td>{$vo.coupon_name}</td>
                  <?php $new=getnewName($vo['house_id']);?>
                  <td><a target="_blank" href="{$new.url}">{$new.title}</a></td>
                  <td><if condition="$vo['pay_status'] eq 0">未支付
                  <a href="/index.php?g=Api&m=Api&a=yhq_pay&id={$vo.id}" style="background:#FF6B07;color:#fff;height:20px;line-height:6px;border-radius:3px;" type="button" class="am-btn am-btn-xs">去支付</a><else />已支付</if></td>                  <td>
                  <if condition="$vo['pay_status'] eq 0">
                  <img onclick="javascript:$('#yhqid').val('{$vo.id}');" data-am-modal="{target: '#my-popup'}" src="{:C('app_ui')}images/delete.png" title="删除" style="width:20px;height:20px;">
                   </if>
                  </td>
        </tr>
         <tr id="hide_{$vo.id}" style="display:none"><td colspan="7">
         <div class="moreinfo">
         <ul>
         <li>购房人：{$vo.buyname}</li>
         <li>购房人手机号：{$vo.buytel}</li>
         <li>使用说明：{$vo.coupon_id|getyhqDesc=###}</li>
         <if condition="$vo['pay_status'] eq 1">         
         <li>支付宝交易流水号：{$vo.trade_no}</li>
         <li>支付宝账号：{$vo.buyer_email}</li>
         <li>支付金额：{$vo.shifu}元</li>
         <li>支付时间：{$vo.paytime|date='Y-m-d H:m:s',###}</li>
         </if>
         </ul>
         </div>
         </td></tr>       
        </volist>
        </tbody>    
        </table>
  </div>
</div>
<div style="height: 255px; background-color: rgb(248, 248, 248);" id="my-popup" class="am-popup am-modal-active">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">删除优惠券</h4>
      <span class="am-close" data-am-modal-close="">×</span> </div>
    <div style="margin-left:15%" class="am-popup-bd">
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">验证码：</span>
        <input type="text" style="border: 1px solid #e4e3e3;font-size: 16px;height: 36px;padding: 0 10px;width: 200px;" id="yzm">
        <span id="myzm"></span>
        <button class="am-btn yzm" type="button" onclick="sendyzm();">发送验证码</button>
      </div>
    </div>
    <div>
      <input type="hidden" id="yhqid">
      <button type="submit" class="am-btn am-btn-default am-btn-block w-submit" onclick="return yhq_del();">确认删除</button>
    </div>
  </div>
</div>
<script type="text/javascript">
profile.init();
function yhq_del(id){
	var yzm = $.trim($("#yzm").val());
	var pat = /(^\d{6}$)/;
	if(yzm == ""){
		$("#myzm").html("<span class='icon'>请输入验证码</span>");
	}else if(!pat.exec(yzm)){
		$("#myzm").html("<span class='icon'>入验证码错误</span>");	
	}else{
	
		$.ajax({

      type: "POST",

      global: false, // 禁用全局Ajax事件.

      url: "/index.php?g=api&m=house&a=coupon_del",

      data: {

        id: $("#yhqid").val(),

        userid: {$userinfo.userid},
		username: {$userinfo.username},
		yzm: $.trim($("#yzm").val())

      },

      dataType: "json",

      success: function (data) {

        if(data.success){

          alert(data.info);
		  window.location.href="/index.php?g=Member&m=User&a=yhq";

        }

      }

    });
	}
};
function showhide(id){
	var ele= $("#hide_"+id);
	var show = ele.is(":visible");
	if(show){
		ele.hide();	
	}else{
		ele.show();
	}
}
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
