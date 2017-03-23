<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <link href="{:C('app_ui')}assets/css/amazeui.min.css" rel="stylesheet">
    <style>
		.chart {
			height: 200px;
			margin: 0px;
			padding: 0px;
		}
		h5 {
			margin-top: 30px;
			font-weight: bold;
		}
		h5:first-child {
			margin-top: 15px;
		}
	</style>
</head>
<body>
<ul class="am-avg-sm-3 am-text-center" style="background:#E84A01;color:#fff;">
	<li class="am-padding-vertical-sm">二手房源全市均价<div>2.8</div></li>
    <li class="am-padding-vertical-sm">全市均价环比上月<div>34123</div></li>
    <li class="am-padding-vertical-sm">昨日新增客房比<div>334</div></li>
    <!--<li class="am-padding-vertical-sm">上月成交量<div>334</div></li>
    <li class="am-padding-vertical-sm">昨日房源带看次数<div>334</div></li>-->
</ul>	 
	<div style="margin-top: 65px;">
		
		<div>
			<h5>价格趋势</h5>
			<div class="chart" id="barChart"></div>
			<br>
			<div class="chart" id="lineChart"></div>
			<h5>各区成交量</h5>
			<div class="chart" id="pieChart"></div>
		</div>
	</div>
	<script src="/statics/taosf/js/echarts-all.js"></script>
	<script>
		var getOption = function(chartType) {
			var chartOption = chartType == 'pie' ? {
				calculable: false,
				series: [{
					name: '访问来源',
					type: 'pie',
					radius: '65%',
					center: ['50%', '50%'],
					data: [{
						value: 335,
						name: '南山'
					}, {
						value: 310,
						name: '福田'
					}, {
						value: 234,
						name: '罗湖'
					}, {
						value: 135,
						name: '盐田'
					}, {
						value: 1548,
						name: '龙华新区'
					}]
				}]
			} : {
				legend: {
					data: ['全市均价', '挂牌均价']
				},
				grid: {
					x: 35,
					x2: 10,
					y: 30,
					y2: 25
				},
				toolbox: {
					show: false,
					feature: {
						mark: {
							show: true
						},
						dataView: {
							show: true,
							readOnly: false
						},
						magicType: {
							show: true,
							type: ['line', 'bar']
						},
						restore: {
							show: true
						},
						saveAsImage: {
							show: true
						}
					}
				},
				calculable: false,
				xAxis: [{
					type: 'category',
					data: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
				}],
				yAxis: [{
					type: 'value',
					splitArea: {
						show: true
					}
				}],
				series: [{
					name: '全市均价',
					type: chartType,
					data: [2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3]
				}, {
					name: '挂牌均价',
					type: chartType,
					data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3]
				}]
			};
			return chartOption;
		};
		var byId = function(id) {
			return document.getElementById(id);
		};
		var barChart = echarts.init(byId('barChart'));
		barChart.setOption(getOption('bar'));
		var lineChart = echarts.init(byId('lineChart'));
		lineChart.setOption(getOption('line'));
		var pieChart = echarts.init(byId('pieChart'));
		pieChart.setOption(getOption('pie'));
		byId("echarts").addEventListener('tap',function(){
			var url = this.getAttribute('data-url');
			plus.runtime.openURL(url);
		},false);
	</script>
</body>
</html>