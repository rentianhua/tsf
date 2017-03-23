<?php
$userinfo = $this -> userinfo = service("Passport") -> getInfo();
$back=urlencode(get_url());
?>
<template file="Content/header.php" xmlns="http://www.w3.org/1999/html"/>
<template file="Content/nav.php"/>
<link rel="stylesheet" href="{:C('app_ui')}css/common.css">
<link rel="stylesheet" href="{:C('app_ui')}css/detailV3.css">
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=qphEBA2YbUeePcowUS1ONiALbXLdGuGT"></script>
<style>
  .img #thumbnail2 ul li{
    position: relative;
  }
  .img #thumbnail2 ul li span{
    background: rgba(0, 0, 0, 0.6) none repeat scroll 0 0;
    bottom: 0;
    color: #fff;
    height: 26px;
    left: 0px;
    line-height: 26px;
    position: absolute;
    text-align: center;
    width: 107px;
    z-index: 3;
    font-size: 14px;
  }
  .imgContainer img{
    max-width:600px;
    max-height: 400px;
  }
  .img{
    width: 600px;
  }
  .img .thumbnail{
    width: 600px;
  }
  .img .thumbnail .pre{
    width: 15px;
  }
  .img .thumbnail .next{
    width: 15px;
  }
  .img #thumbnail2 ul{
    margin-left:14px;
  }
  .img #thumbnail2 ul li{
    width: 104px;
  }
  .overview .content{
    width: 500px;
  }
  .overview .content .price .total{
    max-width: 408px;
  }
  .overview .content .houseInfo .mainInfo{
    width: 245px;
  }
  #goulist li{list-style:none;}
  .am-dropdown-content::after, .am-dropdown-content::before{left:176px !important}
</style>
<div class="header">
  <div class="menu clear" style="padding-bottom: 15px">
    <div class="menuLeft"><a href="/" ><span class="logo"></span><span class="channelName">新房</span></a>
    </div>
    <div class="search">
      <div log-mod="search" class="input">
          <input onkeydown="if(event.keyCode==13){window.location.href='/index.php?a=lists&catid=3&kwds='+$(this).val();};" type="text" autocomplete="off" placeholder="请输入楼盘名或区域" id="searchInput">
          <button onClick="window.location.href='/index.php?a=lists&catid=3&kwds='+$('#searchInput').val();" class="searchButton" type="submit">&nbsp;<i class="am-icon-sm am-icon-search"></i>&nbsp;</button>
      </div>
    </div>
  </div>
</div>
<div class="intro clear" mod-id="lj-common-bread">
  <div class="container">
    <div class="l-txt"><a href="{$config_siteurl}">首页</a><span class="stp">&nbsp;>&nbsp;</span><navigate catid="$catid" space=" &gt; " /><span class="stp">&nbsp;>&nbsp;</span><span>当前房源</span>&nbsp;</div>
  </div>
