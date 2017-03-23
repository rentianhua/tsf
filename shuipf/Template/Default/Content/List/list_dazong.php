<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','ar','zj','mj','sx','yt','lx','fs','order','kwds');
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
<style>
  dl,ul{margin: 0;padding:0}
  li{list-style: none}
  h2{margin-bottom: 0}
  .house-lst .where{
    height: 16px;
    margin-top:0;
  }
  .house-lst .other{
    margin-top:2px !important;
    height:21px !important;
  }
</style>
<!-- NAV头部搜索模块 -->
<div class="searchs">
  <div class="wrapper">
    <div class="fl" log-mod="search">
      <div class="search-txt">
        <div class="search-tab">
            <div  class="txt-serach">
              <input class="left txt" onkeydown='if(event.keyCode==13){$("#search").submit();};' autocomplete="off" placeholder="输入关键词搜索房源" id="keyword-box">
              <div id="suggest-cont" class="suggest-wrap" data-bl="sug" data-el="sug"></div>
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
    <div class="fl l-txt"><a href="/">首页</a><span class="stp">&nbsp;&gt;&nbsp;</span><span><navigate catid="$catid" space=" &gt; " /></span></div>
    <div class="fr r-txt"></div>
  </div>
</div>
<div class="wrapper">
  <div class="filter-box">
    <div>
    <form id="filterForm" action="" method="get">
      	<input type="hidden" name="a" value="lists">
        <input type="hidden" name="catid" value="7">
        <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="ar" name="ar" value="<?php echo $fitervalue['ar']; ?>" />
        <input to="filter" type="hidden" id="zj" name="zj" value="<?php echo $fitervalue['zj']; ?>" />
        <input to="filter" type="hidden" id="mj" name="mj" value="<?php echo $fitervalue['mj']; ?>" />
        <input to="filter" type="hidden" id="sx" name="sx" value="<?php echo $fitervalue['sx']; ?>" />
        <input to="filter" type="hidden" id="yt" name="yt" value="<?php echo $fitervalue['yt']; ?>" />
        <input to="filter" type="hidden" id="lx" name="lx" value="<?php echo $fitervalue['lx']; ?>" />
        <input to="filter" type="hidden" id="fs" name="fs" value="<?php echo $fitervalue['fs']; ?>" />
        <input to="filter" type="hidden" id="order" name="order" value="<?php echo $fitervalue['order']; ?>" />
        <input to="filter" type="hidden" id="kwds" name="kwds" value="<?php echo $fitervalue['kwds']; ?>" />  
        </form>     
      <div class="bd" id="filter-options">
        <dl class="dl-lst clear"><dt>区域：</dt><dd>
        <div class="option-list">
              <a href="javascript:Filter('ct');" class="<?php if(!$_GET['ct']){echo 'on';} ?>">不限</a>
              <?php
              $qulist = get_area_list(1);
              ?>
              <volist name="qulist" id="vo">
                <a href="javascript:Filter('ct','{$vo.id}');" class="<?php if($_GET['ct']==$vo['id']){echo 'on';} ?>">{$vo.name}</a>
              </volist>
            </div>
              <?php
              if($_GET['ct']){
                $arealist = get_area_list($_GET['ct']);
              }
              ?>
              <if condition="$_GET['ct']">
              <div class="option-list sub-option-list">
              <a href="javascript:Filter('ar');" class="<?php if(!$_GET['ar']){echo 'on';} ?>">不限</a>
              <volist name="arealist" id="vo1">
                <a href="javascript:Filter('ar','{$vo1.id}');" class="<?php if($_GET['ar']==$vo1['id']){echo 'on';} ?>">{$vo1.name}</a>
              </volist>
              </div>
              </if>
          </dd></dl>
        <dl class="dl-lst clear">
          <dt>金额：</dt>
          <dd>
            <div class="option-list">
              <a href="javascript:Filter('zj');" class="<?php if(!$_GET['zj']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('zj','0-1000');" class="<?php if($_GET['zj']=='0-1000'){echo 'on';} ?>">1000万以下</a>
              <a href="javascript:Filter('zj','1000-2000');" class="<?php if($_GET['zj']=='1000-2000'){echo 'on';} ?>">1000-2000万</a>
              <a href="javascript:Filter('zj','2000-5000');" class="<?php if($_GET['zj']=='2000-5000'){echo 'on';} ?>">2000-5000万</a>
              <a href="javascript:Filter('zj','5000-10000');" class="<?php if($_GET['zj']=='5000-10000'){echo 'on';} ?>">5000万-1亿</a>
              <a href="javascript:Filter('zj','10000-');" class="<?php if($_GET['zj']=='10000-'){echo 'on';} ?>">1亿以上</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>面积：</dt>
          <dd>
            <div class="option-list">
              <a href="javascript:Filter('mj');" class="<?php if(!$_GET['mj']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('mj','0-10000');" class="<?php if($_GET['mj']=='0-10000'){echo 'on';} ?>">1万平米以下</a>
              <a href="javascript:Filter('mj','10000-50000');" class="<?php if($_GET['mj']=='10000-50000'){echo 'on';} ?>">1-5万平米</a>
              <a href="javascript:Filter('mj','50000-100000');" class="<?php if($_GET['mj']=='50000-100000'){echo 'on';} ?>">5-10万平米</a>
              <a href="javascript:Filter('mj','100000-');" class="<?php if($_GET['mj']=='100000-'){echo 'on';} ?>">10万平米以上</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>属性：</dt>
          <dd data-index="3">
            <div class="option-list">
              <a href="javascript:Filter('sx');" class="<?php if(!$_GET['sx']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('sx','商用/办公土地');" class="<?php if($_GET['sx']=='商用/办公土地'){echo 'on';} ?>">商用/办公土地</a>
              <a href="javascript:Filter('sx','商业用地');" class="<?php if($_GET['sx']=='商业用地'){echo 'on';} ?>">商业用地</a>
              <a href="javascript:Filter('sx','工业用地');" class="<?php if($_GET['sx']=='工业用地'){echo 'on';} ?>">工业用地</a>
              <a href="javascript:Filter('sx','综合用地');" class="<?php if($_GET['sx']=='综合用地'){echo 'on';} ?>">综合用地</a>
              <a href="javascript:Filter('sx','住宅用地');" class="<?php if($_GET['sx']=='住宅用地'){echo 'on';} ?>">住宅用地</a>
              <a href="javascript:Filter('sx','村集体用地');" class="<?php if($_GET['sx']=='村集体用地'){echo 'on';} ?>">村集体用地</a>
              <a href="javascript:Filter('sx','军队用地');" class="<?php if($_GET['sx']=='军队用地'){echo 'on';} ?>">军队用地</a>
              <a href="javascript:Filter('sx','林业用地');" class="<?php if($_GET['sx']=='林业用地'){echo 'on';} ?>">林业用地</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>类型：</dt>
          <dd>
            <div class="option-list">
              <a href="javascript:Filter('lx');" class="<?php if(!$_GET['lx']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('lx','商业用房');" class="<?php if($_GET['lx']=='商业用房'){echo 'on';} ?>">商业用房</a>
              <a href="javascript:Filter('lx','住宅用房');" class="<?php if($_GET['lx']=='住宅用房'){echo 'on';} ?>">住宅用房</a>
              <a href="javascript:Filter('lx','写字楼');" class="<?php if($_GET['lx']=='写字楼'){echo 'on';} ?>">写字楼</a>
              <a href="javascript:Filter('lx','工业厂房');" class="<?php if($_GET['lx']=='工业厂房'){echo 'on';} ?>">工业厂房</a>
              <a href="javascript:Filter('lx','酒店');" class="<?php if($_GET['lx']=='酒店'){echo 'on';} ?>">酒店</a>
              <a href="javascript:Filter('lx','集体');" class="<?php if($_GET['lx']=='集体'){echo 'on';} ?>">集体</a>
              <a href="javascript:Filter('lx','军产房');" class="<?php if($_GET['lx']=='军产房'){echo 'on';} ?>">军产房</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>方式：</dt>
          <dd data-index="3">
            <div class="option-list">
              <a href="javascript:Filter('fs');" class="<?php if(!$_GET['fs']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('fs','整体转让');" class="<?php if($_GET['fs']=='整体转让'){echo 'on';} ?>">整体转让</a>
              <a href="javascript:Filter('fs','控股权转让');" class="<?php if($_GET['fs']=='控股权转让'){echo 'on';} ?>">控股权转让</a>
              <a href="javascript:Filter('fs','部分转让');" class="<?php if($_GET['fs']=='部分转让'){echo 'on';} ?>">部分转让</a>
              <a href="javascript:Filter('fs','股权融资');" class="<?php if($_GET['fs']=='股权融资'){echo 'on';} ?>">股权融资</a>
              <a href="javascript:Filter('fs','债权融资');" class="<?php if($_GET['fs']=='债权融资'){echo 'on';} ?>">债权融资</a>
              <a href="javascript:Filter('fs','租赁融资');" class="<?php if($_GET['fs']=='租赁融资'){echo 'on';} ?>">租赁融资</a>
            </div>
          </dd>
        </dl>
      </div>
      <div class="filter-bar01">
        <div class="sort-bar" id="sort-bar"><span>排序：</span>
          <div class="sort-parent <?php if(!$_GET['order']){echo 'on';} ?>">
          <a href="{$url}"><span>显示全部</span></a></div>
          <div class="sort-parent">
          <a href="javascript:Filter('order','updatetime_DESC');"><span>最新</span></a></div>
          <div class="sort-parent <?php if($_GET['order']=='zongjia_ASC'||$_GET['order']=='zongjia_DESC'){echo 'on';} ?>"><span>
          <?php 
			if($_GET['order']=='zongjia_ASC'){
				echo '金额从低到高';
			}else if($_GET['order']=='zongjia_DESC'){
				echo '金额从高到低';
			}else{
				echo "金额";	
			}
			?>
          </span><i></i>
            <ul class="sort-children">
              <li><a href="javascript:;Filter('order','zongjia_ASC');">金额从低到高</a></li>
              <li><a href="javascript:Filter('order','zongjia_DESC');">金额从高到低</a></li>
            </ul>
          </div>
          <div class="sort-parent <?php if($_GET['order']=='zhandimianji_ASC'||$_GET['order']=='zhandimianji_DESC'){echo 'on';} ?>"><span>
          <?php 
			if($_GET['order']=='zhandimianji_ASC'){
				echo '面积从小到大';
			}else if($_GET['order']=='zhandimianji_DESC'){
				echo '面积从大到小';
			}else{
				echo "面积";	
			}
			?>
          </span><i></i>
            <ul class="sort-children">
              <li><a href="javascript:;Filter('order','zhandimianji_ASC');">面积从小到大</a></li>
              <li><a href="javascript:Filter('order','zhandimianji_DESC');">面积从大到小</a></li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <div class="main-box clear">
    <div class="con-box">
    <?php
        $sql = " province = 1";
		$order = "";
		if($_GET['ct']!=""){
			$sql.= " and city = '".$_GET['ct']."'"; 
			}
		if($_GET['ar']!=""){
			$sql.= " and area = '".$_GET['ar']."'"; 
			}
		if($_GET['zj']!=""){
			$zj = explode('-',$_GET['zj']);			
			$sql.= " and zongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and zongjia <= '".intval($zj[1])."'";
			}	
		}
		if($_GET['mj']!=""){
			$mj = explode('-',$_GET['mj']);			
			$sql.= " and zhandimianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and zhandimianji <= '".intval($mj[1])."'";
			}	
		}
		if($_GET['sx']!=""){
			$sql.= " and tudishuxing = '".$_GET['sx']."'"; 
			}
		if($_GET['lx']!=""){
			$sql.= " and wuyetype = '".$_GET['lx']."'"; 
			}
		if($_GET['fs']!=""){
			$sql.= " and hezuofangshi = '".$_GET['fs']."'"; 
			}
		if($_GET['kwds']!=""){
			$sql.= " and title like '%".$_GET['kwds']."%'"; 
			}	
		if($_GET['order']!=""){
			$order.= str_replace('_',' ',$_GET['order']); 
		}else{
			$order.= "listorder DESC";
		}
		?>
        <content action="lists" catid="$catid" where="$sql" order="$order" num="20"  page="$page">
      <div class="list-head clear">
        <h2>共有<span><?php $count=reset($data);echo $count['datanum'];?></span>套大宗房源</h2>
      </div>
      <div class="list-wrap">
        <ul id="house-lst" class="house-lst">
          
            <volist name="data" id="vo">
              <li>
                <div class="pic-panel">
                  <a target="_blank" href="{$vo.url}">
                    <img src='<if condition="$vo['thumb']">{$vo.thumb}<else />{$config_siteurl}statics/default/images/defaultpic.gif</if>' /></a></div>
                <div class="info-panel">
                  <h2><a target="_blank" href="{$vo.url}" title="{$vo.title}">{$vo.title}&nbsp;<span style="background: #ED1B24; width: 60px; height: 19px;">平台发布</span></a></h2>
                  <div class="col-1">
                    <div class="where">
                      <span class="zone"><span>{$vo.city|getareaName} {$vo.area|getareaName}</span></span>
                      <span>/</span>
                      <span class="meters">{$vo.zhandimianji}平米&nbsp;&nbsp;</span><span>{$vo.chaoxiang}</span></div>
                    <div class="other">
                      <div class="con">
                        合作方式：{$vo.hezuofangshi}<span>/</span>物业类型：{$vo.wuyetype}</div>
                    </div>
                    <div class="other">
                      <div class="con">联系人：{$vo.contactname}</div>
                    </div>
                    <div class="chanquan">
                      <div class="left agency">
                        <div class="view-label left">
                          <span class="haskey-ex"><span>身份认证</span></span>
                          <span class="haskey-ex"><span>合同上传</span></span>
                          <span class="haskey-ex"><span>上门实勘</span></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="price"><span class="num">{$vo.zongjia}</span>万</div>
                    <div class="price-pre">{$vo.updatetime|date='Y-m-d',###} 更新</div>
                  </div>
                  <div class="col-2">
                    <div class="square">
                      <div><span class="num">
                      <if condition="$vo['shiyongnianxian'] eq 999">
                      长期
                      <else/>{$vo.shiyongnianxian}</span>年
                      </if></div>
                      <div class="col-look">使用年限</div>
                    </div>
                  </div>
                  </div>
              </li>
            </volist>
          </content>
        </ul>
        <div class="page-box house-lst-page-box">
          {$pages}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="w-content">
  <!-- 推荐开始 -->
  <div style="border: 1px solid #E3E3E3;margin-top: 20px;background: #fff;">
  	<div style="font-size: 20px;margin: 15px 0 0 10px">好房推荐</div>
  	  <ul id="tuijian" data-am-widget="gallery" class="am-gallery am-avg-sm-4 am-gallery-default" data-am-gallery="{ pureview: false }" >
        <position action="position" posid="10">
          <volist name="data" id="vo">
	      <li>
	        <div class="am-gallery-item">
	            <a href="{$vo.data.url}">
	              <img src="{$vo.data.thumb}"/>
	                <div class="w-f14 w-black" style="font-weight: bold;margin-top: 5px;">
                      {$vo.data.title}
	                	<span class="w-red">{$vo.data.zongjia}万</span>
	                </div>
	                <div class="w-f14 w-black">{$vo.data.city|getareaName} {$vo.data.zhandimianji}㎡</div>
	            </a>
	        </div>
	      </li>
          </volist>
        </position>
	  </ul>

  </div>
  <!-- 推荐结束 -->
</div>
<script>
  function Filter(field,value){
	var $ = function(ele){return document.getElementById(ele);}
	if(field == "ct"){
		$("ar").value = '';	
	}
    var ipts = $('filterForm').getElementsByTagName('input'),result=[];
    for(var i=0,l=ipts.length;i<l;i++){
      if(ipts[i].getAttribute('to')=='filter'){
        result.push(ipts[i]);
      }
    }
    if($(field)){
      value = value || '';
      $(field).value = value;
      for(var j=0,len=result.length;j<len;j++){
        if(result[j].value==''){
          result[j].parentNode.removeChild(result[j]);
        }
      }
	  
      document.forms['filterForm'].submit();
    }
    return false;
  }
  
  $('.ok').click(function() {
   var lzj = $('#lzj').val();
   var hzj = $('#hzj').val();
   if(parseInt(lzj) || parseInt(hzj)){
   var newzj = lzj+'-'+hzj;
   Filter('zj',newzj);
   document.forms['filterForm'].submit();	   
	   }

});
//搜索框
  $('#ss').click(function() {
   var kwds = $('#keyword-box').val();
   if(kwds){
   Filter('kwds',kwds);
   document.forms['filterForm'].submit();	   
	   }

});
 
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>