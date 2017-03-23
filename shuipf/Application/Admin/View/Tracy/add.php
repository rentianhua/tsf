<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">添加行情</div>
  <form name="myform" action="{:U('Tracy/add')}" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
		<tr>
			<th width="135">月份</th> 
			<td>
            <select class="province" name="month" data-val="1" data-title="选择">
            	<option value="1">1月</option>
                <option value="2">2月</option>
                <option value="3">3月</option>
                <option value="4">4月</option>
                <option value="5">5月</option>
                <option value="6">6月</option>
                <option value="7">7月</option>
                <option value="8">8月</option>
                <option value="9">9月</option>
                <option value="10">10月</option>
                <option value="11">11月</option>
                <option value="12">12月</option>
            </select>
            </td>
		</tr>
		<tr>
			<th>二手房源全市均价(元/㎡)</th> 
			<td>
            <input name="avg_price" class="input" />
            <input name="avg_price_o" type="radio" value="1" checked  />上升 <label class="type"><input name="avg_price_o" type="radio" value="2" />下降</td>
		</tr>
		<tr>
			<th>全市均价环比上月(%)</th> 
			<td>
            <input name="avg_percent" class="input" />
            <input name="avg_percent_o" type="radio" value="1" checked  />上升 <label class="type"><input name="avg_percent_o" type="radio" value="2" />下降</td>
		</tr>        
        <tr>
			<th>昨日新增客房比(%)</th> 
			<td>
            <input name="house_percent" class="input" />
            <input name="house_percent_o" type="radio" value="1" checked  />上升 <label class="type"><input name="house_percent_o" type="radio" value="2" />下降</td>
		</tr>
        <tr>
			<th>上月成交量(套)</th> 
			<td>
            <input name="comp_count" class="input" />
            <input name="comp_count_o" type="radio" value="1" checked  />上升 <label class="type"><input name="comp_count_o" type="radio" value="2" />下降</td>
		</tr>
        <tr>
			<th>昨日房源带看次数(次)</th> 
			<td>
            <input name="view_count" class="input" />
            <input name="view_count_o" type="radio" value="1" checked  />上升 <label class="type"><input name="view_count_o" type="radio" value="2" />下降</td>
		</tr>
	</table>
  </div>
   <div class="">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>