</div>
<div class="overview">
  <div class="img" id="topImg">
    <div class="imgContainer"><a target="_blank" href="/index.php?m=public&a=showxc&catid=3&id={$id}">
    <img style="max-width:600px;" class="new-default-icon" src="/statics/default/images/defaultpic.gif"></a></div>
    <div class="thumbnail" id="thumbnail2">
      <div class="pre"><</div>
      <ul class="smallpic">
        <?php		
		foreach ($loupantupian as $k=>$value) {
          if($k == 0){
            echo '<li data-src="'.$value['url'].'"><img src="'.$value['url'].'"><span>效果图</span></li>';
          }
        }
		foreach ($shijingtu as $k=>$value) {
          if($k == 0){
            echo '<li data-src="'.$value['url'].'"><img src="'.$value['url'].'"><span>实景图</span></li>';
          }
        }
		foreach ($yangbantu as $k=>$value) {
          if($k == 0){
            echo '<li data-src="'.$value['url'].'"><img src="'.$value['url'].'"><span>样板间</span></li>';
          }
        }
        foreach ($xiaoqutu as $k=>$value) {
          if($k == 0){
            echo '<li data-src="'.$value['url'].'"><img src="'.$value['url'].'"><span>小区配套</span></li>';
          }
        }
        foreach ($weizhitu as $k=>$value) {
          if($k == 0){
            echo '<li data-src="'.$value['url'].'"><img src="'.$value['url'].'"><span>交通图</span></li>';
          }
        }
        ?>
      </ul>
      <div class="next">></div>
    </div>
  </div>
  <div class="content">
    <div class="price "> <span class="total" style="color:#000;font-size:30px;">{$title}</span>
      <div class="text" style="vertical-align: 12px">
        <span class="am-badge am-badge-primary"><if condition="$zaishou eq 1">在售<else />售罄</if></span>
      </div>
      <div class="removeIcon"></div>
    </div>
    <div style="margin:5px 0 -6px 0;">{$wuyeleixing} | {$fangwuyongtu}    
    </div>
    <div class="houseInfo">
      <div class="room">
        <div class="mainInfo">
          <span class="w-red am-text-xxl"><if condition="$junjia eq 0">待定<else />{$junjia}</if></span>
          <span style="font-size: 12px;">元/平米</span>
        </div>
      </div>
      <div class="area">
        <div class="mainInfo" style="width: 225px;text-align: right">
          <?php
          if($userinfo){
			  if($userinfo['modelid']=='35'){
				$gz = isGZ($id,"new", $userinfo['username']);
				if($gz){
				  echo '<button class="am-btn">已关注</button>';
				}else{
				  echo '<button id="guanzhu" onclick="addguanzhu();" class="am-btn">关注楼盘</button>';
				}
			   }
          }else{
            	echo '<a href="/index.php?g=Member&a=login&back='.$back.'" class="am-btn am-btn-default">关注楼盘</a>';
          }
          ?>
          <span class="subInfo" style="color: #aaa;font-weight: normal;">&nbsp;
		  <span id="favCount"><?php echo gznum($id,"new");?></span>人已关注</span>
        </div>
      </div>
    </div>
    <div class="aroundInfo">
      <div class="communityName"> <i></i> <span class="label">开盘时间</span>
        <span class="info"><if condition="$kaipandate neq '0000-00-00'">{$kaipandate}</if></span>
        <!-- Baidu Button BEGIN -->
    <style>#bdshare{display:inline;float:right}#bdshare a{height:22px}#bdshare span{height:22px}.shareCount{width:42px !important;}</style>
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<span class="bds_more">更多</span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&uid=6478904" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
        </div>
      <div class="areaName"> <i></i> <span class="label">交房时间</span>
        <span class="info"><if condition="$jiaofangdate neq '0000-00-00'">{$jiaofangdate}</if></span> </div>
      <div class="visitTime"> <i></i>
        <span class="label">楼盘地址</span> <span class="info">{$loupandizhi}</span>
      </div>
      <div class="houseRecord">
        <span class="label">主力户型</span>
        <span class="info">{$zhulihuxing}</span>
        <a class="map" href="#huxing" style="margin-left: 10px;text-decoration:underline">全部户型</a>
      </div>
      <div class="houseRecord">
        <span class="label">更新时间</span>
        <span class="info">{$updatetime}</span>        
      </div>
      <div class="houseRecord">
        <span class="label">房源编号</span>
        <span class="info">{$bianhao}</span>        
      </div>
    </div>
    <div class="aroundInfo">
      <i></i>
      <span class="label">现场客户经理</span>
      <span class="info w-red" style="font-size:22px">{$contacttel}</span>
    </div>
    <if condition="$hasyhq eq 1">
     <div id="yhqlist" style="margin:10px 3px">
   <div style="color:#aeb0b1;margin-right:10px">
    优惠券(截止时间：{$yhq_enddate})
   </div>
   <br />
	<?php 
    $yhqlist = M('yhquan')->where('new_catid=3 and new_id='.$id)->select();
    ?>
    <volist name="yhqlist" id="vo">
   <if condition="$userinfo">
		<button style="margin-right:10px;" onclick="chg('{$vo.id}','{$vo.title}','{$vo.description}');" class="am-btn am-btn-primary" data-am-modal="{target: '#my-popup'}">{$vo.title}</button>
   <else/>
		<a style="margin-right:10px;" href="/index.php?g=Member&a=login&back={$back}" class="am-btn am-btn-primary">{$vo.title}</a>
   </if>  
    </volist>
    <div class="am-dropdown am-dropdown-up" data-am-dropdown>
    
  <a class="am-dropdown-toggle" data-am-dropdown-toggle>(已有<?php echo  M('coupon')->where('pay_status=1 and house_id='.$id)->count();?>人购买)</a>
  <ul class="am-dropdown-content" style="padding:20px;width:400px;left:-164px">
      <?php $goulist=yigouinfo($id);?>
      <volist name="goulist" id="vo2">
      <li>姓名：{$vo2.buyname}&nbsp;&nbsp;&nbsp;手机号：{$vo2.buytel}&nbsp;&nbsp;&nbsp;{$vo2.coupon_name}</li>
      </volist>
  </ul>
