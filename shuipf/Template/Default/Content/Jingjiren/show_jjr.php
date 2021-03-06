<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/common.css" rel="stylesheet" type="text/css" />
<link href="{:C('app_ui')}css/list.css" rel="stylesheet" type="text/css" />
<link href="{:C('app_ui')}css/detail_jjr.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "{$config_siteurl}",
    JS_ROOT: "statics/js/"
};
</script>
<script src="{$config_siteurl}statics/js/jquery.js" type="text/javascript"></script>
<script src="{$config_siteurl}statics/default/js/w3cer.js" type="text/javascript"></script>
<script type="text/javascript" src="{$config_siteurl}statics/js/ajaxForm.js"></script>
<style>
li {
	list-style: none;
}
ul, p, h2 {
	margin: 0;
	padding: 0
}
h2 {
	height: 28px !important;
}
</style>
<!-- 面包屑模块 -->
<div class="intro clear" mod-id="lj-common-bread">
  <div class="container">
    <div class="fl l-txt"><i class="icon"></i>&nbsp;<a href="/">首页</a><span class="stp">&nbsp;&gt;&nbsp;</span><a href="/index.php?m=jingjiren&a=list_jjr">经纪人</a><span class="stp">&nbsp;&gt;&nbsp;</span><a>当前经纪人</a></div>
  </div>
</div>
<div class="wrapper">
  <div class="main-box clear" style="margin-top:0px;">
    <div class="left l_wrapper">
      <div class="agent_info con-box">
        <div class="info_head">
          <div class="pic_panel"> <img onerror="this.src='/statics/taosf/images/defaultpic1.jpg';" src='/d/file/avatar/000/00/00/{$info.userid}_180x180.jpg'> </div>
          <div class="info-panel">
            <div class="agent-name" data-id="1">
              <h1>{$info.agent.realname}
              <if condition="$info['agent']['jiav'] eq 1">
              <img src="{:C('app_ui')}images/v.png">
              </if>
              </h1>
              <span class="position">
              <switch name="info['agent']['dengji']">
                <case value="1">普通经纪人</case>
                <case value="2">优秀经纪人</case>
                <case value="3">高级经纪人</case>
                <case value="4">资深经纪人</case>
                <default />
                普通经纪人 </switch>
              </span> 
             </div>
            <div class="col-1">
              <div class="achievement"> <span>联系电话:&nbsp;&nbsp;
              
              <if condition="$info['vtel'] eq ''">{$info.username}
              <else />{:cache('Config.tel400')} 转 {$info.vtel}</if></span> </div>
              <div class="label">
                <?php
            $array = explode(",",$info['agent']['biaoqian']);
            $i = 1;
            foreach ($array as $value) {
              if ($value != ''){
                echo '<span class="top_guider_mark">' . $value . '</span>';
              }
              $i++;
            }
            ?>
              </div>
            </div>
          </div>
        </div>
        <div class="info_bottom">
          <p><span class="congye">从业年限:&nbsp;</span>
            <if condition="$info['agent']['worktime'] eq 6"> 5年以上
              <else />
              {$info.agent.worktime}年 </if>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>个人成绩:&nbsp;&nbsp;</span> <a target="_blank" href="?w=ershoufang">历史成交{$info.chenjiao_count}套</a>， <a target="_blank" href="?w=dujia">独家委托{$info.weituo_count}套</a>，
            最近30天带看{$info.kanfang_count}次 </p>
          <p> <span>主营版块:&nbsp;&nbsp;</span>{$info.agent.mainarea}</p>
          <if condition="$info['agent']['coname'] neq ''">
          <p> <span>所属公司:&nbsp;&nbsp;</span>
          <if condition="$info['agent']['leixing'] eq '个人'">
          个人
          <else />
          <a target="_blank" href="/index.php?m=jingjiren&a=show_com&c={$info.agent.coname}">{$info.agent.coname}</a>
          </if>
          </p>
          </if>
        </div>
      </div>
      <div class="comment_tab con-box">
        <div class="tab">
          <ul class="tab-lst">
            <li <if condition="!$_GET['t']">class="on"</if>> <a href="/index.php?m=jingjiren&a=show_jjr&id={$info.userid}"> <span>&nbsp;&nbsp;概况&nbsp;&nbsp;</span> </a> </li>
            <li <if condition="$_GET['t'] eq 2">class="on"</if>> <a href="/index.php?m=jingjiren&a=show_jjr&id={$info.userid}&t=2"> <span>二手房源</span> </a> </li>
            <li <if condition="$_GET['t'] eq 3">class="on"</if>> <a href="/index.php?m=jingjiren&a=show_jjr&id={$info.userid}&t=3"> <span>评论</span> </a> </li>
          </ul>
          <div class="loading">
            <p>loading...</p>
          </div>
          <div id="main_wrapper" class="mainWrapper">
            <if condition="!$_GET['t']">
              <div class="high_praise"  style="padding-bottom:0;">
                <h2>能力概览</h2>
                <div class="hp_detail bn_w"  style="margin-top:20px">
                  <div class="chart_w fuwux chart_tl">

