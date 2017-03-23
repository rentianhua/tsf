<!-- 右侧固定开始 -->
<div class="tb-toolbar">
<div class="tb-toolbar-space" style="height: 30%;"></div>
<ul class="tb-toolbar-list tb-toolbar-list-with-worthbuying tb-toolbar-list-with-cart tb-toolbar-list-with-history tb-toolbar-list-with-coupon">
<li class="tb-toolbar-item tb-toolbar-history" data-item="history"> <a href="#" class="tb-toolbar-item-hd"> 
  <span class="am-icon-md am-icon-download"></span> 
  <div class="tb-toolbar-item-tip" style="height: 120px;width: 96px; left: -97px;padding-top:8px;">
   <img onclick="javascript:window.location.href='/index.php?a=lists&catid=16'" src="{:C('app_ui')}images/ewm.jpg" style="height: 80px;width: 80px;">
   <div>掌上淘深房</div>
   <div class="tb-toolbar-item-arrow">
  ◆
   </div>
  </div> </a> 
 <div class="tb-toolbar-item-bd tb-toolbar-loading"> 
 </div>
</li>
<li class="tb-toolbar-item tb-toolbar-history" data-item="history"> 
<div class="tb-toolbar-item-hd"> 
  <span class="am-icon-md am-icon-qq"></span> 
  <div class="tb-toolbar-item-tip" style="height: 165px;width: 115px; left: -114px;padding-top:8px;">
  <style>
  .w-qq{background:#0E90D2;color:#fff;height:20px;width:20px;line-height:17px;font-size:14px;}
  </style>
  <?php 
  $qq=cache('Config.qq');
  $qq = nl2br($qq);
  $list=explode("<br />", $qq); 
  foreach($list as $value){
	  $x=explode("|", $value);
	  echo '<a style="color:#fff !important;" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$x[0].'&site=qq&menu=yes">
   <span class="w-qq am-icon-btn am-icon-qq w-qq" alt="点击这里给我发消息" title="点击这里给我发消息"></span> '.$x[1].'</a><br>';
	}
  ?>
   <div class="tb-toolbar-item-arrow">
  ◆
   </div>
  </div> 
  </div> 
 <div class="tb-toolbar-item-bd tb-toolbar-loading"> 
 </div>
</li>
<li class="tb-toolbar-item tb-toolbar-item-coupon" data-item="coupon"> <a href="#" class="tb-toolbar-item-hd tb-toolbar-item-hd-coupon"> 
  <span class="am-icon-md am-icon-headphones"></span>
  <div class="tb-toolbar-item-tip tb-toolbar-item-tip-coupon" style="width: 125px;left:-125px;height:70px">
   <span style="font-size:16px">官方客服<br>{:cache('Config.hottel')}</span>
   <div class="tb-toolbar-item-arrow">
  ◆
   </div>
  </div> </a> 
 <div class="tb-toolbar-item-hd-extra"> 
  <div class="tb-toolbar-item-bubble tb-toolbar-item-bubble-coupon J_TBToolbarBubbleCoupon">
   <span class="tb-toolbar-item-arrow">◆</span>
   <span class="tb-toolbar-item-bubble-saw"></span>
  </div> 
 </div> 
 <div class="tb-toolbar-item-bd tb-toolbar-item-bd-coupon tb-toolbar-loading"></div>
</li>
</ul>
<div class="tb-toolbar-space" style="height: 7%;"></div>
<ul class="tb-toolbar-list tb-toolbar-list-with-feedback tb-toolbar-list-with-gotop">
<li class="tb-toolbar-item" data-item="gotop"> <a href="#" class="tb-toolbar-item-hd"> 
  <span class="am-icon-md am-icon-arrow-up"></span>
  <div class="tb-toolbar-item-tip">
   <span class="tb-toolbar-item-tip-text">返回顶部</span>
   <div class="tb-toolbar-item-arrow">
  ◆
   </div>
  </div> </a>
</li>
</ul>
</div>
<!-- 右侧固定结束 -->