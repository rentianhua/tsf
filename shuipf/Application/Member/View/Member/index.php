<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">搜索</div>
  <form name="searchform" action="" method="get" >
    <input type="hidden" value="Member" name="g">
    <input type="hidden" value="Member" name="m">
    <input type="hidden" value="index" name="a">
    <input type="hidden" value="1" name="search">
    <div class="search_type cc mb10">
      <div class="mb10"> <span class="mr20"> 注册时间：
        <input type="text" name="start_time" class="input length_2 J_date" value="{$Think.get.start_time}" style="width:80px;">
        -
        <input type="text" class="input length_2 J_date" name="end_time" value="{$Think.get.end_time}" style="width:80px;">
        <select name="status">
          <option value='0' >状态</option>
          <option value='1' >锁定</option>
          <option value='2' >正常</option>
        </select>
        <?php echo Form::select($groupCache, (int)$_GET['groupid'], 'name="groupid"', '会员组') ?>
        <select name="type">
          <option value='1' >用户名</option>
          <option value='2' >用户ID</option>
          <option value='4' >注册ip</option>
          <option value='5' >昵称</option>
        </select>
        <input name="keyword" type="text" value="{$Think.get.keyword}" class="input" />
        <button class="btn">搜索</button>
        </span> </div>
    </div>
  </form>
  <form name="myform" action="{:U('Member/delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td  align="left" width="20"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></td>
            <td align="left"></td>
            <td align="left">用户ID</td>
            <td align="left">用户名</td>
            <td align="left">姓名</td>
            <td align="left">模型名称</td>
            <td align="left">分机号</td>
            <!--<td align="left">注册ip</td>-->
            <td align="left">注册时间</td>
            <td align="left">最后登录</td>
            <!--<td align="left">金钱总数</td>
            <td align="left">积分点数</td>-->
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left"><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x"  value="{$vo.userid}" name="userid[]"></td>
              <td align="left"><if condition=" $vo['islock'] eq '1' "><img title="锁定" src="{$config_siteurl}statics/images/icon/icon_padlock.gif"></if>
                <if condition=" $vo['checked'] eq '0' "><img title="待审核" src="{$config_siteurl}statics/images/icon/info.png"></if></td>
              <td align="left">{$vo.userid}</td>
              <td align="left">
              <img src="
                <if condition="$vo['userpic'] neq ''">
                  {$vo.userpic}
                  <else />
                  http://www.taoshenfang.com/statics/extres/member/images/noavatar.jpg
                </if>
                " height=18 width=18>
                {$vo.username}<a href="javascript:member_infomation({$vo.userid}, '{$vo.modelid}', '')"><img src="{$config_siteurl}statics/images/icon/detail.png"></a>
                <if condition="$vo['normal']['jiav'] eq 1">
                <img src="{:C('app_ui')}images/v1.png">
                </if>
                </td>
                
              <td align="left">{$vo.normal.realname}</td>
              <td align="left">{$groupsModel[$vo['modelid']]}</td>
              <td>
              <if condition="$vo['zhuanjie'] eq 0">
              <a class="btn" href="javascript:;" onclick="applyvtel('{$vo.username}','{$vo.userid}');$(this).html('申请中...');$(this).attr('disabled',true);">申请分机号</a>
              <else />
              {$vo.vtel}
              <a href="javascript:;" class="btn" onclick="disbindvtel('{$vo.username}','{$vo.userid}');$(this).html('解绑中...');$(this).attr('disabled',true);">解绑</a>
              </if>
              </td>
              <!--<td align="left">{$vo.regip}</td>-->
              <td align="left">{$vo.regdate|date='Y-m-d H:m:s',###}</td>
              <td align="left"><if condition=" $vo['lastdate'] eq 0 ">还没有登录过
                  <else />
                  {$vo.lastdate|date='Y-m-d H:i:s',###}</if></td>
              <!--<td align="left">{$vo.amount}</td>
              <td align="left">{$vo.point}</td>-->
              <td align="left">
              <a href="<if condition="$vo['modelid'] eq 35">{:U('Member/usercenter', array('userid'=>$vo['userid'], 'username'=>$vo['username']) )}<else />{:U('Member/jjrcenter', array('userid'=>$vo['userid'], 'username'=>$vo['username']) )}</if>">[查看所有信息]</a>
              <a href="{:U('Member/edit', array('userid'=>$vo['userid']) )}">[修改]</a>
              <a href="javascript:if(confirm('确实要删除吗?'))location='{:U('Member/delete', array('userid'=>$vo['userid']) )}'">[删除]</a></td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
    <div class="">
      <div class="btn_wrap_pd">
        <button class="btn  mr10 J_ajax_submit_btn" data-action="{:U('Member/Member/lock')}" type="submit">锁定</button>
        <button class="btn  mr10 J_ajax_submit_btn" data-action="{:U('Member/Member/unlock')}" type="submit">解锁</button>
        <!--<button class="btn  mr10 J_ajax_submit_btn" type="submit">删除</button>-->
        <a class="btn" href="{:U('Member/Member/userlist')}">导出数据</a>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
<script>
//会员信息查看
function member_infomation(userid, modelid, name) {
	omnipotent("member_infomation", GV.DIMAUB+'index.php?g=Member&m=Member&a=memberinfo&userid='+userid+'', "个人信息",1)
}
/*申请分机号*/
function applyvtel(vtel, uid){
	$.get("/index.php?g=api&m=api&a=add_vtel&tel="+vtel+"&userid="+uid,function (data) {
	var obj = jQuery.parseJSON(data);
      if(obj.success == 57){
       window.parent.document.getElementById('iframe_162Member').contentWindow.location.reload(true);

      }else{

        alert(obj.info);

        return false;

      }

  });
}
/*解绑分机号*/
function disbindvtel(vtel, uid){
	$.get("/index.php?g=api&m=api&a=remove_vtel&tel="+vtel+"&userid="+uid,function (data) {
		var obj = jQuery.parseJSON(data);
      if(obj.success == 64){
        window.parent.document.getElementById('iframe_162Member').contentWindow.location.reload(true);

      }else{

        alert(obj.info);

        return false;

      }

  });
}
</script>
</body>
</html>