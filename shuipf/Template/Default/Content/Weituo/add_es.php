<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		二手房委托
	</div>
	<form id="w-form" class="w-form" action="" method="post">
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">标题：</span>
	      <input id="title" name="title" type="text" style="width:300px;"> 
          <span id="mtitle"></span>
	    </div>
        <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">房源区域：</span>
	      	<select class="province" name="province" data-am-selected>
              <option value="1" selected>深圳</option>
			</select>
			<select class="city" name="city" data-am-selected>
			</select>
			<select class="area" name="area" data-am-selected>
			</select>
	    </div>
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">房源地址：</span>
	      <input id="address" name="address" type="text" style="width:300px;"> 
          <span id="maddress"></span>
	    </div>

	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">户型：</span>
	      	<select name="shi" data-am-selected>
			  <option value="1" selected>1室</option>
			  <option value="2">2室</option>
			  <option value="3">3室</option>
			  <option value="4">4室</option>
			  <option value="5">5室</option>
			</select>
			<select name="ting" data-am-selected>
			  <option value="1" selected>1厅</option>
			  <option value="2">2厅</option>
			  <option value="3">3厅</option>
              <option value="0">0厅</option>
			</select>
			<select name="wei" data-am-selected>
			  <option value="1" selected>1卫</option>
			  <option value="2">2卫</option>
			  <option value="3">3卫</option>
			</select>
	    </div>
		<div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">房源面积：</span>
	      <input id="mianji" type="text" name="mianji"> ㎡
          <span id="mmianji"></span>
	    </div>
        <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">房龄：</span>
	      <input id="fangling" type="text" name="fangling"> 年
          <span id="mfangling"></span>
	    </div>
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">期望售价：</span>
	      <input id="shoujia" type="text" name="shoujia"> 万
          <span id="mshoujia"></span>
	    </div>

		<hr>
	    <div>
	      <span class="w-head">是否隐藏手机号码：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="ishidetel" value="公开" checked> 公开
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="ishidetel" value="保密"> 保密
	      </label>
	    </div>
        <div>
	      <span class="w-head">是否发布：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="isfabu" value="发布" checked> 发布
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="isfabu" value="不发布"> 不发布
	      </label>
	    </div>
        <div>
	      <span class="w-head">委托类型：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="weituotype" value="委托给经纪人" checked> 委托给经纪人
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="weituotype" value="委托给平台"> 委托给平台
	      </label>
	    </div>  
	    <p><button type="submit" class="am-btn am-btn-primary am-btn-block w-submit" onClick="return check()">提交房源</button></p>
	  </fieldset>
	</form>
</div>
<script>
  //获取区域
  $.get("/index.php?g=api&m=house&a=diqu&pid=1", function(data){
    for(var i=0;i<data.length;i++){
      $(".city").append("<option value="+data[i].id+">"+data[i].name+"</option>");
    }
  },"json");
  $.get("/index.php?g=api&m=house&a=diqu&pid=2", function(data1){
    for(var i=0;i<data1.length;i++){
      $(".area").append("<option value="+data1[i].id+">"+data1[i].name+"</option>");
    }
  },"json");
  $(document).ready(function(){
    $(".city").change(function(){
      $.get("/index.php?g=api&m=house&a=diqu&pid="+$(".city").val(), function(data){
        $(".area").html("");
        for(var i=0;i<data.length;i++){
          $(".area").append("<option value="+data[i].id+">"+data[i].name+"</option>");
        }
      },"json");
    });
  });
    //清除错误信息
    function clear(){
      $(".icon").remove();
    }
    //字段检查
	function check(){
		var iswrong = false;
      var pat1 = /^[0-9.-]+$/;
      var pat2 = /^[0-9-]+$/;
		if($.trim($("#title").val()) == "")	{
			$("#mtitle").html("<span class='icon'>请输入标题</span>");
			iswrong = true;
		}
		if($.trim($("#address").val()) == "")	{
			$("#maddress").html("<span class='icon'>请输入房源地址</span>");
			iswrong = true;
		}
		if($.trim($("#mianji").val()) == "")	{
			$("#mmianji").html("<span class='icon'>请输入房源面积</span>");
			iswrong = true;	
		}else{
			if (!pat1.exec($.trim($("#mianji").val()))) {
				$("#mmianji").html('<span class="icon">请检查房源面积</span>');
				iswrong = true;
			}
		}
		if($.trim($("#fangling").val()) == "")	{
			$("#mfangling").html("<span class='icon'>请输入房龄</span>");
			iswrong = true;	
		}else{
			if (!pat2.exec($.trim($("#fangling").val()))) {
				$("#mfangling").html('<span class="icon">请检查房龄</span>');
				iswrong = true;	
			}
		}
		if($.trim($("#shoujia").val()) == "")	{
			$("#mshoujia").html("<span class='icon'>请输入售价</span>");	
			iswrong = true;	
		}else{
			if (!pat2.exec($.trim($("#shoujia").val()))) {
				$("#mshoujia").html('<span class="icon">请检查售价</span>');
				iswrong = true;	
			}
		}

		if(iswrong){
          setTimeout(function () {
            clear();
          },2000);
			return false;	
		}
		$("#w-form").submit();
	}	
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>