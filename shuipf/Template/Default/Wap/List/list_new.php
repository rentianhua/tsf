<?php
// Debug: 输出提交的数据
//var_dump($_GET);

// 要进行筛选的字段
$fields = array('ct','zj','shi','sx','yt','od','kw');
// 把上一次已筛选的值保存在Form的隐藏域中
foreach($fields as $f){
  if(isset($_GET[$f])){
    $fitervalue[$f] = $_GET[$f];
  }
}		
?>
<template file="Wap/header.php"/>
<link rel="stylesheet" href="{:C('wap_ui')}css/index.css">
<div class="wrapper">
  <div class="main_start" id="main_start"> 
    <!--页面--> 
    <!--TODO here-->
    <section class="page page_zufang">
      <?php if(!$_GET['tt']){?>
      <style>
      .icon_search,.icon_triangle_down{background-image: url("/statics/wap/images/mysprite.png")};
      </style>
      <div class="content_area"> 
        <!--搜索框-->
        <div class="search_box search_a">
          <input type="text" id="ss" class="input" placeholder="请输入关键词搜索">
          <span class="divide"></span><i class="icon_search"></i> </div>
        <!--/搜索框--> 
        
        <!--房源列表-->
        <div class="mod_box house_lists"> 
          <!--筛选条-->
          <form id="filterForm" action="" method="get">
      	<input type="hidden" name="a" value="lists">
        <input type="hidden" name="catid" value="3">
        <input to="filter" type="hidden" id="ct" name="ct" value="<?php echo $fitervalue['ct']; ?>" />
        <input to="filter" type="hidden" id="zj" name="zj" value="<?php echo $fitervalue['zj']; ?>" />
        <input to="filter" type="hidden" id="shi" name="shi" value="<?php echo $fitervalue['shi']; ?>" />
        <input to="filter" type="hidden" id="sx" name="sx" value="<?php echo $fitervalue['sx']; ?>" />
		<input to="filter" type="hidden" id="yt" name="yt" value="<?php echo $fitervalue['yt']; ?>" />        
        <input to="filter" type="hidden" id="od" name="od" value="<?php echo $fitervalue['od']; ?>" />
        <input to="filter" type="hidden" id="kw" name="kw" value="<?php echo $fitervalue['kw']; ?>" />   
        </form> 
        <?php
		  $qulist = get_area_list(1);
		?>
          <div class="tab_bar flexbox" data-mark="booth">
            <div class="tab_tit box_col" data-mark="booth_area" >
              <h2 class="tit">
              <if condition="!$_GET['ct']">
              区域
              <else />
              	<foreach name="qulist" item="voq" >
                    <if condition="$voq['id'] eq $_GET['ct']">
                    {$voq.name}
                    </if>
                  </foreach>
              </if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_price">
              <h2 class="tit"><if condition="!$_GET['zj']">价格<else />{$_GET['zj']}</if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_model">
              <h2 class="tit"><if condition="!$_GET['shi']">房型<else />
              <switch name="_GET['shi']">
                <case value="1">一室</case>
                <case value="2">二室</case>
                <case value="3">三室</case>
                <case value="4">四室</case>
                <case value="5">五室</case>
                <case value="6">五室以上</case>
        		<default />房型
    		 </switch>
              </if></h2>
              <i class="icon_triangle_down"></i></div>
            <div class="tab_tit box_col" data-mark="booth_more" >
              <h3 class="tit">更多</h3>
              <i class="icon_triangle_down"></i></div>
          </div>
          <!--/筛选条-->
          
          <div class="sort_bar" data-mark="btn_sort"><i class="icon_sort"></i><span>排序</span></div>
          <div class="mod_cont">
            
            <?php
        $sql = " province = 1";
		$order = "";
		if($_GET['ct']!=""){
			$sql.= " and city = '".$_GET['ct']."'"; 
			}	
		if($_GET['zj']!=""){
			$zj = explode('-',$_GET['zj']);			
			$sql.= " and lowzongjia >= '".intval($zj[0])."'"; 
			if(intval($zj[1]) != 0){
				 $sql.= " and highzongjia <= '".intval($zj[1])."'";
			}
		}
		if($_GET['sx']!=""){
			$sql.= " and wuyeleixing = '".$_GET['sx']."'"; 
		}
		if($_GET['shi']!=""){
			$sql.= " and shiarea like '%".$_GET['shi']."%'";
			}
		if($_GET['yt']!=""){
			$sql.= " and fangwuyongtu = '".$_GET['yt']."'";  
			}
		if($_GET['kw']!=""){
			$sql.= " and title like '%".$_GET['kw']."%'"; 
			}	
		if($_GET['od']!=""){
			$order.= str_replace('_',' ',$_GET['od']); 
		}else{
			$order.= "listorder DESC";
		}
		?> 
            <content action="lists" catid="$catid" where="$sql" order="$order" num="20" page="$pages">
    		<ul class="lists" data-mark="list_container" data-info="total=
			<?php 
	     $count=reset($data);echo $count['datanum'];
	  	?>">
            <volist name="data" id="vo">
              <li class="pictext"> <a href="{$vo.url}" class="a_mask"></a>
                <div class="flexbox">
                  <div class="mod_media">
                    <div class="media_main"> <img origin-src="{$vo.thumb}" src="/statics/default/images/defaultpic.gif" alt="{$vo.title}" class="lazyload"> </div>
                  </div>
                  <div class="item_list">
                    <div class="item_main text_cut">{$vo.title}</div>
                    <div class="item_minor">
                      <div class="location">{$vo.loupandizhi}</div>
                      
                    </div>
                    <div class="item_other">
                    <span class="location">
                    <?php $l=strlen($vo['shiarea']);?>
                      <if condition="$l gt 1">
                      {$vo.shiarea|substr=###,0,1}-{$vo.shiarea|substr=###,-1,1}
                      <else />
                      {$vo.shiarea}
                      </if>
                    室</span>
                    <div class="price_total q_rentprice"><if condition="$vo['junjia'] eq 0">待定<else />{$vo.junjia}元/平</if></div></div>
                    <div class="tag_box"> <span class="tag xue_qu_fang" title="学区房二手房">学区房</span><span class="tag haskey" title="随时看房二手房">随时看房</span> </div>
                  </div>
                </div>
              </li>
            </volist>
            <div class="w-page">{$pages}</div>
            </ul>
            </content>            
          </div>
        </div>
        <!--/房源列表-->
        
        <div class="layer_fixed b" style="display: none" data-mark="sort_layer">
          <div class="content">
            <ul class="lists q_sortlist">
              <li class="li <if condition="!$_GET['od']">active</if>" type="od">默认</li>
              <li class="li <if condition="$_GET['od'] eq 'zujin_ASC'">active</if>" type="od" value="zujin_ASC">租金低</li>
            </ul>
          </div>
        </div>
      </div>
      <section class="layer_fixed filter_box" style="display: none;" data-mark="panel_box"> 
      <!--头部筛选条-->
      <header class="tab_bar flexbox">
        <div class="tab_tit box_col" data-mark="button_area" ><span class="tit">区域</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_price"><span class="tit">价格</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_model"><span class="tit">房型</span><i class="icon_triangle_down"></i></div>
        <div class="tab_tit box_col" data-mark="button_more" ><span class="tit">更多</span><i class="icon_triangle_down"></i></div>
      </header>
      <!--/头部筛选条-->
      
      <div class="content"> 
        <!--区域-->
        <div class="filter_item lists_area" data-mark="panel_area">
          <div class="area_list">
            <div class="nav" data-mark="level1">
              <ul class="level1">
                <li class="li active" name="district">区域</li>
              </ul>
            </div>
            <div class="guide" data-mark="level2">
              <ul name="district" class="level2 qu_list active">
                <li class="li" type="ct">不限</li>                
              <volist name="qulist" id="vo">
              <li class="li" type="ct" value="{$vo.id}">{$vo.name}</li>              
              </volist>                
              </ul>
            </div>
          </div>
        </div>
        <!--/区域--> 
        
        <!--价格-->
        <div class="filter_item lists_price" data-mark="panel_price">
          <ul class="price_list zj_list">
            <li class="li" type="zj">不限</li>
            <li class="li" type="zj" value="0-200">200万以下</li>
            <li class="li" type="zj" value="200-300">200-300万</li>
            <li class="li" type="zj" value="300-400">300-400万</li>
            <li class="li" type="zj" value="400-500">400-500万</li>
            <li class="li" type="zj" value="500-800">500-800万</li>
            <li class="li" type="zj" value="800-1000">800-1000万</li>
            <li class="li" type="zj" value="10000-">1000万以上</li>
          </ul>
        </div>
        <!--/价格--> 
        
        <!--房型-->
        <div class="filter_item lists_price"  data-mark="panel_model">
          <ul class="price_list q_roomlist">
            <li class="li" type="shi">不限</li>
            <li class="li" type="shi" value="1">一室</li>
            <li class="li" type="shi" value="2">二室</li>
            <li class="li" type="shi" value="3">三室</li>
            <li class="li" type="shi" value="4">四室</li>
            <li class="li" type="shi" value="5">五室</li>
            <li class="li" type="shi" value="6">五室以上</li>
          </ul>
        </div>
        <!--/房型--> 
        
        <!--更多-->
        <div class="filter_item lists_more" data-mark="panel_more">
          <div class="more_list">
            <dl class="item">
              <dt class="item_tit">类型</dt>
              <dd class="item_cont">
                <ul class="inline value_lists cx_list">
                  <li class="val <if condition="!$_GET['yt']">active</if>" type="yt"><a href="javascript:;">不限</a></li>
                  <li class="val <if condition="$_GET['yt'] eq '居住'">active</if>" type="yt" value="居住"><a href="javascript:;">居住</a></li>
                  <li class="val <if condition="$_GET['yt'] eq '办公'">active</if>" type="yt" value="办公"><a href="javascript:;">办公</a></li>
                  <li class="val <if condition="$_GET['yt'] eq '商业'">active</if>" type="yt" value="商业"><a href="javascript:;">商业</a></li>
                  <li class="val <if condition="$_GET['yt'] eq '商住两用'">active</if>" type="yt" value="商住两用"><a href="javascript:;">商住两用</a></li>
                  <li class="val <if condition="$_GET['yt'] eq '南北'">active</if>" type="yt" value="厂房"><a href="javascript:;">厂房</a></li>
                  <li class="val <if condition="$_GET['yt'] eq '综合体'">active</if>" type="yt" value="综合体"><a href="javascript:;">综合体</a></li>
                </ul>
              </dd>
            </dl>
            <dl class="item">
              <dt class="item_tit">属性</dt>
              <dd class="item_cont">
                <ul class="inline value_lists mj_list">
                  <li class="val <if condition="!$_GET['sx']">active</if>" type="sx"><a href="javascript:;">不限</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '商品房'">active</if>" type="sx" value="商品房"><a href="javascript:;">商品房</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '集体用地村委统建楼'">active</if>" type="sx" value="集体用地村委统建楼"><a href="javascript:;">村委统建</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '集体用地开发商自建楼'">active</if>" type="sx" value="集体用地开发商自建楼"><a href="javascript:;">开发商建设</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '集体用地个人自建房'">active</if>" type="sx" value="集体用地个人自建房"><a href="javascript:;">个人自建房</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '军区建房'">active</if>" type="sx" value="军区建房"><a href="javascript:;">广东省军区军产房</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '武警部队建房'">active</if>" type="sx" value="武警部队建房"><a href="javascript:;">武警部队军产房</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '工业属性长租物业'">active</if>" type="sx" value="工业属性长租物业"><a href="javascript:;">工业长租房</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '工业可分割产权物业'">active</if>" type="sx" value="工业可分割产权物业"><a href="javascript:;">工业产权房</a></li>
                  <li class="val <if condition="$_GET['sx'] eq '其他'">active</if>" type="sx" value="其他"><a href="javascript:;">其他</a></li>
                </ul>
              </dd>
            </dl>
          </div>
          <div class="opt_box"><a href="javascript:;" class="btn btn_green q_button" id="sure">确定</a> </div>
        </div>
        <!--/更多--> 
      </div>
    </section>
    <script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
    <!--动态脚本内容-->
    <script type="text/javascript" src="{:C('wap_ui')}js/search_index.js"></script>
    <script>
    $LMB.start('main_start','m_pages_zufangSearch',{ 
        "selected": {}
    });
    function Filter(field,value){
        var $ = function(ele){return document.getElementById(ele);}
        var ipts = $('filterForm').getElementsByTagName('input'),result=[];
        for(var i=0,l=ipts.length;i<l;i++){
          if(ipts[i].getAttribute('to')=='filter'){
            result.push(ipts[i]);
          }
        }
        if($(field)){
          value = value || '';
          $(field).value = value;
          for(var j=0,len=result.length;j<len;j++){
            if(result[j].value==''){
              result[j].parentNode.removeChild(result[j]);
            }
          }
          document.forms['filterForm'].submit();
        }
        return false;
      }
      
      $(".q_roomlist li,.zj_list li,.qu_list li,.subway_list li,.q_sortlist li").on("tap",function(){
        if(typeof($(this).attr('value'))!="undefined"){		
            Filter($(this).attr('type'),$(this).attr('value')); 
        }else{
            Filter($(this).attr('type')); 
        }
      });
      $(".cx_list li,.mj_list li").on("tap",function(){
        $(this).addClass("active").siblings().removeClass("active");
        if(typeof($(this).attr('value'))!="undefined"){		
            if($(this).attr('value') == 0){
                $("#"+$(this).attr('type')).val("");
            }else{
                $("#"+$(this).attr('type')).val($(this).attr('value'));			
            }		
        }
      });
      $("#sure").on("tap",function(){
        Filter('ct');
      });
      $(".icon_search").on("tap",function(){
        Filter('kw',$("#ss").val()); 
      });
      $(".level1 li").on("tap",function(){
        var type = $(this).attr('name'); 
        $(".guide ul[name='"+type+"']").show().siblings().hide();	
      });
    </script>
    <?php }else{?>
    <link rel="stylesheet" href="/statics/wap/css/new_index.css">
    <div class="content_area">
            <div class="head_xinfang" style="background-image: url('/statics/wap/images/ff1.jpg');">
              <div class="slogan"></div>
              <div class="search_box"><i class="icon_search_gray"></i>
                <form action="/" method="get">
                <input type="hidden" name="a" value="lists">
                <input type="hidden" name="catid" value="3">
                <input name="kw" type="text" class="input" placeholder="输入楼盘开始找房咯~"></form>
              </div> </div>
            <div class="search_xinfang">
              <ul class="gridbox col_3">
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&shi=1">一室</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&shi=2">二室</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&shi=3">三室</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&zj=100-150">100-150万</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&zj=150-200">150-200万</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&zj=200-300">200-300万</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&ct=2">罗湖</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3&ct=4">福田</a></li>
                <li class="li box_col"><a href="/index.php?g=Wap&a=lists&catid=3" title="深圳新房"><span>全部</span><i class="arrR"></i></a></li>
              </ul>
            </div>
            <!--房源列表，房源所在商圈加了title，商圈名+二手房，提高二手房权重-->
            <div class="mod_box house_lists">
              <h3 class="mod_tit">推荐楼盘</h3>
              <div class="mod_cont">
                <ul class="lists">
                <?php 
				$tuijian=M('position_data')->where('catid=3 and posid=15')->select();
				foreach($tuijian as $k=>$v){
					$tjlist[$k]=unserialize($v['data']);
				}
				?>
                <volist name="tjlist" id="vo2">
                  <li class="pictext"> <a href="{$vo2.url}" class="flexbox">
                    <div class="mod_media">
                    <div class="media_main"> <img origin-src="{$vo2.thumb}" src="{$vo2.thumb}" error-src="/statics/default/images/defaultpic.gif" class="lazyload"/> </div>
                  </div>
                    <div class="item_list">
                    <div class="item_main text_cut">{$vo2.title}</div>
                    <div class="item_other"><span class="location text_cut">{$vo2.loupandizhi}</span></div>
                    <div class="item_other">
                        <div class="location">{$vo2.mianjiarea}m²</div>
                        <div class="price_total">{$vo2.junjia}<i class="normal">元/m²</i></div>
                      </div>
                    <div class="tag_box tag_colorful"> </div>
                  </div>
                    </a> </li>
                </volist>
                </ul>
                <!--<div class="detail_more"><a href="/sz/loupan/">查看更多</a></div>-->
              </div>
            </div>
            <!--/房源列表--> 
          </div>
    <?php }?>
      <!--底部:导航当前页用h1着重强调-->
      <template file="Wap/footer.php"/>
      <!--/底部--> 
      
    </section>
    
    <!--/页面--> 
  </div>
</div>
</body>

</html>
