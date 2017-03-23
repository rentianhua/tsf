<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','ar','zj','shi','mj','qs','ly','dt','yt','cx','lc','zx','wy','order','kwds');
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
dl, ul {
	margin: 0;
	padding: 0
}
li {
	list-style: none
}
h2 {
	margin-bottom: 0
}
.col-2 {
	width: 135px !important;
}
.house-lst .where {
	height: 16px;
	margin-top: 0;
}
.house-lst .other {
	margin-top: 2px !important;
	height: 21px !important;
}
.check{
    background: url("{:C('app_ui')}images/sprite_lb.png") no-repeat scroll -27px -8px !important;
  }
  .price-pre{
	  color:#000 !important;
	  font-size:14px !important;
	 }
</style>
<!-- NAV头部搜索模块 -->
<div class="searchs">
  <div class="wrapper">
    <div class="fl">
      <div class="search-txt">
          <div class="search-tab">
            <div  class="txt-serach">
              <input id="keyword-box" placeholder="输入关键词搜索房源" autocomplete="off" onkeydown="if(event.keyCode==13){Filter('kwds',$(this).val());};" class="left txt">
              <div id="suggest-cont" class="suggest-wrap" data-bl="sug" data-el="sug"></div>
            </div>
            <div class="savesearch"></div>
          </div>
          <button class="act-search btn home-ico ico-search" id="ss">搜索</button>
      </div>
    </div>
    <div class="fr last">
      <div class="ditu fr"><a href="/index.php?m=map&a=es" target="_blank"> <span class="am-icon-map-marker"></span>&nbsp;&nbsp;地图找房</a></div>
    </div>
  </div>
</div>
<!-- 面包屑模块 -->
<div class="intro clear" mod-id="lj-common-bread">
  <div class="container">
    <div class="fl l-txt"><a href="/">首页</a><span class="stp">&nbsp;&gt;&nbsp;</span><span>
      <navigate catid="$catid" space=" &gt; " />
      </span></div>
    <div class="fr r-txt"></div>
  </div>
