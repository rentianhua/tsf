<Admintemplate file="Admin/Common/Head"/>
<body class="body_none">
<style>
/*设置tab*/
.pop_nav {
	padding:10px 15px 0;
	margin-bottom:10px;
}
.pop_nav ul{
	border-bottom:1px solid #e3e3e3;
	padding:0 5px;
	height:25px;
	clear:both;
}
.pop_nav ul li{
	float:left;
	margin-right:10px;
}
.pop_nav ul li a{
	float:left;
	display:block;
	padding:0 10px;
	height:25px;
	line-height:23px;
}
.pop_nav ul li.current a{
	border:1px solid #e3e3e3;
	border-bottom:0 none;
	color:#333;
	font-weight:700;
	background:#fff;
	position:relative;
	border-radius:2px;
	margin-bottom:-1px;
}
.pop_cont{
	padding:0 15px;
}
/*上传*/
.edit_menu_cont {
    padding: 10px 15px;
}
.edit_uping {
    height: 30px;
    margin-bottom: 10px;
}
.edit_uping .num {
    color: #999999;
    float: right;
    margin-top: 5px;
}
.edit_uping .num em {
    color: #FF5500;
    font-style: normal;
}
.eidt_uphoto {
    border: 1px solid #CCCCCC;
}
.eidt_uphoto ul {
    height: 280px;
    overflow-y: scroll;
    padding-bottom: 10px;
    position: relative;
}
.eidt_uphoto li {
    display: inline;
    float: left;
    height: 100px;
    margin: 10px 0 0 10px;
    width: 87px;
}
.eidt_uphoto .invalid {
    background: none repeat scroll 0 0 #FBFBFB;
    border: 1px solid #CCCCCC;
    height: 98px;
    position: relative;
    width: 78px;
}
.eidt_uphoto .invalid .error {
    padding: 30px 1px;
    text-align: center;
}
.eidt_uphoto .no {
    background: url("{$config_siteurl}statics/images/icon/upload_pic.jpg") no-repeat scroll center center #FBFBFB;
    border: 1px solid #CCCCCC;
    height: 98px;
    overflow: hidden;
    text-indent: -2000em;
}
.eidt_uphoto .nouplode {
    background: #FBFBFB;
    border: 1px solid #CCCCCC;
    height: 98px;
    overflow: hidden;
	text-align: center;
	padding: 0px 5px 0px 5px;
}
.eidt_uphoto .schedule {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    height: 98px;
    line-height: 98px;
    position: relative;
    text-align: center;
}
.eidt_uphoto .schedule span {
    background: none repeat scroll 0 0 #F0F5F9;
    height: 98px;
    left: 0;
    position: absolute;
    top: 0;
}
.eidt_uphoto .schedule em {
    left: 0;
    position: absolute;
    text-align: center;
    top: 0;
    width: 78px;
    z-index: 1;
}
.eidt_uphoto .get{
	background:#ffffff;
	border:1px solid #cccccc;
	position:relative;
	overflow:hidden;
}
.eidt_uphoto .selected{
	border:2px solid #1D76B7;
}
.eidt_uphoto .get img{
	cursor:pointer;
}
.eidt_uphoto .del{
	position:absolute;
	width:15px;
	height:15px;
	background:url("{$config_siteurl}statics/images/icon/upload_del.png") no-repeat;
	right:1px;
	top:1px;
	overflow:hidden;
	text-indent:-2000em;
	display:none;
}
.eidt_uphoto .del:hover{
	background-position:-20px 0;
}
.eidt_uphoto .get img{
	vertical-align:top;
	width:87px;
	height:75px;
	border-bottom:1px solid #ccc;
}
.eidt_uphoto .get input{
	border:0;
	outline:0 none;
	margin-left:3px;
}
.eidt_uphoto .get .edit{
	position:absolute;
	height:22px;
	line-height:22px;
	text-align:center;
	width:78px;
	bottom:0;
	left:0;
	background:#e5e5e5;
	color:#333;
	filter:alpha(opacity=70);
	-moz-opacity:0.7;
	opacity:0.7;
	display:none;
}
.eidt_uphoto li:hover .edit,
.eidt_uphoto li:hover .del{
	/*text-decoration:none;
	display:block;*/
}
/*上传选择按钮*/
#btupload,.addnew{
	background: url("{$config_siteurl}statics/js/swfupload/images/swfBnt.png") no-repeat; float:left; margin-right:10px;width:75px; height:28px; line-height:28px;font-weight:700; color:#fff;
}
#btupload{ 
    vertical-align:middle;border:none;cursor: hand;!important;cursor: pointer;
}
.addnew{
	background: url("{$config_siteurl}statics/js/swfupload/images/swfBnt.png") no-repeat; float:left; margin-right:10px;width:75px; height:28px; line-height:28px;font-weight:700; color:#fff;
}
.addnew{
	background-position: left bottom;
}
</style>
<script>
//用于图库加载
function set_iframe(id,src){
	if($("#"+id).attr("src") == ""){
		$("#"+id).attr("src",src); 
	}
}

