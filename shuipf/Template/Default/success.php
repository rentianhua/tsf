<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>{$Config.sitename} - 提示信息</title>
<Admintemplate file="Admin/Common/Cssjs"/>
<link rel="stylesheet" type="text/css" media="all" href="{:C('app_ui')}css/style.css">
</head>
<body>
<div class="notify successbox" style="margin-top:10%;">
    <h1>Success!</h1>
    <span class="alerticon"><img src="{:C('app_ui')}images/check.png" /></span>
    <p style="text-align: center;font-size: 18px">{$message}</p>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script language="javascript">
setTimeout(function(){
	location.href = '{$jumpUrl}';
},0);
</script>
</body>
</html>