<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<div class="w-content">
<br>
<div>当前位置：<a href="{$config_siteurl}">{$Config.sitename}</a> &gt; <navigate catid="$catid" space=" &gt; " /></div><br>

<div style="border:1px solid #e4e3e3;font-size: 16px;line-height: 30px;padding: 30px;">

<h1>栏目列表</h1>
<content action="category" catid="32"  order="listorder ASC" >
            <volist name="data" id="vo">         

        <content action="lists" catid="$vo['catid']"  order="listorder ASC" >
            <volist name="data" id="vo2">         
        <div><a href="{$vo2.url}">{$vo2.title}</a></div>
        </volist>
         </content>
           </volist>
         </content>
</div>
</div>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>