</div>
    
  </div>
    </if>
    </div>
  </div>
</div>
</div>
<div class="tab-wrap">
  <div class="panel-tab">
    <ul class="clear">
      <li><a href="#loupandongtai" class="on">楼盘动态</a></li>
      <li><a href="#introduction">楼盘详情</a></li>
      <li> <a href="#huxing" id="taxm">户型介绍</a> </li>
      <li> <a href="#xiangce">楼盘相册</a> </li>
      <li> <a href="#fukuan">付款方式</a> </li>
      <li> <a href="#dealRecord">楼盘点评</a> </li>
      <li> <a href="#around">周边配套</a> </li>
    </ul>
    <div class="panel-bg">
      <!-- <span>&#9660</span> -->
    </div>
  </div>
</div>
<div class="agboxB" style="display: none;">
  <div class="agbox"></div>
</div>
<div class="newwrap">
  <div id="loupandongtai">
    <div class="mod-wrap">
      <div id="house-online" class="clear mod-panel-houseonline mod-house-online">
        <div class="h2-flow">楼盘动态
        <a href="/index.php?g=content&m=public&a=alldongtai&id={$id}" target="_blank" class="dynamic-more am-fr">查看更多动态</a></div>
        <p class="det-line-h"></p>
        <div id="dtlist"></div>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div class="mod-wrap">
    <div id="introduction" class="mod-panel mod-details">
      <h2>楼盘详情</h2>
      <p class="mod-details-line"></p>
      <div class="box-loupan">
        <p class="desc-p"></p>
        <p class="desc-p clear">
          <span class="label">楼盘地址：</span>
          <span class="label-val">{$loupandizhi}</span>
        </p>
        <p class="desc-p clear">
          <span class="label">售楼处地址：</span>
          <span class="label-val">{$shouloudizhi}</span>
        </p>
        <p class="desc-p clear">
          <span class="label">开发商：</span>
          <span class="label-val">{$kaifashang}</span>
        </p>
        <p class="desc-p clear">
          <span class="label">物业公司：</span>
          <span class="label-val">{$wuyegongsi}</span>
        </p>


        <ul class="table-list clear">
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">最新开盘：</span>
              <span class="label-val"><if condition="$kaipandate neq '0000-00-00'">{$kaipandate}</if></span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">物业类型：</span>
              <span class="label-val">{$wuyeleixing}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">最早交房：</span>
              <span class="label-val"><if condition="$jiaofangdate neq '0000-00-00'">{$jiaofangdate}</if></span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">容积率：</span>
              <span class="label-val">{$rongjilv}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">产权年限(年)：</span>
              <span class="label-val">{$chanquannianxian}</span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">绿化率(%)：</span>
              <span class="label-val">{$lvhualv}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">规划户数(户)：</span>
              <span class="label-val">{$guihuahushu}</span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">物业费用：</span>
              <span class="label-val">{$wuyefei}<if condition="$wuyefei neq 0">元/m²/月</if></span>
            </p>
          </li>
          <div class="clear">
            <li class="odd">
              <p class="desc-p clear">
                <span class="label">车位情况：</span>
                <span class="label-val">{$guihuachewei}</span>
                <!-- <span class="label-val">1652</span> -->
              </p>
            </li>
            <li class="odd">
              <p class="desc-p clear">
                <span class="label">装修状况：</span>
                <span class="label-val">{$zhuangxiu}</span>
              </p>
            </li>
          </div>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">水电燃气：</span>
              <span class="label-val">{$shuidianranqi}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">建筑类型：</span>
              <span class="label-val">{$jianzhuleixing}</span>
            </p>
          </li>
          <li class="odd">
            <p class="desc-p clear">
              <span class="label">占地面积(㎡)：</span>
              <span class="label-val">{$zhandimianji}</span>
            </p>
          </li>
          <li class="even">
            <p class="desc-p clear">
              <span class="label">建筑面积(㎡)：</span>
              <span class="label-val">{$jianzhumianji}</span>
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div id="huxing">
    <div class="mod-wrap">
      <div id="house-online" class="clear mod-panel-houseonline mod-house-online">
        <div class="h2-flow">户型介绍</div>
        <p class="det-line-h"></p>
        <div class="list-item latercon" data-index="0">
          {$huxingintro}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div id="xiangce">
    <div class="mod-wrap">
      <div id="house-online" class="clear mod-panel-houseonline mod-house-online">
        <div class="h2-flow">楼盘相册</div>
        <p class="det-line-h"></p>
        <div class="album-wrap clearfix latercon" style="margin: 20px 0">
          <div class="album-list-item pull-left">
            <a target="_blank" href="/index.php?g=content&m=public&a=showxc&catid=3&id={$id}">
            <?php
            $n = 0;
            foreach ($loupantupian as $value){
              if($n == 0){
                echo '
                <img alt="'.$value['alt'].'" src="'.$value['url'].'">
                ';
              }
              $n ++;
            }
            ?>
            <if condition="$n neq 0"><span class="album-list-info clearfix">效果图(<?php echo $n;?>)</span></a></if>
            </a>
          </div>
          <div class="album-list-item pull-left">
            <a target="_blank" href="/index.php?g=content&m=public&a=showxc&catid=3&id={$id}">
              <?php
              $n = 0;
              foreach ($shijingtu as $value){
                if($n == 0){
                  echo '
                <img alt="'.$value['alt'].'" src="'.$value['url'].'">
                ';
                }
                $n ++;
              }
              ?>
              <if condition="$n neq 0"><span class="album-list-info clearfix">实景图(<?php echo $n;?>)</span></a></if>
            </a>
          </div>
          <div class="album-list-item pull-left">
            <a target="_blank" href="/index.php?g=content&m=public&a=showxc&catid=3&id={$id}">
              <?php
              $n = 0;
              foreach ($yangbantu as $value){
                if($n == 0){
                  echo '
                <img alt="'.$value['alt'].'" src="'.$value['url'].'">
                ';
                }
                $n ++;
              }
              ?>
              <if condition="$n neq 0"><span class="album-list-info clearfix">样板间(<?php echo $n;?>)</span></a></if>
            </a>
          </div>
          <div class="album-list-item pull-left">
            <a target="_blank" href="/index.php?g=content&m=public&a=showxc&catid=3&id={$id}">
              <?php
              $n = 0;
              foreach ($xiaoqutu as $value){
                if($n == 0){
                  echo '
                <img alt="'.$value['alt'].'" src="'.$value['url'].'">
                ';
                }
                $n ++;
              }
              ?>
              <if condition="$n neq 0"><span class="album-list-info clearfix">小区配套(<?php echo $n;?>)</span></a></if>
            </a>
          </div>
          <div class="album-list-item pull-left">
            <a target="_blank" href="/index.php?g=content&m=public&a=showxc&catid=3&id={$id}">
              <?php
              $n = 0;
              foreach ($weizhitu as $value){
                if($n == 0){
                  echo '
                <img alt="'.$value['alt'].'" src="'.$value['url'].'">
                ';
                }
                $n ++;
              }
              ?>
            <if condition="$n neq 0"><span class="album-list-info clearfix">交通图(<?php echo $n;?>)</span></a></if>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div id="fukuan">
    <div class="mod-wrap">
      <div id="house-online" class="clear mod-panel-houseonline mod-house-online">
        <div class="h2-flow">付款方式</div>
        <p class="det-line-h"></p>
        <div class="list-item latercon" data-index="0">
          <if condition="$fukuanfangshi neq ''">{$fukuanfangshi}<else /><div class="nocomment">暂时还没有内容哦~</div></if>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="newwrap" style="margin-top:35px;">
  <div id="dealRecord">
    <div class="mod-wrap">
      <div id="user-comment" class="mod-panel user-comment">
        <h2>楼盘点评</h2>
        <div class="top_box clear">
          <div class="totalscore_box">
            <div class="totalscore">综合评分：<span style="color: #999">
                <?php
                echo ($dafen_zbpt+$dafen_hj+$dafen_jt)/3;
                ?>
                分</span>
            </div>
            <div class="itemscore clear">
              <div class="item">
                <span>周边配套：</span>
                <?php
                  for ($i=0; $i<5; $i++){
                    if($i<$dafen_zbpt){
                      echo '<span class="am-icon-star" style="color: #f00;"></span> ';
                    }else{
                      echo '<span class="am-icon-star"></span> ';
                    }
                  }
                ?>
                <i style="color: #666">{$dafen_zbpt}分</i>
              </div>
              <div class="item">
                <span>交通方便：</span>
                <?php
                for ($i=0; $i<5; $i++){
                  if($i<$dafen_jt){
                    echo '<span class="am-icon-star" style="color: #f00;"></span> ';
                  }else{
                    echo '<span class="am-icon-star"></span> ';
                  }
                }
                ?>
                <i style="color: #666">{$dafen_jt}分</i>
              </div>
              <div class="item">
                <span>绿化环境：</span>
                <?php
                for ($i=0; $i<5; $i++){
                  if($i<$dafen_hj){
                    echo '<span class="am-icon-star" style="color: #f00;"></span> ';
                  }else{
                    echo '<span class="am-icon-star"></span> ';
                  }
                }
                ?>
                <i style="color: #666">{$dafen_hj}分</i>
              </div>
            </div>
          </div>
        </div>
          <if condition="$dianping eq '' ">
            <div class="nocomment">暂时还没有评价哦~</div>
            <else /><div style="margin: 20px 0">{$dianping}</div>
          </if>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div class="around" id="around" style="width:100%;">
    <h2>
      <div class="title">周边配套</div>
    </h2>
    <div class="content" style="width: 100%">
      <ul class="type">
        <li class="select">公交</li>
        <li>地铁</li>
        <li>教育</li>
        <li>医院</li>
        <li>银行</li>
        <li>休闲娱乐</li>
        <li>购物</li>
        <li>餐饮</li>
        <li>运动健身</li>
      </ul>
      <div class="container" style="height: 450px;">
        <div class="map" id="l-map"> </div>
        <div class="list" id="r-result" style="height: 400px;"> </div>
      </div>
    </div>
  </div>
