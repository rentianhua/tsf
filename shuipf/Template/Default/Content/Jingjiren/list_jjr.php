<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','bq','or','kw');
// 把上一次已筛选的值保存在Form的隐藏域中
foreach($fields as $f){
  if(isset($_GET[$f])){
    $fitervalue[$f] = $_GET[$f];
  }
}
?>
<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<link rel="stylesheet" href="{:C('app_ui')}css/common.css">
<link rel="stylesheet" href="{:C('app_ui')}css/list.css">
<link rel="stylesheet" href="{:C('app_ui')}css/list_jjr.css">
<!-- NAV头部搜索模块 -->
<div class="searchs">
  <div class="wrapper">
    <div class="fl" log-mod="search">
      <div class="search-txt">
        <div class="search-tab">
          <div  class="txt-serach">
            <input class="left txt" onkeydown='if(event.keyCode==13){Filter("kw",$.trim($(this).val()));};' autocomplete="off" placeholder="输入关键词搜索" id="keyword-box">
          </div>
        </div>
        <button id="ss" class="act-search btn home-ico ico-search">搜索</button>
      </div>
    </div>
  </div>
</div>

<!-- 面包屑模块 -->
<div class="intro clear" mod-id="lj-common-bread">
  <div class="container">
    <div class="fl l-txt"><a href="/">首页</a><span class="stp">&nbsp;&gt;&nbsp;</span> <a href="/index.php?m=jingjiren&a=list_jjr">经纪人</a> </div>
  </div>
