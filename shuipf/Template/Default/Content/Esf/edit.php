<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<script src="/statics/js/content_addtop.js"></script>
<script src="/statics/js/wind.js"></script>
<script src="/statics/js/common.js"></script>
<link rel="stylesheet" href="/statics/js/artDialog/skins/default.css">
<style>
  .tangram-suggestion-main{z-index:9999}
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
     请输入地址搜索: <input type="text" id="suggestId" style="width:460px">
     <input type="button" value="确定" id="search" ><span class="w-red">(鼠标单击地图获取地址)</span>
     <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto;display:none;"></div>
   </div>
   <div id="allmap" style="width:800px;height:500px;"></div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=uzMdOehOj94huBKKo2bCZv8V7Ebx3HU3"></script>

<div class="w-content am-text-lg" style="border: 1px solid #F2F2F2;">
	<div class="am-g" style="border-bottom: 1px solid #F2F2F2;padding: 30px;text-align:center;font-size:24px;font-weight:bold">
		二手房房源
	</div>
	<form id="myform" class="w-form" action="" method="post">
	   <div>
          <span class="w-head">房源区域：</span>
	      	<select class="province" name="province" data-am-selected>
              <option value="1" selected>深圳</option>
			</select>
			<select class="city" name="city" data-am-selected>
			</select>
			<select id="area" class="area" name="area" data-am-selected>
			</select>
	    </div>
      <div style="position: relative">
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>小区名称：</span>
        <input autocomplete="off" id="xiaoquname" name="xiaoquname" type="text" style="width:610px;" value="{$info.xiaoquname}">
        <span id="mxiaoquname"></span>
        <div id="searchRS" class="searchRS"></div>
      </div>
	    <div>
          <span class="w-head">详细信息：</span>
	      楼栋号：<input id="loudong" name="loudong" value="{$info.loudong}" type="text" style="width:110px;"> 
          单元：<input id="danyuan" name="danyuan" value="{$info.danyuan}" type="text" style="width:110px;">
          门牌号：<input id="menpai" name="menpai" value="{$info.menpai}" type="text" style="width:110px;">
	    </div>
        <div>
        <span class="w-head">楼层：</span>
        <select name="ceng" data-am-selected>
          <option value="低层" <if condition="$info['ceng'] eq '低层'">selected</if>>低层</option>
          <option value="中层" <if condition="$info['ceng'] eq '中层'">selected</if>>中层</option>
          <option value="高层" <if condition="$info['ceng'] eq '高层'">selected</if>>高层</option>
        </select>
        ，所在楼层：<input id="curceng" type="text" name="curceng" value="{$info.curceng}">层，
        ，共 <input id="zongceng" type="text" name="zongceng" value="{$info.zongceng}"> 层
        <span id="mzongceng"></span>
      </div>
           
      <div>
          <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>地图坐标：</span>
          <button onClick="return false;" class="am-btn" id="getjwd">点击拾取</button>
	      <input id="jingweidu" name="jingweidu" type="text" style="width:200px;" value="{$info.jingweidu}">
          <span id="zbdz">{$info.zuobiaodizhi}</span>
          <input type="hidden" id="zbdz1" name="zuobiaodizhi" value="{$info.zuobiaodizhi}">
          <span id="mjingweidu"></span>
	    </div>       
      
      <div>
        <span class="w-head">房源图片：</span>
        <?php echo unimages('pics',$info['pics'],7);?>
      </div>
      <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>期望售价：</span>
        <input id="zongjia" type="text" name="zongjia" value="{$info.zongjia}"> 万
        <span id="mzongjia"></span>
      </div>
      <if condition="$userinfo.modelid eq 35">
      <div> <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>称呼：</span>
      <input id="chenghu" type="text" name="chenghu"  style="width:110px" value="{$info.chenghu}">
      <span id="mchenghu"></span> </div>
      <div> <span class="w-head">手机号码：</span>
      {$userinfo.username}</div>
      </if>
      <?php $userinfo=$this->userinfo = service("Passport")->getInfo();?>
      <if condition="$userinfo.modelid eq 36">
      
      <div>
          <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>标题：</span>
	      <input autocomplete="off" id="title" name="title" type="text" style="width:610px;" value="{$info.title}"> 
          <span id="mtitle"></span>
	    </div>
          
        <div>
          <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>房源描述：</span>
	      <input id="desc" name="desc" type="text" style="width:610px;" value="{$info.desc}"> 
          <span id="mdesc"></span>
	    </div>
      <div>
        <span class="w-head"><span class="w-red am-text-default w-bixu">*</span>建筑面积：</span>
        <input id="jianzhumianji" type="text" name="jianzhumianji" value="{$info.jianzhumianji}"> ㎡
        <span id="mjianzhumianji"></span>
      </div>
 	   <div>
          <span class="w-head">户型：</span>
	      	<select name="shi" data-am-selected>
			  <option value="1" <if condition="$info['shi'] eq 1">selected</if>>1室</option>
			  <option value="2" <if condition="$info['shi'] eq 2">selected</if>>2室</option>
			  <option value="3" <if condition="$info['shi'] eq 3">selected</if>>3室</option>
			  <option value="4" <if condition="$info['shi'] eq 4">selected</if>>4室</option>
			  <option value="5" <if condition="$info['shi'] eq 5">selected</if>>5室</option>
              <option value="6" <if condition="$info['shi'] eq 6">selected</if>>5室以上</option>
			</select>
			<select name="ting" data-am-selected>
			  <option value="1" <if condition="$info['ting'] eq 1">selected</if>>1厅</option>
			  <option value="2" <if condition="$info['ting'] eq 2">selected</if>>2厅</option>
			  <option value="3" <if condition="$info['ting'] eq 3">selected</if>>3厅</option>
              <option value="4" <if condition="$info['ting'] eq 4">selected</if>>3厅以上</option>
              <option value="0" <if condition="$info['ting'] eq 0">selected</if>>0厅</option>
			</select>
			<select name="wei" data-am-selected>
			  <option value="1" <if condition="$info['wei'] eq 1">selected</if>>1卫</option>
			  <option value="2" <if condition="$info['wei'] eq 2">selected</if>>2卫</option>
			  <option value="3" <if condition="$info['wei'] eq 3">selected</if>>3卫</option>
              <option value="4" <if condition="$info['wei'] eq 4">selected</if>>3卫以上</option>
			</select>
	    </div>
      
      <div>
        <span class="w-head">房龄：</span>
        <input autocomplete="off" id="fangling" type="text" name="fangling" value="{$info.fangling}"> 年
        <span id="mfangling"></span>
      </div>
      <div>
          <span class="w-head">房屋属性：</span>
	      	<select name="jiegou" data-am-selected>	
            	<option value="平层" <if condition="$info['jiegou'] eq '平层'">selected</if>>平层</option>
                <option value="复式" <if condition="$info['jiegou'] eq '复式'">selected</if>>复式</option>
                <option value="跃层" <if condition="$info['jiegou'] eq '跃层'">selected</if>>跃层</option>
                <option value="错层" <if condition="$info['jiegou'] eq '错层'">selected</if>>错层</option>
                <option value="开间" <if condition="$info['jiegou'] eq '开间'">selected</if>>开间</option>	 
			</select>
			<select name="zhuangxiu" data-am-selected>
            	<option value="毛坯" <if condition="$info['zhuangxiu'] eq '毛坯'">selected</if>>毛坯</option>
                <option value="简装" <if condition="$info['zhuangxiu'] eq '简装'">selected</if>>简装</option>
                <option value="精装" <if condition="$info['zhuangxiu'] eq '精装'">selected</if>>精装</option>
            </select>
			<select name="chaoxiang" data-am-selected>
                <option value="南" <if condition="$info['chaoxiang'] eq '南'">selected</if>>南</option>
                <option value="北" <if condition="$info['chaoxiang'] eq '北'">selected</if>>北</option>
                <option value="东" <if condition="$info['chaoxiang'] eq '东'">selected</if>>东</option>
                <option value="西" <if condition="$info['chaoxiang'] eq '西'">selected</if>>西</option>
                <option value="南北" <if condition="$info['chaoxiang'] eq '南北'">selected</if>>南北</option>
			</select>
	    </div>
        <div>
        <span class="w-head">物业类型：</span>
        <select name="jiaoyiquanshu" data-am-selected>
          <option value="商品房" <if condition="$info['jiaoyiquanshu'] eq '商品房'">selected</if>>商品房</option>
          <option value="村委统建" <if condition="$info['jiaoyiquanshu'] eq '村委统建'">selected</if>>村委统建</option>          
          <option value="开发商建设" <if condition="$info['jiaoyiquanshu'] eq '开发商建设'">selected</if>>开发商建设</option>
          <option value="个人自建房" <if condition="$info['jiaoyiquanshu'] eq '个人自建房'">selected</if>>个人自建房</option>
          <option value="广东省军区军产房" <if condition="$info['jiaoyiquanshu'] eq '广东省军区军产房'">selected</if>>广东省军区军产房</option>
          <option value="武警部队军产房" <if condition="$info['jiaoyiquanshu'] eq '武警部队军产房'">selected</if>>武警部队军产房</option>
          <option value="工业长租房" <if condition="$info['jiaoyiquanshu'] eq '工业长租房'">selected</if>>工业长租房</option>
          <option value="工业产权房" <if condition="$info['jiaoyiquanshu'] eq '工业产权房'">selected</if>>工业产权房</option>
          <option value="其他" <if condition="$info['jiaoyiquanshu'] eq '其他'">selected</if>>其他</option>
        </select>
      </div>
      <div>
        <span class="w-head">抵押信息：</span>
        <select name="diyaxinxi" data-am-selected>
          <option value="无抵押" <if condition="$info['diyaxinxi'] eq '无抵押'">selected</if>>无抵押</option>
          <option value="有抵押" <if condition="$info['diyaxinxi'] eq '有抵押'">selected</if>>有抵押</option>
          <option value="暂无数据" <if condition="$info['diyaxinxi'] eq '暂无数据'">selected</if>>暂无数据</option>
        </select>
      </div>
      <div class="am-form-group">
	    	<span class="w-head">是否唯一住宅：</span>
	      <label class="am-radio-inline">
	        <input type="radio"  value="是" name="isweiyi" <if condition="$info['isweiyi'] eq '是'">checked</if>> 是
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="isweiyi" value="否" <if condition="$info['isweiyi'] eq '否'">checked</if>> 否
	      </label>
	    </div>         
      <div>
        <span class="w-head">建筑类型：</span>
        <select name="jianzhutype" data-am-selected>
          <option value="塔板结合" <if condition="$info['jianzhutype'] eq '塔板结合'">selected</if>>塔板结合</option>
          <option value="塔楼" <if condition="$info['jianzhutype'] eq '塔楼'">selected</if>>塔楼</option>
          <option value="板楼" <if condition="$info['jianzhutype'] eq '板楼'">selected</if>>板楼</option>
        </select>
      </div>
      <div>
        <span class="w-head">建筑结构：</span>
        <select name="jianzhujiegou" data-am-selected>
          <option value="钢混结构" <if condition="$info['jianzhujiegou'] eq '钢混结构'">selected</if>>钢混结构</option>
        </select>
      </div>
      <div>
        <span class="w-head">梯户比例：</span>
        <select name="tihubili" data-am-selected>
          <option value="三梯六户" <if condition="$info['tihubili'] eq '三梯六户'">selected</if>>三梯六户</option>
          <option value="三梯八户" <if condition="$info['tihubili'] eq '三梯八户'">selected</if>>三梯八户</option>
          <option value="三梯九户" <if condition="$info['tihubili'] eq '三梯九户'">selected</if>>三梯九户</option>
          <option value="两梯三户" <if condition="$info['tihubili'] eq '两梯三户'">selected</if>>两梯三户</option>
          两梯三户
        </select>
      </div>
		 <div>
          <span class="w-head">房屋用途：</span>
	      	<select name="fangwuyongtu" data-am-selected>
			  <option value="住宅" <if condition="$info['fangwuyongtu'] eq '住宅'">selected</if>>住宅</option>
			  <option value="公寓" <if condition="$info['fangwuyongtu'] eq '公寓'">selected</if>>公寓</option>
              <option value="写字楼" <if condition="$info['fangwuyongtu'] eq '写字楼'">selected</if>>写字楼</option>
			  <option value="商铺" <if condition="$info['fangwuyongtu'] eq '商铺'">selected</if>>商铺</option>
              <option value="其他" <if condition="$info['fangwuyongtu'] eq '其他'">selected</if>>其他</option>
			</select>
	    </div>      
      <div>
        <span class="w-head">产权所属：</span>
        <select name="chanquansuoshu" data-am-selected>
          <option value="共有" <if condition="$info['chanquansuoshu'] eq '共有'">selected</if>>共有</option>
          <option value="非共有" <if condition="$info['chanquansuoshu'] eq '非共有'">selected</if>>非共有</option>
        </select>
      </div>
      
      <div>
        <span class="w-head">挂牌时间：</span>
        <input value="
        <if condition="$info['guapaidate' neq '0000-00-00']">{$info.guapaidate}</if>
        " id="guapaidate" name="guapaidate" type="text" data-am-datepicker readonly required />
        <span id="mguapaidate"></span>
      </div>
      <div>
        <span class="w-head">套内面积：</span>
        <input id="taoneimianji" type="text" name="taoneimianji" value="{$info.taoneimianji}"> ㎡
        <span id="mtaoneimianji"></span>
      </div>


	    
        <div class="am-form-group">
	    	<span class="w-head">电梯：</span>
	      <label class="am-radio-inline">
	        <input type="radio"  value="有" name="dianti" <if condition="$info['dianti'] eq '有'">checked</if>> 有
	      </label>
	      <label class="am-radio-inline">
	        <input type="radio" name="dianti" value="无" <if condition="$info['dianti'] eq '无'">checked</if>> 无
	      </label>
	    </div>
      <div class="am-form-group forbiaoqian">
        <span class="w-head">标签：</span>
        <input type="checkbox" value="全明格局" <?php if(strstr($info['biaoqian'],'全明格局')){echo 'checked';};?>> 全明格局
        <input type="checkbox" value="全景落地窗" <?php if(strstr($info['biaoqian'],'全景落地窗')){echo 'checked';};?>> 全景落地窗
        <input type="checkbox" value="厨卫不对门" <?php if(strstr($info['biaoqian'],'厨卫不对门')){echo 'checked';};?>> 厨卫不对门
        <input type="checkbox" value="户型方正" <?php if(strstr($info['biaoqian'],'户型方正')){echo 'checked';};?>> 户型方正
        <input type="checkbox" value="主卧带卫" <?php if(strstr($info['biaoqian'],'主卧带卫')){echo 'checked';};?>> 主卧带卫
        <input type="checkbox" value="车位车库" <?php if(strstr($info['biaoqian'],'车位车库')){echo 'checked';};?>> 车位车库
        <input type="hidden" name="biaoqian" id="biaoqian" value="{$info.biaoqian}">
      </div>
        <div class="am-form-group forditie">
	    	<span class="w-head">地铁线：</span>
	      <input type="checkbox" value="[1]" <?php if(strstr($info['ditiexian'],'[1]')){echo 'checked';};?>> 1号线(罗宝线)
          <input type="checkbox" value="[2]" <?php if(strstr($info['ditiexian'],'[2]')){echo 'checked';};?>> 2号线(蛇口线)
          <input type="checkbox" value="[3]" <?php if(strstr($info['ditiexian'],'[3]')){echo 'checked';};?>> 3号线(龙岗线)
          <input type="checkbox" value="[4]" <?php if(strstr($info['ditiexian'],'[4]')){echo 'checked';};?>> 4号线(龙华线)
          <input type="checkbox" value="[5]" <?php if(strstr($info['ditiexian'],'[5]')){echo 'checked';};?>> 5号线(环中线)
          <input type="checkbox" value="[7]" <?php if(strstr($info['ditiexian'],'[7]')){echo 'checked';};?>> 7号线
          <input type="checkbox" value="[9]" <?php if(strstr($info['ditiexian'],'[9]')){echo 'checked';};?>> 9号线
          <input type="checkbox" value="[11]" <?php if(strstr($info['ditiexian'],'[11]')){echo 'checked';};?>> 11号线
          <input type="hidden" name="ditiexian" id="ditiexian" value="{$info.ditiexian}">
	    </div>
        <div class="am-form-group">
	    	<span class="w-head">周边配套：</span>
	      <input name="shenghuopeitao" type="text" style="width:610px;" value="{$info.shenghuopeitao}">
	    </div>
      <div class="am-form-group">
        <span class="w-head">教育配套：</span>
        <input name="xuexiaomingcheng" type="text" style="width:610px;" value="{$info.xuexiaomingcheng}">
      </div>
        <div class="am-form-group">
	    	<span class="w-head">交通出行：</span>
	      <input name="jiaotong" type="text" style="width:610px;"  value="{$info.jiaotong}">
	    </div>
      <div>
        <span class="w-head">核心卖点：</span>
        <input name="hexinmaidian" type="text" style="width:610px;" value="{$info.hexinmaidian}">
      </div>
      <div>
        <span class="w-head">小区优势：</span>
        <input name="xiaoquyoushi" type="text" style="width:610px;" value="{$info.xiaoquyoushi}">
      </div>
      <div>
        <span class="w-head">权属抵押：</span>
        <input name="quanshudiya" type="text" style="width:610px;" value="{$info.quanshudiya}">
      </div>
      <div class="am-form-group">
        <span class="w-head">投资分析：</span>
        <input name="touzifenxi" type="text" style="width:610px;" value="{$info.touzifenxi}">
      </div>
      <div class="am-form-group">
        <span class="w-head">户型介绍：</span>
        <input name="huxingintro" type="text" style="width:610px;" value="{$info.huxingintro}">
      </div>
      <div class="am-form-group">
        <span class="w-head">小区介绍：</span>
        <input name="xiaoquintro" type="text" style="width:610px;" value="{$info.xiaoquintro}">
      </div>
      <div class="am-form-group">
        <span class="w-head">税费解析：</span>
        <input name="shuifeijiexi" type="text" style="width:610px;" value="{$info.shuifeijiexi}">
      </div>
      <div class="am-form-group">
        <span class="w-head">装修描述：</span>
        <input name="zxdesc" type="text" style="width:610px;" value="{$info.zxdesc}">
      </div>
        <div class="am-form-group">
	    	<span class="w-head">推荐理由：</span>
	      <input name="yezhushuo" type="text" style="width:610px;" value="{$info.yezhushuo}">
	    </div>
