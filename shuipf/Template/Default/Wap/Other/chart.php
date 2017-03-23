<template file="Wap/header.php"/>
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
	<div class="mui-content" style="margin-top: 65px;">
		
		<div class="mui-content-padded">
			<h5>价格趋势</h5>
			<div class="chart" id="barChart"></div>
			<br>
			<div class="chart" id="lineChart"></div>
			<h5>各区成交量</h5>
			<div class="chart" id="pieChart"></div>
		</div>
	</div>
	<script src="{:C('wap_ui')}js/echarts-all.js"></script>
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