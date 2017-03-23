<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<?php $t=$_GET['t'];$uname=$_GET['username'];$uid=$_GET['userid'];?>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <a style="margin-left:15px;" href="/index.php?g=Member&m=Member&menuid=162"><返回用户列表</a>
  <div style="margin-left:15px;font-weight: bold;font-size: 18px">
  当前用户：{$uname}&nbsp;/ 普通会员</div>
  <div class="nav">
    <ul class="cc">
        <li <if condition="(!$t) OR ($t eq 1)">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>1,'userid'=>$uid,'username'=>$uname) )}">关注的二手房</a></li>
        <li <if condition="$t eq 2">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>2,'userid'=>$uid,'username'=>$uname) )}">关注的新房</a></li>
        <li <if condition="$t eq 3">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>3,'userid'=>$uid,'username'=>$uname) )}">发布的二手房</a></li>
        <li <if condition="$t eq 4">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>4,'userid'=>$uid,'username'=>$uname) )}">发布的出租房</a></li>
        <li <if condition="$t eq 5">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>5,'userid'=>$uid,'username'=>$uname) )}">求租房</a></li>
        <li <if condition="$t eq 6">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>6,'userid'=>$uid,'username'=>$uname) )}">预约</a></li>
        <li <if condition="$t eq 7">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>7,'userid'=>$uid,'username'=>$uname) )}">优惠券订单</a></li>
        <li <if condition="$t eq 8">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>8,'userid'=>$uid,'username'=>$uname) )}">勾地订单</a></li>
        <li <if condition="$t eq 9">class="current"</if>><a href="{:U('Member/usercenter', array('t'=>9,'userid'=>$uid,'username'=>$uname) )}">历史记录</a></li>
      </ul>
</div>
  <form name="myform" action="{:U('Member/delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
      <if condition="(!$t) OR ($t eq 1) OR ($t eq 3)">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">房源名称</td>
            <td align="left">区域</td>
            <td align="left">小区</td>
            <td align="left">户型</td>
            <td align="left">面积</td>
            <td align="left">总价(万)</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left"><a target="_blank" href="{$vo.url}">{$vo.title}</a></td>
              <td align="left">{$vo.city|getareaName=###} / {$vo.area|getareaName=###}</td>
              <td align="left">{$vo.xiaoqu|getxiaoquName=###}</td>
              <td align="left">{$vo.shi}室{$vo.ting}厅</td>
              <td align="left">{$vo.jianzhumianji}</td>
              <td align="left">{$vo.zongjia}</td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 2" />
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">楼盘名称</td>
            <td align="left">区域</td>
            <td align="left">小区</td>
            <td align="left">均价(元/平米)</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left"><a target="_blank" href="{$vo.url}">{$vo.title}</a></td>
              <td align="left">{$vo.city|getareaName=###} / {$vo.area|getareaName=###}</td>
              <td align="left">{$vo.xiaoqu|getxiaoquName=###}</td>
              <td align="left">{$vo.junjia}</td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 4" />
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">房源名称</td>
            <td align="left">区域</td>
            <td align="left">小区</td>
            <td align="left">户型</td>
            <td align="left">面积</td>
            <td align="left">租金(元/月)</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left"><a target="_blank" href="{$vo.url}">{$vo.title}</a></td>
              <td align="left">{$vo.city|getareaName=###} / {$vo.area|getareaName=###}</td>
              <td align="left">{$vo.xiaoqu|getxiaoquName=###}</td>
              <td align="left">{$vo.shi}室{$vo.ting}厅</td>
              <td align="left">{$vo.mianji}</td>
              <td align="left">{$vo.zujin}</td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 5" />
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">标题</td>
            <td align="left">区域</td>
            <td align="left">期望厅室</td>
            <td align="left">期望租金(元/月)</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left"><a target="_blank" href="{$vo.url}">{$vo.title}</a></td>
              <td align="left">{$vo.city|getareaName=###} / {$vo.area|getareaName=###}</td>
              <td align="left">{$vo.zulin} / {$vo.shi}室</td>
              <td align="left">
              <if condition="$vo['zujinrange'] eq '0-500'">500元以下/月
              <elseif condition="$vo['zujinrange'] eq '4500-'" />4500元以上/月
              <else />{$vo.zujinrange}元
              </if>
              </td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 6" />
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">房源名称</td>
            <td align="left">预约时间</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left"><a target="_blank" href="{$vo.house.url}">{$vo.house.title}</a></td>
              <td align="left">{$vo.yuyuedate}&nbsp;{$vo.yuyuetime}</td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 7" />
        <thead>
          <tr>
            <td align="left">订单号</td>
            <td align="left">优惠券名称</td>
            <td align="left">抵付金额(元)</td>
            <td align="left">使用说明</td>
            <td align="left">购房人</td>
            <td align="left">购房人手机号</td>
            <td align="left">支付状态</td>
            <td align="left">楼盘名称</td>
            <td align="left">创建时间</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td>{$vo.order_no}</td>
              <td>{$vo.coupon_name}</td>
              <td>{$vo.difu}</td>
              <td>{$vo.desc}</td>
              <td>{$vo.buyname}</td>
              <td>{$vo.buytel}</td>
              <td align="left" <if condition="$vo.pay_status eq 1">title="支付宝交易流水号：{$vo.trade_no}&#10;&#13;支付宝账户：{$vo.buyer_email}&#10;&#13;支付金额：{$vo.shifu}元&#10;&#13;支付时间：{$vo.paytime|date='Y-m-d H:m:s',###}"</if>>
              <if condition="$vo.pay_status eq 0">未支付<else />已支付</if></td>
              <td align="left"><a target="_blank" href="{$vo.house.url}">{$vo.house.title}</a></td>              <td align="left">{$vo.inputtime|date='Y-m-d H:i:s',###}</td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 8" />
        <thead>
          <tr>
            <td align="left">订单号</td>
            <td align="left">勾地金额(元)</td>
            <td align="left">支付状态</td>
            <td align="left">楼盘名称</td>
            <td align="left">创建时间</td>
          </tr>
        </thead>
        <tbody>
          <volist name="info" id="vo">
            <tr>
              <td>{$vo.order_no}</td>
              <td>{$vo.jine}</td>
              <td align="left" <if condition="$vo.pay_status eq 1">title="支付宝交易流水号：{$vo.trade_no}&#10;&#13;支付宝账户：{$vo.buyer_email}&#10;&#13;支付金额：{$vo.shifu}元&#10;&#13;支付时间：{$vo.paytime|date='Y-m-d H:m:s',###}"</if>>
              <if condition="$vo.pay_status eq 0">未支付<else />已支付</if></td>
              <td align="left"><a target="_blank" href="{$vo.house.url}">{$vo.house.title}</a></td>              <td align="left">{$vo.paytime|date='Y-m-d H:i:s',###}</td>
            </tr>
          </volist>
        </tbody>
        <elseif condition="$t eq 9" />       
        </if>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
<script>
//会员信息查看
function member_infomation(userid, modelid, name) {
	omnipotent("member_infomation", GV.DIMAUB+'index.php?g=Member&m=Member&a=memberinfo&userid='+userid+'', "个人信息",1)
}
</script>
</body>
</html>