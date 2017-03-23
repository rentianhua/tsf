<template file="Wap/header.php"/>
<style>
.service-banner {
    height: 330px;
    background: url({:C('wap_ui')}images/weituo1.jpg) no-repeat 0 0;
    background-size: 100% auto;
}
.service-banner h2 {
    padding-top: 50px;
    font-size: 28px;
    color: #212121;
    text-align: center;
    margin-bottom: .32rem;
}
.service-banner a {
    display: block;
    width: 200px;
    height: 50px;
    text-align: center;
    line-height: 50px;
    margin: 30px auto;
    color: #fff;
    font-size: 20px;
    border-radius: 75pt;
}
.service-banner .phone {
    background: rgba(54,73,96,.9);
}
.service-banner .app {
    background: #ED1B24;
}
.service-banner p {
    font-size: .14rem;
    color: #212121;
    text-align: center;
}
.service-step {
    background: #fff;
    border-bottom: 1px solid #e7e7e7;
    padding: 32px 0;
	text-align:center
}
.service-step li b {
    display: table-cell;
    width: 40px;
    height: 40px;
    border: 3px solid #c7c7cc;
    border-radius: 75pt;
    float: left;
    text-align: center;
    font-size: 28px;
    color: #c7c7cc;
    box-sizing: border-box;
    background: #fff;
    line-height: 35px;
	margin-left:2rem
}
.service-step h2 {
    height: .125rem;
    border-bottom: 1px solid #e5e5e5;
    position: relative;
	margin-bottom:30px;
}
.service-step h2 p {
    position: absolute;
    background: #fff;
    text-align: center;
    line-height: .25rem;
    left: 107px;
    top: 0;
	font-size:20px;
}
.service-step li{
	list-style:none;	
}
.service-step li .title {
    display: table-cell;
    vertical-align: middle;
    padding-left: 5px;
	height:40px;
}
.service-step .title h3 {
    font-size: 16px;
    text-align: left;
	margin-bottom:5px;
}
.service-step .title h4 {
    font-size: 14px;
    color: #757575;
}
.service-step li img {
    width:250px;
}
</style>
<div class="service-banner">
  <h2><b>3</b>种委托通道任你挑</h2>
  <a class="phone" href="tel:{:cache('Config.tel400')}"><span class="mui-icon mui-icon-phone"></span>400-856-0008</a> 
  <a class="app" href="#">手机APP委托</a>
  <div style="text-align:center">或在电脑上登录 taoshenfang.com 进行委托</div>
</div>
<div class="service-step">
  <h2>
    <p>委托房源仅需三步</p>
  </h2>
  <ul>
    <li class="step1"> <b>1</b>
      <div class="title">
        <h3>提交房源信息</h3>
        <h4>选“二手房”或“出租房”,提交房源信息</h4>
      </div>
      <img src="{:C('wap_ui')}images/step1.jpg"> </li>
    <li class="step2"> <b>2</b>
      <div class="title">
        <h3>客服致电业主,验证房源真实性</h3>
      </div>
      <img src="{:C('wap_ui')}images/step2.jpg"> </li>
    <li class="step3"> <b>3</b>
      <div class="title">
        <h3>经纪人实地拍照/视频带客户上门</h3>
      </div>
      <img src="{:C('wap_ui')}images/step3.jpg"> </li>
  </ul>
</div>
<template file="Wap/footer.php"/>
