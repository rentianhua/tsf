<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
  <div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
    新房房源
  </div>
  <div class="w-form" action="" method="post">
    <div>
      <span class="w-head">标题：</span>
      <label>{$info.title}</label>
    </div>
    <div>
      <span class="w-head">地图坐标：</span>
      <label>{$info.jingweidu}({$info.zuobiaodizhi})</label>
    </div>
    <div>
      <span class="w-head">房源区域：</span>
      <label>深圳市，<span id="city"></span>，<span id="area"></span></label>
    </div>
    <div>
      <span class="w-head">楼盘地址：</span>
      <label>{$info.loupandizhi}</label>
    </div>
    <div>
      <span class="w-head">开发商：</span>
      <label>{$info.kaifashang}</label>
    </div>
    <div>
      <span class="w-head">占地面积：</span>
      <label>{$info.zhandimianji}</label>
    </div>

    <div>
      <span class="w-head">建筑面积：</span>
      <label>{$info.jianzhumianji}</label>
    </div>
    <div>
      <span class="w-head">均价：</span>
      <label>{$info.junjia}</label>
    </div>
    <div>
      <span class="w-head">开盘日期：</span>
      <label>{$info.kaipandate}</label>
    </div>
    <div>
      <span class="w-head">交房日期：</span>
      <label>{$info.jiaofangdate}</label>
    </div>
    <div>
      <span class="w-head">物业类型：</span>
      <label>{$info.wuyeleixing}</label>
    </div>
    <div>
      <span class="w-head">物业公司：</span>
      <label>{$info.wuyegongsi}</label>
    </div>
    <div>
      <span class="w-head">物业费：</span>
      <label>{$info.wuyefei}</label> 元/㎡
    </div>
    <div>
      <span class="w-head">规划户数：</span>
      <label>{$info.guihuahushu}</label> 户
    </div>
    <div>
      <span class="w-head">规划车位：</span>
      <label>{$info.guihuachewei}</label> 个
    </div>
    <div>
      <span class="w-head">产权年限：</span>
      <label>{$info.chanquannianxian}</label> 年
    </div>
    <div>
      <span class="w-head">建筑类型：</span>
      <label>{$info.jianzhuleixing}</label>
    </div>
    <div>
      <span class="w-head">容积率：</span>
      <label>{$info.rongjilv}</label> %
    </div>
    <div>
      <span class="w-head">绿化率：</span>
      <label>{$info.lvhualv}</label> %
    </div>
    <div class="am-form-group">
      <span class="w-head">地铁房：</span>
      <label>{$info.isditie}</label>
    </div>
    <div class="am-form-group forditie">
      <span class="w-head">地铁线：</span>
      <label>{$info.ditiexian}</label>
    </div>
    <div class="am-form-group">
      <span class="w-head">学区房：</span>
      <label>{$info.isxuequ}</label>
    </div>
    <div class="am-form-group">
      <span class="w-head">周边医疗：</span>
      <label>{$info.yiliao}</label>
    </div>
    <div class="am-form-group">
      <span class="w-head">生活配套：</span>
      <label>{$info.shenghuopeitao}</label>
    </div>
    <div class="am-form-group">
      <span class="w-head">交通配置：</span>
      <label>{$info.jiaotong}</label>
    </div>
    <div class="am-form-group">
      <span class="w-head">楼盘解说：</span>
      <label>{$info.loupanjieshuo}</label>
    </div>
    <div class="am-form-group forbiaoqian">
      <span class="w-head">标签：</span>
      <label>{$info.biaoqian}</label>
    </div>

    <hr>
    <div>
      <span class="w-head">您的姓名：</span>
      <label>{$info.contactname}</label>
    </div>
    <div class="am-form-group">
      <span class="w-head">您的性别：</span>
      <label>{$info.sex}</label>
    </div>
    <div>
      <span class="w-head">手机号码：</span>
      <label>{$info.contacttel}</label>
    </div>
    <div>
      <span class="w-head">是否隐藏手机号码：</span>
      <label>{$info.hidetel}</label>
    </div>
    <div>
      <span class="w-head">是否发布：</span>
      <label>{$info.isfabu}</label>
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