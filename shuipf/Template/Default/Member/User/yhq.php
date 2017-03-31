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
                  <a href="/index.php?g=Api&m=Api&a=yhq_pay&id={$vo.id}" style="background:#FF6B07;color:#fff;height:20px;line-height:6px;border-radius:3px;" type="button" class="am-btn am-btn-xs">去支付</a><else />已支付</if>
                     <if condition="$vo['isused'] eq 0"><div style="color:green">未使用</div><else /><div style="color:red">已使用</div></if>
                  </td>                  
                  <td>
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
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">手机号：<span id="mgtel"></span></span> 
        <input type="text" placeholder="手机号" id="gtel" style="border: 1px solid #e4e3e3;font-size: 16px;height: 36px;padding: 0 10px;width: 200px;" value="<?php echo $userinfo['username'];?>" readonly>
         </div>
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">验证码：<span id="mgyzm"></span></span>
        <input type="text" id="gyzm" style="border: 1px solid #e4e3e3;font-size: 16px;height: 36px;padding: 0 10px;width: 200px;">        
        <button id="sendcode" onclick="sendyzm();" type="button" class="am-btn yzm">发送验证码</button>
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

function clear(){
  $("#my-popup .icon").remove();
}

var $tel = $("#gtel");
var $mtel = $("#mgtel");
var $sendcode = $("#sendcode");
var $yzm = $("#gyzm");
var $myzm = $("#mgyzm");
var pat = /(^1[3|4|5|7|8][0-9]{9}$)/;
var pat1 = /(^\d{6}$)/;
//验证码倒计时
var countdown=60;
$sendcode.removeAttr("disabled");

function settime() {      
  if (countdown == 0) { 
    $sendcode.removeAttr("disabled");    
    $sendcode.html("发送验证码"); 
    countdown = 60; 
    return;
  } else { 
    $sendcode.attr("disabled", true); 
    $sendcode.html("已发送(" + countdown + ")"); 
    countdown--; 
  }     
  setTimeout(function(){settime();},1000);       
}

//发送验证码
function sendyzm(){
  var err = false;
  if(err){
    setTimeout(function(){
      clear();  
    },2000);
  }else{
    //发送验证码
    $.ajax({
      type: "POST",
      global: false, // 禁用全局Ajax事件.
      url: "/index.php?g=api&m=sms&a=getyzm_hd",
      data: {
        mob: '<?php echo $userinfo['username'];?>'
      },
      dataType: "json",
      success: function (data) {
        if(data.success == 11){
          //倒计时
          $sendcode.attr("disabled", true);
          settime();
        }
      }       
    });
  }
}

function yhq_del(){
  var yzm = $.trim($("#yzm").val());
  var pat = /(^\d{6}$)/;
  var err = false; 
  if($.trim($yzm.val()) == ""){
    $myzm.html("<span class='icon'>×</span>");
    err = true; 
  }else if(!pat1.exec($.trim($yzm.val()))){
    $myzm.html("<span class='icon'>×</span>");
    err = true; 
  }
  
  if(err){
    setTimeout(function(){
    clear();
    },2000);    
  }else{
    <?php if($userinfo){?>
    $.ajax({
      type: "POST",
      global: false, // 禁用全局Ajax事件.
      url: "/index.php?g=api&m=house&a=coupon_del",
      data: {
        "id": $("#yhqid").val(),
        "userid": <?php echo $userinfo['userid'];?>,
        "yzm": $("#gyzm").val(),
        "username": <?php echo $userinfo['username'];?>
      },
      dataType: "json",
      success: function (data) {
        if(data.success == 76){
          alert(data.info);
          window.location.href="/index.php?g=Member&m=User&a=yhq";     
        }else{
          alert(data.info);
        }
      }
    });
    <?php }?>
  }
}
// function yhq_del(){
//   console.log("yzm");
// 	var yzm = $.trim($("#yzm").val());
//   console.log(yzm);


// 	var pat = /(^\d{6}$)/;
// 	if(yzm == ""){
// 		//$("#myzm").html("<span class='icon'>请输入验证码</span>");
// 	}else if(!pat.exec(yzm)){
// 		//$("#myzm").html("<span class='icon'>入验证码错误</span>");	
// 	}else{
// 	  alert(11111);
  //   <?php if($userinfo){?>
		// $.ajax({
  //     type: "POST",
  //     global: false, // 禁用全局Ajax事件.
  //     url: "/index.php?g=api&m=house&a=coupon_del",
  //     data: {
  //       "id": $("#yhqid").val(),
  //       "userid": {$userinfo.userid},
		//     "username": {$userinfo.username},
		//     "yzm": $.trim($("#yzm").val())
  //     },
  //     dataType: "json",
  //     success: function (data) {
  //       if(data.success == 67){
  //         alert(data.info);
  //         window.location.href="/index.php?g=Member&m=User&a=yhq";     
  //       }else{
  //         alert(data.info);
  //       }
  //     }
  //   });
  //   <?php }?>
// 	}
// };

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
