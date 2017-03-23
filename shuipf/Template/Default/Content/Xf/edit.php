<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<style>.tangram-suggestion-main{z-index:9999}#zuobiaodizhi{display:none}</style>
<div id="cover" style="z-index:9999;width:100%;height:100%;background:rgba(0,0,0,.5);position:fixed;top:0;left:0;display:none;"></div>
<div id="showmap" style="z-index:9999;display:none;position:absolute;top:92px;left:20%;width:800px;height:550px;background:#fff;">
  <div style="height:50px;line-height:50px;padding:0 10px">
    请输入地址搜索: <input type="text" id="suggestId" style="width:400px">
    <input type="button" value="确定" id="search" ><span class="w-red">(鼠标单击地图获取地址)</span>
    <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto;display:none;"></div>
  </div>
  <div id="allmap" style="width:800px;height:500px;"></div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=uzMdOehOj94huBKKo2bCZv8V7Ebx3HU3"></script>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
  <div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
    新房房源
  </div>
  <form class="w-form" action="" method="post">
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">标题：</span>
      <input id="title" name="title" type="text" style="width:300px;" value="{$info.title}">
      <span id="mtitle"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">地图坐标：</span>
      <button onClick="return false;" class="am-btn" id="getjwd">点击拾取</button>
      <input id="jingweidu" name="jingweidu" type="text" style="width:300px;" value="{$info.jingweidu}">
      <input name="zuobiaodizhi" id="zuobiaodizhi" value="{$info.zuobiaodizhi}">
      <span id="zbdz" >{$info.zuobiaodizhi}</span>
      <span id="mzuobiao"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">房源区域：</span>
      <select class="province" name="province" data-am-selected>
      </select>
      <select class="city" name="city" data-am-selected>
      </select>
      <select class="area" name="area" data-am-selected>
      </select>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">楼盘地址：</span>
      <input id="loupandizhi" name="loupandizhi" type="text" style="width:300px;" value="{$info.loupandizhi}">
      <span id="mloupandizhi"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">开发商：</span>
      <input id="kaifashang" name="kaifashang" type="text" style="width:300px;" value="{$info.kaifashang}">
      <span id="mkaifashang"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">占地面积：</span>
      <input id="zhandimianji" type="text" name="zhandimianji" value="{$info.zhandimianji}"> ㎡
      <span id="mzhandimianji"></span>
    </div>

    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">建筑面积：</span>
      <input id="jianzhumianji" type="text" name="jianzhumianji" value="{$info.jianzhumianji}"> ㎡
      <span id="mjianzhumianji"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">均价：</span>
      <input id="junjia" type="text" name="junjia" value="{$info.junjia}"> 元/㎡
      <span id="mjunjia"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">开盘日期：</span>
      <input name="kaipandate" type="text" id="my-start-2" readonly  value="{$info.kaipandate}"/>
      <span id="mkaipandate"></span>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">交房日期：</span>
      <input name="jiaofangdate" type="text" id="my-end-2" readonly  value="{$info.jiaofangdate}"/>
      <span id="mjiaofangdate"></span>
    </div>
    <div>
      <span class="w-head">物业类型：</span>
      <select name="wuyeleixing" data-am-selected>
        <option value="商品房" <if condition="$info['wuyeleixing'] eq '商品房'">selected</if>>商品房</option>
        <option value="集体用地村委统建楼" <if condition="$info['wuyeleixing'] eq '集体用地村委统建楼'">selected</if>>集体用地村委统建楼</option>
        <option value="集体用地开发商自建楼" <if condition="$info['wuyeleixing'] eq '集体用地开发商自建楼'">selected</if>>集体用地开发商自建楼</option>
        <option value="集体用地个人自建房" <if condition="$info['wuyeleixing'] eq '集体用地个人自建房'">selected</if>>集体用地个人自建房</option>
        <option value="军区建房" <if condition="$info['wuyeleixing'] eq '军区建房'">selected</if>>军区建房</option>
        <option value="武警部队建房" <if condition="$info['wuyeleixing'] eq '武警部队建房'">selected</if>>武警部队建房</option>
        <option value="工业属性长租物业" <if condition="$info['wuyeleixing'] eq '工业属性长租物业'">selected</if>>工业属性长租物业</option>
        <option value="工业可分割产权物业" <if condition="$info['wuyeleixing'] eq '工业可分割产权物业'">selected</if>>工业可分割产权物业</option>
        <option value="其他" <if condition="$info['wuyeleixing'] eq '其他'">selected</if>>其他</option>
      </select>
    </div>
    <div>
      <span class="w-head">物业公司：</span>
      <input id="wuyegongsi" name="wuyegongsi" type="text" style="width:300px;"  value="{$info.wuyegongsi}">
      <span id="mwuyegongsi"></span>
    </div>
    <div>
      <span class="w-head">物业费：</span>
      <input id="wuyefei" name="wuyefei" type="text" style="width:300px;" value="{$info.wuyefei}"> 元/㎡
      <span id="mwuyefei"></span>
    </div>
    <div>
      <span class="w-head">规划户数：</span>
      <input id="guihuahushu" name="guihuahushu" type="text" style="width:300px;" value="{$info.guihuahushu}"> 户
      <span id="mguihuahushu"></span>
    </div>
    <div>
      <span class="w-head">规划车位：</span>
      <input id="guihuachewei" name="guihuachewei" type="text" style="width:300px;" value="{$info.guihuachewei}"> 个
      <span id="mguihuachewei"></span>
    </div>
    <div>
      <span class="w-head">产权年限：</span>
      <select name="chanquannianxian" data-am-selected>
        <option value="50" <if condition="$info['chanquannianxian'] eq '50'">selected</if>>50</option>
        <option value="70" <if condition="$info['chanquannianxian'] eq '70'">selected</if>>70</option>
        <option value="-" <if condition="$info['chanquannianxian'] eq '-'">selected</if>>-</option>
      </select> 年
    </div>
    <div>
      <span class="w-head">建筑类型：</span>
      <select name="jianzhuleixing" data-am-selected>
        <option value="小高层" <if condition="$info['jianzhuleixing'] eq '小高层'">selected</if>>小高层</option>
        <option value="中高层" <if condition="$info['jianzhuleixing'] eq '中高层'">selected</if>>中高层</option>
        <option value="高层" <if condition="$info['jianzhuleixing'] eq '高层'">selected</if>>高层</option>
      </select>
    </div>
    <div>
      <span class="w-head">容积率：</span>
      <input id="rongjilv" name="rongjilv" type="text" style="width:300px;" value="{$info.rongjilv}"> %
      <span id="mrongjilv"></span>
    </div>
    <div>
      <span class="w-head">绿化率：</span>
      <input id="lvhualv" name="lvhualv" type="text" style="width:300px;" value="{$info.lvhualv}"> %
      <span id="mlvhualv"></span>
    </div>
    <div class="am-form-group">
      <span class="w-head">地铁房：</span>
      <label class="am-radio-inline">
        <input id="ditie_yes" type="radio"  value="是" name="isditie" <if condition="$info['isditie'] eq '是'">checked</if>> 是
      </label>
      <label class="am-radio-inline">
        <input id="ditie_no" type="radio" name="isditie" value="否" <if condition="$info['isditie'] eq '否'">checked</if>> 否
      </label>
    </div>
    <div class="am-form-group forditie">
      <span class="w-head">地铁线：</span>
      <input type="checkbox" value="1" <?php if(strstr($info['ditiexian'],'1')){echo 'checked';};?>> 1号线(罗宝线)
      <input type="checkbox" value="2" <?php if(strstr($info['ditiexian'],'2')){echo 'checked';};?>> 2号线(蛇口线)
      <input type="checkbox" value="3" <?php if(strstr($info['ditiexian'],'3')){echo 'checked';};?>> 3号线(龙岗线)
      <input type="checkbox" value="4" <?php if(strstr($info['ditiexian'],'4')){echo 'checked';};?>> 4号线(龙华线)
      <input type="checkbox" value="5" <?php if(strstr($info['ditiexian'],'5')){echo 'checked';};?>> 5号线(环中线)
      <input type="checkbox" value="11" <?php if(strstr($info['ditiexian'],'11')){echo 'checked';};?>> 11号线
      <input type="hidden" name="ditiexian" id="ditiexian">
    </div>
    <div class="am-form-group">
      <span class="w-head">学区房：</span>
      <label class="am-radio-inline">
        <input type="radio"  value="是" name="isxuequ" <if condition="$info['isxuequ'] eq '是'">checked</if>> 是
      </label>
      <label class="am-radio-inline">
        <input type="radio" name="isxuequ" value="否" <if condition="$info['isxuequ'] eq '否'">checked</if>> 否
      </label>
    </div>
    <div class="am-form-group">
      <span class="w-head">周边医疗：</span>
      <input name="yiliao" type="text" style="width:400px;" placeholder="多个以空格隔开" value="{$info.yiliao}">
    </div>
    <div class="am-form-group">
      <span class="w-head">生活配套：</span>
      <input name="shenghuopeitao" type="text" style="width:400px;" placeholder="多个以空格隔开" value="{$info.shenghuopeitao}">
    </div>
    <div class="am-form-group">
      <span class="w-head">交通配置：</span>
      <input name="jiaotong" type="text" style="width:400px;" placeholder="多个以空格隔开" value="{$info.jiaotong}">
    </div>
    <div class="am-form-group">
      <span class="w-head">楼盘解说：</span>
      <input name="loupanjieshuo" type="text" style="width:400px;" value="{$info.loupanjieshuo}">
    </div>
    <div class="am-form-group forbiaoqian">
      <span class="w-head">标签：</span>
      <input type="checkbox" value="总价低" <?php if(strstr($info['biaoqian'],'总价低')){echo 'checked';};?>> 总价低
      <input type="checkbox" value="交通便利" <?php if(strstr($info['biaoqian'],'交通便利')){echo 'checked';};?>> 交通便利
      <input type="checkbox" value="学区房" <?php if(strstr($info['biaoqian'],'学区房')){echo 'checked';};?>> 学区房
      <input type="checkbox" value="高档社区" <?php if(strstr($info['biaoqian'],'高档社区')){echo 'checked';};?>> 高档社区
      <input type="hidden" name="biaoqian" id="biaoqian">
    </div>

    <hr>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">您的姓名：</span>
      <input autocomplete="off" id="contactname" type="text" name="contactname" value="{$info.contactname}">
      <span id="mcontactname"></span>
    </div>
    <div class="am-form-group">
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">您的性别：</span>
      <label class="am-radio-inline">
        <input type="radio" name="sex" value="男" <if condition="$info['sex'] eq '男'">checked</if>> 男
      </label>
      <label class="am-radio-inline">
        <input type="radio" name="sex" value="女" <if condition="$info['sex'] eq '女'">checked</if>> 女
      </label>
    </div>
    <div>
      <span class="w-red am-text-default w-bixu">*</span><span class="w-head">手机号码：</span>
      <input id="contacttel" type="text" name="contacttel" value="{$info.contacttel}">
      <span id="mcontacttel"></span>
    </div>
    <div>
      <span class="w-head">是否隐藏手机号码：</span>
      <label class="am-radio-inline">
        <input type="radio" name="hidetel" value="公开" <if condition="$info['hidetel'] eq '公开'">checked</if>> 公开
      </label>
      <label class="am-radio-inline">
        <input type="radio" name="hidetel" value="保密" <if condition="$info['hidetel'] eq '保密'">checked</if>> 保密
      </label>
    </div>
    <div>
      <span class="w-head">是否发布：</span>
      <label class="am-radio-inline">
        <input type="radio" name="isfabu" value="发布" <if condition="$info['isfabu'] eq '发布'">checked</if>> 发布
      </label>
      <label class="am-radio-inline">
        <input type="radio" name="isfabu" value="不发布" <if condition="$info['isfabu'] eq '不发布'">checked</if>> 不发布
      </label>
    </div>
    <input type="hidden" name="s" value="1">
    <p><button type="submit" class="am-btn am-btn-primary am-btn-block w-submit" onClick="return check()">提交房源</button></p>
    </fieldset>
  </form>
