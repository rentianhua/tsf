<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div><a href="{:U('Tracy/add')}" class="btn" title="添加内容"><span class="add"></span>添加内容</a></div>
  <br>
  <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">月份</td>
            <td align="left">二手房源全市均价(元/㎡)</td>
            <td align="left">全市均价环比上月(%)</td>
            <td align="left">昨日新增客房比(%)</td>
            <td align="left">上月成交量(套)</td>
            <td align="left">昨日房源带看次数(次)</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
            	<td align="left">{$vo.id}</td>
              <td align="left">{$vo.month}</td>
              <td align="left">{$vo.avg_price}
              <if condition="$vo['avg_price_o'] eq 1">↑<else />↓</if></td>
              <td align="left">{$vo.avg_percent}
              <if condition="$vo['avg_percent_o'] eq 1">↑<else />↓</if></td>                
              <td align="left">{$vo.house_percent}
              <if condition="$vo['house_percent_o'] eq 1">↑<else />↓</if></td>
              <td align="left">{$vo.comp_count}
              <if condition="$vo['comp_count_o'] eq 1">↑<else />↓</if></td>
              <td>{$vo.view_count}
              <if condition="$vo['view_count_o'] eq 1">↑<else />↓</if></td>
              <td align="left">
              <a href="{:U('Tracy/edit', array('id'=>$vo['id']) )}">修改</a> | 
              <a href="{:U('Tracy/delete', array('id'=>$vo['id']) )}" class="J_ajax_del">删除</a>
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
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