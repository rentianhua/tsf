<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','ar','zj','shi','tj','zx','yt','wy','xq','order','kwds');
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
  .col-2{width: 180px !important;}
  .house-lst .where{
    height: 16px;
    margin-top:0;
  }
  .house-lst .other{
    margin-top:2px !important;
    height:25px !important;
  }
  .main-box{
    margin-top:0;
  }
</style>
<!--广告位-->
<!--<div class="w-content" style="text-align: center;">
  <a href="/"><img src="{:C('app_ui')}images/xfgg.jpg" style="width: 100%;"></a>
</div>-->
<!-- NAV头部搜索模块 -->
<div class="searchs">
  <div class="wrapper">
    <div class="fl">
      <div class="search-txt">
        
          <div class="search-tab">
            <div  class="txt-serach">
              <input class="left txt" onkeydown='if(event.keyCode==13){Filter("kwds",$(this).val());};' autocomplete="off" placeholder="输入关键词搜索房源" id="keyword-box">
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
        <input type="hidden" name="catid" value="3">
        <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="ar" name="ar" value="<?php echo $fitervalue['ar']; ?>" />
        <input to="filter" type="hidden" id="zj" name="zj" value="<?php echo $fitervalue['zj']; ?>" />
        <input to="filter" type="hidden" id="shi" name="shi" value="<?php echo $fitervalue['shi']; ?>" />
        <input to="filter" type="hidden" id="zx" name="zx" value="<?php echo $fitervalue['zx']; ?>" />
        <input to="filter" type="hidden" id="yt" name="yt" value="<?php echo $fitervalue['yt']; ?>" />
        <input to="filter" type="hidden" id="wy" name="wy" value="<?php echo $fitervalue['wy']; ?>" />
        <input to="filter" type="hidden" id="xq" name="xq" value="<?php echo $fitervalue['xq']; ?>" />
        <input to="filter" type="hidden" id="tj" name="tj" value="<?php echo $fitervalue['tj']; ?>" />
        <input to="filter" type="hidden" id="order" name="order" value="<?php echo $fitervalue['order']; ?>" />
        <input to="filter" type="hidden" id="kwds" name="kwds" value="<?php echo $fitervalue['kwds']; ?>" />   
        </form>     
        <div class="bd" id="filter-options">
        <dl class="dl-lst clear">
          <dt>区域：</dt><dd>
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
          <dt>总价：</dt>
          <dd type="zongjiarange">
            <div class="option-list">
