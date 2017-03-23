<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr" id="allList">
    <div class="title" id="showTotal">共<span>{$count}</span>套 关注房源</div>
    <div class="tab">
    <a href="/index.php?g=Member&m=User&a=guanzhu&t=1">
    <span class="actTap <if condition="$_GET['t'] eq 1">hover selected</if>">二手房</span>
    </a>
    <a href="/index.php?g=Member&m=User&a=guanzhu&t=2">
    <span class="actTap <if condition="$_GET['t'] eq 2">hover selected</if>">新房</span>
    </a>
    </div>
    <div id="ershoufang" style="display: block;" class="all-list selected fav-list">
      <ul class="list-bot">
      <volist name="arr" id="vo">
      <if condition="$_GET['t'] eq 1">
        <li>
          <div class="list">
            <div class="pic-panel"> <a href="{$vo.house.url}" target="_blank"> 
            <img src='<if condition="$vo['house']['thumb']">{$vo.house.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>            
            '> </a> </div>
            <div class="info-panel">
              <h2> <a href="{$vo.house.url}" target="_blank">{$vo.house.title}</a> </h2>
              <div class="col-1">
                <div class="where"> <span class="region">{$vo.house.xiaoquname}&nbsp;&nbsp;</span> <span class="zone"> <span>{$vo.house.shi}室{$vo.house.ting}厅</span> </span> 
                <span class="meters">{$vo.house.jianzhumianji}平米</span> 
                <span>{$vo.house.chaoxiang}</span> </div>
                <div class="other">
                  <div class="con">{$vo.house.ceng}(共{$vo.house.zongceng}层) <span>/</span> {$vo.house.fangling}年房{$vo.house.jianzhutype} </div>
                </div>
                <div class="chanquan">
                  <div class="left agency">
                    <div class="view-label left"> <span class="fang-subway"></span> 
                    <span class="fang-subway-ex"> <span>{$vo.house.ditiexian}号线</span> </span> </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="price"> <span class="num">{$vo.house.zongjia}</span>万 </div>
                <div class="price-pre"><?php  echo ceil($vo['house']['zongjia']*10000/$vo['house']['jianzhumianji'])?> 元/m²</div>
              </div>
            </div>
          </div>
          <a href="/index.php?g=Member&m=User&a=delguanzhu&id={$vo.id}" class="del-fav actDelFollow">取消关注</a> </li>
      <else />
      	<li>
                <div class="pic-panel">
                  <a href="{$vo.house.url}" target="_blank">
                    <img src='<if condition="$vo['house']['thumb']">{$vo.house.thumb}
                  <else />
                  {$config_siteurl}statics/default/images/defaultpic.gif
                  </if>
                    '></a></div>
                <div class="info-panel">
                  <h2><a href="{$vo.house.url}" target="_blank">{$vo.house.title}</a></h2>
                  <div class="col-1">
                    <div class="where">
                      <span class="zone"><span>                      
                      <?php $l=strlen($vo['house']['shiarea']);?>
                      <if condition="$l gt 1">
                      {$vo.house.shiarea|substr=###,0,1}-{$vo.house.shiarea|substr=###,-1,1}
                      <else />
                      {$vo.house.shiarea}
                      </if>
                      室 / {$vo.house.mianjiarea}平米</span></span>
                    </div>
                    <div class="other">
                      <div class="con">楼盘地址：{$vo.house.loupandizhi}</div>
                    </div>
                    <div class="other">
                      <div class="con">
                        开盘时间：{$vo.house.kaipandate} / 交房时间：{$vo.house.jiaofangdate}
                      </div>
                    </div>
                  </div>
                  <div class="col-3" style="width:175px;">
                    <div class="price">
                      <span class="num"><if condition="$vo['house']['junjia'] eq ''">待定<else />{$vo.house.junjia}</if></span>
                      <if condition="$vo['house']['junjia'] neq ''">元/平米</if></div>
                    <div class="price-pre"><span class="am-icon-phone"></span> {$vo.house.contacttel}</div>
                  </div>
                </div>
                <a href="/index.php?g=Member&m=User&a=delguanzhu&id={$vo.id}" class="del-fav actDelFollow">取消关注</a>
              </li>
      </if>
      </volist>
      </ul>
    </div>
  </div>
</div>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