</div>
<div class="newwrap">
  <div class="mod-wrap">
    <div id="house-push" class="clear mod-panel">
      <h2>推荐楼盘</h2>
      <div class="img-list">
        <div class="show-content">
          <position action="position" posid="5">
            <ul>
              <volist name="data" id="vo">
                <li>
                  <a href="{$vo.data.url}" class="pic">
                    <img src="{$vo.data.thumb}">
                    <span class="tip">均价 {$vo.data.junjia} 元/平</span>
                  </a>
                  <span class="house-name">{$vo.data.title}</span>
                  <span class="zhuzhai">{$vo.data.fangwuyongtu}</span>
                  <div>54㎡-144㎡</div>
                </li>
              </volist>
            </ul>
          </position>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="am-popup" id="my-popup" style="height: 310px;background-color: #F8F8F8;">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">{$title} - <span id="yhqname"></span></h4>
      <span data-am-modal-close class="am-close">&times;</span> </div>
    <div class="am-popup-bd" style="margin-left:15%">
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">购房人：<span id="mgname"></span></span>
        <input id="gname" type="text" style="border: 1px solid #e4e3e3;font-size: 16px;height: 36px;padding: 0 10px;width: 200px;" placeholder="请输入购房人姓名"/>
         </div>
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">手机号：<span id="mgtel"></span></span> 
        <input type="text" placeholder="请输入购房人手机号" id="gtel" style="border: 1px solid #e4e3e3;font-size: 16px;height: 36px;padding: 0 10px;width: 200px;" value="<?php echo $userinfo['username'];?>" readonly>
         </div>
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">验证码：<span id="mgyzm"></span></span>
        <input type="text" id="gyzm" style="border: 1px solid #e4e3e3;font-size: 16px;height: 36px;padding: 0 10px;width: 200px;">        
        <button id="sendcode" onclick="sendyzm();" type="button" class="am-btn yzm">发送验证码</button>
      </div>
    </div>
    <div>
      <input type="hidden" id="yhqid">
      <button onclick="return apply();" style="width: 120px;margin: auto;color:#fff;background:#ED1B24" class="am-btn am-btn-default am-btn-block w-submit" type="submit">立即抢购</button>
      <div style="margin-top:10px;padding-left:110px;"><span id="yhqdesc"></span></div>
    </div>
  </div>
