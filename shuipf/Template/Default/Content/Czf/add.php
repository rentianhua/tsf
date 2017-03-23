<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<script src="/statics/js/content_addtop.js"></script>
<script src="/statics/js/wind.js"></script>
<link rel="stylesheet" href="/statics/js/artDialog/skins/default.css">
<style>.tangram-suggestion-main{z-index:9999}#zuobiaodizhi{display:none}
.w-bixu{vertical-align: middle;}
.searchRS{
  border: 1px solid #eee;
  position: absolute;
  background: #fff;
  left: 139px;
  width: 610px;
  background: #fcfcfc;
  display: none;
}
  .searchRS a{
    display: block;
    padding-left: 8px;
  }
  .searchRS a:hover{
    background: #eee;
  }
  li{list-style:none;}
  .picList img{margin-bottom:-12px !important;margin-right:10px;}
</style>
<div id="cover" style="z-index:9999;width:100%;height:100%;background:rgba(0,0,0,.5);position:fixed;top:0;left:0;display:none;"></div>
<div id="showmap" style="z-index:9999;display:none;position:fixed;top:92px;left:20%;width:800px;height:550px;background:#fff;">
   <div style="height:50px;line-height:50px;padding:0 10px">
     请输入地址搜索: <input type="text" id="suggestId" style="width:450px">
     <input type="button" value="确定" id="search" ><span class="w-red">(鼠标单击地图获取地址)</span>
     <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto;display:none;"></div>
   </div>
   <div id="allmap" style="width:800px;height:500px;"></div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=uzMdOehOj94huBKKo2bCZv8V7Ebx3HU3"></script>

