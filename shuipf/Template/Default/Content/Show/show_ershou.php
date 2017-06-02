<?php
$userinfo = $this -> userinfo = service("Passport") -> getInfo();
$back = urlencode(get_url());
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

<div class="header">
  <div class="menu clear">
    <div class="menuLeft"><a href="/" ><span class="logo"></span><span class="channelName">二手房</span></a>
      <ul class="typeList">       
        <li ><a target="_blank" href="/index.php?m=map&a=es">地图找房</a></li>
      </ul>
    </div>
    <div class="search">
      <div class="input" log-mod="search">
          <input type="text" onkeydown="if(event.keyCode==13){window.location.href='/index.php?a=lists&catid=6&kwds='+$(this).val();};" id="searchInput" placeholder="请输入关键字搜索" autocomplete="off">
          <button onClick="window.location.href='/index.php?a=lists&catid=6&kwds='+$('#searchInput').val();" type="button" class="searchButton">&nbsp;<i class="am-icon-sm am-icon-search"></i>&nbsp;</button>
        <div class="searchMsg" id="searchMsgContainer"></div>
      </div>
    </div>
  </div>
</div>
<div class="sellDetailHeader">
  <div class="title-wrapper" log-mod="detail_header">
    <div class="content">
      <div class="title">
        <h1 class="main">{$title}</h1>
        <div class="sub">{$desc}</div>
      </div>
      <div class="btnContainer ">
        <div>
          <?php

          if($userinfo){
			if($userinfo['modelid'] == 35){
            	if($userinfo['username'] != $username){

				  $gz = isGZ($id,"ershou", $userinfo['username']);
				  if($gz){
	
					echo '<button class="followbtn">已关注</button>';
	
				  }else{
	
					echo '<button onclick="addguanzhu();" class="guanzhu followbtn">关注房源</button>';
	
				  }
	
				}
			}
          }else{

            echo '<a style="padding-top:10px;" href="index.php?g=Member&a=login&back='.$back.'" class="followbtn">关注房源</a>';

          }

          ?>
        </div>
        <div class="notice-num"><span id="favCount"><?php echo gznum($id,"ershou");?></span>人已关注</div>
      </div>
    </div>
  </div>
</div>
<link href="/statics/icheck/skins/square/red.css" rel="stylesheet">
<script src="/statics/icheck/icheck.js"></script>
<div class="am-popup" id="my-popup" style="height: 245px;background-color: #F8F8F8;">
  <div class="am-popup-inner">
    <div class="am-popup-hd">
      <h4 class="am-popup-title">预约看房</h4>
      <span data-am-modal-close

            class="am-close">&times;</span> </div>
    <div class="am-popup-bd" style="margin-left:20%">
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">看房日期：</span>
        <input type="radio" name="yuyuedate" class="reg_type" value="<?php echo date("Y-m-d");?>" checked> 今天&nbsp;&nbsp;&nbsp;
 <input type="radio"  name="yuyuedate" class="reg_type" value="<?php echo date("Y-m-d",strtotime("+1 day"));?>"> 明天&nbsp;&nbsp;&nbsp; 
 <input type="radio"  name="yuyuedate" class="reg_type" value="<?php echo date("Y-m-d",strtotime("+2 day"));?>"> 后天
        </div>
      <div> <span style="display: inline-block;width: 100px;margin-bottom: 15px">看房时间段：</span>
      <select id="yuyuetime1" data-am-selected>
          <option value="09:00-12:00">09:00-12:00</option>
          <option value="13:00-15:00">13:00-15:00</option>
        </select>
      </div>
    </div>
    <div>
      <button style="width: 120px;margin: auto;color:#fff;background:#ED1B24" onclick="return check()" class="am-btn am-btn-default am-btn-block w-submit" type="submit">立即预约</button>
    </div>
  </div>
</div>
<script>
$('.reg_type').iCheck({
	radioClass: 'iradio_square-red',
	increaseArea: '20%' // optional
});
</script>
</div>
<div class="intro clear" mod-id="lj-common-bread">
  <div class="container">
    <div class="l-txt"><a href="{$config_siteurl}">首页</a><span class="stp">&nbsp;>&nbsp;</span>
      <navigate catid="$catid" space=" &gt; " />
      <span class="stp">&nbsp;>&nbsp;</span><span>当前房源</span>&nbsp;</div>
  </div>
