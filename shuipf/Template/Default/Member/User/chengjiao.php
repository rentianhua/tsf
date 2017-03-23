<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr" id="allList">
    <div class="title" id="showTotal">共<span>{$count}</span>套 成交房源</div>
    <div class="tab">
    <a href="/index.php?g=Member&m=User&a=chengjiao&t=1">
    <span class="actTap <if condition="$_GET['t'] eq 1">hover selected</if>">二手房</span>
    </a>
    <a href="/index.php?g=Member&m=User&a=chengjiao&t=2">
    <span class="actTap <if condition="$_GET['t'] eq 2">hover selected</if>">租房</span>
    </a>
    </div>
    <div id="ershoufang" style="display: block;" class="all-list selected fav-list">
      <ul class="list-bot">
      <volist name="arr" id="vo">
      <if condition="$_GET['t'] eq 1">
        <li>
          <div class="list">
            <div class="pic-panel"> <a href="{$vo.url}" target="_blank"> 
            <img src='<if condition="$vo['thumb']">{$vo.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>            
            '> </a> </div>
            <div class="info-panel">
              <h2> <a href="{$vo.url}" target="_blank">{$vo.title}</a> </h2>
              <div class="col-1">
                <div class="where"> <span class="region">{$vo.xiaoquname}&nbsp;&nbsp;</span> <span class="zone"> <span>{$vo.shi}室{$vo.ting}厅</span> </span> 
                <span class="meters">{$vo.jianzhumianji}平米</span> 
                <span>{$vo.chaoxiang}</span> </div>
                <div class="other">
                  <div class="con">{$vo.ceng}(共{$vo.zongceng}层) <span>/</span> {$vo.fangling}年房{$vo.jianzhutype} </div>
                </div>
                <div class="chanquan">
                  <div class="left agency">
                    <div class="view-label left"> 
                    <if condition="$vo['ditiexian'] neq ''">
                    <span class="fang-subway"></span> 
                    <span class="fang-subway-ex"> <span>{$vo.ditiexian}号线</span> </span> </if>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="price"> <span class="num">{$vo.zongjia}</span>万 </div>
                <div class="price-pre"><?php  echo ceil($vo['zongjia']*10000/$vo['jianzhumianji'])?> 元/m²</div>
              </div>
            </div>
          </div></li>
      <else />
      	<li>
          <div class="list">
            <div class="pic-panel"> <a <if condition="$vo['status'] eq 99">href="{$vo.url}" target="_blank"<else />href="javascript:;"</if>> 
            <img src='<if condition="$vo['thumb']">{$vo.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>            
            '> </a> </div>
            <div class="info-panel">
              <h2> <a <if condition="$vo['status'] eq 99">href="{$vo.url}" target="_blank"<else />href="javascript:;"</if>>{$vo.title}</a> </h2>
              <div class="col-1">
                <div class="where"> <span class="region">
                {$vo.city|getareaName=###} / {$vo.area|getareaName=###} / {$vo.xiaoqu|getxiaoquName=###}&nbsp;&nbsp;</span>
                </div>
                <div class="other">
                  <div class="con">{$vo.shi}室{$vo.ting}厅 / {$vo.mianji}平米<span></div>
                </div>
                <div class="chanquan">
                  <div class="left agency">
                    <div class="view-label left"> 
                    	<if condition="$vo['pub_type'] eq 1">直接出租<elseif condition="$vo['pub_type'] eq 2" />委托给平台<else />委托给经纪人</if>           
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="price"> <span class="num">{$vo.zujin}</span>元/月 </div>               
              </div>
            </div>
          </div>
          <div>
          </div>
          </li>
      </if>
      </volist>
      </ul>
    </div>
  </div>
</div>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