<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		发布出租房
	</div>
	<form class="w-form" action="" method="post">	           
        <div>
			<span class="w-head">房源区域：</span>
	      	<select class="province" name="province" id="province" data-am-selected>
              <option value="1" selected>深圳</option>
			</select>
			<select class="city" name="city" id="city" data-am-selected>
			</select>
			<select id="area" class="area" name="area" id="area" data-am-selected>
			</select>
	    </div>
      <div style="position: relative;">
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>小区名称：</span>
        <input id="xiaoquname" name="xiaoquname" type="text" style="width:610px;" autocomplete="off">
        <span id="mxiaoquname"></span>
        <div id="searchRS" class="searchRS"></div>
      </div>
      <div>
			<span class="w-head"><span class="w-red am-text-default w-bixu">*</span>地图坐标：</span>
          <button onClick="return false;" class="am-btn" id="getjwd">点击拾取</button>
	      <input id="jingweidu" name="jingweidu" type="text" style="width:200px;">
          <input name="zuobiaodizhi" id="zuobiaodizhi">
          <span id="zbdz" ></span>
          <span id="mzuobiao"></span>
	    </div>
      <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>面积：</span>
        <input id="mianji" type="text" name="mianji"> ㎡
        <span id="mmianji"></span>
      </div>
      <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>租金：</span>
        <input id="zujin" type="text" name="zujin"> 元/月
        <span id="mzujin"></span>
      </div>
      <div>
			<span class="w-head">户型：</span>
	      	<select name="shi" id="shi" data-am-selected>
			  <option value="1" selected>1室</option>
			  <option value="2">2室</option>
			  <option value="3">3室</option>
			  <option value="4">4室</option>
			  <option value="5">5室</option>
			  <option value="6">5室以上</option>
			</select>
			<select name="ting" id="ting" data-am-selected>
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
      <tr>
              <th width="80">
                图片集 
               </th>
               <td><input type="hidden" value="1" name="pics">
		<fieldset class="blue pad-10">
        <center><div id="nameTip" class="onShow">您最多每次可以同时上传 <font color="red">10</font> 张</div></center><div class="picList" id="pics"></div>
		</fieldset>
		<div class="bk10"></div> 
		<a class="btn am-btn am-btn-danger am-round" onclick="javascript:flashupload1('pics_images', '图片上传','pics',change_images,'10,gif|jpg|jpeg|png|bmp,1,,,0','Content','6')" herf="javascript:void(0);"><span class="add"></span>选择图片 </a> <span></span></td>
            </tr>
      </div>
      <if condition="$userinfo.modelid eq 35">
      <input type="hidden" name="title" id="bt">
      </if>
      <if condition="$userinfo.modelid eq 36"> 
      <div>
			<span class="w-head"><span class="w-red am-text-default w-bixu">*</span>标题：</span>
	      <input id="title" name="title" type="text" style="width:610px;">
          <span id="mtitle"></span>
	    </div>
        <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>房源描述：</span>
          <input id="desc" name="desc" type="text" style="width:610px;">
          <span id="mdesc"></span>
	    </div>            
	    <div>
			<span class="w-head"><span class="w-red am-text-default w-bixu">*</span>房源地址：</span>
	      <input id="address" name="address" type="text" style="width:610px;">
          <span id="maddress"></span>
	    </div>
      
      <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>楼层：</span>
        <select name="ceng" data-am-selected>
          <option value="低层" selected>低层</option>
          <option value="中层">中层</option>
          <option value="高层">高层</option>
        </select>
        ，共 <input id="zongceng" type="text" name="zongceng"> 层
        <span id="mzongceng"></span>
      </div>
      <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>房龄：</span>
        <input id="fangling" type="text" name="fangling"> 年
        <span id="mfangling"></span>
      </div>
	    
        <div>
			<span class="w-head">房屋属性：</span>
			<select name="zhuangxiu" data-am-selected>
            	<option value="毛坯" selected>毛坯</option>
                <option value="简装">简装</option>
                <option value="精装">精装</option>
			</select>
			<select name="chaoxiang" data-am-selected>
                <option value="南" selected>南</option>
				<option value="北">北</option>
                <option value="东">东</option>
                <option value="西">西</option>
                <option value="南北">南北</option>
			</select>
          <select name="leixing" data-am-selected>
            <option value="住宅" selected>住宅</option>
            <option value="公寓">公寓</option>
            <option value="写字楼">写字楼</option>
            <option value="商铺">商铺</option>
            <option value="其它">其它</option>
          </select>
	    </div>
      <div>
        <span class="w-head">建筑类型：</span>
        <select name="jianzhutype" data-am-selected>
          <option value="板塔结合" selected>板塔结合</option>
        </select>
      </div>
       <div>
        <span class="w-head">物业类型：</span>
        <select name="wuyetype" data-am-selected>
          <option value="商品房" selected>商品房</option>
          <option value="村委统建">村委统建</option>
          <option value="开发商建设">开发商建设</option>
          <option value="个人自建房">个人自建房</option>
          <option value="广东省军区军产房">广东省军区军产房</option>
          <option value="武警部队军产房">武警部队军产房</option>
          <option value="工业长租房">工业长租房</option>
          <option value="工业产权房">工业产权房</option>
          <option value="其他">其他</option>
        </select>
      </div>
        <div>
          <span class="w-head">出租方式：</span>
	      <select name="zulin" data-am-selected>
			  <option value="整租" selected>整租</option>
			  <option value="合租">合租</option>
              <option value="--">--</option>
			</select>
	    </div>
        <div>
          <span class="w-head">支付方式：</span>
	      <select name="fukuan" data-am-selected>
			  <option value="付一压二" selected>付一压二</option>
			  <option value="付一压三">付一压三</option>
              <option value="付一压一">付一压一</option>
              <option value="付三压一">付三压一</option>
              <option value="其他">其他</option>
			</select>
	    </div>
      <div class="am-form-group forfangwupeitao">
        <span class="w-head">房屋配套：</span>
        <input type="checkbox" value="空调"> 空调
        <input type="checkbox" value="热水器"> 热水器
        <input type="checkbox" value="冰箱"> 冰箱
        <input type="checkbox" value="洗衣机"> 洗衣机
        <input type="checkbox" value="电视"> 电视
        <input type="checkbox" value="宽带"> 宽带
        <input type="checkbox" value="床"> 床
        <input type="checkbox" value="家具"> 家具
        <input type="checkbox" value="天然气"> 天然气
        <input type="hidden" name="fangwupeitao" id="fangwupeitao">
      </div>
        <div class="am-form-group forditie">
	    	<span class="w-head">地铁线：</span>
	      <input type="checkbox" value="[1]"> 1号线(罗宝线)
          <input type="checkbox" value="[2]"> 2号线(蛇口线)
          <input type="checkbox" value="[3]"> 3号线(龙岗线)
          <input type="checkbox" value="[4]"> 4号线(龙华线)
          <input type="checkbox" value="[5]"> 5号线(环中线)
          <input type="checkbox" value="[7]"> 7号线
          <input type="checkbox" value="[9]"> 9号线
          <input type="checkbox" value="[11]"> 11号线
          <input type="hidden" name="ditiexian" id="ditiexian">
	    </div>
      <div class="am-form-group forbiaoqian">
        <span class="w-head">标签：</span>
        <input type="checkbox" value="随时看房"> 随时看房
        <input type="checkbox" value="精装"> 精装
        <input type="hidden" name="biaoqian" id="biaoqian">
      </div>
      <div class="am-form-group">
        <span class="w-head">户型介绍：</span>
        <input name="huxingjieshao" type="text" style="width:610px;">
      </div>
      <div class="am-form-group">
        <span class="w-head">房源亮点：</span>
        <input name="liangdian" type="text" style="width:610px;">
      </div>
      <div class="am-form-group">
        <span class="w-head">出租原因：</span>
        <input name="czreason" type="text" style="width:610px;">
      </div>
      <div class="am-form-group">
        <span class="w-head">小区介绍：</span>
        <input name="xiaoquintro" type="text" style="width:610px;">
      </div>
      <div class="am-form-group">
        <span class="w-head">装修描述：</span>
        <input name="zxdesc" type="text" style="width:610px;">
      </div>
        <div class="am-form-group">
	    	<span class="w-head">周边配套：</span>
	      <input name="shenghuopeitao" type="text" style="width:610px;">
	    </div>
        <div class="am-form-group">
	    	<span class="w-head">交通出行：</span>
	      <input name="jiaotong" type="text" style="width:610px;">
	    </div>
        <div class="am-form-group">
	    	<span class="w-head">业主说：</span>
	      <input name="yezhushuo" type="text" style="width:610px;">
	    </div>
	</if>
		<hr>
        <if condition="$userinfo['modelid'] eq 35">
        <div>
	      <span class="w-head">发布方式：</span>
	      <if condition="!$_GET['t']">
        <label class="am-radio-inline">
	        <input id="pub_type_1" type="radio" name="pub_type" value="1" checked> 直接出租
	      </label>
	      </if>
	      <label class="am-radio-inline">
	        <input id="pub_type_2" type="radio" name="pub_type" value="2" <if condition="$_GET['t'] eq 1">checked</if>> 委托给经纪人
	      </label>
          <label class="am-radio-inline">
	        <input id="pub_type_3" type="radio" name="pub_type" value="3"> 委托给平台
	      </label>
	    </div>
	    <?php if(!$_GET['t'] ){ ?>
	    <div class="for_pubtype">
	      <span class="w-head">是否隐藏手机号码：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="hidetel" value="公开" checked> 公开
	      </label>
	      <label class="am-radio-inline">
          <?php  $v=hasvtel($userinfo['userid']);?>
	       <input <if condition="$v eq 0">disabled</if> type="radio" name="hidetel" value="保密"> 保密
           <if condition="$v eq 0">(您还未申请转机号码，请至个人中心申请)</if>
	      </label>
	    </div>
       <?php }?>
        </if>        
	    <p><button type="submit" class="am-btn am-btn-primary am-btn-block w-submit" onClick="return check()">提交房源</button></p>
	</form>
