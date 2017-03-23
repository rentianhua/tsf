<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		租房委托
	</div>
	<form id="w-form" class="w-form" action="" method="post">
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">标题：</span>
	      <input autocomplete="off" id="title" name="title" type="text" style="width:300px;" value="{$info.title}"> 
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
	      <input autocomplete="off" id="address" name="address" type="text" style="width:300px;" value="{$info.address}"> 
          <span id="maddress"></span>
	    </div>

	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">户型：</span>
	      	<select name="shi" data-am-selected>
			  <option value="1" <if condition="$info['shi'] eq 1">selected</if>>1室</option>
			  <option value="2" <if condition="$info['shi'] eq 2">selected</if>>2室</option>
			  <option value="3" <if condition="$info['shi'] eq 3">selected</if>>3室</option>
			  <option value="4" <if condition="$info['shi'] eq 4">selected</if>>4室</option>
			  <option value="5" <if condition="$info['shi'] eq 5">selected</if>>5室</option>
			</select>
			<select name="ting" data-am-selected>
			  <option value="1" <if condition="$info['ting'] eq 1">selected</if>>1厅</option>
			  <option value="2" <if condition="$info['ting'] eq 2">selected</if>>2厅</option>
			  <option value="3" <if condition="$info['ting'] eq 3">selected</if>>3厅</option>
              <option value="0" <if condition="$info['ting'] eq 0">selected</if>>0厅</option>
			</select>
			<select name="wei" data-am-selected>
			  <option value="1" <if condition="$info['wei'] eq 1">selected</if>>1卫</option>
			  <option value="2" <if condition="$info['wei'] eq 2">selected</if>>2卫</option>
			  <option value="3" <if condition="$info['wei'] eq 3">selected</if>>3卫</option>
              <option value="0" <if condition="$info['wei'] eq 0">selected</if>>0卫</option>
			</select>
	    </div>
		<div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">出租方式：</span>
	      <select name="chuzutype" data-am-selected>
			  <option value="整租" <if condition="$info['chuzutype'] eq '整租'">selected</if>>整租</option>
			  <option value="合租" <if condition="$info['chuzutype'] eq '合租'">selected</if>>合租</option>
			</select>
	    </div>
        <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">支付方式：</span>
	      <select name="paytype" data-am-selected>
			  <option value="付一压二" <if condition="$info['paytype'] eq '付一压二'">selected</if>>付一压二</option>
			  <option value="付一压三" <if condition="$info['paytype'] eq '付一压三'">selected</if>>付一压三</option>
              <option value="付一压一" <if condition="$info['paytype'] eq '付一压一'">selected</if>>付一压一</option>
              <option value="付三压一" <if condition="$info['paytype'] eq '付三压一'">selected</if>>付三压一</option>
              <option value="其他" <if condition="$info['paytype'] eq '其他'">selected</if>>其他</option>
			</select>
	    </div>
        <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">装修：</span>
	      	<select name="zhuangxiu" data-am-selected>
			  <option value="毛坯" <if condition="$info['zhuangxiu'] eq '毛坯'">selected</if>>毛坯</option>
			  <option value="简装" <if condition="$info['zhuangxiu'] eq '简装'">selected</if>>简装</option>
			  <option value="精装" <if condition="$info['zhuangxiu'] eq '精装'">selected</if>>精装</option>
			</select>
	    </div>
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">期望租金：</span>
	      <input id="zujin" name="zujin" type="text" value="{$info.zujin}"> 元/月
          <span id="mzujin"></span>
	    </div>

		<hr>
	    <div>
	      <span class="w-head">是否隐藏手机号码：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="ishidetel" value="公开" <if condition="$info['ishidetel'] eq '公开'">checked</if>> 公开
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="ishidetel" value="保密" <if condition="$info['ishidetel'] eq '保密'">checked</if>> 保密
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
        <div>
	      <span class="w-head">委托类型：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="weituotype" value="委托给经纪人" <if condition="$info['weituotype'] eq '委托给经纪人'">checked</if>> 委托给经纪人
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="weituotype" value="委托给平台" <if condition="$info['weituotype'] eq '委托给平台'">checked</if>> 委托给平台
	      </label>
	    </div>
        <input type="hidden" name="s" value="1">
	    <p><button type="submit" class="am-btn am-btn-primary am-btn-block w-submit" onClick="return check()">确认修改</button></p>
	  </fieldset>
	</form>
</div>
<script>
  //获取区域
  $.get("/index.php?g=api&m=house&a=diqu&pid=1", function(data){
    for(var i=0;i<data.length;i++){
      $(".city").append("<option value="+data[i].id+">"+data[i].name+"</option>");
    }
    $(".city").val({$info.city});
    $.get("/index.php?g=api&m=house&a=diqu&pid={$info.city}", function(data1){
      for(var i=0;i<data1.length;i++){
        $(".area").append("<option value="+data1[i].id+">"+data1[i].name+"</option>");
      }
    },"json");
  },"json");
  $(document).ready(function(){
    $(".city").change(function(){
      $.get("/index.php?g=api&m=house&a=diqu&pid="+$(".city").val(), function(data){
        $(".area").html("");
        for(var i=0;i<data.length;i++){
          $(".area").append("<option value="+data[i].id+">"+data[i].name+"</option>");
        }
        $(".area").val({$info.area});
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
      var pat2 = /^[0-9-]+$/;
		if($.trim($("#title").val()) == "")	{
			$("#mtitle").html("<span class='icon'>请输入标题</span>");
			iswrong = true;
		}
		if($.trim($("#address").val()) == "")	{
			$("#maddress").html("<span class='icon'>请输入房源地址</span>");
			iswrong = true;
		}
		if($.trim($("#zujin").val()) == "")	{
			$("#mzujin").html("<span class='icon'>请输入租金</span>");	
			iswrong = true;	
		}else{
			if (!pat2.exec($.trim($("#zujin").val()))) {
				$("#mzujin").html('<span class="icon">请检查租金</span>');
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