<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		我要买房
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
          <span class="w-red am-text-default w-bixu">*</span><span class="w-head">预算：</span>
	      <select id="zongjia" name="zongjiarange" data-am-selected>
			  <option value="0-100" selected>100万以下</option>
			  <option value="100-200">100-200万</option>
			  <option value="200-300">200-300万</option>
			  <option value="300-400">300-400万</option>
			  <option value="400-">400万以上</option>
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
		$("#title").val("深圳"+$(".city option:selected").text()+$(".area option:selected").text()+" "+$("#shi option:selected").text()+" "+$("#zongjia option:selected").text());
		$("#w-form").submit();
	}
	
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>