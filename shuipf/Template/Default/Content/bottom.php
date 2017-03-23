<!-- 底部开始 -->
<div style="background: #fff;margin-top:50px;">
<footer class="footer w-content" style="padding: 40px 0;">
<div class="am-g">

<content action="category" catid="32"  order="listorder ASC" >
            <volist name="data" id="vo">         
  <div class="am-u-sm-2">
    <div class="am-slider-desc am-w-slider">
      <div class="am-slider-content">
        <h2 class="am-slider-title">{$vo.catname}</h2>
        <content action="lists" catid="$vo['catid']"  order="listorder ASC" >
            <volist name="data" id="vo2">         
        <div><a href="{$vo2.url}">{$vo2.title}</a></div>
        </volist>
         </content>
         
      </div>
    </div>
  </div>
           </volist>
         </content>
         <div class="am-u-sm-2">
    <div class="am-slider-desc am-w-slider">
      <div class="am-slider-content">
        <h2 class="am-slider-title">合作伙伴</h2>
        <div><a href="/index.php?g=Member&a=login">业主房东</a></div>
        <div><a href="/index.php?a=lists&catid=17">中介经纪</a></div>      </div>
    </div>
  </div>
  <div class="am-u-sm-4">
    <div class="am-slider-desc am-w-slider">
      <div class="am-slider-content">
        <h2 class="am-slider-title">联系我们</h2>
        <div><a href="mailto:{:cache('Config.siteemail')}">客服邮箱：{:cache('Config.siteemail')}</a></div>
        <div>客服热线：{:cache('Config.hottel')}</div>
        <div>工作时间：{:cache('Config.worktime')}</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-2">
    <img style="width:120px;height:120px;" src="{:C('app_ui')}images/ewm.jpg">
  </div>
</div>
<div class="am-container">
  <br>
   Copyright By 淘深房 ©2016 深圳市瑞安兴业房地产顾问有限公司 
	&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44030602000320"><img src="{:C('app_ui')}images/beian.png"/>粤公网安备 44030602000320号</a>&nbsp;&nbsp;&nbsp;
   粤ICP备16061979号-1
   
</div>
</footer>
</div>
<!-- 底部结束 -->