</div>
<div class="wrapper"> 
  <!--filter 模块-->
  <div class="filter-box">
    <div class="pd">
    <div id="filterForm" action="/index.php?m=jingjiren&a=list_jjr" method="get">
		<input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="bq" name="bq" value="<?php echo $fitervalue['bq']; ?>" />
        <input to="filter" type="hidden" id="or" name="od" value="<?php echo $fitervalue['od']; ?>" />
        <input to="filter" type="hidden" id="kw" name="kw" value="<?php echo $fitervalue['kw']; ?>" />
    </div>
      <div class="bd" id="filter-options">
        <dl class="dl-lst clear">
          <dt>区域：</dt>
          <dd>
            <div class="option-list"> <a href="javascript:Filter('ct');" class="<?php if(!$_GET['ct']){echo 'on';} ?>">不限</a>
              <?php
              $qulist = get_area_list(1);
              ?>
              <volist name="qulist" id="vo"> <a href="javascript:Filter('ct','{$vo.name}');" class="<?php if($_GET['ct']==$vo['name']){echo 'on';} ?>">{$vo.name}</a> </volist>
            </div>
          </dd>
        </dl>
      </div>
      <div class="filter-bar01 filter-bars">
        <div id="sort-panel" class="sort-panel">
          <div class="left filterdrop">
            <div class="fs14"><span class="left">筛选：</span></div>
          </div>
          <div class="left">
            <div class="item-check">
              <ul>
                <li><a 
                 <?php 
				if(strpos($_GET['bq'], "房东信赖") !== false){
					echo ' class="check-a" href="javascript:Filter(\'bq_\',\'房东信赖\');"';	
				}else{
					echo 'href="javascript:Filter(\'bq\',\'房东信赖\');"';
				}
				?>>
                <i></i>房东信赖</a></li>
                <li><a 
                <?php 
				if(strpos($_GET['bq'], "客户热评") !== false){
					echo ' class="check-a" href="javascript:Filter(\'bq_\',\'客户热评\');"';	
				}else{
					echo 'href="javascript:Filter(\'bq\',\'客户热评\');"';
				}
				?>>
                <i></i>客户热评</a></li>
                <li><a <?php 
				if(strpos($_GET['bq'], "销售达人") !== false){
					echo ' class="check-a" href="javascript:Filter(\'bq_\',\'销售达人\');"';	
				}else{
					echo 'href="javascript:Filter(\'bq\',\'销售达人\');"';
				}
				?>>
                <i></i>销售达人</a></li>
                <li><a <?php 
				if(strpos($_GET['bq'], "带看活跃") !== false){
					echo ' class="check-a" href="javascript:Filter(\'bq_\',\'带看活跃\');"';	
				}else{
					echo 'href="javascript:Filter(\'bq\',\'带看活跃\');"';
				}
				?>>
                <i></i>带看活跃</a></li>
                <li><a <?php 
				if(strpos($_GET['bq'], "学区专家") !== false){
					echo ' class="check-a" href="javascript:Filter(\'bq_\',\'学区专家\');"';	
				}else{
					echo 'href="javascript:Filter(\'bq\',\'学区专家\');"';
				}
				?>>
                <i></i>学区专家</a></li>
                <li><a <?php 
				if(strpos($_GET['bq'], "海外专家") !== false){
					echo ' class="check-a" href="javascript:Filter(\'bq_\',\'海外专家\');"';	
				}else{
					echo 'href="javascript:Filter(\'bq\',\'海外专家\');"';
				}
				?> >
                <i></i>海外专家</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="filter-bar01">
        <div class="sort-bar" id="sort-bar"><span>排序：</span>
          <div class="sort-parent <?php if(!$_GET['order']){echo 'on';} ?>"> <a href="{$url}"><span>显示全部</span></a></div>
          <div class="sort-parent"><a href="#"><span>好评率从高到低</span></a></div>
          <div class="sort-parent"><a href="#"><span>成交量从高到低</span></a></div>
          <div class="sort-parent"><a href="#"><span>带看量从高到低</span></a></div>
        </div>
      </div>
    
    </div>
  </div>
  <div class="main-box clear">
    <div class="con-box">
      <div class="list-head clear" pan="">
        <h2 style="font-size:14px;">共有<span>{$count}</span>名经纪人</h2>
      </div>
      <div class="list-wrap">
        <ul class="agent-lst">
          <volist name="jjrlist" id="vo">
            <li>
              <div class="pic-panel">
              <a target="_blank" href="/index.php?m=jingjiren&a=show_jjr&id={$vo.userid}"> 
              <img onerror="this.src='/statics/extres/member/images/noavatar.jpg';" src='/d/file/avatar/000/00/00/{$vo.userid}_180x180.jpg'></a></div>
              <div class="info-panel">
                <div class="agent-name">
                <a target="_blank" href="/index.php?m=jingjiren&a=show_jjr&id={$vo.userid}">
                  <span style="font-size: 18px;">{$vo.realname}</span>
                  <if condition="$vo['jiav'] eq 1">
                  &nbsp;<img src="{:C('app_ui')}images/v.png" alt="">
                  </if>
                  </a><span class="position">
                  <switch name="vo['dengji']">
                    <case value="1">普通经纪人</case>
                    <case value="2">优秀经纪人</case>
                    <case value="3">高级经纪人</case>
                    <case value="4">资深经纪人</case>
                    <default />普通经纪人
                    </switch>
                  </span></div>
                <div class="col-1">
                  <div class="main-plate"><span class="mp-title">主营板块:&nbsp;&nbsp;</span>
                  <span>
                  <a target="_blank" href="#">{$vo.mainarea}</a>                  
                  </span></div>
                  <div class="achievement"><a target="_blank" href=""><span>历史成交{$vo.chenjiao_count}套</span>,&nbsp;</a><a target="_blank" href=""><span>独家委托{$vo.weituo_count}套</span>,&nbsp;</a><span>最近30天带看{$vo.kanfang_count}次</span></div>
                  <div class="label">
                    <?php
            $array = explode(",",$vo['biaoqian']);
            $i = 1;
            foreach ($array as $value) {
              if ($value != ''){
                echo '<span class="top_guider_mark">' . $value . '</span>';
              }
              $i++;
            }
            ?>
              </div>
                </div>
                <div class="col-2">
                  <div class="high-praise">好评率<span class="num">100%</span></div>
                  <div class="comment-num"><a href="/index.php?m=jingjiren&a=show_jjr&id={$vo.userid}&t=3">评论{$vo.comm_count}条</a></div>
                </div>
                <div class="col-3">
                  <div><if condition="$vo['tel'] neq ''">{:cache('Config.tel400')} 转 {$vo.tel}<else />{$vo.username}</if></div>
                  <p class="method">联系方式</p>
                  <p class="mobile_p"></p>
                </div>
                <div class="clear"></div>
              </div>
            </li>
          </volist>
          <div class="page-box house-lst-page-box">{$Page}</div>
        </ul>
      </div>
    </div>
  </div>
</div>
<script>
 function Filter(t,v){
    if(t == "ct"){
		$("#ct").val(v);
	}
	if(t == "kw"){
		$("#kw").val(v);
	}
	if(t == "bq"){
		var arr = [];
		if($("#bq").val() != ""){
			arr = $("#bq").val().split(",");
		}
		arr.push(v);
		$("#bq").val(arr.join(","));
	}
	if(t == "bq_"){
		var arr = [];
		if($("#bq").val() != ""){
			arr = $("#bq").val().split(",");
		}
		if(arr.length>0){
			for(var i=0;i<arr.length;i++){
				if(arr[i] == v)	{
					arr.splice(i,1);	
				}
			}
			$("#bq").val(arr.join(","));
		}
	}
	var str = "";
	$("#filterForm input").each(function(){
		if($(this).val() != ""){
			str += "&" + $(this).attr("name") + "=" + $(this).val();
		}
	});
	window.location.href = "/index.php?m=jingjiren&a=list_jjr" + str;
  }
	
  $('.ok').click(function() {
   var lzj = $('#lzj').val();
   var hzj = $('#hzj').val();
   if(parseInt(lzj) || parseInt(hzj)){
   var newzj = lzj+'-'+hzj;
   Filter('zj',newzj);
   }
});
//搜索框
$('#ss').click(function() {
	var kwds = $('#keyword-box').val();
	
		Filter('kw',kwds);   
	
});
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>
