<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		编辑求租
	</div>
	<form id="w-form" class="w-form" action="" method="post">
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">标题：</span>
	      <input id="title" name="title" type="text" style="width:300px;" value="{$info.title}"> 
          <span id="mtitle"></span>
	    </div>
        <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">描述：</span>
	      <input id="desc" name="desc" type="text" style="width:300px;" value="{$info.desc}"> 
          <span id="mdesc"></span>
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
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">期望厅室：</span>
          <select name="zulin" data-am-selected>
			  <option value="整租" <if condition="$info['zulin'] eq '整租'">selected</if>>整租</option>
			  <option value="合租" <if condition="$info['zulin'] eq '合租'">selected</if>>合租</option>
			</select>
	      	<select name="shi" data-am-selected>
			  <option value="1" <if condition="$info['shi'] eq '1'">selected</if>>1室</option>
			  <option value="2" <if condition="$info['shi'] eq '2'">selected</if>>2室</option>
			  <option value="3" <if condition="$info['shi'] eq '3'">selected</if>>3室</option>
			  <option value="4" <if condition="$info['shi'] eq '4'">selected</if>>4室</option>
			  <option value="5" <if condition="$info['shi'] eq '5'">selected</if>>5室</option>
              <option value="6" <if condition="$info['shi'] eq '6'">selected</if>>5室以上</option>
			</select>
	    </div>
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">期望租金：</span>
	      <select name="zujinrange" data-am-selected>
			  <option value="0-500" <if condition="$info['zujinrange'] eq '0-500'">selected</if>>500元以下/月</option>
			  <option value="500-1000" <if condition="$info['zujinrange'] eq '500-1000'">selected</if>>500-1000元/月</option>
			  <option value="1000-1500" <if condition="$info['zujinrange'] eq '1000-1500'">selected</if>>1000-1500元/月</option>
			  <option value="1500-2000" <if condition="$info['zujinrange'] eq '1500-2000'">selected</if>>1500-2000元/月</option>
			  <option value="3000-4500" <if condition="$info['zujinrange'] eq '3000-4500'">selected</if>>3000-4500元/月</option>
              <option value="4500-" <if condition="$info['zujinrange'] eq '4500-'">selected</if>>4500元以上/月</option>
			</select>
	    </div> 
        <input type="hidden" name="s" value="1">
	    <p><button type="submit" class="am-btn am-btn-primary am-btn-block w-submit" onClick="return check()">确认修改</button></p>
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
      var pat2 = /^[0-9-]+$/;
		if($.trim($("#title").val()) == "")	{
			$("#mtitle").html("<span class='icon'>请输入标题</span>");
			iswrong = true;	
		}
		if($.trim($("#desc").val()) == "")	{
			$("#mdesc").html("<span class='icon'>请输入描述</span>");
			iswrong = true;	
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