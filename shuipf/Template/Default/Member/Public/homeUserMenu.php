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
<div class="main-left fl">
  <div class="name"><img style="border-radius:50%;" src="
  <if condition="$userinfo['userpic'] neq ''">
  {$userinfo.userpic}
  <else />
  /statics/extres/member/images/noavatar.jpg
  </if>
  " id="menu-avatar"></div>
  <div class="user-name">{$userinfo.username|substr_replace=###,'****',3,4}</div>
  <?php $a = $_SERVER["QUERY_STRING"];?>
  <ul>    
    <if condition="$userinfo['modelid'] eq 35">
    	<li 
		<?php 
		if(strpos($a, "guanzhu") !== false){
			echo 'class="hover"';
		}
		?>        
        ><a href="{:U('User/guanzhu?t=1')}">我的关注</a></li>
       	<li 
        <?php 
		if(strpos($a, "esf") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=esf">我要卖房</a></li>
        <li 
        <?php 
		if(strpos($a, "czf") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=czf">我要出租</a></li>        
        <li 
        <?php 
		if(strpos($a, "qiuzu") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=qiuzu">我要租房</a></li>
        <li 
        <?php 
		if(strpos($a, "qiugou") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=qiugou">我要买房</a></li>
        <li 
        <?php 
		if(strpos($a, "yuyue") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=yuyue&t=1">我的预约</a></li>
        <li 
        <?php 
		if(strpos($a, "yhq") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=yhq">我的优惠券</a></li>
        <li 
            <?php 
		if(strpos($a, "gd") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=gd">勾地订单</a></li>
        <li 
        <?php 
		if(strpos($a, "history") !== false){
			echo 'class="hover"';
		}
		?> 
        ><a href="/index.php?g=Member&m=User&a=history">历史记录</a></li>  <!--执行删除的和成交的记录-->
      </if>
      <if condition="$userinfo['modelid'] eq 36">
      	<li
            <?php 
		if(strpos($a, "esf") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=esf">二手房管理</a></li>
            
            <li
            <?php 
		if(strpos($a, "czf") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=czf">出租房管理</a></li>
            <li
            <?php 
		if(strpos($a, "chengjiao") !== false){
			echo 'class="hover"';
		}
		?> 
        	><a href="/index.php?g=Member&m=User&a=chengjiao&t=1">成交房源</a></li>
            <li
            <?php 
		if(strpos($a, "yuyue") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=yuyue">预约管理</a></li>
            <li 
            <?php 
		if(strpos($a, "qiuzu") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=qiuzu">求租管理</a></li>
            <li 
            <?php 
		if(strpos($a, "qiugou") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=qiugou">求购管理</a></li>
            <li 
            <?php 
		if(strpos($a, "weituo") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=weituo&t=1">委托管理</a></li>
            <li 
            <?php 
		if(strpos($a, "gd") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=gd">勾地订单</a></li>
            <li 
            <?php 
		if(strpos($a, "yhq") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=yhq">我的优惠券</a></li>
            <li 
            <?php 
		if(strpos($a, "history") !== false){
			echo 'class="hover"';
		}
		?> 
            ><a href="/index.php?g=Member&m=User&a=history&ly=jjr">历史记录</a></li>  <!--执行删除的和成交的记录-->
      </if> 
      <li
    <?php 
		if(strpos($a, "profile") !== false){
			echo 'class="hover"';
		}
		?>
    ><a href="{:U('User/profile')}">个人中心</a></li>
  </ul>
</div>