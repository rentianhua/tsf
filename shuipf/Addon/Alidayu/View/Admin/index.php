<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap jj">
  <Admintemplate file="Common/Nav"/>
  <div class="common-form">
    <form method="post" class="J_ajaxForm" action="{:U('Addons/Alidayu/test',array('isadmin'=>1))}">
      <div class="h_a">短信测试</div>
      <div class="table_list">
        <table cellpadding="0" cellspacing="0" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="140">手机号码:</td>
              <td><input type="text" class="input" name="mobile" id="mobile" value=""></td>
            </tr>
            <tr>
              <td>短信模板ID:</td>
              <td><input type="text" class="input" name="sms_id" id="sms_id" value=""></td>
            </tr>
            <tr>
              <td>模板内容变量:</td>
              <td>
                  <textarea name="sms_param" rows="5" cols="57" placeholder="code:123456"></textarea>
                  <p>变量设置格式，变量名称:变量内容；如：var:value<br>
可设置多个变量，一行一个<br>
变量名称只能是字母，数字</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">发送</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>