</if>
		<hr>
        <if condition="$userinfo['modelid'] eq 35">
        <div> <span class="w-head">发布方式：</span>
      <label class="am-radio-inline">
        <input type="radio" onClick="$('.foruser').show()" name="pub_type" value="1" <if condition="$info['pub_type'] eq 1">checked</if>>
        自售 </label>
      <label class="am-radio-inline">
        <input type="radio" onClick="$('.foruser').hide()" name="pub_type" value="2" <if condition="$info['pub_type'] eq 2">checked</if>>
        委托给经纪人 </label>
      <label class="am-radio-inline">
        <input type="radio" onClick="$('.foruser').hide()" name="pub_type" value="3" <if condition="$info['pub_type'] eq 3">checked</if>>
        委托给平台 </label>
    </div>
	    <div>
	      <span class="w-head">是否隐藏手机号码：</span>
	      <label class="am-radio-inline">
	        <input type="radio" name="hidetel" value="公开" <if condition="$info['hidetel'] eq '公开'">checked</if>> 公开
	      </label>
	      <label class="am-radio-inline">
          <?php  $v=hasvtel($userinfo['userid']);?>
	        <input <if condition="$v eq 0">disabled</if> type="radio" name="hidetel" value="保密" <if condition="$info['hidetel'] eq '保密'">checked</if>> 保密<if condition="$v eq 0">(您还未申请转机号码，请至个人中心申请)</if>
	      </label>
	    </div>
        </if>
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
		 $(".area").val({$info.area});
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
	function check(){
      var pat1 = /^[0-9.-]+$/;
      var pat2 = /^[0-9-]+$/;
      
      if($.trim($("#xiaoquname").val()) == "")	{
        alert("请输入小区名称");
		return false;
      }
	  if($.trim($("#jingweidu").val()) == "")	{
        alert("请拾取地图坐标");
		return false;
      }
	  
      
	  if($.trim($("#zongjia").val()) == "")	{
        alert("请输入期望售价");
		return false;
      }else{
        if (!pat2.exec($.trim($("#zongjia").val()))) {
          alert("请检查期望售价");
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
	  if($.trim($("#jianzhumianji").val()) == "")	{
        alert("请输入建筑面积");
		return false;
      }else{
        if (!pat1.exec($.trim($("#jianzhumianji").val()))) {
          alert("请检查建筑面积");
		return false;
        }
      }
      if ($.trim($("#taoneimianji").val()) != ""){
        if (!pat1.exec($.trim($("#taoneimianji").val()))) {
          alert("请检查套内面积");
		return false;
        }
      }  
	  if($.trim($("#fangling").val()) == "")	{
        alert("请输入房龄");
		return false;
      }else{
        if (!pat2.exec($.trim($("#fangling").val()))) {
          alert("请检查房龄");
		return false;
        }
      }          
	  <?php };?>		
		document.getElementById("myform").submit();
	}
<?php if($userinfo['modelid'] == 36){;?>
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
			$("#zbdz1").val(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
			$("#zbdz").html(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);			
		});
	});
   $("#getjwd").click(function(){
      $("#cover").show();
      $("#showmap").show();
   });
   $("#cover").click(function(){
      $("#cover").hide();
      $("#showmap").hide();
   });
   $("#search").click(function(){
      local.search($("#suggestId").val());
   });
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
	 setTimeout(function(){
		$("#area").change(function(){
		  $("#xiaoquname").val("");
		});
	},2000);
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>