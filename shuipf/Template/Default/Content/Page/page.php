<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<style>
.max-wrapper {
    /*background-color: #f1f1f1;*/
    border-top: 1px solid #f1f1f1;
    clear: both;
    padding-bottom: 80px;
    position: relative;
    top: -1px;
}
.max-wrapper .wrapper {
    position: relative;
}
.wrapper {
    margin: 0 auto;
    width: 1000px;
}
.fl {
    float: left;
}
.max-wrapper .menu_fixed {
    position: fixed;
    top: 15px;
}
.max-wrapper .menu {
    background-color: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    width: 255px;
}
.max-wrapper .menu {
	background-color: #fff;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	width: 255px;
}
.max-wrapper ul {
	padding: 0;
	margin: 0;
}
.max-wrapper .menu li {
	border-bottom: 1px solid #f5f5f5;
	line-height: 60px;
	list-style: none;
}
.max-wrapper .menu li i {
	display: inline-block;
	height: 21px;
	margin-left: 22px;
	margin-right: 10px;
	position: relative;
	top: -3px;
	width: 21px;
}
.max-wrapper .menu li a {
	color: #555;
	font-size: 14px;
}
.max-wrapper .hover {
	background-color: #ED1B24;
	color: #fff;
}
.max-wrapper .menu .hover a {
    color: #fff;
}
.max-wrapper .count {
    background-color: #fff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    height: auto;
    min-height: 400px;
    padding: 30px 40px;
    position: relative;
    width: 728px;
}
.fr {
    float: right;
}
.max-wrapper .count .name {
    border-bottom: 1px solid #f5f5f5;
    color: #333;
    font-size: 22px;
    height: 75px;
}
.max-wrapper .count .contactUs {
    padding: 35px 0 20px;
}
.clear::after {
    clear: both;
    content: ".";
    display: block;
    font-size: 0;
    height: 0;
    line-height: 0;
    visibility: hidden;
}
.clear {
    display: block;
}
</style>

<div class="max-wrapper">
  <div class="wrapper">
  <br><div>当前位置：<a href="{$config_siteurl}">{$Config.sitename}</a> &gt; <navigate catid="$catid" space=" &gt; " /></div><br>
    <div class="fl menu menu_abs">
      <ul>     
        <content action="category" catid="18"  order="listorder ASC">
             <volist name="data" id="vo">
                <li class="aboutLj <?php if($vo['catid']==$_GET['catid']){echo "hover";}?>"><i class="am-icon-pagelines"></i>
                <a href="{$vo.url}">{$vo.catname}</a> 
                </li>
             </volist>
        </content>
         <content action="category" catid="19"  order="listorder ASC">
             <volist name="data" id="vo">
                <li class="aboutLj <?php if($vo['catid']==$_GET['catid']){echo "hover";}?>"><i class="am-icon-pagelines"></i>
                <a href="{$vo.url}">{$vo.catname}</a> 
                </li>
             </volist>
        </content>
         <content action="category" catid="20"  order="listorder ASC">
             <volist name="data" id="vo">
                <li class="aboutLj <?php if($vo['catid']==$_GET['catid']){echo "hover";}?>"><i class="am-icon-pagelines"></i>
                <a href="{$vo.url}">{$vo.catname}</a> 
                </li>
             </volist>
        </content>
      </ul>
    </div>
    <div class="count fr">
      <div class="name">{$title}</div>
      <div class="contactUs">
        {$content}
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>
