<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">搜索</div>
  <form name="searchform" action="" method="get" >
    <input type="hidden" value="Admin" name="g">
    <input type="hidden" value="Order" name="m">
    <input type="hidden" value="goudi" name="a">
    <input type="hidden" value="1" name="search">
    <div class="search_type cc mb10">
      <div class="mb10"> <span class="mr20">
        <input placeholder="输入订单号搜索" name="keyword" type="text" value="{$Think.get.keyword}" class="input" />
        <button class="btn">搜索</button>
        </span> </div>
    </div>
  </form>
  <form name="myform" action="{:U('Member/delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">用户名</td>
            <td align="left">订单号</td>           
            <td align="left">勾地金额(元)</td>
            <td align="left">支付状态</td>
            <td align="left">楼盘名称</td>
            <td align="left">创建时间</td>            
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left">{$vo.username}</td>
              <td align="left">{$vo.order_no}</td>
              <td align="left">{$vo.jine}</td>
              <td align="left" <if condition="$vo.pay_status eq 1">title="支付宝交易流水号：{$vo.trade_no}&#10;&#13;支付宝账户：{$vo.buyer_email}&#10;&#13;支付金额：{$vo.jine}元&#10;&#13;支付时间：{$vo.paytime|date='Y-m-d H:m:s',###}"</if>>
              <if condition="$vo.pay_status eq 0">未支付<else />已支付</if></td>
              <td align="left"><a target="_blank" href="{$vo.house_url}">{$vo.house_title}</a></td>             
              <td align="left">{$vo.inputtime|date='Y-m-d H:i:s',###}</td>              
              <td align="left">
              <if condition="$vo.pay_status eq 0">
              <a class="J_ajax_del" href="{:U('Admin/Order/goudi_del', array('id'=>$vo['id']) )}">[删除]</a>
              </if>
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
</body>
</html>