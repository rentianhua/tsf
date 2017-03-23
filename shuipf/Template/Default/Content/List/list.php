<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<content action="category" catid="32"  order="listorder ASC" >
            <volist name="data" id="vo">         

        <content action="lists" catid="$vo['catid']"  order="listorder ASC" >
            <volist name="data" id="vo2">         
        <div><a href="{$vo2.url}">{$vo2.title}</a></div>
        </volist>
         </content>
           </volist>
         </content>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>