</div>
<script>
	$("#pub_type_1").click(function(){
		$(".for_pubtype").show();
	});
	$("#pub_type_2").click(function(){
		$(".for_pubtype").hide();
	});
	
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
		});
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
		
				
      if($.trim($("#xiaoquname").val()) == "")	{
        alert("请输入小区名称");
			return false;
      }
	  if($.trim($("#jingweidu").val()) == "")	{
		  alert("请在拾取地图坐标");
			return false;
		}
		if($.trim($("#mianji").val()) == "")	{
			alert("请输入面积");
			return false;
		}else{
			if (!pat1.exec($.trim($("#mianji").val()))) {
				alert("请检查面积");
			return false;
			}
		}
		if($.trim($("#zujin").val()) == "")	{
			alert("请输入租金");
			return false;
		}else{
			if (!pat2.exec($.trim($("#zujin").val()))) {
				alert("请检查租金");
			return false;
			}
		}
		<?php if($userinfo['modelid'] == 36){;?>
		if($.trim($("#title").val()) == "")	{
			alert("请输入标题");
			return false;
		}
		if($.trim($("#desc").val()) == "")	{
			alert("请输入房源描述");
			return false;
		}
		if($.trim($("#zongceng").val()) == "")	{
			alert("请输入总层数");
			return false;
      }else {
        if (!pat2.exec($.trim($("#zongceng").val()))) {
			alert("请检查总层数");
			return false;
        }
      }
	  if($.trim($("#address").val()) == "")	{
		  alert("请输入房源地址");
			return false;
		}
      if($.trim($("#fangling").val()) == "")	{
		  alert("请输入房龄");
			return false;
      }else {
        if (!pat2.exec($.trim($("#fangling").val()))) {
			alert("请检查房龄");
			return false;
        }
      }
	  
		<?php };?>
		
		<?php if($userinfo['modelid'] == 35){?>
		var btstr = $("#province option:selected").text()+$("#city option:selected").text()+$("#area option:selected").text()+$("#xiaoquname").val()+" "+$("#shi option:selected").text()+$("#ting option:selected").text()+$("#mianji").val()+"㎡";
		$("#bt").val(btstr);
		<?php }?>
		document.getElementById("myform").submit();
	}	
	<?php if($userinfo['modelid'] == 36){;?>
	
   $('.forfangwupeitao input[type=checkbox]').change(function(){
		$('#fangwupeitao').val($('.forfangwupeitao input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
	 })
	 
	 $('.forbiaoqian input[type=checkbox]').change(function(){
		$('#biaoqian').val($('.forbiaoqian input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
	 })
	 
	 $('.forditie input[type=checkbox]').change(function(){
		$('#ditiexian').val($('.forditie input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
	 })
	 <?php };?>
  $("#xiaoquname").keyup(function(){
    var kw = $.trim($("#xiaoquname").val());
    if(kw != ""){
      $.ajax({
        type: "POST",
        global: false, // 禁用全局Ajax事件.
        url: "/index.php?g=Content&m=Public&a=searchXiaoqu",
        data: {
          area: $("#area").val(),
          title: kw
        },
        dataType: "json",
        success: function (data) {
          var str = "";
          for(name in data){
            if(name == "state"){
              continue;
            }
            str += '<a href="javascript:;" onclick="gtXiaoquName($(this).text());">'
                + data[name].title
                + '</a>';
          }
          $("#searchRS").html(str).show();
        }
      });
    }
  });
  function gtXiaoquName(text){
    $("#xiaoquname").val(text);
    $("#searchRS").hide();
  }
  $("#area").change(function(){
	  $("#xiaoquname").val("");
	});
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>