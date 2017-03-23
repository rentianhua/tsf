<!--导航开始-->
<div class="nav-bg">
  <div class="am-g" style="margin:auto;width: 1010px;">
    <div class="am-u-lg-1 nav-other" style="width:80px;">
      深圳
    </div>
    <div class="am-u-lg-8" style="padding: 0;width:755px;">
      <!-- 菜单 -->
      <div class="w-navbar">
    <nav data-am-widget="menu" class="am-menu  am-menu-dropdown2">
      <a href="javascript: void(0)" class="am-menu-toggle">
            <i class="am-menu-toggle-icon am-icon-bars"></i>
      </a>
      <ul class="am-menu-nav am-avg-sm-4 am-collapse w-nav">
          <li>
            <a href="/">首页</a>            
          </li>
          <content action="category" catid="0"  order="listorder ASC" >
            <volist name="data" id="vo">
              <li>
                <a href="{$vo.url}"  title="{$vo.description}">{$vo.catname}</a>
              </li>
           </volist>
         </content>
      </ul>
    </nav>
  </div>
    </div>
    <div class="am-u-lg-3 nav-other" style="width:175px">
    <?php 
		$userinfo=$this->userinfo = service("Passport")->getInfo();
		if($userinfo){
			?>
            <a href="/index.php?g=Member&m=User&a=<if condition="$userinfo['modelid'] eq 35">guanzhu&t=1<else />esf</if>" id="username">{$userinfo['username']|substr_replace=###,'****',3,4}</a>
            &nbsp;&nbsp;<a href="/index.php?g=Member&a=logout">退出</a>            
		<?php
		}else{
			$back=urlencode(get_url());
			echo '
			<a href="/index.php?g=Member&a=login&back='.$back.'"><span class="am-icon-user"></span>登录</a> | 
      		<a href="/index.php?g=Member&a=register&back='.$back.'">注册</a>';
		}
	?>      
    </div>
  </div>
  
</div>
<!-- 导航结束 --> 
