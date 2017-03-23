<?php 
if($jjr_id == 0){	//自售
	$u['username']=$username;
	$lxr=M('member')->where($u)->find();
	$k['userid']=$lxr['userid'];
	$realname=M('member_normal')->where($k)->getfield('realname');
}else{ //委托或经纪人自己发布
	$u['userid']=$jjr_id;
	$lxr=M('member')->where($u)->find();
	$realname=M('member_agent')->where($u)->getfield('realname');
}
?>
<template file="Wap/header.php"/>
  <link rel="stylesheet" href="{:C('wap_ui')}css/index.css">
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page page_ershoufang has_fixbar"> 
      
      <div class="content_area"> 
        <!--房源简介-->
        <?php
		$picstr="";
		$i=0;
			foreach ($pics as $k=>$value) {	
			$i++;		
				if($k == 0){
					$picstr.='{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				
				}else{
					$picstr.=',{"url":"'.$value['url'].'","type":"'.$value['alt'].'"}';
				}
			 }?> 
        <div class="mod_box house_head">
          <div class="pic_box">
            <ul class="pic_lists flexbox" style="width: <?php echo $i*100?>%;" data-act="viewImage" 
                data-info='[{$picstr}]'>
              <?php
			foreach ($pics as $value) {			
			echo '<li class="box_col"><img origin-src="'.$value["url"].'" src="/statics/default/images/defaultpic.gif" class="lazyload" alt="'.$value["alt"].'" /></li>';
			 }?>
            </ul>
            <div class="opt_bar"><a style="display: none;" href="javascript:;" class="map">地图</a><a   href="javascript:;" class="count"><span data-mark="img_index">1</span>/{$i}</a></div>
          </div>
          <div class="info_box">
            <div class="info_inner flexbox">
              <div class="box_col">
                <h1 class="house_title">{$title}</h1>
              </div>
            </div>
            <div class="house_price"><span class="total_price"><em>{$zujin}</em><small>元/月</small></span></div>
          </div>
        </div>
        <!--/房源简介--> 
        
        <!--房源具体信息-->
        <div class="mod_box house_detail">
          <ul class="lists">            
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">户型：</div>
                <div class="value box_col">{$shi}室{$ting}厅</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">面积：</div>
                <div class="value box_col">{$mianji}平</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">楼层：</div>
                <div class="value box_col">{$ceng}/{$zongceng}层</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">朝向：</div>
                <div class="value box_col">{$chaoxiang}</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">装修：</div>
                <div class="value box_col">{$zhuangxiu}</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">楼型：</div>
                <div class="value box_col">{$jianzhutype}</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">房龄：</div>
                <div class="value box_col">{$fangling}年</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">房源编号：</div>
                <div class="value box_col size_s">105100300120</div>
              </div>
            </li>
            <li class="li_item">
              <div class="tit">地铁：</div>
              <div class="value box_col">{$ditiexian|substr=###,0,-3}</div>
            </li>
            <li class="li_item arrow"> <a href="/sz/xiaoqu/2411049094015/" class="flexbox">
              <div class="tit">小区：</div>
              <div class="value box_col">{$xiaoqu|getxiaoquName=###}</div>
              </a> </li>
          </ul>
          <div class="detail_more" style="display: none;"><a href="">更多房源信息</a></div>
        </div>
        <!--/房源具体信息--> 
        
        <!--房源亮点-->
        <if condition="$liangdian neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">房源亮点</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$liangdian}</p>
          </div>          
        </div>
        </if>
        <!--/房源亮点--> 
        <!--小区介绍-->
        <if condition="$xiaoquintro neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">小区介绍</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$xiaoquintro}</p>
          </div>          
        </div>
        </if>
        <!--/小区介绍-->
        <!--户型介绍-->
        <if condition="$huxingjieshao neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">户型介绍</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$huxingjieshao}</p>
          </div>          
        </div>
        </if>
        <!--/户型介绍-->
        <!--装修描述-->
        <if condition="$zxdesc neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">装修描述</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$zxdesc}</p>
          </div>          
        </div>
        </if>
        <!--/装修描述-->
        <!--出租原因-->
        <if condition="$czreason neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">出租原因</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$czreason}</p>
          </div>          
        </div>
        </if>
        <!--/出租原因-->
        <!--周边配套-->
        <if condition="$shenghuopeitao neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">周边配套</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$shenghuopeitao}</p>
          </div>          
        </div>
        </if>
        <!--/周边配套-->
        <!--交通出行-->
        <if condition="$jiaotong neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">交通出行</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$jiaotong}</p>
          </div>          
        </div>
        </if>
        <!--/交通出行-->
        <!--业主说-->
        <if condition="$yezhushuo neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">业主说</h3>
          <div class="mod_cont gap">
            <p class="text threeline">{$yezhushuo}</p>
          </div>          
        </div>
        </if>
        <!--/业主说-->
                
        <!--看房记录-->
        <div class="mod_box house_record">
          <h3 class="mod_tit"><strong>看房记录</strong><small><i class="icon_bell"></i><span>最近一次带看：2016-08-29</span></small></h3>
          <div class="mod_cont">
            <div class="data flexbox">
              <div class="box_col"> <strong>49</strong> <small>本月带看次数</small> </div>
              <div class="box_col"> <strong>72</strong> <small>累计带看次数</small> </div>
            </div>
            <div class="detail_more"><a href="/sz/ershoufang/jilu/105100300120.html">查看更多详情</a></div>
          </div>
        </div>
        <!--/看房记录-->
        
        <div class="mod_box location">
          <h3 class="mod_tit"><a class="arrow" href="/index.php?g=wap&m=map&jwd={$jingweidu}">位置及周边</a></h3>
          <div class="mod_cont"> <a href="/index.php?g=wap&m=map&jwd={$jingweidu}">
            <div class="location_desc">地址：{$city|getareaName=###}/{$area|getareaName=###}/{$xiaoqu|getxiaoquName=###}</div>
            <img class="lazyload" src="//api.map.baidu.com/staticimage?center={$jingweidu}&amp;width=334&amp;height=253&amp;markers={$jingweidu}|{$jingweidu}&amp;zoom=15" origin-src="//api.map.baidu.com/staticimage?center={$jingweidu}&amp;width=334&amp;height=253&amp;markers={$jingweidu}|{$jingweidu}&amp;zoom=15" data-listen="1"> </a> </div>
        </div> 
        <div class="mod_box house_lists">
          <h3 class="mod_tit">同小区成交（17）</h3>
          <div class="mod_cont"> <a href="/sz/chengjiao/105100330393.html" class="pictext flexbox">
            <div class="mod_media">
              <div class="media_main"> <img class="lazyload" src="/statics/default/images/defaultpic.gif" origin-src="" alt="万科金域华府 2室2厅 89平"> </div>
            </div>
            <div class="item_list">
              <div class="item_main text_cut">万科金域华府 2室2厅 89平</div>
              <div class="item_minor"><span class="info">2室2厅  89m²  东南</span></div>
              <div class="item_other"><span class="dea3.90625remce">签约价格：67070元/平</span><span class="price_total">600万</span></div>
              <div class="item_other"><span class="deal_time">签约时间：2016-08-04</span></div>
            </div>
            </a>
            <div class="detail_more"><a href="/sz/xiaoqu/2411049094015/chengjiao/">查看更多成交详情</a></div>
          </div>
        </div>        
      </div>
      
      <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部-->
      
      <div class="fixed_bar fixed_opt flexbox">
        <div class="pictext flexbox">
          <div class="mod_media"> <a href="/sz/jingjiren/1000000020153623/" data-act="headimg" data-query="ucid=1000000020153623"><img onError="this.src='/statics/extres/member/images/noavatar.jpg';" src="/d/file/avatar/000/00/00/{$lxr.userid}_180x180.jpg" alt=""></a> </div>
          <div class="box_col item_list">
            <div class="item_main text_cut">{$realname}</div>
            <div class="item_minor">
            <if condition="$pub_type eq 1"> <!--自售-->
            	<if condition="$hidetel eq '公开'">
                {$username}
                <else /> <!--隐藏手机号-->
                    <?php 
					if($lxr['vtel']==''){
						echo $lxr['username'];
					}else{
						?>
						{:cache('Config.tel400')}转{$lxr.vtel}
                        <?php
					}
					?>
                </if>
            <else /> <!--委托-->
            	<if condition="$lxr['vtel'] eq ''"> <!--未申请转机号-->
                {$lxr.username}
                <else />
                {:cache('Config.tel400')}转{$lxr.vtel}
                </if>
            </if>            	
          </div>
          <a href="tel:<if condition="$lxr['vtel'] eq ''">{$lxr.username}<else />{:cache('Config.tel400')}{$lxr.vtel}</if>" class="plus">
          <div class="icon_con"><i class="icon_phone"></i></div>
          <p>致电</p>
          </a> <a href="javascript:;" class="plus" data-act="sendSMS" data-query="tel=<if condition="$lxr['vtel'] eq ''">{$lxr.username}<else />{:cache('Config.tel400')}转{$lxr.vtel}</if>&content=我想咨询房源：{$title}，{$mianji}㎡，{$zujin}元/月，请尽快与我联系。来自【手机淘深房】">
          <div class="icon_con"><i class="icon_news"></i></div>
          <p>短信</p>
          </a> </div>
      </div>
    </section>
    <!--/页面--> 
  </div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/index.js"></script>
<script>
$LMB.start('main_start','m_pages_ershoufangDetail');
</script>
</html>