</div>
<div class="wrapper">
  <div class="filter-box">
    <form id="filterForm" action="" method="get">
      <input type="hidden" name="a" value="lists">
      <input type="hidden" name="catid" value="6">
      <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
      <input to="filter" type="hidden" id="ar" name="ar" value="<?php echo $fitervalue['ar']; ?>" />
      <input to="filter" type="hidden" id="zj" name="zj" value="<?php echo $fitervalue['zj']; ?>" />
      <input to="filter" type="hidden" id="shi" name="shi" value="<?php echo $fitervalue['shi']; ?>" />
      <input to="filter" type="hidden" id="mj" name="mj" value="<?php echo $fitervalue['mj']; ?>" />
      <input to="filter" type="hidden" id="qs" name="qs" value="<?php echo $fitervalue['qs']; ?>" />
      <input to="filter" type="hidden" id="ly" name="ly" value="<?php echo $fitervalue['ly']; ?>" />
      <input to="filter" type="hidden" id="dt" name="dt" value="<?php echo $fitervalue['dt']; ?>" />
      <input to="filter" type="hidden" id="yt" name="yt" value="<?php echo $fitervalue['yt']; ?>" />
      <input to="filter" type="hidden" id="cx" name="cx" value="<?php echo $fitervalue['cx']; ?>" />
      <input to="filter" type="hidden" id="lc" name="lc" value="<?php echo $fitervalue['lc']; ?>" />
      <input to="filter" type="hidden" id="zx" name="zx" value="<?php echo $fitervalue['zx']; ?>" />
      <input to="filter" type="hidden" id="wy" name="wy" value="<?php echo $fitervalue['wy']; ?>" />
      <input to="filter" type="hidden" id="order" name="order" value="<?php echo $fitervalue['order']; ?>" />
      <input to="filter" type="hidden" id="kwds" name="kwds" value="<?php echo $fitervalue['kwds']; ?>" /> 
      </form>
      <div>
        <div class="bd" id="filter-options">
          <dl class="dl-lst clear">
            <dt>区域：</dt>
            <dd>
              <div class="option-list"> <a href="javascript:Filter('ct');" class="<?php if(!$_GET['ct']){echo 'on';} ?>">不限</a>
                <?php
              $qulist = get_area_list(1);
              ?>
                <volist name="qulist" id="vo"> <a href="javascript:Filter('ct','{$vo.id}');" class="<?php if($_GET['ct']==$vo['id']){echo 'on';} ?>">{$vo.name}</a> </volist>
              </div>
              <?php
              if($_GET['ct']){
                $arealist = get_area_list($_GET['ct']);
              }
              ?>
              <if condition="$_GET['ct']">
                <div class="option-list sub-option-list"> <a href="javascript:Filter('ar');" class="<?php if(!$_GET['ar']){echo 'on';} ?>">不限</a>
                  <volist name="arealist" id="vo1"> <a href="javascript:Filter('ar','{$vo1.id}');" class="<?php if($_GET['ar']==$vo1['id']){echo 'on';} ?>">{$vo1.name}</a> </volist>
                </div>
              </if>
            </dd>
          </dl>
          <dl class="dl-lst clear">
            <dt>地铁：</dt>
            <dd>
              <div class="option-list">
              <a href="javascript:Filter('dt');" class="<?php if(!$_GET['dt']){echo 'on';} ?>">不限</a> 
              <a href="javascript:Filter('dt','[1]');" class="<?php if($_GET['dt']=='[1]'){echo 'on';} ?>">1号线(罗宝线)</a> 
              <a href="javascript:Filter('dt','[2]');" class="<?php if($_GET['dt']=='[2]'){echo 'on';} ?>">2号线(蛇口线)</a> 
              <a href="javascript:Filter('dt','[3]');" class="<?php if($_GET['dt']=='[3]'){echo 'on';} ?>">3号线(龙岗线)</a> 
              <a href="javascript:Filter('dt','[4]');" class="<?php if($_GET['dt']=='[4]'){echo 'on';} ?>">4号线(龙华线)</a> 
              <a href="javascript:Filter('dt','[5]');" class="<?php if($_GET['dt']=='[5]'){echo 'on';} ?>">5号线(环中线)</a> 
              <a href="javascript:Filter('dt','[7]');" class="<?php if($_GET['dt']=='[7]'){echo 'on';} ?>">7号线</a>
              <a href="javascript:Filter('dt','[9]');" class="<?php if($_GET['dt']=='[9]'){echo 'on';} ?>">9号线</a>
              <a href="javascript:Filter('dt','[11]');" class="<?php if($_GET['dt']=='[11]'){echo 'on';} ?>">11号线</a>
              </div>
            </dd>
          </dl>
          <dl class="dl-lst clear">
            <dt>预算：</dt>
            <dd>
              <div class="option-list"> 
              <a href="javascript:Filter('zj');" class="<?php if(!$_GET['zj']){echo 'on';} ?>">不限</a> 
              <a href="javascript:Filter('zj','0-100');" class="<?php if($_GET['zj']=='0-100'){echo 'on';} ?>">100万以下</a> 
              <a href="javascript:Filter('zj','100-200');" class="<?php if($_GET['zj']=='100-200'){echo 'on';} ?>">100-200万</a> 
              <a href="javascript:Filter('zj','200-300');" class="<?php if($_GET['zj']=='200-300'){echo 'on';} ?>">200-300万</a> 
              <a href="javascript:Filter('zj','300-400');" class="<?php if($_GET['zj']=='300-400'){echo 'on';} ?>">300-400万</a>
              <a href="javascript:Filter('zj','400-');" class="<?php if($_GET['zj']=='400-'){echo 'on';} ?>">400万以上</a>
                <div class="custom">
                  <div class="txt-box">
                    <input id="lzj" type="text" class="txt" value="<?php
                  if($_GET['zj']!=""){
					  $arr=explode('-',$_GET['zj']);
					  echo $arr[0];
					  }
				  ?>" />
                  </div>
                  &nbsp;-&nbsp;
                  <div class="txt-box">
                    <input id="hzj" type="text" class="txt" value="<?php
                  if($_GET['zj']!=""){
					  $arr=explode('-',$_GET['zj']);
					  echo $arr[1];}
				  ?>" />
                  </div>
                  &nbsp;万
                  <input type="button" class="ok" value="确定" />
                </div>
              </div>
            </dd>
          </dl>
          <dl class="dl-lst clear">
            <dt>面积：</dt>
            <dd data-index="2">
              <div class="option-list"> 
              <a href="javascript:Filter('mj');" class="<?php if(!$_GET['mj']){echo 'on';} ?>">不限</a> 
              <a href="javascript:Filter('mj','0-50');" class="<?php if($_GET['mj']=='0-50'){echo 'on';} ?>">50平以下</a> 
              <a href="javascript:Filter('mj','50-70');" class="<?php if($_GET['mj']=='50-70'){echo 'on';} ?>">50-70平</a> 
              <a href="javascript:Filter('mj','70-90');" class="<?php if($_GET['mj']=='70-90'){echo 'on';} ?>">70-90平</a> 
              <a href="javascript:Filter('mj','90-110');" class="<?php if($_GET['mj']=='90-110'){echo 'on';} ?>">90-110平</a>
              <a href="javascript:Filter('mj','110-140');" class="<?php if($_GET['mj']=='110-140'){echo 'on';} ?>">110-140平</a>
              <a href="javascript:Filter('mj','140-170');" class="<?php if($_GET['mj']=='140-170'){echo 'on';} ?>">140-170平</a>
              <a href="javascript:Filter('mj','170-200');" class="<?php if($_GET['mj']=='170-200'){echo 'on';} ?>">170-200平</a>
              <a href="javascript:Filter('mj','200-');" class="<?php if($_GET['mj']=='200-'){echo 'on';} ?>">200平以上</a>
                <div class="custom">
                  <div class="txt-box">
                    <input type="text" class="txt" id="lmj" value="<?php
                  if($_GET['mj']!=""){
					  $arr=explode('-',$_GET['mj']);
					  echo $arr[0];
					  }
				  ?>" />
                  </div>
                  &nbsp;-&nbsp;
                  <div class="txt-box">
                    <input type="text" class="txt" id="hmj" value="<?php
                  if($_GET['mj']!=""){
					  $arr=explode('-',$_GET['mj']);
					  echo $arr[1];
					  }
				  ?>" />
                  </div>
                  &nbsp;平
                  <input type="button" class="ok2" value="确定" />
                </div>
              </div>
            </dd>
          </dl>
          <dl class="dl-lst clear">
            <dt>房型：</dt>
            <dd data-index="3">
              <div class="option-list"> 
              <a href="javascript:Filter('shi');" class="<?php if(!$_GET['shi']){echo 'on';} ?>">不限</a> 
              <a href="javascript:Filter('shi','1');" class="<?php if($_GET['shi']=='1'){echo 'on';} ?>">一室</a> 
              <a href="javascript:Filter('shi','2');" class="<?php if($_GET['shi']=='2'){echo 'on';} ?>">二室</a> 
              <a href="javascript:Filter('shi','3');" class="<?php if($_GET['shi']=='3'){echo 'on';} ?>">三室</a> 
              <a href="javascript:Filter('shi','4');" class="<?php if($_GET['shi']=='4'){echo 'on';} ?>">四室</a> <a href="javascript:Filter('shi','5');" class="<?php if($_GET['shi']=='5'){echo 'on';} ?>">五室</a> 
              <a href="javascript:Filter('shi','6');" class="<?php if($_GET['shi']=='6'){echo 'on';} ?>">五室以上</a> 
              </div>
            </dd>
          </dl>
          <dl class="dl-lst clear">
            <dt>物业：</dt>
            <dd data-index="3">
              <div class="option-list"> 
              <a href="javascript:Filter('qs');" class="<?php if(!$_GET['qs']){echo 'on';} ?>">不限</a> 
              <a href="javascript:Filter('qs','商品房');" class="<?php if($_GET['qs']=='商品房'){echo 'on';} ?>">商品房</a> 
              <a href="javascript:Filter('qs','村委统建');" class="<?php if($_GET['qs']=='村委统建'){echo 'on';} ?>">村委统建</a> 
              <a href="javascript:Filter('qs','开发商建设');" class="<?php if($_GET['qs']=='开发商建设'){echo 'on';} ?>">开发商建设</a> 
              <a href="javascript:Filter('qs','个人自建房');" class="<?php if($_GET['qs']=='个人自建房'){echo 'on';} ?>">个人自建房</a> 
              <a href="javascript:Filter('qs','广东省军区军产房');" class="<?php if($_GET['qs']=='广东省军区军产房'){echo 'on';} ?>">广东省军区军产房</a> 
              <a href="javascript:Filter('qs','武警部队军产房');" class="<?php if($_GET['qs']=='武警部队军产房'){echo 'on';} ?>">武警部队军产房</a> 
              <a href="javascript:Filter('qs','工业长租房');" class="<?php if($_GET['qs']=='工业长租房'){echo 'on';} ?>">工业长租房</a> 
              <a href="javascript:Filter('qs','工业产权房');" class="<?php if($_GET['qs']=='工业产权房'){echo 'on';} ?>">工业产权房</a> 
              <a href="javascript:Filter('qs','其他');" class="<?php if($_GET['qs']=='其他'){echo 'on';} ?>">其他</a> 
              </div>
            </dd>
          </dl>
          <dl class="dl-lst clear">
            <dt>来源：</dt>
            <dd>
              <div class="option-list"> 
              <a href="javascript:Filter('ly');" class="<?php if(!$_GET['ly']){echo 'on';} ?>">不限</a> 
              <a href="javascript:Filter('ly','yz');" class="<?php if($_GET['ly']=='yz'){echo 'on';} ?>">业主</a> 
              <a href="javascript:Filter('ly','jjr');" class="<?php if($_GET['ly']=='jjr'){echo 'on';} ?>">经纪人</a> 
              </div>
            </dd>
          </dl>
        </div>
        <div class="filter-bar01">
          <div id="sort-panel" class="sort-panel">
            <div class="left">
              <div class="fs14"><span class="left">筛选：</span></div>
              <div class="right">
                <div class="d-3 dropdown">
                <span><?php 
				if($_GET['yt']){
					echo $_GET['yt'];
				}else{
					echo 类型;
				} 
				?></span>
                <i class="am-icon-angle-down"></i>
                  <ul class="fil-item">
                    <a href="javascript:Filter('yt');">
                    <li>全部</li>
                    </a><a href="javascript:Filter('yt','住宅');">
                    <li>住宅</li>
                    </a><a href="javascript:Filter('yt','公寓');">
                    <li>公寓</li>
                    </a><a href="javascript:Filter('yt','商铺');">
                    <li>商铺</li>
                    </a><a href="javascript:Filter('yt','写字楼');">
                    <li>写字楼</li>
                    </a><a href="javascript:Filter('yt','其他');">
                    <li>其他</li>
                    </a>
                  </ul>
                </div>
                <div class="d-1 dropdown">
                <span><?php 
				if($_GET['cx']){
					echo $_GET['cx'];
				}else{
					echo 朝向;
				} 
				?></span><i class="am-icon-angle-down"></i>
                  <ul class="fil-item">
                  <a href="javascript:Filter('cx');">
                    <li>全部</li>
                    </a>
                    <a href="javascript:Filter('cx','东');">
                    <li>朝东</li>
                    </a><a href="javascript:Filter('cx','南');">
                    <li>朝南</li>
                    </a><a href="javascript:Filter('cx','西');">
                    <li>朝西</li>
                    </a><a href="javascript:Filter('cx','北');">
                    <li>朝北</li>
                    </a><a href="javascript:Filter('cx','南北');">
                    <li>南北</li>
                    </a>
                  </ul>
                </div>
                <div class="d-2 dropdown">
                <span><?php 
				if($_GET['lc']){
					echo $_GET['lc'];
				}else{
					echo 楼层;
				} 
				?></span>
                <i class="am-icon-angle-down"></i>
                  <ul class="fil-item">
                  <a href="javascript:Filter('lc');">
                    <li>全部</li>
                    </a>
                    <a href="javascript:Filter('lc','低层');">
                    <li>低楼层</li>
                    </a><a href="javascript:Filter('lc','中层');">
                    <li>中楼层</li>
                    </a><a href="javascript:Filter('lc','高层');">
                    <li>高楼层</li>
                    </a>
                  </ul>
                </div>
                <div class="item-check">
                  <ul>
                    <li>
                    <if condition="$_GET['zx'] eq '精装'">
                    <a href="javascript:Filter('zx');">
                    <else />
                    <a href="javascript:Filter('zx','精装');">
                    </if>                    
                    <i class="<?php if($_GET['zx']=='精装'){echo 'check';} ?>"></i>
                    精装修</a></li>
                    <li>
                    <if condition="$_GET['wy'] eq '是'">
                    <a href="javascript:Filter('wy');">
                    <else />
                    <a href="javascript:Filter('wy','是');">
                    </if>  
                    
                    <i class="<?php if($_GET['wy']=='是'){echo 'check';} ?>"></i>
                    唯一住房</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="filter-bar01">
          <div class="sort-bar <?php if($_GET['order']=='inputtime_DESC'){echo 'on';} ?>" id="sort-bar"><span>排序：</span>
            <div class="sort-parent">
            <a href="{$url}">
            <span>显示全部</span></a></div>
            <div class="sort-parent <?php if($_GET['order']=='updatetime_DESC'){echo 'on';} ?>">
            <a href="javascript:Filter('order','updatetime_DESC');">
            <span>最新</span></a></div>
            <div class="sort-parent <?php if($_GET['order']=='zongjia_ASC'||$_GET['order']=='zongjia_DESC'){echo 'on';} ?>"><span>
            <?php 
			if($_GET['order']=='zongjia_ASC'){
				echo '总价从低到高';
			}else if($_GET['order']=='zongjia_DESC'){
				echo '总价从高到低';
			}else{
				echo "总价";	
			}
			?>
            </span><i></i>
              <ul class="sort-children">
                <li><a href="javascript:;Filter('order','zongjia_ASC');">总价从低到高</a></li>
                <li><a href="javascript:;Filter('order','zongjia_DESC');">总价从高到低</a></li>
              </ul>
            </div>
            <div class="sort-parent <?php if($_GET['order']=='jianzhumianji_ASC'||$_GET['order']=='jianzhumianji_DESC'){echo 'on';} ?>"><span>
            <?php 
			if($_GET['order']=='jianzhumianji_ASC'){
				echo '面积从小到大';
			}else if($_GET['order']=='jianzhumianji_DESC'){
				echo '面积从大到小';
			}else{
				echo "面积";	
			}
			?>
            </span><i></i>
              <ul class="sort-children">
                <li><a href="javascript:;Filter('order','jianzhumianji_ASC');">面积从小到大</a></li>
                <li><a href="javascript:;Filter('order','jianzhumianji_DESC');">面积从大到小</a></li>
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
		if($_GET['dt']!=""){
			$sql.= " and ditiexian like '%".$_GET['dt']."%'"; 
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
			$sql.= " and jianzhumianji >= '".intval($mj[0])."'"; 
			if(intval($mj[1]) != 0){
				 $sql.= " and jianzhumianji <= '".intval($mj[1])."'";
			}
		}
		if($_GET['shi']!=""){
			$sql.= " and shi = '".$_GET['shi']."'"; 
			}
		if($_GET['qs']!=""){
			$sql.= " and jiaoyiquanshu = '".$_GET['qs']."'"; 
			}
		if($_GET['ly']!=""){
			if($_GET['ly']=='yz'){
				$sql.= " and jjr_id = ''"; 
			}elseif($_GET['ly']=='jjr'){
				$sql.= " and jjr_id != ''"; 
			}
		}
		if($_GET['yt']!=""){
			$sql.= " and fangwuyongtu = '".$_GET['yt']."'"; 
			}
		if($_GET['cx']!=""){
			$sql.= " and chaoxiang = '".$_GET['cx']."'"; 
			}
		if($_GET['lc']!=""){
			$sql.= " and ceng = '".$_GET['lc']."'"; 
			}
		if($_GET['zx']!=""){
			$sql.= " and zhuangxiu = '".$_GET['zx']."'"; 
			}
		if($_GET['wy']!=""){
			$sql.= " and isweiyi = '".$_GET['wy']."'"; 
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
    <content action="lists" catid="$catid" where="$sql" order="$order" num="20" page="$page">
      <div class="list-head clear">
        <h2>共有<span><?php $count=reset($data);echo $count['datanum'];?></span>套二手房源</h2>
      </div>
      <div class="list-wrap">
        <ul id="house-lst" class="house-lst">
          
            <volist name="data" id="vo">
              <li>
                <div class="pic-panel"> <a target="_blank" href="{$vo.url}"> 
                <img src='<if condition="$vo['thumb']">{$vo.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>
                  ' /></a></div>
                <div class="info-panel">
                  <h2><a target="_blank" href="{$vo.url}" title="{$vo.title}">{$vo.title}
                  <span style="background: #ED1B24; width: 67px; height: 19px;"><if condition="($vo.pub_type eq 1) AND ($vo.jjr_id neq '')">经纪人<else/>业主</if>发布</span>
                  <if condition="$vo.zaishou eq 0"><span style="background: rgb(237, 27, 36) none repeat scroll 0% 0%; width: 43px; height: 19px;">已售出</span></if>
                  </a></h2>
                  <div class="col-1">
                    <div class="where"> <a class="laisuzhou"> <span class="am-icon-home"></span> <span class="region">{$vo.xiaoqu|getxiaoquName}&nbsp;&nbsp;</span></a> <span class="zone"><span>{$vo.shi}室{$vo.ting}厅&nbsp;&nbsp;</span></span> <span class="meters">{$vo.jianzhumianji}平米&nbsp;&nbsp;</span><span>{$vo.chaoxiang}</span> </div>
                    <div class="other">
                      <div class="con"> <span style="margin:0 3px;" class="am-icon-map-marker"></span> {$vo.ceng}(共{$vo.zongceng}层)<span>/</span>{$vo.fangling}年房{$vo.jianzhutype}</div>
                    </div>
                    <div class="other">
                      <div class="con"> <span style="margin:0;" class="am-icon-star"></span> <?php echo gznum($vo['id'],'ershou');?>人关注 / 共0次带看 / {$vo.inputtime|date='Y-m-d',###}发布 </div>
                    </div>
                    <div class="chanquan">
                      <div class="left agency">
                        <div class="view-label left"> <span class="haskey"></span> 
                        <if condition="$vo['idcard'] neq ''">
                        <span class="haskey-ex">身份认证</span> 
                        </if>
                        <if condition="$vo['contract'] neq ''">
                        <span class="haskey-ex">合同上传</span> 
                        </if>
                        <!--<span class="haskey-ex">上门实勘</span>--> 
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="price"><span class="num">{$vo.zongjia}</span>万</div>
                    <div class="price-pre">单价
                      <?php  echo ceil($vo['zongjia']*10000/$vo['jianzhumianji'])?>
                      元/平米</div>
                  </div>
                </div>
              </li>
            </volist>
          </content>
        </ul>
        <div class="page-box house-lst-page-box"> {$pages} </div>
      </div>
    </div>
  </div>
</div>
<div class="w-content"> 
  <!-- 推荐开始 -->
  <div style="border: 1px solid #E3E3E3;margin-top: 20px;background: #fff">
    <div style="font-size: 20px;;margin: 15px 0 0 10px">好房推荐</div>
    <position action="position" posid="8">
      <ul class="am-gallery am-avg-sm-4 am-gallery-default am-no-layout" id="tuijian">
        <volist name="data" id="vo">
          <li>
            <div class="am-gallery-item"> <a href="{$vo.data.url}" title="{$vo.data.title}"> <img src="{$vo.data.thumb}">
              <div style="font-weight: bold;margin-top: 5px;" class="w-f14 w-black am-text-truncate"> {$vo.data.title} </div>
              <div class="w-f14 w-black">{$vo.data.shi}室{$vo.data.ting}厅&nbsp;{$vo.data.jianzhumianji}㎡&nbsp;<span class="w-red">{$vo.data.zongjia}万</span></div>
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
  $('.ok2').click(function() {
   var lmj = $('#lmj').val();
   var hmj = $('#hmj').val();
   if(parseInt(lmj) || parseInt(hmj)){
   var newmj = lmj+'-'+hmj;
   Filter('mj',newmj);
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