<a href="javascript:Filter('zj');" class="<?php if(!$_GET['zj']){echo 'on';} ?>">不限</a>
<a href="javascript:Filter('zj','0-30');" class="<?php if($_GET['zj']=='0-30'){echo 'on';} ?>">30万以下</a>
<a href="javascript:Filter('zj','30-50');" class="<?php if($_GET['zj']=='30-50'){echo 'on';} ?>">30-50万</a>
<a href="javascript:Filter('zj','50-100');" class="<?php if($_GET['zj']=='50-100'){echo 'on';} ?>">50-100万</a>
<a href="javascript:Filter('zj','100-150');" class="<?php if($_GET['zj']=='100-150'){echo 'on';} ?>">100-150万</a>
<a href="javascript:Filter('zj','150-200');" class="<?php if($_GET['zj']=='150-200'){echo 'on';} ?>">150-200万</a>
<a href="javascript:Filter('zj','200-250');" class="<?php if($_GET['zj']=='200-250'){echo 'on';} ?>">200-250万</a>
<a href="javascript:Filter('zj','250-300');" class="<?php if($_GET['zj']=='250-300'){echo 'on';} ?>">250-300万</a>
<a href="javascript:Filter('zj','300-');" class="<?php if($_GET['zj']=='300-'){echo 'on';} ?>">300万以上</a>
              <div class="custom" data-type="price">
                <div class="txt-box">
                  <input type="text" class="txt" data-index="1" value="<?php
                  if($_GET['zj']!=""){
					  $arr=explode('-',$_GET['zj']);
					  echo $arr[0];
					  }
				  ?>"  id="lzj"/>
                </div>
                &nbsp;-&nbsp;
                <div class="txt-box">
                  <input type="text" class="txt"  data-index="1" value="<?php
                  if($_GET['zj']!=""){
					  $arr=explode('-',$_GET['zj']);
					  echo $arr[1];}
				  ?>" id="hzj"/>
                </div>
                &nbsp;万
                <input  type="button" class="ok" value="确定" />
              </div>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>房型：</dt>
          <dd type="shi">
            <div class="option-list">
              <a href="javascript:Filter('shi');" class="<?php if(!$_GET['shi']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('shi','1');" class="<?php if($_GET['shi']=='1'){echo 'on';} ?>">一室</a>
              <a href="javascript:Filter('shi','2');" class="<?php if($_GET['shi']=='2'){echo 'on';} ?>">二室</a>
              <a href="javascript:Filter('shi','3');" class="<?php if($_GET['shi']=='3'){echo 'on';} ?>">三室</a>
              <a href="javascript:Filter('shi','4');" class="<?php if($_GET['shi']=='4'){echo 'on';} ?>">四室</a>
              <a href="javascript:Filter('shi','5');" class="<?php if($_GET['shi']=='5'){echo 'on';} ?>">五室</a>
              <a href="javascript:Filter('shi','6');" class="<?php if($_GET['shi']=='6'){echo 'on';} ?>">五室以上</a></div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>装修：</dt>
          <dd type="zx">
            <div class="option-list">
              <a href="javascript:Filter('zx');" class="<?php if(!$_GET['zx']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('zx','精装');" class="<?php if($_GET['zx']=='精装'){echo 'on';} ?>">精装</a>
              <a href="javascript:Filter('zx','简装');" class="<?php if($_GET['zx']=='简装'){echo 'on';} ?>">简装</a>
              <a href="javascript:Filter('zx','毛坯');" class="<?php if($_GET['zx']=='毛坯'){echo 'on';} ?>">毛坯</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>类型：</dt>
          <dd type="yt">
            <div class="option-list">
              <a href="javascript:Filter('yt');" class="<?php if(!$_GET['yt']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('yt','居住');" class="<?php if($_GET['yt']=='居住'){echo 'on';} ?>">居住</a>
              <a href="javascript:Filter('yt','办公');" class="<?php if($_GET['yt']=='办公'){echo 'on';} ?>">办公</a>
              <a href="javascript:Filter('yt','商业');" class="<?php if($_GET['yt']=='商业'){echo 'on';} ?>">商业</a>
              <a href="javascript:Filter('yt','商住两用');" class="<?php if($_GET['yt']=='商住两用'){echo 'on';} ?>">商住两用</a>
              <a href="javascript:Filter('yt','厂房');" class="<?php if($_GET['yt']=='厂房'){echo 'on';} ?>">厂房</a>
              <a href="javascript:Filter('yt','综合体');" class="<?php if($_GET['yt']=='综合体'){echo 'on';} ?>">综合体</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>属性：</dt>
          <dd type="wy">
            <div class="option-list">
              <a href="javascript:Filter('wy');" class="<?php if(!$_GET['wy']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('wy','商品房');" class="<?php if($_GET['wy']=='商品房'){echo 'on';} ?>" value="商品房">商品房</a>
              <a href="javascript:Filter('wy','集体用地村委统建楼');" class="<?php if($_GET['wy']=='集体用地村委统建楼'){echo 'on';} ?>">村委统建</a>
              <a href="javascript:Filter('wy','集体用地开发商自建楼');" class="<?php if($_GET['wy']=='集体用地开发商自建楼'){echo 'on';} ?>">开发商建设</a>
              <a href="javascript:Filter('wy','集体用地个人自建房');" class="<?php if($_GET['wy']=='集体用地个人自建房'){echo 'on';} ?>">个人自建房</a>
              <a href="javascript:Filter('wy','军区建房');" class="<?php if($_GET['wy']=='军区建房'){echo 'on';} ?>">广东省军区军产房</a>
              <a href="javascript:Filter('wy','武警部队建房');" class="<?php if($_GET['wy']=='武警部队建房'){echo 'on';} ?>">武警部队军产房</a>
              <a href="javascript:Filter('wy','工业属性长租物业');" class="<?php if($_GET['wy']=='工业属性长租物业'){echo 'on';} ?>">工业长租房</a>
              <a href="javascript:Filter('wy','工业可分割产权物业');" class="<?php if($_GET['wy']=='工业可分割产权物业'){echo 'on';} ?>">工业产权房</a>
              <a href="javascript:Filter('wy','其他');" class="<?php if($_GET['wy']=='其他'){echo 'on';} ?>">其他</a>
            </div>
          </dd>
        </dl>
        <dl class="dl-lst clear">
          <dt>小区：</dt>
          <dd type="xq">
            <div class="option-list">
              <a href="javascript:Filter('xq');" class="<?php if(!$_GET['xq']){echo 'on';} ?>">不限</a>
              <a href="javascript:Filter('xq','独栋');" class="<?php if($_GET['xq']=='独栋'){echo 'on';} ?>">独栋</a>
              <a href="javascript:Filter('xq','小区房');" class="<?php if($_GET['xq']=='小区房'){echo 'on';} ?>">小区房</a>
            </div>
          </dd>
        </dl>
      </div>
        <div class="filter-bar01">
        <div class="sort-bar" id="sort-bar"><span>排序：</span>
          <div class="sort-parent <?php if(!$_GET['order']){echo 'on';} ?>">
            <a href="javascript:Filter('order');"><span>默认</span></a>
          </div>
          <div class="sort-parent <?php if($_GET['order']=='updatetime_DESC'){echo 'on';} ?>">
          <a href="javascript:Filter('order','updatetime_DESC');"><span>最新</span></a></div>
          <div class="sort-parent <?php if($_GET['order']=='junjia_ASC'||$_GET['order']=='junjia_DESC'){echo 'on';} ?>"><span>
          <?php 
			if($_GET['order']=='junjia_ASC'){
				echo '均价从低到高';
			}else if($_GET['order']=='junjia_DESC'){
				echo '均价从高到低';
			}else{
				echo "均价";	
			}
			?>
          </span><i></i>
            <ul class="sort-children">
              <li><a href="javascript:;Filter('order','junjia_ASC');">均价从低到高</a></li>
              <li><a href="javascript:Filter('order','junjia_DESC');">均价从高到低</a></li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <div class="orderTag"><ul>
  <?php
        $sql = " province = 1";
		$order = "";
		if($_GET['ct']!=""){
			$sql.= " and city = '".$_GET['ct']."'"; 
			}
		if($_GET['ar']!=""){
			$sql.= " and area = '".$_GET['ar']."'"; 
			}	
		if($_GET['shi']!=""){
			$sql.= " and shiarea like '%".$_GET['shi']."%'"; 
			}
		if($_GET['zj']!=""){
			$zj = explode('-',$_GET['zj']);			
			$sql.= " and lowzongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and highzongjia <= '".intval($zj[1])."'";
			}	
		}
		if($_GET['zx']!=""){
			$sql.= " and zhuangxiu = '".$_GET['zx']."'"; 
			}
		if($_GET['yt']!=""){
			$sql.= " and fangwuyongtu = '".$_GET['yt']."'"; 
			}
		if($_GET['wy']!=""){
			$sql.= " and wuyeleixing = '".$_GET['wy']."'"; 
			}
		if($_GET['xq']!=""){
			$sql.= " and xiaoqutype = '".$_GET['xq']."'"; 
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
        <!--搜索where结束-->
          <content action="lists" catid="$catid" where="$sql" order="$order" num="20" page="$page">
          
      <li class="all <if condition="$_GET['tj'] neq '1'">selected</if>"><span><a href="index.php?a=lists&catid=3">全部楼盘</a></span></li>
      <li class="recom  <if condition="$_GET['tj'] eq '1'">selected</if>"><span><a href="javascript:Filter('tj','1');">推荐楼盘</a></span></li></ul></div>
      <if condition="$_GET['tj'] neq '1'">
  <div id="listall" class="main-box clear">
    <div class="con-box" >
      <div class="list-head clear">
        <h2>共有<span><?php $count=reset($data);echo $count['datanum'];?></span>个楼盘</h2>
      </div>
      <div class="list-wrap">
        <ul id="house-lst" class="house-lst" >
        <!--搜索where开始-->
        
            <volist name="data" id="vo">
              <li>
                <div class="pic-panel">
                  <a target="_blank" href="{$vo.url}">
                    <img src='<if condition="$vo['thumb']">{$vo.thumb}<else />{$config_siteurl}statics/default/images/defaultpic.gif</if>' /></a></div>
                <div class="info-panel">
                  <h2><a target="_blank" href="{$vo.url}" title="{$vo.title}">{$vo.title}&nbsp;<span style="background: #ED1B24; width: 60px; height: 19px;">平台发布</span></a>
                  <?php $y=hasyhq($vo['id']);?>
                  <if condition="$y">
                  <span style="background: rgb(237, 27, 36) none repeat scroll 0% 0%; width: 43px; height: 19px;">优惠</span></if>
                  <if condition="$vo.zaishou eq 0"><span style="background: rgb(237, 27, 36) none repeat scroll 0% 0%; width: 43px; height: 19px;">售罄</span></if>
                  </h2>
                  <div class="col-1">
                    <div class="where">
                      <span class="zone"><span>
                      <?php 
                      $l= explode(',',$vo['shiarea']);
                      if(count($l)>1)
                        { $s=$l[0];
                          $d=$l[count($l)-1];
                          echo $s,"-",$d;
                      }
                      else
                        {echo $l[0];};
                      ?>
                      室 / {$vo.mianjiarea}平米</span></span>
                    </div>
                    <div class="other">
                      <div class="con">楼盘地址：{$vo.loupandizhi}</div>
                    </div>
                    <div class="other">
                      <div class="con">
                        开盘时间：{$vo.kaipandate} / 交房时间：{$vo.jiaofangdate}
                      </div>
                    </div>
                    <div class="chanquan">
                      <div class="con">
                        <div class="view-label left">
                          总价范围(万)：{$vo.lowzongjia}-{$vo.highzongjia}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="price">
                      <span class="num"><if condition="$vo['junjia'] eq 0">待定<else />{$vo.junjia}</if></span>
                      <if condition="$vo['junjia'] eq 0"><else />元/平米</if></div>
                    <div class="price-pre"><span class="am-icon-phone"></span> {$vo.contacttel}</div>
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
  <else/>
  <div id="listrecom" <if condition="$_GET['tj'] neq '1'">style="display: none"</if> class="main-box clear">
    <div class="con-box">
      <div class="list-head clear">
      <position action="position" posid="15">
        <h2>共有<span><?php if($data){echo count($data);}else{echo "0";};?></span>个楼盘</h2>
      </div>
      <div class="list-wrap">
        <ul id="house-lst" class="house-lst">
          
            <volist name="data" id="vo">
              <li>
                <div class="pic-panel">
                  <a target="_blank" href="{$vo.data.url}">
                    <img src='<if condition="$vo['thumb']">{$vo.data.thumb}<else />{$config_siteurl}statics/default/images/defaultpic.gif</if>' /></a></div>
                <div class="info-panel">
                  <h2><a target="_blank" href="{$vo.data.url}" title="{$vo.data.title}">{$vo.data.title}&nbsp;<span style="background: #ED1B24; width: 60px; height: 19px;">平台发布</span></a></h2>
                  <div class="col-1">
                    <div class="where">
                      <span class="zone"><span>
                      <?php 
                      $l=count($vo['data']['shiarea']);
                      if($l>1)
                        { $s=strval($vo['data']['shiarea'][1]);
                          $d=strval($vo['data']['shiarea'][$l-1]);
                          echo $s,"-",$d;
                      }
                      else
                        {echo $vo['data']['shiarea'][1];};
                      ?>
                      室 / {$vo.data.mianjiarea}平米</span></span>
                    </div>
                    <div class="other">
                      <div class="con">楼盘地址：{$vo.data.loupandizhi}</div>
                    </div>
                    <div class="other">
                      <div class="con">
                        开盘时间：{$vo.data.kaipandate} / 交房时间：{$vo.data.jiaofangdate}
                      </div>
                    </div>
                    <div class="chanquan">
                      <div class="con">
                        <div class="view-label left">
                          总价范围(万)：{$vo.data.lowzongjia}-{$vo.data.highzongjia}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="price"><span class="num">{$vo.data.junjia}</span>元/平米</div>
                    <div class="price-pre"><span class="am-icon-phone"></span> {$vo.data.contacttel}</div>
                  </div>
                </div>
              </li>
            </volist>
          </position>
        </ul>

      </div>
    </div>
  </div>
  </if>
</div>

<div class="w-content">
  <!-- 推荐开始 -->
  <div style="border: 1px solid #E3E3E3;margin-top: 20px;background: #fff">
  	<div style="font-size: 20px;margin: 15px 0 0 10px">好房推荐</div>
  	 <position action="position" posid="7">
    <ul id="tuijian" class="am-gallery am-avg-sm-4 am-gallery-default am-no-layout">
      <volist name="data" id="vo">
        <li>
          <div class="am-gallery-item"> <a href="{$vo.data.url}" title="{$vo.data.title}"> <img src="{$vo.data.thumb}">
            <div style="font-weight: bold;margin-top: 5px;" class="w-f14 w-black am-text-truncate"> {$vo.data.title} </div>
            <div class="w-f14 w-black">均价：<span class="w-red">{$vo.data.junjia}元/㎡</span></div>
            </a> </div>
        </li>
      </volist>
    </ul>
  </position>
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
	   }

});
//搜索框
  $('#ss').click(function() {
   var kwds = $('#keyword-box').val();
   if(kwds){
   Filter('kwds',kwds);	   
	   }

});
 
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>