<!--                    -->
<div class="am-tabs" data-am-tabs>
  <ul class="am-tabs-nav am-nav am-nav-tabs">
    <li class="am-active"><a href="#tab1">成交小区</a></li>
    <li><a href="#tab2">带看小区</a></li>
  </ul>

  <div class="am-tabs-bd">
    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
     <div class="r_kuang">
                      <div id="rank_sold" class="rankHide">
                        <table style=" width:100%;margin-top: 20px;">
                        	<tr style="background: #f5f5f5 none repeat scroll 0 0;border-bottom: 1px solid #eee;height:40px">
                        		<td style="width:10%;text-align: center;color:#999999;">#</td>
                        		<td style="width:30%;text-align: center;color:#999999;">小区名称</td>
                        		<td style="width:30%;text-align: center;color:#999999;">所属区域</td>
                        		<td style="width:30%;text-align: center;color:#999999;">成交套数</td>
                        	</tr>
                        	<?php
								$b['username'] = $a['username'] = $info['username'];
								$b['zaishou'] = $a['zaishou'] = 0;
								$list_cj_xq = M('ershou')->distinct(true)->where($a)->field('xiaoqu,city')->select();
								foreach($list_cj_xq as $k=>$v){
									$b['xiaoqu'] = $v['xiaoqu'];
									?>
                        	<tr style=" background: #fbfbfb none repeat scroll 0 0;border-bottom: 1px solid #eee;height:40px">
                        		<td style="text-align: center"><p style="background-color: #e4393c;border-radius: 22px;height: 23px;width: 23px;color:#fff;font-weight: 700;margin: 0 auto;">{$k+1}</p></td>
                        		<td style="text-align: center"><?php echo getxiaoquName($v['xiaoqu']);?></td>
                        		<td style="text-align: center"><?php echo M('area')->where('id='.$v["city"])->getField('name');?></td>
                        		<td style="text-align: center"><?php echo M('ershou')->where($b)->count();?></td>
                        	</tr>									
									<?php
								}
							?>

                        </table>
                      </div>
                    </div>
    </div>
    <div class="am-tab-panel am-fade" id="tab2">
     <table style=" width:100%;margin-top: 20px;">
                        	<tr style="background: #f5f5f5 none repeat scroll 0 0;border-bottom: 1px solid #eee;height:40px">
                        		<td style="width:10%;text-align: center;color:#999999;">#</td>
                        		<td style="width:30%;text-align: center;color:#999999;">客户</td>
                        		<td style="width:30%;text-align: center;color:#999999;">楼盘名称</td>
                        		<td style="width:30%;text-align: center;color:#999999;">预约时间</td>
                        	</tr>
					  <?php
						$data = M('ershou')->where('jjr_id='.$_GET["id"])->Field('id')->select();
						$str="";
						foreach($data as $k=>$v){
							$str=$str.",'".$v['id']."'";
						}

						$str = ltrim($str, ",");
						$data = M('yuyue')->where('fromid in('.$str.')')->select();
						foreach($data as $kk=>$vv){
							?>
                        	<tr style=" background: #fbfbfb none repeat scroll 0 0;border-bottom: 1px solid #eee;height:40px">
                        		<td style="text-align: center">{$kk+1}</td>
                        		<td style="text-align: center"><?php $str= $vv['username'];?>
                        		{$str|substr_replace=###,'****',3,4}
                        		</td>
                        		<td style="text-align: center"><?php echo M($vv['fromtable'])->where('id='.$vv["fromid"])->getField('title');
									
									?></td>
                        		<td style="text-align: center"><?php echo $vv['yuyuedate'];?></td>
                        	</tr>									
									<?php
								}
							?>

                        </table>
   
    </div>

  </div>
</div>
<!--                                    -->

                                    </div>
                </div>
                
                <!--<div class="mo_ck mo_wi"><a id="moreAbility" class="more_comment" href="?w=nengli" target="_blank">查看更多&nbsp;&gt;&gt;</a></div>-->
              </div>
              <div class="house">
                <h2>成交房源</h2>
                <?php 
				// $a['username'] = $info['username'];
				// $a['zaishou'] = 0;
        $arry1 = M('ershou')->where("(username='".$info['username']."' OR jjr_id='".$info['userid']."') and zaishou=0")->select();
        $arry2 = M('chuzu')->where("(username='".$info['username']."' OR jjr_id='".$info['userid']."') and zaizu=0")->select();

        if(count($arry1)>0){
          $list_cj = $arry1;
        }
        if(count($arry2)>0){
           $list_cj = $arry2;
        }
        if(count($arry1)>0 && count($arry2)>0){
           $list_cj = array_merge($arry1,$arry2);
        }
				if(count($list_cj)==0){
                echo '<div class="nofang" id="nosold" style="display:block">
                  <p>暂无成交房源。</p>
                </div>';
				}else{ ?>
                <ul class="deal kuan" id="baseHouse_list">
                <volist name="list_cj" id="vo2">
                  <li class="house_l bs_house">
                    <div class="info_head">
                      <div class="pic_panel"><a href="" target="_blank"><img src="{$vo2.thumb}" onerror="this.src='/statics/default/images/defaultpic.gif';"></a></div>
                      <div class="info-panel">
                        <div class="agent-name">
                          <h2><a href="{$vo2.url}" title="{$vo2.title}" target="_blank">{$vo2.title}</a></h2>
                        </div>
                        <div class="col-1">
                        	<div class="main-plate">
                            <p><span class="am-icon-home"></span>&nbsp;{$vo2.xiaoqu|getxiaoquName} / {$vo2.shi}室{$vo2.ting}厅 / {$vo2.jianzhumianji}平米</p>
                          </div>
                          <div class="main-plate">
                            <p>{$vo2.chaoxiang} / {$vo2.ceng} (共{$vo2.zongceng}层) / {$vo2.fangling}年房{$vo2.jianzhutype}</p>
                          </div>
                          <div class="label">
                            <p>签约时间：{$vo2.updatetime|date='Y-m-d',###}</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-2">
                      <if condition="$vo2.catid eq 6"> 
                          <p>单价&nbsp;<span><?php  echo ceil($vo2['zongjia']*10000/$vo2['jianzhumianji'])?></span>&nbsp;元/平</p>
                          <p>总价&nbsp;<span>{$vo2.zongjia}万</span></p>
                      <else />
                          <p>出租&nbsp;<span>{$vo2.zujin}</span>&nbsp;元/平</p>
                      </if>  
                      </div>
                    </div>
                    <!--<div class="transaction">
                      <p><span>成交感言：</span>暂无</p>
                    </div>-->
                  </li>
                  </volist>
                </ul>
                <?php } ?>
                <!--<div class="hide_xia"><a id="moreSold" class="more_comment" href="?w=ershoufang" target="_blank">查看所有成交的房源&gt;&gt;</a></div>-->
              </div>
              <elseif condition="$_GET['t'] eq 2" />
              <!--二手房源-->
              <ul class="deal deal_k">
                <volist name="list" id="vo1">
                <li class="house_l house_xu">
                  <div class="info_head">
                    <div class="pic_panel"><a href="{vo1.url}" target="_blank">
                    <img src="
                    <if condition="$vo1['thumb']">{$vo1.thumb}
                  <else />
                  /statics/default/images/defaultpic.gif
                  </if>
                    "></a></div>
                    <div class="info-panel">
                      <div class="agent-name">
                        <h2><a href="{$vo1.url}" title="{$vo1.title}" target="_blank">{$vo1.title}</a></h2>
                      </div>
                      <div class="col-1 col-1_pt">
                        <div class="main-plate">
                          <p>{$vo1.xiaoqu|getxiaoquName=###} / {$vo1.shi}室{$vo1.ting}厅 / {$vo1.jianzhumianji}平米 / {$vo1.chaoxiang}</p>
                        </div>
                        <div class="achievement">
                          <p> {$vo1.ceng}(共{$vo1.zongceng}层)/ {$vo1.fangling}年房{$vo1.jianzhutype}</p>
                        </div>
                        <div class="label">
                          <p>{$vo1.guanzhu_count}人关注 / 共{$vo1.yuyue_count}次带看 / {$vo1.inputtime|date='Y-m-d',###}发布</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-2 col_p">
                      <p>单价&nbsp;<span><?php  echo ceil($vo1['zongjia']*10000/$vo1['jianzhumianji'])?></span>&nbsp;元/平</p>
                      <p>总价&nbsp;<span>{$vo1.zongjia}万</span></p>
                    </div>
                  </div>
                </li>
                </volist>
              </ul>
              <else />
             <!-- 评论-->
             <!--评论部分-->
             <link href="{$config_siteurl}statics/default/css/article_list.css" rel="stylesheet" type="text/css" />
             <script type="text/javascript" src="{$config_siteurl}statics/js/comment/raty-2.5.2/lib/jquery.raty.min.js"></script>
             <script type="text/javascript" src="{$config_siteurl}statics/js/comment/raty-2.5.2/lib/jquery.raty.min.js"></script>
    <div class="duoshuo">
      <h2><span>此评论不代表本站观点</span>大家说</h2>
      <!--评论主体-->
      <div id="ds-reset" style="margin: 8px;"></div>
    </div>
              </if>
            </if>
          </div>
          <div class="pager" id="pager" pany="1"> </div>
        </div>
      </div>
    </div>
    <div class="right r_wrapper">
      <div class="authentication con-box">
        <h2>服务行程</h2>
         <?php 
        $arry1 = M('ershou')->where("(username='".$info['username']."' OR jjr_id='".$info['userid']."') and zaishou=0")->order('updatetime DESC')->getField("xiaoqu,updatetime,url,shi,ting,jianzhumianji as mianji,title,1 as type,zongjia as jiage");
        $arry2 = M('chuzu')->where("(username='".$info['username']."' OR jjr_id='".$info['userid']."') and zaizu=0")->order('updatetime DESC')->getField("xiaoqu,updatetime,url,shi,ting,mianji,title, 2 as type,zujin as jiage");

        if(count($arry1)>0){
          $list_chenjiao = $arry1;
        }
        if(count($arry2)>0){
           $list_chenjiao = $arry2;
        }
        if(count($arry1)>0 && count($arry2)>0){
           $list_chenjiao = array_merge($arry1,$arry2);
        }

        $data = M('yuyue')->where('fromuser='.$info['username'])->Field('fromid')->select();
        $str="";
        foreach($data as $k=>$v){
          $str=$str.",'".$v['fromid']."'";
        }
        $str = ltrim($str, ",");
        $list_daikan = M('ershou')->where('id in('.$str.')')->order('updatetime DESC')->getField("xiaoqu,updatetime,url,shi,ting,jianzhumianji as mianji,title,3 as type,zongjia as jiage");
        
        if(count($list_chenjiao)>0)
          $list_service = $list_chenjiao ;
        if(count($list_daikan)>0){
          $list_service = $list_daikan;
        }
        if(count($list_chenjiao)>0 && count($list_daikan)>0){
           $list_service = array_merge($list_chenjiao,$list_daikan);
        }

        foreach ($list_service as $key => $value) {
          $date[$key] = $value['updatetime'];
        }
        array_multisort($date,SORT_DESC, $list_service);
        $isfirst_daikan=1;
        $isfirst_chenjiao=1;
        if(count($list_service)==0){
           echo '<p class="overline">暂无</p>';
        }else{ ?>
          <ul class="deal kuan" id="service_list">
            <volist name="list_service" id="vo3">
               <p class="bold_t">
                  <span class="bold_">
                      <?php
                       if($isfirst_daikan==1&&$vo3['type']==3)
                       {
                          $isfirst_daikan=0;
                          echo "[最新带看]";
                       }
                       if($isfirst_chenjiao==1&&$vo3['type']!=3)
                       {
                          $isfirst_chenjiao=0;
                          echo "[最新成交]";
                       }
                       ?>
                  </span>&nbsp;{$vo3.updatetime|date='Y-m-d h:i',###}<br/>
                  <if condition="$vo3['type']==3">
                      带客户看房
                  <else />
                      成交了
                  </if>
                  <a target="_blank" href="{$vo3.url}" title="{$vo3.title}" href="#">&nbsp;{$vo3.xiaoqu|getxiaoquName=###}  {$vo3.shi}室{$vo3.ting}厅 {$vo3.mianji}平米  {$vo3['jiage']}<if condition="$vo3['type']==2">元/月<else/>万元</if>&nbsp;</a>等1套</p>
            </volist>
          </ul>
            <?php } ?>
      <!--   <p class="bold_t"><span class="bold_">[最新带看]</span>&nbsp;2016-08-21<br/>
          带客户看房<a target="_blank" href="#">&nbsp;汀兰鹭榭花园 6室4厅 273平 6000万&nbsp;</a>等1套</p>
        <p class="bold_t"><span class="bold_">[最新成交]</span>&nbsp;2016-07-31<br/>
          成交了<a target="_blank" href="#">&nbsp;百仕达红树西岸 2室2厅 116平 1210万</a></p>
        <p class="overline">2016-08-21 10:10<br/>
          带客户看房<a target="_blank" href="#">&nbsp;汀兰鹭榭花园 6室4厅 273平 6000万&nbsp;</a>等1套</p> -->
        
      </div>
    </div>
  </div>
</div>
<script>
//评论
var commentsQuery = {
    'catid': '88',
    'id': <?php echo $_GET['id'];?>,
    'size': 10
};
(function () {
    var ds = document.createElement('script');
    ds.type = 'text/javascript';
    ds.async = true;
    ds.src = GV.DIMAUB+'statics/js/comment/embed.js';
    ds.charset = 'UTF-8';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);
})();
//评论结束
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>
