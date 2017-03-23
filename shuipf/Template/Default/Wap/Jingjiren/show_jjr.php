<template file="Wap/header.php"/>
<div class="wrapper">
	<div class="main_start" id="main_start">
		<!--页面-->
		<!--TODO here-->
        <section class="page page_agent has_fixbar">
      <link rel="stylesheet" href="{:C('wap_ui')}css/jjr_index.css">
    <style>
    .tab_bar .tab_tit{width:33.3%}
	.flexbox .box_col{flex: 1 1 0}	
    </style>
    <div class="content_area">
        <!--经纪人简介-->
        <div class="mod_box jingjiren_head">
            <div class="basic_info flexbox">
                <div class="head_info">
                    <img src="/d/file/avatar/000/00/00/{$info.userid}_180x180.jpg" class="lazyload" data-mark="agent_img" onerror="this.src='/statics/extres/member/images/noavatar.jpg';">
                </div>
                <div class="detail_info box_col">
                    <h1 class="item_main text_cut"><span class="name q_agentname" data-mark="agent_name">{$info.realname}</span><span class="info q_level">
                    <switch name="info['dengji']">
                    <case value="1">普通经纪人</case>
                    <case value="2">优秀经纪人</case>
                    <case value="3">高级经纪人</case>
                    <case value="4">资深经纪人</case>
                    <default />普通经纪人
                    </switch>
                    </span></h1>
                    <div class="item_other"><span>从业年限：</span><span>
                    <if condition="$info['worktime'] eq 6">5年以上<else />{$info.worktime}年</if></span></div>
                    <div class="item_other q_shopname"><span>主营区域：</span><span data-mark="shop_name">{$info.mainarea}</span></div>
                </div>
                <div class="good_info">
                    <div class="item_other"><span class="good_rate" data-mark="good_rate" data-info="num=79&rate=95.0">95.0<span>%</span></span><span class="good_rate_title">好评率</span></div>
                </div>
            </div>
            <div class="data_info tab_bar flexbox">
                <div class="tab_tit box_col" >
                    <div class="tit num q_soldnum">9</div>
                    <div class="tit">历史成交(套)</div>
                </div>
                <div class="tab_tit box_col" >
                    <div class="tit num q_soldcycle">18</div>
                    <div class="tit">平均成交周期(天)</div>
                </div>
                <div class="tab_tit box_col" >
                    <div class="tit num q_see">30</div>
                    <div class="tit">近30天带看(次)</div>
                </div>
            </div>
            <div class="tags q_tags">
            <?php
            $array = explode(",",$info['biaoqian']);
            $i = 1;
            foreach ($array as $value) {
              if ($value != ''){
                echo '<span class="tag top_guider_mark">' . $value . '</span> ';
              }
              $i++;
            }
            ?>
            </div>
        </div>
        <!--/房源简介-->
        
        <!--用户评价-->
                <div class="mod_box jingjiren_info">
            <h3 class="mod_tit"><a href="#" class="arrow"><em>用户评价</em><span>（79条评价）</span></a></h3>
            <div class="mod_cont">
                <div class="pictext people_img flexbox">
                    <div class="mod_media">
                        <div class="media_main">
                            <img origin-src="" src="/statics/extres/member/images/noavatar.jpg" class="lazyload">
                        </div>
                    </div>
                    <div class="item_list">
                        <div class="item_main"><span class="name">181******09</span><span class="info">买房人</span></div>
                        <div class="item_minor text_cut">
                            <span class="type">
                                <em>服务态度</em>
                                <span class="score">
                                <span class="icon_rate_up"></span><span class="icon_rate_up"></span><span class="icon_rate_up"></span><span class="icon_rate_up"></span><span class="icon_rate_up"></span>                                </span>
                            </span>
                            <span class="type">
                                <em>专业技能</em>
                                <span class="score">
                                <span class="icon_rate_up"></span><span class="icon_rate_up"></span><span class="icon_rate_up"></span><span class="icon_rate_up"></span><span class="icon_rate_up"></span>                                </span>
                            </span>
                        </div>
                        <div class="item_minor text_cut">小程很认真</div>
                        <div class="item_minor text_cut"><span>带看</span><span class="time">2016.09.08</span></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /用户评价 -->
        
                <!--TA的成交房源-->
        <div class="mod_box house_lists">
            <h3 class="mod_tit"><a href="#" class="arrow"><em>TA的成交房源</em><span>（9套）</span></a></h3>
            <div class="mod_cont">
                <a href="#" class="pictext flexbox">
                    <div class="mod_media">
                        <div class="media_main">
                            <img origin-src="/statics/default/images/defaultpic.gif" src="/statics/default/images/defaultpic.gif" alt="国展苑 2室1厅 51平" class="lazyload">
                        </div>
                    </div>
                    <div class="item_list">
                        <div class="item_main text_cut">国展苑 2室1厅 51平</div>

                        <div class="item_minor"><span class="info">北 高楼层/35层</span></div>
                        <div class="item_other"><em>签约价格：</em><span class="red">169万 32983元/平</span></div>
                        <div class="item_other"><em>签约日期：</em>2016-07-23</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /TA的成交房源 -->
        
        
                <!--TA的在售房源-->
        <div class="mod_box house_lists jingjiren_info">
            <h3 class="mod_tit"><a href="#" class="arrow"><em>TA的在售房源</em><span>（11套）</span></a></h3>
            <div class="mod_cont">
                <a href="#" class="pictext flexbox">
                    <div class="mod_media">
                        <div class="media_main">
                            <img origin-src="/statics/default/images/defaultpic.gif" src="/statics/default/images/defaultpic.gif" alt="国展苑 正规两房 满五红本 业主诚心卖"  class="lazyload">
                        </div>
                    </div>
                    <div class="item_list">
                        <div class="item_main text_cut">国展苑 正规两房 满五红本 业主诚心卖</div>
                        <div class="item_minor"><span class="info">2室1厅  74m²  西</span><span class="price_total">230万</span></div>
                        <div class="item_other"><span class="location" title="国展苑.'二手房'">国展苑</span><span class="unit_price">31081元/平</span></div>
                        <div class="tag_box">
                                                    <span class="tag" title="地铁房.'二手房'">地铁房</span>
                                                    <span class="tag" title="学区房.'二手房'">学区房</span>
                                                    <span class="tag" title="满五年唯一.'二手房'">满五年唯一</span>
                                                    <span class="tag" title="新上.'二手房'">新上</span>
                                                </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /TA的在售房源 -->
        
        <!-- 服务动态 -->
                <div class="mod_box jingjiren_info fuwu">
            <h3 class="mod_tit">服务动态</h3>
            <div class="mod_cont">
                <ul class="lists">
                                                        <li class="li_item"><a href="#"><span class="tit">【 最新带看 】</span><span class="value box_col">2016-09-11 带客户看房<span class="info">龙珠花园(布吉) 2室1厅 59平 195万</span>等5套</span></a></li>
                                                                            <li class="li_item"><a href="#"><span class="tit">【 最新成交 】</span><span class="value box_col">2016-07-23 成交了<span class="info">国展苑 2室1厅 51.24平 169万</span></span></a></li>
                                                    </ul>
            </div>
        </div>
                <!-- /服务动态 -->
    </div>

    <!--底部:导航当前页用h1着重强调-->
      <footer class="footer">
        <div class="nav"> <span class="location"><a href="/">首页</a></span> <span class="location"><i class="crumb"></i>
          <a href="/index.php?g=Wap&m=Jingjiren&a=list_jjr">经纪人</a> 
          </span> <span class="cur"><i class="crumb"></i>当前经纪人</span></div>
        <div class="info">
          <div class="icon_box"> <a style="float:left" href="" title="iPhone客户端" class="icon_iphone" rel="nofollow">iPhone客户端</a> <a href="" title="Android客户端" class="icon_android" rel="nofollow">Android客户端</a> </div>
          <div class="copyright">
            <p class="company">深圳市瑞安兴业房地产顾问有限公司</p>
            <p class="record">网络经营许可证 粤ICP备16061979号-1</p>
          </div>
        </div>
      </footer>
      <!--/底部--> 

        <div class="fixed_bar fixed_opt flexbox">
        <div class="box_col"><a href="javascript:;" data-act="telphone" data-query="tel=<if condition="$info['vtel'] eq ''">{$info.username}<else />{:cache('Config.tel400')}转{$info.vtel}</if>" class="btn q_phone"><i class="icon_phone"></i> <span>电话</span></a></div>
        <div class="box_col"><a href="javascript:;" data-act="sendSMS" data-query="tel=13641441804&ucid=1000000020049128&content=你好，我在淘深房上看到你的主页，我想咨询你一些购房的问题，请与我联系。来自【手机淘深房】" class="btn q_message"><i class="icon_news"></i> <span>短信</span></a></div>
    </div>
    
</section>
		<!--/页面-->
	</div>
</div>
<script type="text/javascript" src="{:C('wap_ui')}js/all.js"></script>
<!--动态脚本内容-->
<script type="text/javascript" src="{:C('wap_ui')}js/index.js"></script>
<script>
$LMB.start('main_start','m_pages_ershoufangDetail');
</script>
</body>
</html>
