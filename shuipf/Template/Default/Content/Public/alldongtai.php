<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<style>
  .big-left {
    width: 1000px;
    margin:40px auto 0;
  }
  .dongtai-one {
    border-bottom: 1px solid #eeeeee;
    padding: 30px 0;
  }
  .litt {
    font-weight: bold;
    margin-bottom: 8px;
  }
  .litt .a-tag {
    background: #ED1B24 none repeat scroll 0 0;
    border-radius: 2px;
    color: #ffffff;
    display: inline-block;
    font-size: 12px;
    margin-right: 10px;
    padding: 2px 3px;
  }
  .litt .a-title {
    font-size: 16px;
    font-weight: normal;
    vertical-align: -2px;
  }
  .litt .a-time {
    color: #9c9fa1;
    display: inline-block;
    float: right;
    font-weight: normal;
    margin-top: 2px;
  }
  .a-word {
    line-height: 24px;
  }
  .a-word a {
    color: #9c9fa1;
  }
  .a-word a:hover {
    text-decoration: none;
  }

  .resb-name {
    color: #333333;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    margin-top: 13px;
  }
</style>
<div class="big-left">
  <div class="resb-name">全部楼盘动态</div>
  <volist name="list" id="vo">
    <div class="dongtai-one for-dtpic">
      <div class="litt">
        <span class="a-tag">{$vo.biaoqian}</span>
        <span class="a-title">{$vo.title}</span>
        <span class="a-time">{$vo.inputtime|date="Y-m-d H:m:s",###}</span>
      </div>
      <div class="a-word">{$vo.description}</div>
    </div>
  </volist>

  <!--<div class="dongtai-one for-dtpic">
    <div class="litt">
      <span class="a-tag">销售动态</span>
      <span class="a-title">东海国际公寓平层和复式在售</span>
      <span class="a-time">2016-07-18 13:27:19</span>
    </div>
    <div class="a-word"><a onclick="return false" href="/loupan/p_dhgjgyaaejt/dongtai/17137.html">东海国际公寓 目前在售76-200平2-4房精装公寓，其中平层公寓均价约10万/平，复式公寓均价约9万/平。</a></div>
  </div>-->
  <div page-data="{&quot;totalPage&quot;:1,&quot;curPage&quot;:1}" page-url="/loupan/p_dhgjgyaaejt/dongtai/pg{page}" comp-module="page" class="page-box house-lst-page-box">
  </div>
</div>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>