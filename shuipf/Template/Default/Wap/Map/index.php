<template file="Wap/header.php"/>
<link rel="stylesheet" href="{:C('wap_ui')}css/map_index.css">
<div class="wrapper">
	<div class="main_start" id="main_start">
		<!--页面-->
		<!--TODO here-->
        <section class="page page_map" style="height: 100%;width: 100%;">
 
	<div class="map" id="map-content" style="overflow: hidden;position: relative;z-index: 0;color: rgb(0, 0, 0);text-align: left;background-color: rgb(243, 241, 236);height: 160%;width: 160%;top: -30%;left: -30%;">
	    </div>
	<div class="types_container" data-mark="types_container">
		<div class="show_type" data-act="scroll">
		<a href="javascript:;" class="on" data-act="actSearch" data-query="type=教育&className=edu"><span class="type_icons edu"></span><p>教育</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=医院&className=hosp"><span class="type_icons hosp"></span><p>医院</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=地铁&className=subway"><span class="type_icons subway"></span><p>地铁</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=公交&className=bus"><span class="type_icons bus"></span><p>公交</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=银行&className=bank"><span class="type_icons bank"></span><p>银行</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=休闲&className=game"><span class="type_icons game"></span><p>休闲</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=购物&className=shop"><span class="type_icons shop"></span><p>购物</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=健身&className=sport"><span class="type_icons sport"></span><p>健身</p></a>
		<a href="javascript:;" data-act="actSearch" data-query="type=美食&className=eat"><span class="type_icons eat"></span><p>美食</p></a>
		</div></div>
</section>		<!--/页面-->
	</div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/map_all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/map_index.js"></script>
<script>
global_jjd = "<?php echo $_GET['jwd']?>";
$LMB.start('main_start','m_pages_mapPos');
</script>
</html>
