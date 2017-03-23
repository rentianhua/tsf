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
                  <?php $dz=getdzName($vo['house_id']);?>
                  <td><a target="_blank" href="{$dz.url}">{$dz.title}</a></td>
                  <td><if condition="$vo['pay_status'] eq 0">未支付
                  <a href="/index.php?g=Api&m=Api&a=gd_pay&id={$vo.id}" style="background:#FF6B07;color:#fff;height:20px;line-height:6px;border-radius:3px;" type="button" class="am-btn am-btn-xs">去支付</a><else />已支付</if></td>                  <td>
                  <if condition="$vo['pay_status'] eq 0">
                  <img onclick="gd_del('{$vo.id}');" src="{:C('app_ui')}images/delete.png" title="删除" style="width:20px;height:20px;">
                   </if>
                  </td>
        </tr>
         <tr id="hide_{$vo.id}" style="display:none"><td colspan="7">
         <div class="moreinfo">
         <ul>
         <if condition="$vo['pay_status'] eq 1">         
         <li>支付宝交易流水号：{$vo.trade_no}</li>
         <li>支付宝账号：{$vo.buyer_email}</li>
         <li>支付金额：{$vo.jine}元</li>
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
<script type="text/javascript">
profile.init();
function gd_del(oid){
	if(confirm("确认删除吗？")){
	$.ajax({

      type: "POST",

      global: false, // 禁用全局Ajax事件.

      url: "/index.php?g=api&m=house&a=goudi_del",

      data: {

        id: oid,

        userid: <?php echo $userinfo['userid']?>

      },

      dataType: "json",

      success: function (data) {

        if(data.success){

          alert(data.info);
		  window.location.href="/index.php?g=Member&m=User&a=gd";

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
