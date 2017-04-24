<?php
$userinfo = $this -> userinfo = service("Passport") -> getInfo();
if($jjr_id == 0){	//用户自售
	$u['username'] = $username;
	$lxr = M('member')->where($u)->find();
	$lxr['realname'] = M('member_normal')->where('userid='.$lxr['userid'])->getfield('realname');
}else{ //委托或经纪人发布
	$u['userid'] = $jjr_id;
	$lxr = M('member')->where($u)->find();
	$r = M('member_agent')->where('userid='.$lxr['userid'])->field('realname,dengji,jiav')->find();
	$lxr['realname'] = $r['realname'];
	$lxr['dengji'] = $r['dengji'];
	$lxr['jiav'] = $r['jiav'];
}
?>
<template file="Content/header.php"/>

<template file="Content/nav.php"/>

<link rel="stylesheet" href="{:C('app_ui')}css/common.css">

<link rel="stylesheet" href="{:C('app_ui')}css/detailV3.css">

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=qphEBA2YbUeePcowUS1ONiALbXLdGuGT"></script>

<div class="intro clear" mod-id="lj-common-bread">

  <div class="container">

    <div class="l-txt"><a href="{$config_siteurl}">首页</a><span class="stp">&nbsp;>&nbsp;</span><navigate catid="$catid" space=" &gt; " /><span class="stp">&nbsp;>&nbsp;</span><span>当前房源</span>&nbsp;</div>

  </div>

</div>

<div style="width: 1150px;margin: auto" class="title-wrapper1">

  <div class="content">

    <div class="title">

      <h1 class="main">{$title}</h1>

      <div class="sub">{$desc}</div>

    </div>

    <div class="btnContainer" style="color: #aaa">

      浏览次数: {$views}

    </div>

  </div>

</div>