</div>
<script src="{:C('app_ui')}js/fe.js"></script>
<script src="{:C('app_ui')}js/common.js"></script>
<script src="{:C('app_ui')}js/detailV3.js"></script>
<script>
  require(['ershoufang/sellDetail/detailV3'],function(init){
    init({});
  });
  <?php
  if($userinfo){
  ?>
  function addguanzhu(){
    $("#guanzhu").attr("disabled", true);
    $.ajax({
      type: "POST",
      global: false, // 禁用全局Ajax事件.
      url: "/index.php?g=Member&m=User&a=addguanzhu",
      data: {
        username: {$userinfo.username},
        userid: {$userinfo.userid},
        title: "{$userinfo.nickname}",
        fromid: {$id},
        fromtable: "new",
        type: "新房"
      },
      dataType: "json",
      success: function (data) {
        if(data.success){
          $("#guanzhu").html("已关注");
		  $("#favCount").html(parseInt($("#favCount").html())+1);
        }else{
          alert("关注失败！");
          $("#guanzhu").removeAttr("disabled");
          return false;
        }
      }
    });
  }
  <?php
  }
  ?>
  $(document).ready(function () {
	   //点击
	$.get("{$config_siteurl}api.php?m=Hits&catid={$catid}&id={$id}", function (data) {
	    $("#hits").html(data.views);
	}, "json");
    //最新动态
    getdtlist();
    
    // 百度地图
    var map = new BMap.Map("l-map");            // 创建Map实例
    var mPoint = new BMap.Point({$jingweidu});
    map.enableScrollWheelZoom();
    map.centerAndZoom(mPoint,15);
	
	var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
	var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
	map.addControl(top_left_control);        
	map.addControl(top_left_navigation);

    // 复杂的自定义覆盖物
    function ComplexCustomOverlay(point, text){
      this._point = point;
      this._text = text;
    }
    ComplexCustomOverlay.prototype = new BMap.Overlay();
    ComplexCustomOverlay.prototype.initialize = function(map){
      this._map = map;
      var div = this._div = document.createElement("div");
      div.style.position = "absolute";
      div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
      div.style.backgroundColor = "#EE5D5B";
      div.style.border = "1px solid #BC3B3A";
      div.style.color = "white";
      div.style.height = "24px";
      div.style.padding = "2px";
      div.style.lineHeight = "18px";
      div.style.whiteSpace = "nowrap";
      div.style.MozUserSelect = "none";
      div.style.fontSize = "12px"
      var span = this._span = document.createElement("span");
      div.appendChild(span);
      span.appendChild(document.createTextNode(this._text));
      var that = this;

      var arrow = this._arrow = document.createElement("div");
      arrow.style.background = "url(http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png) no-repeat";
      arrow.style.position = "absolute";
      arrow.style.width = "11px";
      arrow.style.height = "10px";
      arrow.style.top = "22px";
      arrow.style.left = "10px";
      arrow.style.overflow = "hidden";
      div.appendChild(arrow);
      map.getPanes().labelPane.appendChild(div);

      return div;
    }
    ComplexCustomOverlay.prototype.draw = function(){
      var map = this._map;
      var pixel = map.pointToOverlayPixel(this._point);
      this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
      this._div.style.top  = pixel.y - 30 + "px";
    }
    var myCompOverlay = new ComplexCustomOverlay(mPoint, "{$title}");

    map.addOverlay(myCompOverlay);
	
	//全景控件
	var stCtrl = new BMap.PanoramaControl(); //构造全景控件
	stCtrl.setAnchor(BMAP_ANCHOR_BOTTOM_LEFT);
	stCtrl.setOffset(new BMap.Size(20, 50));
	map.addControl(stCtrl);//添加全景控
    //周边配套
    var local =  new BMap.LocalSearch(map, {renderOptions: {map: map, autoViewport: false, panel: "r-result"}});

    local.searchNearby('公交',mPoint,1000);

    $("#around li").click(function(){
		var txt = $(this).text();
		if(txt=="地铁"){
			txt="地铁站";	
			local.searchNearby(txt,mPoint,3000);
		}else{
			local.searchNearby(txt,mPoint,1000);
		}
      
      $(this).addClass("select").siblings().removeClass("select");
    });
  });
    
  function getdtlist(){
    $.ajax({
      type: "POST",
      global: false, // 禁用全局Ajax事件.
      url: "/index.php?g=Api&m=House&a=getlpdt",
      data: {
        new_id: {$id}
      },
      dataType: "json",
      success: function (data) {
        var i=1;
		var str = "";
        for(name in data){
          if(i>2 || name == "state"){
            continue;
          }
          str+=
              '<div class="dynamic-wrap-block clearfix">'
              +'<span class="am-badge am-badge-primary am-fl">'+data[name].biaoqian+'</span>'
              +'<div class="dynamic-block-detail">'
              +'<div class="dongtai-title">'+data[name].title+'</div>'
              +'<span class="dynamic-detail-info-full">'
              +data[name].description
              +'</span>'
              +'<div class="dynamic-detail-time">'
              +'<span>'+data[name].inputtime+'</span>'
              +'</div>'
              +'</div>'
              +'</div>';
          i++;
        }
		if(str == ""){
			$("#dtlist").html('<div class="nocomment">暂时还没有动态哦~</div>');
		}else{
			$("#dtlist").html(str);
		}
		
      }
    });
  }
  
  <?php if($hasyhq && $hasyhq == 1){?>
function chg(id,text,desc){
	$("#yhqid").val(id);
	$("#yhqname").html(text);
	if(desc == ""){
	$("#yhqdesc").html("");
	}else{
	$("#yhqdesc").html("使用说明："+desc);	
	}
}
<?php }?>

