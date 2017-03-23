<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <br>
  <form action="{:U('Msg/send_user')}" method="post">
  发送给所有用户的消息：<input type="text" class="input" name="content" size="100" required> <input type="submit" class="btn" value="一键发送"></form>
  <br><br>
  <form action="{:U('Msg/send_jjr')}" method="post">
  发送给所有经纪人的消息：<input type="text" class="input" name="content" size="100" required> <input type="submit" class="btn" value="一键发送"></form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>