<div class="overview">

  <div id="topImg" class="img">

    <div class="imgContainer" style="height: 400px;"> <img src="/statics/default/images/defaultpic.gif" class="new-default-icon" style="display: block;"> <span style="display: block;">样板图</span> </div>

    <div id="thumbnail2" class="thumbnail">

      <div class="pre">&lt;</div>

      <ul class="smallpic">

        <?php

        foreach ($pics as $value) {

          echo '<li data-src="'.$value['url'].'" data-desc="'.$value['alt'].'"><img src="'.$value['url'].'"></li>';

        }

        ?>

        </ul>

      <div class="next">&gt;</div>

    </div>

  </div>

  <div style="margin-top:20px;" class="content zf-content">

    <div class="price ">

      <span class="total">{$zujin}</span>
		
      <span class="unit">

        <span>元/月</span>
		
      </span>
		<span class="am-badge am-badge-primary" style="margin:25px 0 0 15px;vertical-align:top"><if condition="$zaizu neq 1">已出租</if></span>
      <div class="removeIcon"></div>

    </div>

    <div class="zf-room">

      <p class="lf"><i>面积：</i>{$mianji}平米</p><p class="lf"><i>房屋户型：</i>{$shi}室{$ting}厅{$wei}卫  </p>

      <p class="lf"><i>楼层：</i>{$ceng} (共{$zongceng}层)</p><p class="lf"><i>房屋朝向：</i>{$chaoxiang}</p>
      
      <p class="lf"><i>发布时间：</i>{$inputtime|date="Y-m-d",###}</p><p class="lf"><i>房源编号：</i>{$bianhao}</p>

      <div class="clear"></div>

      <p><i>地铁：</i>{$ditiexian|substr=###,0,-3}</p>
     <!--  <p><i>地铁：</i>{$ditiexian}</p> -->
      <p><i>小区：</i>{$xiaoqu|getxiaoquName=###}</p>

      <p><i>位置：</i>{$city|getareaName=###} {$area|getareaName=###}</p>

    </div>
    <div class="brokerInfo" style="position:relative;">
      <a style="position:absolute;top:85px;" href="<if condition="$lxr['modelid'] eq 36">
    /index.php?m=jingjiren&a=show_jjr&id={$lxr.userid}
    <else />
    javascript:;
    </if>">
        <img style="margin-top: -64px;" src="/d/file/avatar/000/00/00/{$lxr.userid}_180x180.jpg" onError="this.src='/statics/extres/member/images/noavatar.jpg';" class="LOGCLICK">

      </a>

      <div class="brokerInfoText" style="margin-left:100px;">

        <div class="brokerName">

          <a href="<if condition="$lxr['modelid'] eq 36">
    /index.php?m=jingjiren&a=show_jjr&id={$lxr.userid}
    <else />
    javascript:;
    </if>" class="name LOGCLICK">{$lxr.realname}</a>
			<if condition="$lxr['modelid'] eq 36">
        <span class="tag first" >
        <switch name="lxr['dengji']">
        <case value="1">普通经纪人</case>
        <case value="2">优秀经纪人</case>
        <case value="3">高级经纪人</case>
        <case value="4">资深经纪人</case>
        <default />普通经纪人
    	</switch>
        </span></if>
        <if condition="$lxr['jiav'] eq 1">
        <img style="background:none;width:14px;height:14px;border-radius:0;margin-bottom:10px;" src="{:C('app_ui')}images/v.png">
        </if>
        </div>

        <div class="evaluate">

          <span class="rate">好评率：暂无</span>

          <!--<span class="time">本房带看：2次</span>-->

        </div>

        <div class="phone">
		<if condition="$lxr['modelid'] eq 35">
            <if condition="($hidetel eq '保密') AND ($lxr['zhuanjie'] eq 1)  AND ($lxr['vtel'] neq '')">
            {:cache('Config.tel400')} 转 {$lxr.vtel}
            <else />{$lxr.username}
            </if>
        <else />
        	<if condition="$lxr['vtel'] eq ''">
            {$lxr.username}
            <else />
            {:cache('Config.tel400')} 转 {$lxr.vtel}
            </if>
        </if>
        </div>

      </div>

    </div>

    <div style="margin: 20px 0;line-height: 20px">

      {$yezhushuo}

    </div>
    <br>
	<!-- Baidu Button BEGIN -->
    <style>#bdshare a{height:22px}#bdshare span{height:22px}.shareCount{width:42px !important;}</style>
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

</div>

<div class="tab-wrap">

  <div class="panel-tab">

    <ul class="clear">

      <li><a href="#introduction" class="on">房源介绍</a></li>

      <!--<li><a href="#brokerList">联系经纪人</a></li>-->

      <!--<li> <a href="#record">带看记录</a> </li>-->

      <li> <a href="#dealRecord">小区成交</a> </li>

      <li> <a href="#around">周边配套</a> </li>

      <li> <a href="#xiaoqu">小区环境</a> </li>

    </ul>

  </div>

</div>

<div class="agboxB" style="display: none;">

  <div class="agbox"></div>

</div>

<div id="introduction" class="newwrap content-wrapper introduction-wrapper">

  <div class="introduction">

    <div class="title">房源介绍</div>

    <div class="introContent">

      <div class="base">

        <div class="name">基本属性</div>

        <div class="content">

          <ul style="padding: 0;font-size:14px">

            <li><span class="label">租赁方式：</span>{$zulin}</li>

            <li>

              <span class="label">付款方式：</span>

              {$fukuan}

            </li>

          </ul>

        </div>

      </div>

      <div class="feature">

        <div class="name">房源特色</div>

        <div class="zf-tag">

          <ul class="se">

            <?php

            $fangwupeitao = str_replace(' 、',',',$fangwupeitao);

            $fangwupeitao = substr($fangwupeitao,0,-1);

            $array = explode(",",$fangwupeitao);

            foreach ($array as $value) {

              if($value == "床"){echo '<li class="tag1 tags"><span></span>床</li>';}

              if($value == "电视"){echo '<li class="tag2 tags"><span></span>电视</li>';}

              if($value == "冰箱"){echo '<li class="tag3 tags"><span></span>冰箱</li>';}

              if($value == "洗衣机"){echo '<li class="tag4 tags"><span></span>洗衣机</li>';}

              if($value == "空调"){echo '<li class="tag5 tags"><span></span>空调</li>';}

              if($value == "宽带"){echo '<li class="tag7 tags"><span></span>宽带</li>';}

              if($value == "家具"){echo '<li class="tag8 tags"><span></span>家具</li>';}

              if($value == "天然气"){echo '<li class="tag9 tags"><span></span>天然气</li>';}

              if($value == "热水器"){echo '<li class="tag10 tags"><span></span>热水器</li>';}

            }

            ?>

          </ul>

          <div class="clear"></div>

        </div>

        <div class="featureContent">

          <ul style="padding: 0">

            <if condition="$liangdian neq ''">

            <li>

              <span class="label">房源亮点：</span>

              <span class="text">{$liangdian}</span>

            </li>

            </if>

            <if condition="$huxingjieshao neq ''">

            <li>

              <span class="label">户型介绍：</span>

              <span class="text">{$huxingjieshao}</span>

            </li>

            </if>
            <if condition="$xiaoquintro neq ''">

            <li>

              <span class="label">小区介绍：</span>

              <span class="text">{$xiaoquintro}</span>

            </li>

            </if>

            <if condition="$zxdesc neq ''">

            <li>

              <span class="label">装修描述：</span>

              <span class="text">{$zxdesc}</span>

            </li>

            </if>

            <if condition="$czreason neq ''">

            <li>

              <span class="label">出租原因：</span>

              <span class="text">{$czreason}</span>

            </li>

            </if>

            <if condition="$jiaotong neq ''">

            <li>

              <span class="label">交通出行：</span>

              <span class="text">{$jiaotong}</span>

            </li>

            </if>

            <if condition="$shenghuopeitao neq ''">

            <li>

              <span class="label">周边配套：</span>

              <span class="text">{$shenghuopeitao}</span>

            </li>

            </if>

          </ul>

        </div>

      </div>

    </div>

  </div>

</div>

<!--<div class="newwrap">

<div id="brokerList" class="brokerList">

  <div class="content">

    <div>

      <span class="title">联系经纪人</span>

    </div>

    <ul>

      <li>

        <a href="#"><img data-log_index="1" data-el="1000000020220598" data-bl="agent" data-log_id="20001" class="LOGCLICK" alt="" src="#"></a>

        <div class="desc">

          <div class="title">

            <a data-log_index="1" data-el="1000000020220598" data-bl="agent" data-log_id="20001" class="name LOGCLICK" href="">胡霞</a>

            <a data-log_index="1" data-el="1000000020220598" data-bl="agentim" data-log_id="20001" data-ucid="1000000020220598" data-role="lianjiaim-createtalk" title="在线咨询" style="display: none;" class="lianjiaim-createtalkAll LOGCLICK">

            </a>

            <div class="rate"><span class="level">助理经纪人</span>好评率：100%</div>

          </div>

          <div class="phone">4008806527转7330</div>

        </div>

      </li>

      <li>

        <a href=""><img data-log_index="2" data-el="1000000020200992" data-bl="agent" data-log_id="20001" class="LOGCLICK" alt="" src=""></a>

        <div class="desc">

          <div class="title">

            <a data-log_index="2" data-el="1000000020200992" data-bl="agent" data-log_id="20001" class="name LOGCLICK" href="">陈丽</a>

            <div class="rate"><span class="level">助理经纪人</span>好评率：100%</div>

          </div>

          <div class="phone">4008099756转6409</div>

        </div>

      </li>

      <li>

        <a href=""><img data-log_index="3" data-el="1000000020243603" data-bl="agent" data-log_id="20001" class="LOGCLICK" alt="" src=""></a>

        <div class="desc">

          <div class="title">

            <a data-log_index="3" data-el="1000000020243603" data-bl="agent" data-log_id="20001" class="name LOGCLICK" href="">李娜</a>

            <div class="rate"><span class="level">经纪人</span>好评率：100%</div>

          </div>

          <div class="phone">4008015365转2150</div>

        </div>

      </li>

    </ul>

  </div>

</div>

</div>-->

<!--<div class="newwrap">

  <div id="record" class="record" style="width: 100%">

    <div class="list">

      <div class="title">带看记录</div>
      <div>暂无</div>

      <!--<div class="content cz_record">

        <div class="record-header">

          <div class="item mytime">带看时间</div>

          <div class="item myname">带看经纪人</div>

          <div class="item mytotal">本房总带看</div>

          <div class="phone" style="margin-left:12px;">咨询电话</div>

        </div>

        <div class="row">

          <div class="item mytime">2016-07-31</div>

          <div class="item agentName myname"> <a target="_blank" href="javascript:;"><img src="/statics/taosf/images/jjr1.jpg" alt=""> <span>张连娣</span></a> </div>

          <div class="item mytotal">3次</div>

          <div class="phone">4008160767转1825</div>

        </div>

      </div>

      <div class="pagination"> <span class="pre disable">&lt;</span> <span class="next ">&gt;</span> </div>

    </div>

    <div class="panel">

      <div class="panel-title">近7天带看次数</div>

      <div class="count">0</div>

      <div class="totalCount">- 总带看<span>0</span>次 -</div>

    </div>-->

  </div>

</div>
</div>

<div style="margin-top:35px;" class="newwrap">

  <div class="dealRecord" id="dealRecord">
    <div class="title"> <span class="resblockDeal">同小区成交记录</span> </div>
    <?php
    $tongqu = M('chuzu')->where('xiaoqu='.$xiaoqu.' and zaizu =0 and area='.$area.' and id <> '.$id)->select();
  if(!$tongqu){
    echo '<div>暂无</div>';
  }else{
  ?>
  <div id="resblockDeal">
      <div class="tableHeader">
        <div class="house">房屋户型</div>
        <div class="area">面积</div>
        <div class="date">签约日期</div>
        <div class="price">成交租金</div>
        <div class="unitPrice">成交来源</div>
      </div>
      <volist name="tongqu" id="vo1">
      <div class="row">
        <div class="house"> <a href="{$vo1.url}"><img src='
        <if condition="$vo1['thumb']">{$vo1.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>
        '></a>
          <div class="desc">
            <div class="frame"> {$vo1.shi}室{$vo1.ting}厅 </div>
            <div class="floor">{$vo1.ceng}/{$vo1.zongceng}层 {$vo1.chaoxiang} 其他</div>
            <span class="address">{$xiaoqu|getxiaoquName=###}</span> </div>
        </div>
        <div class="area">{$vo1.mianji}㎡</div>
        <div class="date">{$vo1.updatetime|date='Y-m-d',###}</div>
        <div class="price">{$vo1.zujin}元／月</div>
        <div class="unitPrice"><if condition="($vo1.pub_type eq 1) AND ($vo1.jjr_id neq '')">经纪人<else/>业主</if></div>
      </div>
      </volist>      
       </div>
       <!--<a class="more" href="javascript:;">查看全部成交信息</a>-->
  <?php }?>
  
    
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

      <div class="container">

        <div id="l-map" class="map"> </div>

        <div id="r-result" class="list"> </div>

      </div>

    </div>

  </div>

</div>

<div class="newwrap">

  <div class="around" id="xiaoqu" style="width:100%;">

    <h2>

      <div class="title">小区环境</div>

    </h2>

    <div class="content" style="width: 100%">

      <div class="container" style="height: 450px;">

        <div class="map" id="panorama"> </div>

      </div>

    </div>

  </div>

</div>

<div class="newwrap">

  <div class="mod-wrap">

    <div id="house-push" class="clear mod-panel">

      <h2>好房推荐</h2>

      <div class="img-list">

        <div class="show-content">

          <position action="position" posid="4">

            <ul>

              <volist name="data" id="vo">

                <li>

                  <a href="{$vo.data.url}" class="pic">

                    <img src="{$vo.data.thumb}">

                    <span class="tip">租金 {$vo.data.zujin} 元/月</span>

                  </a>

                  <a href="/loupan/p_hyjcaaknv/" class="house-name">{$vo.data.title}</a>
                  <div class="info">{$vo.data.shi}室{$vo.data.ting}厅  {$vo.data.mianji}平米</div> 
                </li>

              </volist>

            </ul>

          </position>

        </div>

      </div>



    </div>

  </div>

</div>

<div class="bigImg">

  <div class="mask"></div>

  <div class="list"> <img src="" alt="">

    <div class="loading"></div>

    <div class="pre"><span></span></div>

    <div class="next"><span></span></div>

  </div>

  <div class="close"></div>

  <div class="slide">

    <div class="desc"></div>

    <ul>

      <?php

      foreach ($pics as $value) {

        echo '<li data-src="'.$value['url'].'" data-desc="'.$value['alt'].'"><img src="'.$value['url'].'"></li>';

      }

      ?>

    </ul>

  </div>

</div>

<script src="{:C('app_ui')}js/fe.js"></script>

<script src="{:C('app_ui')}js/common.js"></script>

<script src="{:C('app_ui')}js/detailV3.js"></script>

<script>

  require(['ershoufang/sellDetail/detailV3'],function(init){

    init({});

  });

  $(document).ready(function () {
	   //点击
	$.get("{$config_siteurl}api.php?m=Hits&catid={$catid}&id={$id}", function (data) {
	    $("#hits").html(data.views);
	}, "json");


    // 周边配套

    var map = new BMap.Map("l-map");            // 创建Map实例

    var mPoint = new BMap.Point({$jingweidu});

    map.enableScrollWheelZoom();

    map.centerAndZoom(mPoint,15);

	var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
	var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
	map.addControl(top_left_control);        
	map.addControl(top_left_navigation);
	
	//全景控件
	var stCtrl = new BMap.PanoramaControl(); //构造全景控件
	stCtrl.setAnchor(BMAP_ANCHOR_BOTTOM_LEFT);
	stCtrl.setOffset(new BMap.Size(20, 50));
	map.addControl(stCtrl);//添加全景控

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

    //小区全景图

    var panorama = new BMap.Panorama('panorama');

    panorama.setPosition(new BMap.Point({$jingweidu})); //根据经纬度坐标展示全景图



  });

</script>

<template file="Content/bottom.php"/>

<template file="Content/footer.php"/>

<template file="Content/sidebar.php"/>