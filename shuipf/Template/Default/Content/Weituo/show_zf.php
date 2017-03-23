<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
  <div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
    二手房委托
  </div>
  <div class="w-form">
    <div>
      <span class="w-head">标题：</span>
      <label>{$info.title}</label>
    </div>
    <div>
      <span class="w-head">房源区域：</span>
      <label>深圳市，<span id="city"></span>，<span id="area"></span></label>
    </div>
    <div>
      <span class="w-head">房源地址：</span>
      <label>{$info.address}</label>
    </div>

    <div>
      <span class="w-head">户型：</span>
      <label>{$info.shi}室{$info.ting}厅{$info.wei}卫</label>
    </div>
    <div>
      <span class="w-head">出租方式：</span>
      <label>{$info.chuzutype}</label>
    </div>
    <div>
      <span class="w-head">支付方式：</span>
      <label>{$info.paytype}</label>
    </div>
    <div>
      <span class="w-head">装修：</span>
      <label>{$info.zhuangxiu}</label>
    </div>
    <div>
      <span class="w-head">期望租金：</span>
      <label>{$info.zujin}元/月</label>
    </div>

    <hr>
    <div>
      <span class="w-head">是否隐藏手机号码：</span>
      <label>{$info.ishidetel}</label>
    </div>
    <div>
      <span class="w-head">是否发布：</span>
      <label>{$info.isfabu}</label>
    </div>
    <div>
      <span class="w-head">委托类型：</span>
      <label>{$info.weituotype}</label>
    </div>
  </div>
</div>
<script>
  //获取city名称
  $.get("/index.php?g=api&m=house&a=diqu&pid=1", function(data1){
    for(var i=0;i<data1.length;i++){
      if(<?php echo $info['city']?> == data1[i].id){
        $("#city").html(data1[i].name);
        return;
      }
    }
  },"json");
  //获取area名称
  $.get("/index.php?g=api&m=house&a=diqu&pid=<?php echo $info['city']?>", function(data2){
    for(var j=0;j<data2.length;j++){
      if(<?php echo $info['area']?> == data2[j].id){
        $("#area").html(data2[j].name);
        return;
      }
    }
  },"json");
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>