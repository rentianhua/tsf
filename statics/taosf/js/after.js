$(function(){
	/*首页搜索推荐联动*/
	$("#tuijian>div:not(:first)").hide();
	$(".index-tab-nav a").click(function(){
		$( $(this).attr("href") + "-con" ).show().siblings().hide();
	});
	$("#tuijian a").hover(function(){
		$(this).children(".am-gallery-title").css({"background":"#ED1B24"});
	},function(){
		$(this).children(".am-gallery-title").css({"background":"rgba(0, 0, 0, 0.5)"});
	});
});

function mymapinit(jwd) {
    // 百度地图API功能
    var map = new BMap.Map("l-map");            // 创建Map实例
    map.centerAndZoom(new BMap.Point(jwd), 18);

    var local = new BMap.LocalSearch(map, {
        renderOptions: {map: map, panel: "r-result"}
    });
    local.search("公交");

    var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
    map.addControl(top_left_control);
    map.addControl(top_left_navigation);

    $("#around li").click(function(){
        local.search($(this).text());
        $(this).addClass("select").siblings().removeClass("select");
    });
}