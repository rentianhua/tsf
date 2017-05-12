<template file="Member/Public/head_user.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/main.css" rel="stylesheet">
<div class="user-main">
  <template file="Member/Public/homeUserMenu.php"/>
  <div class="main-right fr">
    <table class="am-table">
    <if condition="($userinfo['modelid'] eq 35)">
    <!--普通用户-我的预约-->
    <div class="tab">
    <a href="/index.php?g=Member&m=User&a=yuyue&t=1">
    <span class="actTap <if condition="$_GET['t'] eq 1">hover selected</if>">看房行程</span>
    </a>
    <a href="/index.php?g=Member&m=User&a=yuyue&t=2">
    <span class="actTap <if condition="$_GET['t'] eq 2">hover selected</if>">带看行程</span>
    </a>
    </div>
    	<if condition="$_GET['t'] eq 1">
        <thead>
            <tr>
              <th>#</th>
              <th>房源</th>
              <th>看房日期</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
        </thead>
        <tbody>
           <!--  <content action="lists" catid="50" where="$sql" order="inputtime DESC" num="8" page="$page"> -->
        <volist name="arr" id="vo">
        <tr>
                  <td>{$i}</td>
                  <?php $bt = getBT($vo['fromid'],$vo['fromtable']);?>
                  <td><div class="am-text-truncate" style="width: 270px;">
                      <a target="_blank" href="<?php echo $bt['url'];?>"><?php echo $bt['title'];?></a>
                    </div></td>
                  <td>{$vo.yuyuedate} {$vo.yuyuetime}</td>
                  <?php
                  //判断是否过期				  
				  $str = $vo['yuyuedate']." ".explode('-',$vo['yuyuetime'])[1].":00";
                  $yuyuetime = strtotime($str);
                  if( time()>$yuyuetime ){
                    $expire = true;
                  }
                  ?>
                  <td>{$vo.zhuangtai}<?php if($expire){echo '<span class="w-red">(已过期)</span>';}?></td>
                  <td>
                      <!-- <if condition="$vo['lock'] neq 1"> -->
                      <if condition="($expire neq true) and ($vo['zhuangtai'] neq '已取消')">
                        <a href="javascript:;" value="/index.php?g=Member&m=User&a=cancelyuyue&id={$vo.id}" class="del" >
                          取消预约
                        </a>
                      </if>
                      <!-- <a href="javascript:;" value="/index.php?g=Member&m=User&a=delyuyue&id={$vo.id}" class="del">
                        <img src="{:C('app_ui')}images/delete.png" title="删除" style="width:20px;height:20px;">
                      </a> -->
                      <!-- </if> -->
                      <!-- <if condition="$vo['lock'] neq 0">
                        <span class="w-red">(已锁)</span> 
                      </if> -->
                  </td>
                </tr>
        </volist>
    </content>
        </tbody>
        <else />
        <thead>
            <tr>
              <th>#</th>
              <th>房源</th>
              <th>预约人</th>
              <th>看房日期</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <!-- <content action="lists" catid="50" where="$sql" order="inputtime DESC" num="8" page="$page"> -->
        <volist name="arr" id="vo">
        <tr>
                  <td>{$i}</td>
                  <?php $bt = getBT($vo['fromid'],$vo['fromtable']);?>
                  <td><div class="am-text-truncate" style="width: 270px;">
                      <a target="_blank" href="<?php echo $bt['url'];?>"><?php echo $bt['title'];?></a>
                    </div></td>
                    <td>{$vo.username}</td>
                  <td>{$vo.yuyuedate} {$vo.yuyuetime}</td>
                  <td>{$vo.zhuangtai}
				  <?php 
                  //判断是否过期				  
				  $str = $vo['yuyuedate']." ".explode('-',$vo['yuyuetime'])[1].":00";
                  $yuyuetime = strtotime($str);
                  if( time()>$yuyuetime ){
                    $expire = true;
                  }
				  if($expire){
					  echo '<span class="w-red">(已过期)</span>';
					}
					?></td>
          <td>
           <?php
              if($expire){
            
              }else{
                if($vo['lock'] == 1){
                }else{
                  echo '<a href="/index.php?g=member&m=user&a=confirmyuyue&id='.$vo['id'].'" style="text-decoration:underline">确认</a>';
                }
              }
            ?>
          </td>
                </tr>
        </volist>
    </content>
        </tbody>
        </if>
    <else />
    	<thead>
            <tr>
              <th>#</th>
              <th>房源</th>
              <th>预约人</th>
              <th>看房日期</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <!-- <content action="lists" catid="50" where="$sql" order="inputtime DESC" num="8" page="$page"> -->
        <volist name="arr" id="vo">
        <tr>
                  <td>{$i}</td>
                  <?php $bt = getBT($vo['fromid'],$vo['fromtable']);?>
                  <td><div class="am-text-truncate" style="width: 270px;">
                      <a target="_blank" href="<?php echo $bt['url'];?>"><?php echo $bt['title'];?></a>
                    </div></td>
                    <td>{$vo.username}</td>
                  <td>{$vo.yuyuedate} {$vo.yuyuetime}</td>
                  <td>{$vo.zhuangtai}
				  <?php 
                  //判断是否过期				  
				  $str = $vo['yuyuedate']." ".explode('-',$vo['yuyuetime'])[1].":00";
                  $yuyuetime = strtotime($str);
                  if( time()>$yuyuetime ){
                    $expire = true;
                  }
				  if($expire){
					  echo '<span class="w-red">(已过期)</span>';
					}
					?></td>
          <td>
            <?php
              if($expire){
              }else{
                if($vo['lock'] == 1){
                }else{
                  echo '<a href="/index.php?g=member&m=user&a=confirmyuyue&id='.$vo['id'].'" style="text-decoration:underline">确认</a>';
                }
              }
            ?>
          </td>
                </tr>
        </volist>
    </content>
        </tbody>
    </if>
        </table>
  </div>
</div>
<script type="text/javascript">
profile.init();
$(".del").click(function(){
	var href = $(this).attr("value");
	if(confirm("确认取消吗？")){
		window.location.href = href;	
	}
});
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
