<template file="Wap/header.php"/>
      <link rel="stylesheet" href="{:C('wap_ui')}css/index.css">
      <style>      
	.icon_zixun,.icon_fenxiang{
	background-image: url("/statics/wap/images/sprite1.svg");
    background-repeat: no-repeat;
    background-size: 2rem 54.5rem;
    display: inline-block;
    height: 2rem;
    margin-bottom: -0.35rem; 
    transform: scale(0.5);
    width: 2rem;
	display: inline-flex;
    margin-right: 0.1rem;	
	margin-left:-0.5rem;
	vertical-align: bottom;
	}
	.icon_zixun {background-position: 0 -44.625rem;transform: scale(1)}
	.icon_fenxiang{background-position: 0 -13.125rem;transform: scale(1);margin:1.1rem 0 0 0}
	.footer{margin-bottom:3.8rem}
      </style>
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page page_zufang">      
      <div class="content_area"> 
        <!--房源简介-->
        	<?php
			 $picstr='{"url":"'.$thumb.'","type":""}';
			?> 
        <div class="mod_box house_head">
          <div class="pic_box">
            <ul class="pic_lists flexbox" style="width: 100%;" data-act="viewImage" 
                data-info='[{$picstr}]'>
                <li class="box_col"><img origin-src="{$thumb}" src="/statics/default/images/defaultpic.gif" class="lazyload" /></li>
            </ul>
            <div class="opt_bar"><a   href="javascript:;" class="count"><span data-mark="img_index">1</span>/1</a></div>
          </div>
          <div class="info_box">
            <div class="info_inner flexbox">
              <div class="box_col">
                <h1 class="house_title">{$title}</h1>
              </div>
            </div>
            <div class="house_price"><span class="total_price">勾地需付款<em>{$goudijine}</em><small>元</small></span></div>
          </div>
        </div>
        <!--/房源简介--> 
        
        <!--房源具体信息-->
        <div class="mod_box house_detail">
          <ul class="lists">            
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">所在地区：</div>
                <div class="value box_col">{$city|getareaName=###} {$area|getareaName=###}</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">面积：</div>
                <div class="value box_col">{$zhandimianji}平</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">合作方式：</div>
                <div class="value box_col">{$hezuofangshi}</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">使用年限：</div>
                <div class="value box_col">{$shiyongnianxian}年</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">物业类型：</div>
                <div class="value box_col">{$wuyetype}</div>
              </div>
              <div class="box_col flexbox">
                <div class="tit">预算金额：</div>
                <div class="value box_col">{$zongjia}万</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">联系人：</div>
                <div class="value box_col">{$contactname}</div>
              </div>
            </li>
            <li class="li_item">
              <div class="box_col flexbox">
                <div class="tit">位置：</div>
                <div class="value box_col">{$address}</div>
              </div>
            </li>
          </ul>
        </div>
        <!--/房源具体信息--> 
        <!--详细介绍-->
        <if condition="$content neq ''">
        <div class="mod_box house_intro">
          <h3 class="mod_tit">详细介绍</h3>
          <div class="mod_cont gap">
            {$content}
          </div>
        </div>
        </if>
        <!--/详细介绍-->               
      </div>
      
      <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部-->
      <div class="fixed_bar fixed_opt flexbox">
        <div class="pictext flexbox box_center_v">
          <div class="mod_media"> <a href="javascript:;" data-act="telphone" data-query="tel={:cache('Config.tel400')}"> <i class="icon_zixun"></i> </a> </div>
          <div class="box_col item_list"> <a href="javascript:;" data-act="telphone" data-query="tel={:cache('Config.tel400')}">
            <div class="item_main text_cut">免费咨询</div>
            </a> </div>
          <a href="javascript:;" class="plus" data-act="sendSMS" data-query="hasUrl=1tel=&content=这个大宗交易不错:{$title}。快来看看吧：">
          <div class="icon_con"><i class="icon_fenxiang"></i></div>
          </a> </div>
      </div>
    </section>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/index.js"></script>
<script>
$LMB.start('main_start','m_pages_ershoufangDetail');
</script>
</html>