//网络地址
function addonlinefile(obj) {
	var strs = $(obj).val() ? '|'+ $(obj).val() :'';
	$('#att-status').html(strs);
}

//是否添加水印设置
function change_params(){
	if($('#watermark_enable').attr('checked')) {
		swfu_{$module}.addPostParam('watermark_enable', '1');
	} else {
		swfu_{$module}.removePostParam('watermark_enable');
	}
}
//图片选择处理回调
function album_cancel(obj,id,source){
	//图片地址
	var src = $(obj).attr("data-path");
	//上传图片文件名
	var filename = $(obj).attr("title");
	//选择状态中的数据对象
	var selected = $("#fsUploadProgress .selected");
	if($("#aid-"+id).hasClass('selected')){
		$("#aid-"+id).removeClass("selected");
		selected = $("#fsUploadProgress .selected");
		var imgstr = $("#att-status").html();
		var length = selected.children("img").length;
		var strs = filenames = '';
		$.get('i/ndex.php?a=swfupload_json_del&m=Attachments&g=Attachment&aid='+id+'&src='+source+'&filename='+filename);
		for(var i=0;i<length;i++){
			strs += '|'+selected.children("img").eq(i).attr('path');
			filenames += '|'+selected.children("img").eq(i).attr('title');
		}
		$('#att-status').html(strs);
		$('#att-status').html(filenames);
	} else {
		var num = $('#att-status').html().split('|').length;
		var file_upload_limit = '{$file_upload_limit}';
		if(num > file_upload_limit) {alert('不能选择超过'+file_upload_limit+'个附件'); return false;}
		$("#aid-"+id).addClass("selected");
		$.get('/index.php?a=swfupload_json&m=Attachments&g=Attachment&aid='+id+'&src='+source+'&filename='+filename);
		$('#att-status').append('|'+src);
		$('#att-name').append('|'+filename);
	}
}
</script>
<script type="text/javascript">
{$initupload}
</script>
<div class="wrap" style="padding:5px;">
  <div class="pop_nav">
    <ul class="J_tabs_nav">
      <li class="current"><a href="javascript:;;">上传附件</a></li>
    </ul>
  </div>
  <div class="J_tabs_contents">
    <div class="pop_cont">
      <div class="">
        <div class="edit_uping"> 
             <!--选择按钮-->
            <div class="addnew"><span  id="buttonPlaceHolder"></span></div>
            <span class="num"><input type="checkbox" id="watermark_enable" value="1" <if condition=" $watermark_enable ">checked</if>  onclick="change_params()"><em>是否添加水印</em> 最多上传<em> {$file_upload_limit}</em> 个附件,单文件最大 <em>{$file_size_limit} KB</em>，<em style="cursor: help;" title="可上传格式：{$file_types}">支持格式？</em></span>
        </div>
        <div class="eidt_uphoto">
          <ul id="fsUploadProgress" class="cc">
            <!--<li class="J_empty"><div class="no">暂无</div></li>-->
          </ul>
        </div>
      </div>
    </div>
    
    <div class="pop_cont">
      <iframe name="album-list" src="" frameborder="false" scrolling="no" style="overflow-x:hidden;border:none" width="100%" height="350" allowtransparency="true" id="album_list"></iframe>
    </div>
    <if condition="$att_not_used neq ''">
      <div class="pop_cont">
       <div class="eidt_uphoto">
          <ul class="cc" style="height: 330px;">
            <volist name="att" id="vo">
            <li class="uploaded">
                <div class="get" id="aid-{$vo.aid}"> <a class="del" href="javascript:;">删除</a> 
                <img onClick="album_cancel(this,'{$vo.aid}','{$vo.src}')" width="87" height="98" src="{$vo.fileimg}" data-id="{$vo.aid}" data-path="{$vo.src}" alt="{$vo.filename}" title="{$vo.filename}"><input type="text" class="J_file_desc" name="flashatt[{$vo.aid}]" value="{$vo.filename}" style="width:68px"></div>
            </li>
            </volist>
          </ul>
        </div>
      </div>
    </if>
  </div>
</div>
<div id="att-status" style="display:none"></div>
<div id="att-status-del" style="display:none"></div>
<div id="att-name" style="display:none"></div>
<script src="{$config_siteurl}statics/js/common.js"></script> 
<script>
$(function(){
    //擦，ie8 ie9,会莫名奇妙的在div#att-status里面多一个 http:// 我太囧了。。。
    $("#att-status").html("");
    $("#att-status-del").html("");
    $("#att-name").html("");
});
</script>
</body>
</html>