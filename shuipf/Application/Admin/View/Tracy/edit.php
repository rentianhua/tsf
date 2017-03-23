<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">修改行情</div>
  <form name="myform" action="{:U('Tracy/edit')}" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
		<tr>
			<th width="135">月份</th> 
			<td>
            <select class="province" name="month" data-val="1" data-title="选择">
            	<option value="1" <if condition="$vo['month'] eq 1">selected</if>>1月</option>
                <option value="2" <if condition="$vo['month'] eq 2">selected</if>>2月</option>
                <option value="3" <if condition="$vo['month'] eq 3">selected</if>>3月</option>
                <option value="4" <if condition="$vo['month'] eq 4">selected</if>>4月</option>
                <option value="5" <if condition="$vo['month'] eq 5">selected</if>>5月</option>
                <option value="6" <if condition="$vo['month'] eq 6">selected</if>>6月</option>
                <option value="7" <if condition="$vo['month'] eq 7">selected</if>>7月</option>
                <option value="8" <if condition="$vo['month'] eq 8">selected</if>>8月</option>
                <option value="9" <if condition="$vo['month'] eq 9">selected</if>>9月</option>
                <option value="10" <if condition="$vo['month'] eq 10">selected</if>>10月</option>
                <option value="11" <if condition="$vo['month'] eq 11">selected</if>>11月</option>
                <option value="12" <if condition="$vo['month'] eq 12">selected</if>>12月</option>
            </select>
            </td>
		</tr>
		<tr>
			<th>二手房源全市均价(元/㎡)</th> 
			<td>
            <input name="avg_price" class="input" value="{$vo.avg_price}" />
            <input name="avg_price_o" type="radio" value="1" <if condition="$vo['avg_price_o'] eq 1">checked</if> />上升 <label class="type"><input name="avg_price_o" type="radio" value="2" <if condition="$vo['avg_price_o'] eq 2">checked</if> />下降</td>
		</tr>
		<tr>
			<th>全市均价环比上月(%)</th> 
			<td>
            <input name="avg_percent" class="input" value="{$vo.avg_percent}" />
            <input name="avg_percent_o" type="radio" value="1" <if condition="$vo['avg_percent_o'] eq 1">checked</if>  />上升 <label class="type"><input name="avg_percent_o" type="radio" value="2" <if condition="$vo['avg_percent_o'] eq 2">checked</if> />下降</td>
		</tr>        
        <tr>
			<th>昨日新增客房比(%)</th> 
			<td>
            <input name="house_percent" class="input" value="{$vo.house_percent}" />
            <input name="house_percent_o" type="radio" value="1" <if condition="$vo['house_percent_o'] eq 1">checked</if>  />上升 <label class="type"><input name="house_percent_o" type="radio" value="2" <if condition="$vo['house_percent_o'] eq 2">checked</if> />下降</td>
		</tr>
        <tr>
			<th>上月成交量(套)</th> 
			<td>
            <input name="comp_count" class="input" value="{$vo.comp_count}" />
            <input name="comp_count_o" type="radio" value="1" <if condition="$vo['comp_count_o'] eq 1">checked</if>  />上升 <label class="type"><input name="comp_count_o" type="radio" value="2" <if condition="$vo['comp_count_o'] eq 2">checked</if> />下降</td>
		</tr>
        <tr>
			<th>昨日房源带看次数(次)</th> 
			<td>
            <input name="view_count" class="input" value="{$vo.view_count}"/>
            <input name="view_count_o" type="radio" value="1" <if condition="$vo['view_count_o'] eq 1">checked</if>  />上升 <label class="type"><input name="view_count_o" type="radio" value="2" <if condition="$vo['view_count_o'] eq 2">checked</if> />下降</td>
		</tr>
	</table>
  </div>
   <div class="">
      <div class="btn_wrap_pd">   
      	<input type="hidden" value="{$vo.id}" name="id">          
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">修改</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>