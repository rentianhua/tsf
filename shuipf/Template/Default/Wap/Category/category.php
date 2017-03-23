<template file="Wap/header.php"/>
<link rel="stylesheet" href="{:C('wap_ui')}css/article_index.css">
<div class="wrapper">
	<div class="main_start" id="main_start">
		<!--页面-->
		<!--TODO here-->
        
<section class="page page_hot">
	
	<div class="content_area">
		
		<!-- tab -->
		<div class="tab">
			<ul class="tab_fix clearfix" data-mark="tab_fix">
            <content action="category" catid="$catid"  order="listorder ASC" >
            	<volist name="data" id="vo">
                <?php $k=(int)($i)-1;?>
                    <li data-query="tabIndex={$k}&source={$k}" data-act="topTab" data-mark="tabLi" source="{$k}">{$vo.catname}</li>
                </volist>
            </content>
			</ul>
		</div>

		<!--文章列表-->
		<div class="mod_box article_box" data-mark="container">
        	<content action="category" catid="$catid" order="listorder ASC" >
            
            	<volist name="data" id="vo">
                    <ul class="article_lists" data-mark="list_container">   
                        <content action="lists" catid="$vo['catid']"  order="listorder ASC" >  
                        	<volist name="data" id="vo2">
                                <li class="article_item">
            <a href="{$vo2.url}" class="pictext flexbox">
                <div class="item_list">
                    <div class="item_main">{$vo2.title}</div>
                    <div class="item_minor twoline">{$vo2.description}</div>
                    <div class="item_other">
                        <span class="date">{$vo2.inputtime|date='Y-m-d H:m:s',###}</span>
                        <span class="fr"><em class="view_time"></em>{$vo2.views}</span>
                    </div>
                </div>
                <div class="mod_media">
                    <img origin-src="{$vo2.thumb}" src="/statics/default/images/defaultpic.gif" alt="十大最贵小城房价曝光 有你家乡吗(附名单)" class="lazyload">
                </div>
            </a>
        </li>
        					</volist>
						</content>
					</ul>
                </volist>
            </content>
		</div>
		<!--/文章列表-->
	</div>
	
		<!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部--> 
	</section>
		<!--/页面-->
	</div>
</div>
</body>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/article_index.js"></script>
<script>
$LMB.start('main_start','m_pages_redianIndex');
</script>
</html>
