<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		发布求租
	</div>
	<form id="w-form" class="w-form" action="" method="post">        
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
          <select id="zulin" name="zulin" data-am-selected>
			  <option value="整租" selected>整租</option>
			  <option value="合租">合租</option>
			</select>
	      	<select id="shi" name="shi" data-am-selected>
			  <option value="1" selected>1室</option>
			  <option value="2">2室</option>
			  <option value="3">3室</option>
			  <option value="4">4室</option>
			  <option value="5">5室</option>
              <option value="6">5室以上</option>
			</select>
	    </div>
	    <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">期望租金：</span>
	      <select id="zujin" name="zujinrange" data-am-selected>
			  <option value="0-500" selected>500元以下/月</option>
			  <option value="500-1000">500-1000元/月</option>
			  <option value="1000-1500">1000-1500元/月</option>
			  <option value="1500-2000">1500-2000元/月</option>
			  <option value="3000-4500">3000-4500元/月</option>
              <option value="4500-">4500元以上/月</option>
			</select>
	    </div> 
        <div>
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">称呼：</span>
	      <input id="chenghu" name="chenghu" type="text" style="width:300px;"> 
          <span id="mchenghu"></span>
	    </div>
        <div>
          <span class="w-head">手机号码：</span>
	      {$userinfo.username}
	    </div>
        <input type="hidden" id="title" name="title">
	    <p><button type="submit" class="am-btn am-btn-primary am-btn-block w-submit" onClick="return check()">发布</button></p>
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
		if($.trim($("#chenghu").val()) == "")	{
			$("#mchenghu").html("<span class='icon'>请输入称呼</span>");
			iswrong = true;	
		}
		if(iswrong){
          setTimeout(function () {
            clear();
          },2000);
			return false;	
		}
		$("#title").val("深圳"+$(".city option:selected").text()+$(".area option:selected").text()+" "+$("#zulin option:selected").text()+$("#shi option:selected").text()+" "+$("#zujin option:selected").text());
		$("#w-form").submit();
	}
	
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>