</div>
<script>
  $("#ditie_yes").click(function(){
    $(".forditie").show();
  });
  $("#ditie_no").click(function(){
    $(".forditie").hide();
  });
  $('.forbiaoqian input[type=checkbox]').change(function(){
    $('#biaoqian').val($('.forbiaoqian input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
  })

  $('.forditie input[type=checkbox]').change(function(){
    $('#ditiexian').val($('.forditie input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
  })

  //获取区域
  function getarea(pid, tag){
    $.get("/index.php?g=api&m=house&a=diqu&pid="+pid, function(data){
      $(tag).html("");
      for(var i=0;i<data.length;i++){
        $(tag).append("<option value="+data[i].id+">"+data[i].name+"</option>");
      }
    },"json");
  }
  $(document).ready(function(){
    getarea(-1, ".province");
    $(".province").change(function(){
      getarea($(this).val(), ".city");
    });
    $(".city").change(function(){
      getarea($(this).val(), ".area");
    });
    setTimeout(function(){
      //设置当前city
      //alert({$info.city});
      $(".city option[value='<?php echo $info['city'];?>']").attr("selected",true);
    },500);
    setTimeout(function(){
      //设置当前area
      $(".area option[value='<?php echo $info['area'];?>']").attr("selected","selected");
    },1000);
  });
  $("#title").focus(function(){
    $("#mtitle").html("");
  });
  $("#loupandizhi").focus(function(){
    $("#mloupandizhi").html("");
  });
  $("#jianzhumianji").focus(function(){
    $("#mjianzhumianji").html("");
  });
  $("#kaifashang").focus(function(){
    $("#mkaifashang").html("");
  });
  $("#zhandimianji").focus(function(){
    $("#mzhandimianji").html("");
  });
  $("#junjia").focus(function(){
    $("#mjunjia").html("");
  });
  $("#kaipandate").focus(function(){
    $("#mkaipandate").html("");
  });
  $("#jiaofangdate").focus(function(){
    $("#mjiaofangdate").html("");
  });
  $("#guihuahushu").focus(function(){
    $("#mguihuahushu").html("");
  });
  $("#guihuachewei").focus(function(){
    $("#mguihuachewei").html("");
  });
  $("#wuyefei").focus(function(){
    $("#mwuyefei").html("");
  });
  $("#lvhualv").focus(function(){
    $("#mlvhualv").html("");
  });
  $("#rongjilv").focus(function(){
    $("#mrongjilv").html("");
  });
  $("#contactname").focus(function(){
    $("#mcontactname").html("");
  });
  $("#my-start-2").focus(function(){
    $("#mkaipandate").html("");
  });
  $("#my-end-2").focus(function(){
    $("#mjiaofangdate").html("");
  });
  $("#contacttel").focus(function(){
    $("#mcontacttel").html("");
  });
  function check(){
    var iswrong = false;
    if($.trim($("#title").val()) == "")	{
      $("#mtitle").html("<span class='icon'>请输入标题</span>");
      iswrong = true;
    }else{
      $("#mtitle").html('<span class="rightIcon">√ 验证通过</span>');
    }
    if($.trim($("#jingweidu").val()) == "")	{
      $("#mzuobiao").html("<span class='icon'>请选择地图坐标</span>");
      iswrong = true;
    }else{
      $("#mzuobiao").html('<span class="rightIcon">√ 验证通过</span>');
    }
    if($.trim($("#loupandizhi").val()) == "")	{
      $("#mloupandizhi").html("<span class='icon'>请输入楼盘地址</span>");
      iswrong = true;
    }else{
      $("#mloupandizhi").html('<span class="rightIcon">√ 验证通过</span>');
    }
    if($.trim($("#kaifashang").val()) == "")	{
      $("#mkaifashang").html("<span class='icon'>请输入开发商</span>");
      iswrong = true;
    }else{
      $("#mkaifashang").html('<span class="rightIcon">√ 验证通过</span>');
    }
    if($.trim($("#jianzhumianji").val()) == "")	{
      $("#mjianzhumianji").html("<span class='icon'>请输入建筑面积</span>");
      iswrong = true;
    }else{
      var patrn = /(^\d+$)/;
      if (!patrn.exec($.trim($("#jianzhumianji").val()))) {
        $("#mjianzhumianji").html('<span class="icon">请检查建筑面积</span>');
        iswrong = true;
      }else{
        $("#mjianzhumianji").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if($.trim($("#zhandimianji").val()) == "")	{
      $("#mzhandimianji").html("<span class='icon'>请输入占地面积</span>");
      iswrong = true;
    }else{
      var patrn = /(^\d+$)/;
      if (!patrn.exec($.trim($("#zhandimianji").val()))) {
        $("#mzhandimianji").html('<span class="icon">请检查占地面积</span>');
        iswrong = true;
      }else{
        $("#mzhandimianji").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if($.trim($("#junjia").val()) == "")	{
      $("#mjunjia").html("<span class='icon'>请输入均价</span>");
      iswrong = true;
    }else{
      var patrn = /(^\d+$)/;
      if (!patrn.exec($.trim($("#junjia").val()))) {
        $("#mjunjia").html('<span class="icon">请检查均价</span>');
        iswrong = true;
      }else{
        $("#mjunjia").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if($.trim($("#my-start-2").val()) == "")	{
      $("#mkaipandate").html("<span class='icon'>请选择开盘日期</span>");
      iswrong = true;
    }else{
      $("#mkaipandate").html('<span class="rightIcon">√ 验证通过</span>');
    }
    if($.trim($("#my-end-2").val()) == "")	{
      $("#mjiaofangdate").html("<span class='icon'>请选择交房日期</span>");
      iswrong = true;
    }else{
      $("#mjiaofangdate").html('<span class="rightIcon">√ 验证通过</span>');
    }
    var patrn1 = /^[0-9.]+$/;
    if ($.trim($("#wuyefei").val()) != "" ){
      if(!patrn1.exec($.trim($("#wuyefei").val()))) {
        $("#mwuyefei").html('<span class="icon">请检查物业费</span>');
        iswrong = true;
      }else{
        $("#mwuyefei").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if ($.trim($("#rongjilv").val()) != "" ){
      if(!patrn1.exec($.trim($("#rongjilv").val()))) {
        $("#mrongjilv").html('<span class="icon">请检查容积率</span>');
        iswrong = true;
      }else{
        $("#mwrongjilv").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if ($.trim($("#lvhualv").val()) != "" ){
      if(!patrn1.exec($.trim($("#lvhualv").val()))) {
        $("#mlvhualv").html('<span class="icon">请检查绿化率</span>');
        iswrong = true;
      }else{
        $("#mlvhualv").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    var patrn = /^\d+$/;
    if ($.trim($("#guihuachewei").val()) != "" ){
      if(!patrn.exec($.trim($("#guihuachewei").val()))) {
        $("#mguihuachewei").html('<span class="icon">请检查规划车位</span>');
        iswrong = true;
      }else{
        $("#mguihuachewei").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if ($.trim($("#guihuahushu").val()) != "") {
      if(!patrn.exec($.trim($("#guihuahushu").val()))) {
        $("#mguihuahushu").html('<span class="icon">请检查规划户数</span>');
        iswrong = true;
      }else{
        $("#mguihuahushu").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if($.trim($("#contactname").val()) == "")	{
      $("#mcontactname").html("<span class='icon'>请输入姓名</span>");
      iswrong = true;
    }else{
      $("#mcontactname").html('<span class="rightIcon">√ 验证通过</span>');
    }
    if($.trim($("#contacttel").val()) == "")	{
      $("#mcontacttel").html("<span class='icon'>请输入手机号</span>");
      iswrong = true;
    }else{
      var patrn = /(^1[3|4|5|7|8][0-9]{9}$)/;
      if (!patrn.exec($.trim($("#contacttel").val()))) {
        $("#mcontacttel").html('<span class="icon">请输入正确的手机号码</span>');
        iswrong = true;
      }else{
        $("#mcontacttel").html('<span class="rightIcon">√ 验证通过</span>');
      }
    }
    if(iswrong){
      return false;
    }
    document.getElementById("myform").submit();
  }

  $("#zbdz").html($("#zuobiaodizhi").val());
  // 百度地图API功能
  function G(id) {
    return document.getElementById(id);
  }
  var map = new BMap.Map("allmap");
  map.centerAndZoom(new BMap.Point(113.813345,22.71394),12);
  var geoc = new BMap.Geocoder();
  var local = new BMap.LocalSearch(map, {
    renderOptions:{map: map}
  });
  //鼠标滚轮缩放地图
  map.enableScrollWheelZoom(true);
  var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
  var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
  map.addControl(top_left_control);
  map.addControl(top_left_navigation);

  var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
      {"input" : "suggestId"
        ,"location" : map
      });
  ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
    var str = "";
    var _value = e.fromitem.value;
    var value = "";
    if (e.fromitem.index > -1) {
      value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    }
    str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

    value = "";
    if (e.toitem.index > -1) {
      _value = e.toitem.value;
      value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    }
    str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
    G("searchResultPanel").innerHTML = str;
  });

  var myValue;
  ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
    var _value = e.item.value;
    myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
    G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

    setPlace();
  });
  function setPlace(){
    function myFun(){
      var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
      map.centerAndZoom(pp, 18);
      map.addOverlay(new BMap.Marker(pp));    //添加标注
    }
    var local = new BMap.LocalSearch(map, { //智能搜索
      onSearchComplete: myFun
    });
    local.search(myValue);
  }

  //单击获取点击的经纬度
  map.addEventListener("click",function(e){
    var pt = e.point;
    $("#jingweidu").val(pt.lng + "," + pt.lat);
    $("#cover").hide();
    $("#showmap").hide();
    geoc.getLocation(pt, function(rs){
      var addComp = rs.addressComponents;
      $("#zuobiaodizhi").val(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
      $("#zbdz").html(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
      $(".city option").each(function() {
        if($(this).text() == addComp.district){
          $(this).attr("selected",true);
        }
      });
    });
  });
  $("#jingweidu").focus(function () {
    $("#mzuobiao").html("");
  });
  $("#getjwd").click(function(){
    $("#cover").show();
    $("#showmap").show();
    $("#mzuobiao").html("");
  });
  $("#cover").click(function(){
    $("#cover").hide();
    $("#showmap").hide();
  });
  $("#search").click(function(){
    local.search($("#suggestId").val());
  });
  //amazeUI 日期控件
  var nowTemp = new Date();
  var nowDay = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0).valueOf();
  var nowMoth = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), 1, 0, 0, 0, 0).valueOf();
  var nowYear = new Date(nowTemp.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();
  var $myStart2 = $('#my-start-2');

  var checkin = $myStart2.datepicker({
    onRender: function(date, viewMode) {
      // 默认 days 视图，与当前日期比较
      var viewDate = nowDay;

      switch (viewMode) {
          // moths 视图，与当前月份比较
        case 1:
          viewDate = nowMoth;
          break;
          // years 视图，与当前年份比较
        case 2:
          viewDate = nowYear;
          break;
      }

      return date.valueOf() < viewDate ? 'am-disabled' : '';
    }
  }).on('changeDate.datepicker.amui', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
      var newDate = new Date(ev.date)
      newDate.setDate(newDate.getDate() + 1);
      checkout.setValue(newDate);
    }
    checkin.close();
    $('#my-end-2')[0].focus();
  }).data('amui.datepicker');

  var checkout = $('#my-end-2').datepicker({
    onRender: function(date, viewMode) {
      var inTime = checkin.date;
      var inDay = inTime.valueOf();
      var inMoth = new Date(inTime.getFullYear(), inTime.getMonth(), 1, 0, 0, 0, 0).valueOf();
      var inYear = new Date(inTime.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();

      // 默认 days 视图，与当前日期比较
      var viewDate = inDay;

      switch (viewMode) {
          // moths 视图，与当前月份比较
        case 1:
          viewDate = inMoth;
          break;
          // years 视图，与当前年份比较
        case 2:
          viewDate = inYear;
          break;
      }

      return date.valueOf() <= viewDate ? 'am-disabled' : '';
    }
  }).on('changeDate.datepicker.amui', function(ev) {
    checkout.close();
  }).data('amui.datepicker');
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>