</div>
<div class="overview">
  <div id="topImg" class="img">
    <div class="imgContainer"> <img src="/statics/default/images/defaultpic.gif" class="new-default-icon" style="display: block;"> <span style="display: block;"></span> </div>
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
  <div class="content">
    <div class="price "> <span class="total">{$zongjia}</span> <span class="unit"><span>万</span></span>
      <div class="text">
        <div class="unitPrice"> <span class="unitPriceValue">
          <?php  echo ceil($zongjia*10000/$jianzhumianji)?>
          <i>元/平米</i></span> </div>
      </div>
      <div style="vertical-align: 12px" class="text">
        <span class="am-badge am-badge-primary"><if condition="$zaishou eq 1">在售<else />已售出</if></span>
      </div>
      <div class="removeIcon"></div>
    </div>
    <div class="houseInfo">
      <div class="room">
        <div class="mainInfo"><if condition="$shi eq 6">5室以上<else/>{$shi}室</if>{$ting}厅</div>
        <div class="subInfo">{$ceng}/共{$zongceng}层</div>
      </div>
      <div class="type">
        <div class="mainInfo">{$chaoxiang}</div>
        <div class="subInfo">{$jiegou}/{$zhuangxiu}</div>
      </div>
      <div class="area">
        <div class="mainInfo">{$jianzhumianji}平米</div>
        <div class="subInfo">{$fangling}年房/板塔结合</div>
      </div>
    </div>
    <div class="aroundInfo">
      <div class="communityName"> <i></i> <span class="label">小区名称</span> <span class="info">{$xiaoqu|getxiaoquName=###}</span></div>
      <div class="areaName"> <i></i> <span class="label">所在区域</span> <span class="info">{$city|getareaName=###} {$area|getareaName=###}</span> </div>
      <div class="visitTime"> <i></i> <span class="label">看房时间</span> <span class="info">提前预约随时可看</span>
        <?php

        if($userinfo){

          if($userinfo['username'] != $username){

            $yy = isYY($id,"ershou", $userinfo['username']);

            if($yy==1){

              echo '<button class="am-btn am-btn-xs">已预约</button>';

            }else{
				if($userinfo['modelid'] == 35 && $zaishou == 1){
					echo '<button id="yuyue" class="am-btn am-btn-xs" type="button" data-am-modal="{target: \'#my-popup\'}" >立即预约</button>';
				}
             }

          }

        }else{
		if($zaishou == 1){
          echo '<a href="index.php?g=Member&a=login&back='.$back.'" class="am-btn am-btn-default am-btn-xs">立即预约</a>';
		  }

        }

        ?>
      </div>
      <div class="houseRecord"> <span class="label">房源编号</span> <span class="info">
      {$bianhao}</span> </div>
      <div class="houseRecord"> <span class="label">发布时间</span> <span class="info">{$inputtime|date="Y-m-d",###} </span> </div>
    </div>
    <div class="brokerInfo clear"> 
    <a class="fl LOGVIEW LOGCLICK" target="_blank" href="
    <if condition="$lxr['modelid'] eq 36">
    /index.php?m=jingjiren&a=show_jjr&id={$lxr.userid}
    <else />
    javascript:;
    </if>"> 
    <img src="/d/file/avatar/000/00/00/{$lxr.userid}_180x180.jpg" onError="this.src='/statics/extres/member/images/noavatar.jpg';"></a>
      <div class="brokerInfoText fr">
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
          {$yezhushuo}
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
<div class="agboxB">
  <div class="agbox">
    <div class="myAgent">
      <div class="topinfor clear"> <span class="fl">联系人</span> </div>
      <div id="diamondAgent">
        <div class="brokerInfoFixed"> 
        <a href="
        <if condition="$lxr['modelid'] eq 36">
        /index.php?m=jingjiren&a=show_jjr&id={$lxr.userid}
        <else />
        javascript:;
        </if>
        " class="agent_item_url LOGCLICK" target="_blank">
        <img src="/d/file/avatar/000/00/00/{$lxr.userid}_180x180.jpg" onError="this.src='/statics/extres/member/images/noavatar.jpg';">
        </a>
          <div class="brokerInfoText">
            <div class="brokerName"> 
            <a href="<if condition="$lxr['modelid'] eq 36">
        /index.php?m=jingjiren&a=show_jjr&id={$lxr.userid}
        <else />
        javascript:;
        </if>" class="name LOGCLICK">{$lxr.realname}</a>
            <if condition="$lxr['modelid'] eq 36">
            <span class="tag first" >
        <switch name="lxr.dj">
        <case value="1">普通经纪人</case>
        <case value="2">优秀经纪人</case>
        <case value="3">高级经纪人</case>
        <case value="4">资深经纪人</case>
        <default />普通经纪人
    	</switch>
        </span></if>
        <if condition="$lxr['jiav'] eq 1">
        &nbsp;<img style="background:none;width:14px;height:14px;border-radius:0;margin-bottom:10px;" src="{:C('app_ui')}images/v.png">
        </if>
        </div>
            <div class="evaluate">{$yezhushuo}</div>
            <div class="phone">
            <if condition="$lxr['modelid'] eq 35">
                <if condition="($hidetel eq '保密') AND ($lxr['zhuanjie'] eq 1) AND ($lxr['vtel'] neq '')">
            	{:cache('Config.tel400')} 转 {$lxr.vtel}
            	<else />{$lxr.username}</if>
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
      </div>
      <?php

          if($userinfo){
			if($userinfo['modelid'] == 35){
	
				if($userinfo['username'] != $username){
	
				  $gz = isGZ($id,"ershou", $userinfo['username']);
	
				  if($gz){
	
					echo '<div class="myfollow myfollowcss followbtn">已关注</div>';
	
				  }else{
	
					echo '<div class="guanzhu myfollow myfollowcss followbtn" onclick="addguanzhu();">关注房源</div>';
	
				  }
	
				}
			}

          }else{

            echo '<a href="index.php?g=Member&a=login&back='.$back.'" class="myfollow myfollowcss followbtn">关注房源</a>';

          }

          ?>
      
      <div class="myline"></div>
      <div class="looknum"><span id="haslook">已有{$views}人看过此房</span></div>
    </div>
  </div>

</div>
<div class="tab-wrap">
  <div class="panel-tab">
    <ul class="clear">
      <li><a href="#introduction" class="on">房源信息介绍</a></li>
      <li> <a href="#calculator" id="taxm">购房算账</a> </li>
      <li> <a href="#record">带看记录</a> </li>
      <li> <a href="#dealRecord">小区成交</a> </li>
      <li> <a href="#around">周边配套</a> </li>
    </ul>
  </div>
</div>

<div class="agboxB" style="display: none;">
  <div class="agbox"></div>
</div>
<div class="newwrap baseinform" id="introduction">
  <div class="" style="width:700px;">
    <h2>
      <div class="title">基本信息</div>
    </h2>
    <div class="introContent">
      <div class="base">
        <div class="name">基本属性</div>
        <div class="content">
          <ul>
            <li><span class="label">房屋户型</span><if condition="$shi eq 6">5室以上<else/>{$shi}室</if><if condition="$ting eq 4">3厅以上<else/>{$ting}厅</if>{$chu}厨<if condition="$wei eq 4">3卫以上<else/>{$wei}卫</if></li>
            <li><span class="label">所在楼层</span>{$ceng} (共{$zongceng}层)</li>
            <li><span class="label">建筑面积</span>{$jianzhumianji}㎡</li>
            <li><span class="label">户型结构</span>{$jiegou}</li>
            <li><span class="label">套内面积</span>{$taoneimianji}㎡</li>
            <li><span class="label">建筑类型</span>{$jianzhutype}</li>
            <li><span class="label">房屋朝向</span>{$chaoxiang}</li>
            <li><span class="label">建筑结构</span>{$jianzhujiegou}</li>
            <li><span class="label">装修情况</span>{$zhuangxiu}</li>
            <li><span class="label">梯户比例</span>{$tihubili}</li>
            <li><span class="label">配备电梯</span>{$dianti}</li>
          </ul>
        </div>
      </div>
      <div class="transaction">
        <div class="name">交易属性</div>
        <div class="content">
          <ul>
            <li><span class="label">挂牌时间</span>{$guapaidate}</li>
            <li><span class="label">物业类型</span>{$jiaoyiquanshu}</li>
            <li><span class="label">上次交易</span>{$shangcijiaoyi}</li>
            <li><span class="label">房屋类型</span>{$fangwuyongtu}</li>
            <li><span class="label">产权所属</span>{$chanquansuoshu}</li>
            <li><span class="label">唯一住宅</span>{$isweiyi}</li>
            <li><span class="label">抵押信息</span>{$diyaxinxi}</li>
          </ul>
        </div>
      </div>
    </div>
    
    <!-- 房源特色 -->
    
    <div class="newwrap baseinform">
      <h2>
        <div class="title" style="margin-top:50px;">房源特色</div>
      </h2>
      <div class="introContent showbasemore">
        <div class="tags clear">
          <div class="name">房源标签</div>
          <div class="content">
            <?php

            $array = explode("、",$biaoqian);

            $i = 1;

            foreach ($array as $value) {

              if ($value != ''){

                echo '<span class="tag">' . $value . '</span>';

              }

              $i++;

            }

            ?>
          </div>
        </div>
         <if condition="$xiaoquintro neq ''">
			<div class="baseattribute clear">
			  <div class="name">小区介绍</div>
			  <div class="content">{$xiaoquintro}</div>
			</div>
		  </if>  

 		  <if condition="$huxingintro neq ''">
			<div class="baseattribute clear">
			  <div class="name">户型介绍</div>
			  <div class="content">{$huxingintro}</div>
			</div>
		  </if> 
        
        <if condition="$shenghuopeitao neq ''">
        <div class="baseattribute clear">
          <div class="name">周边配套</div>
          <div class="content">{$shenghuopeitao}</div>
        </div>
		  </if>
       
        <if condition="$xiaoquyoushi neq ''">
        <div class="baseattribute clear">
          <div class="name">小区优势</div>
          <div class="content">{$xiaoquyoushi}</div>
        </div>
		</if>
        
         <if condition="$xuexiaomingcheng neq ''">
        <div class="baseattribute clear">
          <div class="name">教育配套</div>
          <div class="content">{$xuexiaomingcheng}</div>
        </div>
		  </if>
        
         <if condition="$touzifenxi neq ''">
			<div class="baseattribute clear">
			  <div class="name">投资分析</div>
			  <div class="content">{$touzifenxi}</div>
			</div>
		  </if>
        
        <if condition="$hexinmaidian neq ''">
			<div class="baseattribute clear">
			  <div class="name">核心卖点</div>
			  <div class="content">{$hexinmaidian}</div>
			</div>
        </if>
        
        <if condition="$quanshudiya neq ''">
			<div class="baseattribute clear">
			  <div class="name">权属抵押</div>
			  <div class="content">{$quanshudiya}</div>
			</div>
		</if>
       <if condition="$jiaotong neq ''">
        <div class="baseattribute clear">
          <div class="name">交通出行</div>
          <div class="content">{$jiaotong}</div>
        </div>
		</if>
   		  <if condition="$shuifeijiexi neq ''">
			<div class="baseattribute clear">
			  <div class="name">税费解析</div>
			  <div class="content">{$shuifeijiexi}</div>
			</div>
		  </if> 
   		  <if condition="$zxdesc neq ''">
			<div class="baseattribute clear">
			  <div class="name">装修描述</div>
			  <div class="content">{$zxdesc}</div>
			</div>
		  </if>                                          
        <div class="viewmore">展开更多信息</div>
        <div class="disclaimer">！免责声明：入学情况仅凭历史经验总结，在此不承诺升学事宜，学区房标签仅供购房者参考。</div>
      </div>
    </div>
    
    <!-- 业主说 --> 
    
  </div>
  
  <!-- <div class="more">展开更多信息</div> --> 
  
</div>
<div class="newwrap">
  <div class="content-wrapper housePic">
    <h3>
      <div class="title">房源照片</div>
    </h3>
    <div class="container">
      <div class="list">
        <?php

        foreach ($pics as $value) {

          echo '<div data-index="'.$i.'"><img src="'.$value['url'].'" alt="'.$value['alt'].'"><span class="name">'.$value['alt'].'</span></div>';

        }

        ?>
        <div class="left_fix"></div>
        <div class="left_fix"></div>
      </div>
    </div>
    <div class="more">查看更多图片</div>
  </div>
</div>
<div class="newwrap">
  <div class="calculator" id="calculator">
    <div class="cal-title" id="calculatorTab">
      <div class="tax-tab select" data-target="#taxCalculator">
        <h3 class="title">购房算账</h3>
      </div>
    </div>
	    <div class="tax" id="taxCalculator">
      <div class="option">
       <div class="row">
          <label for=""><i class="am-icon-calculator"></i><a target="_blank" href="/index.php?g=content&m=calculate&a=fangdai"> 房贷计算器</a></label>
          <div class="content"></div>
        </div>
        <div class="row">
          <label for=""><i class="am-icon-calculator"></i><a target="_blank" href="/index.php?g=content&m=calculate&a=shuifei"> 税费计算器</a></label>
          <div class="content"></div>
        </div>
        <!--
        <div class="row">
          <label for="">卖房家庭唯一：</label>
          <div class="content">唯一</div>
        </div>
        <div class="row">
          <label for="">距上次交易：</label>
          <div class="content">满五年</div>
        </div>
        <div class="row">
          <label for="">买房家庭首套：</label>
          <div class="content">首套</div>
        </div>
        <div class="row">
          <label for="">计征方式：</label>
          <div class="content">总价</div>
        </div>
        <div class="row">
          <label for="">房屋面积：</label>
          <div class="content">76㎡</div>
        </div>
        <div class="row">
          <label for="">房屋总价：</label>
          <div class="content">236万元</div>
        </div>
        <div class="row">
          <label for="">转让税费：</label>
          <div class="content">2万元</div>
        </div>
      </div>
      <div class="tax-right">
        <div>
          <div class="row">
            <label for="">贷款类型：</label>
            <div class="content">商贷</div>
          </div>
          <div class="row">
            <label for="">贷款金额：</label>
            <div class="content">176万元</div>
          </div>
          <div class="row">
            <label for="">贷款期限：</label>
            <div class="content">30年</div>
          </div>
          <div class="row">
            <label for="">基准利率：</label>
            <div class="content">4.9%</div>
          </div>
          <div class="row">
            <label for="">利息：</label>
            <div class="content">1502516.72 元</div>
          </div>
          -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="newwrap">
  <div class="record" id="record">
    <div class="list">
      <div class="title">带看记录<span style="font-size:12px">(显示最新5条)</span></div>
      <?php
	  $k['fromid'] = $id;
	  $k['fromtable'] = 'ershou';
	  $k['lock'] = 1;		  
      $daikan=M('yuyue')->limit(5)->where($k)->order('inputtime desc')->select();
	  foreach($daikan as $x=>$v){
		  $aa['username']=$v['username'];
		  $uid=M('member')->where($aa)->getfield('userid');
		  $uname=M('member_normal')->where('userid='.$uid)->getfield('realname');
		  if($uname){
			$daikan[$x]['realname'] = $uname;
			 }else{
				 $daikan[$x]['realname']="***";
				}
		 }
		//获取总带看次数
	  $yy_ct=M('yuyue')->where($k)->count();
	  //获取近7天带看次数
	  $today=date("Y-m-d");
	  $time=strtotime($today." 00:00:00")-60*60*24*7;
	  $k['inputtime']=array('EGT',$time);
	  $seven_ct=M('yuyue')->where($k)->count();
	if(!$daikan){
		echo '<div>暂无</div>';
	}else{
		?>
      <div class="content">
      
        <div class="record-header">
          <div class="item mytime">带看日期</div>
          <div class="item mytime">带看时间</div>
          <div class="item mytime">看房人</div>
          <div class="item mytime">看房人电话</div>
        </div>
        <volist name="daikan" id="vo">
        <div class="row">
          <div class="item mytime">{$vo.yuyuedate}</div>
          <div class="item mytime">{$vo.yuyuetime}</div>
          <div class="item mytime"> {$vo.realname|substr_replace=###,'*',3,3} </div>
          <div class="item mytime">{$vo.username|substr_replace=###,'****',3,4}</div>
        </div>
        </volist>
      </div>
      <!--<div class="pagination"> <span class="pre disable">&lt;</span> <span class="next ">&gt;</span> </div>-->
      <?php
	}
	  ?>
    </div>
    <?php if($daikan){ ?>
    <div class="panel">
      <div class="panel-title">近7天带看次数</div>
      <div class="count">{$seven_ct}</div>
      <div class="totalCount">- 总带看<span>{$yy_ct}</span>次 -</div>
    </div>
    <?php
	}
	  ?>
  </div>
</div>
<div class="newwrap" style="margin-top:35px;">
  <div class="dealRecord" id="dealRecord">
    <div class="title"> <span class="resblockDeal">同小区成交记录</span> </div>
    <?php
    $tongqu = M('ershou')->where('xiaoqu='.$xiaoqu.' and zaishou=0 and area='.$area.' and id <> '.$id)->select();
	if(!$tongqu){
		echo '<div>暂无</div>';
	}else{
	?>
	<div id="resblockDeal">
      <div class="tableHeader">
        <div class="house">房屋户型</div>
        <div class="area">面积</div>
        <div class="date">签约日期</div>
        <div class="price">成交价</div>
        <div class="unitPrice">成交单价</div>
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
        <div class="area">{$vo1.jianzhumianji}㎡</div>
        <div class="date">{$vo1.updatetime|date='Y-m-d',###}</div>
        <div class="price">{$vo1.zongjia}万</div>
        <div class="unitPrice"><?php echo ceil($vo1['zongjia']*10000/$vo1['jianzhumianji'])?>元/平米</div>
        <div class="unitPrice"><if condition="($vo1.pub_type eq 1) AND ($vo1.jjr_id neq '')">经纪人<else/>业主</if></div>
      </div>
      </volist>      
       </div>
       <!--<a class="more" href="javascript:;">查看全部成交信息</a>-->
	<?php }?>
	
    
  </div>
</div>
<div class="newwrap">
  <div class="around" id="around">
    <h2>
      <div class="title">周边配套</div>
    </h2>
    <div class="content">
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
        <div class="map" id="l-map"> </div>
        <div class="list" id="r-result"> </div>
      </div>
    </div>
  </div>
</div>
<div id="pushContainer" log-mod="ershoufang_detail_recommend-ershoufang">
  <div class="newwrap">
    <div class="push">
      <div class="content">
        <div class="pushheader">
          <h3><span class="title">好房推荐</span></h3>
        </div>
        <position action="position" posid="6">
          <ul>
            <volist name="data" id="vo">
              <li>
                <div class="pic">
                  <a class="LOGCLICK" href="{$vo.data.url}" target="_blank">
                    <img src="{$vo.data.thumb}" class="new-default-icon">
                  </a>
                  <span>{$vo.data.zongjia}万</span>
                </div>
                <div class="htitle"> 
                  <span class="name">{$vo.data.title}</span> 
                </div>
                <div>
                  <span class="info">{$vo.data.shi}室{$vo.data.ting}厅/{$vo.data.jianzhumianji}平米</span> 
                </div>
                <div class="desc"> <span class="front"></span> <span class="back"></span> </div>
              </li>
            </volist>
          </ul>
        </position>
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

  <?php

  if($userinfo){

?>

  function addguanzhu(){

    $(".guanzhu").attr("disabled", true);
    $.ajax({

          type: "POST",

          global: false, // 禁用全局Ajax事件.

          url: "/index.php?g=Member&m=User&a=addguanzhu",

          dataType: "json",

          data: {

            username: "{$userinfo.username}",

          userid: {$userinfo.userid},

        title: "{$userinfo.username}",

        fromid: {$id},

    fromtable: "ershou",

        type: "二手房"

  },

    success: function (data) {

      if(data.success){

        $(".guanzhu").html("已关注");
		$("#favCount").html(parseInt($("#favCount").html())+1);

      }else{

        alert("关注失败！");

        $(".guanzhu").removeAttr("disabled");

        return false;

      }

    }

  });

  }

  function check(){

    var iswrong = false;

    var nowh = <?php echo (int)(date("H"));?>;
	if($("div[class='checked'] input").attr('id') == "d1"){
		if(nowh >= 15){
			alert("您预约的时间已经过去了哦~");
			var iswrong = true;
		}else if(nowh >=12 && $("#yuyuetime1 option:selected").index() == 0){
			alert("您预约的时间已经过去了哦~");
			var iswrong = true;
		}
	}
    if(!iswrong){

      $.ajax({

        type: "POST",

        url: "/index.php?g=Member&m=User&a=addyuyue",

        data: {

          fromuser: '<?php echo $lxr['username']?>',

          fromid: <?php echo $id?>,

          fromtable: "ershou",

          type: "二手房",

          zhuangtai: "新预约",

          yuyuedate: $("div[class='iradio_square-red checked'] input").val(),

          yuyuetime: $("#yuyuetime1").val()

        },

        dataType: "json",

        success: function (data) {

          if(data.success){
			  alert("预约成功");

            window.location.reload();

          }else{

            alert("预约失败");

            return false;

          }

        },

        error: function () {

          alert("预约失败");

          return false;

        }

      });

    }

  }

  <?php

  }

  ?>

</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>
