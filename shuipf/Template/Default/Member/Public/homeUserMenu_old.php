<?php
switch (CONTROLLER_NAME) {
	case 'Index':
			$user_menu = 'mfeed'; 
			break;
	case 'User':
			$user_menu = 'profilem';
			break;
	case 'Relation':
			$user_menu = 'fansm';
			break;
	case 'Message':
			$user_menu = ACTION_NAME=='notification'?'mnotification':'messagem';
			break;
	case 'Wall':
			$user_menu = 'wallm';
			break;
	case 'Miniblog':
			$user_menu = 'miniblogm';
			break;
	case 'Album':
			$user_menu = 'albumm';
			break;
	case 'Favorite':
			$user_menu = 'song';
			break;
	case 'Msg':
			$user_menu = 'messagem';
			break;
	case 'Account':
			$user_menu = 'account';
			break;
	default:
			$user_menu = 'feed';
            break;
}
?>
<div class="user_menu" id="{$user_menu}">
  <div class="userinfo">
    <div class="face" style="border:none;text-align: center">
      <img style="border-radius:50%;" src="
      <if condition="$userinfo['userpic'] neq ''">
      {$userinfo.userpic}
      <else />
      http://www.taoshenfang.com/statics/extres/member/images/noavatar.jpg
      </if>
    " id="menu-avatar"> </div>
 	<div style=" width:160px;font-size:16px;text-align:center;margin-bottom:2px;font-weight:bold">欢迎你，{$userinfo.nickname}</div>
  </div>
  <div >
<style>
  #memus ul{width:180px !important;}
  #memus li{
	list-style: outside none none;
    margin: 0;
    padding: 0;
	width:180px !important;}
  #memus a {
    color: #555;
    display: inline-block;
    font-size: 16px;
    height: 40px;
    line-height: 40px;
    margin: 0 auto;
    text-align: left;
    width: 82px;
}
  .userinfo .face img {
    height: 120px;
    width: 120px;
  }
  </style>
    <ul id="memus">
    	<li><a href="{:U('User/profile')}">个人中心</a></li>
      <if condition="$userinfo['modelid'] eq 35">
       	<li><a href="/index.php?g=Member&m=User&a=esf&ly=yz">我的二手房</a></li>
        <li><a href="/index.php?g=Member&m=User&a=czf&ly=yz">我的出租</a></li>
        <li><a href="{:U('User/weituo')}">我的委托</a></li>
        <li><a href="/index.php?g=Member&m=User&a=qiuzu&ly=yz">求租房</a></li>
        <li><a href="{:U('User/guanzhu')}">我的关注</a></li>
        <li><a href="/index.php?g=Member&m=User&a=yuyue&ly=yz">我的预约</a></li>
        <li><a href="/index.php?g=Member&m=User&a=history&ly=yz">历史记录</a></li>  <!--执行删除的和成交的记录-->

      </if>
      <if condition="$userinfo['modelid'] eq 36">
            <li><a href="javascript:;">历史成交</a></li>
            <li><a href="/index.php?g=Member&m=User&a=czf&ly=jjr">我的出租</a></li>
            <li><a href="/index.php?g=Member&m=User&a=esf&ly=jjr">我的二手房</a></li>
            <li><a href="/index.php?g=Member&m=User&a=yuyue&ly=jjr">预约管理</a></li>
            <li><a href="/index.php?g=Member&m=User&a=qiuzu&ly=jjr">求租管理</a></li>
            <li><a href="/index.php?g=Member&m=User&a=history&ly=jjr">历史记录</a></li>  <!--执行删除的和成交的记录-->
            <!--历史记录表字段：id 来源id 来源table_name 删除时间 类型(租房删除，二手房删除，新房删除，预约删除，成交,代金券购买)，username, userid,nickname,-->
      </if>      
    </ul>
  </div>
</div>