function clear(){
	$("#my-popup .icon").remove();
}
var $name = $("#gname");
var $mname = $("#mgname");
var $tel = $("#gtel");
var $mtel = $("#mgtel");
var $sendcode = $("#sendcode");
var $yzm = $("#gyzm");
var $myzm = $("#mgyzm");
var pat = /(^1[3|4|5|7|8][0-9]{9}$)/;
var pat1 = /(^\d{6}$)/;
//验证码倒计时
var countdown=60;
$sendcode.removeAttr("disabled");
function settime() { 			
	if (countdown == 0) { 
		$sendcode.removeAttr("disabled");    
		$sendcode.html("发送验证码"); 
		countdown = 60; 
		return;
	} else { 
		$sendcode.attr("disabled", true); 
		$sendcode.html("已发送(" + countdown + ")"); 
		countdown--; 
	}			
	setTimeout(function(){settime();},1000);			 
}
//发送验证码
function sendyzm(){
	var err = false;
	if($.trim($name.val()) == ""){
		$mname.html("<span class='icon'>×</span>");	
		err = true;
	}	
	if(err){
		setTimeout(function(){
			clear();	
		},2000);
	}else{
		//发送验证码
		$.ajax({
			type: "POST",
			global: false, // 禁用全局Ajax事件.
			url: "/index.php?g=api&m=sms&a=getyzm_hd",
			data: {
				mob: '<?php echo $userinfo['username'];?>'
			},
			dataType: "json",
			success: function (data) {
				if(data.success == 11){
					//倒计时
					$sendcode.attr("disabled", true);
					settime();
				}
			}				
		});
	}
}
function apply(){
	var err = false;
	if($.trim($name.val()) == ""){
		$mname.html("<span class='icon'>×</span>");	
		err = true;
	}
	if($.trim($tel.val()) == ""){
		$mtel.html("<span class='icon'>×</span>");	
		err = true;
	}else if(!pat.exec($.trim($tel.val()))){
		$mtel.html("<span class='icon'>×</span>");
		err = true;	
	}
	if($.trim($yzm.val()) == ""){
		$myzm.html("<span class='icon'>×</span>");	
		err = true;
	}else if(!pat1.exec($.trim($yzm.val()))){
		$myzm.html("<span class='icon'>×</span>");
		err = true;	
	}
	if(err){
		setTimeout(function(){
			clear();
		},2000);		
	}else{
		//购买优惠券
		<?php if($userinfo){?>
		$.ajax({
			type: "POST",
			global: false, // 禁用全局Ajax事件.
			url: "/index.php?g=api&m=house&a=coupon_add",
			data: {
				"house_id":<?php echo $id;?>,
				"coupon_id":$("#yhqid").val(),
				"userid":<?php echo $userinfo['userid'];?>,
				"buyname":$("#gname").val(),
				"buytel":$("#gtel").val(),
				"yzm":$("#gyzm").val(),
				"username":<?php echo $userinfo['username'];?>
			},
			dataType: "json",
			success: function (data) {
				if(data.success == 67){
					alert(data.info);
					window.location.href="/index.php?g=Api&m=Api&a=yhq_pay&id="+data.id;				
				}else{
					alert(data.info);
				}
			}
		});
		<?php }?>
	}	
}
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>