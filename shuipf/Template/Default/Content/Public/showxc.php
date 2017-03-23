<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<link rel="stylesheet" href="{:C('app_ui')}css/xiangceDetail.css">
<style>
  .xiangce-detail ul, .xiangce-detail li {
    list-style: outside none none;
    margin: 0;
    padding: 0;
  }
</style>
<div class="main-wrap xiangce-detail">
  <h1>{$title}相册&nbsp;&nbsp;<a style="font-size: 12px;font-weight: normal" href="{$url}">返回</a></h1>
  <?php
  $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;
  foreach ($loupantupian as $value){
    $t1++;
  }
  foreach ($weizhitu as $value){
    $t2++;
  }
  foreach ($yangbantu as $value){
    $t3++;
  }
  foreach ($shijingtu as $value){
    $t4++;
  }
  foreach ($xiaoqutu as $value){
    $t5++;
  }
  ?>
  <ul class="photo-type">
    <li class="current" data-type=101900000004 data-index=0>效果图
      ({$t1}) </li>
    <li  data-type=101900000002 data-index=1>位置图
      ({$t2}) </li>
    <li  data-type=102000000003 data-index=2>样板间
      ({$t3}) </li>
    <li  data-type=101900000001 data-index=3>实景图
      ({$t4}) </li>
    <li  data-type=102000000012 data-index=4>小区配套
      ({$t5}) </li>
  </ul>
  <div class="slides-all-wrap">
    <div class="slider-wrap" data-type=101900000004 data-role="current">
      <div class="photo-large"> <a class="slide-control slide-prev"></a>
        <div class="photoslier">
          <ul class="slides clear">
            <?php
            $i=0;
            foreach ($loupantupian as $value){
              echo '
              <li data-index="'.$i.'"> <img src="'.$value['url'].'" alt="'.$value['alt'].'" title="'.$value['alt'].'" /> </li>
              ';
              $i++;
            }
            if($i == 0){
              echo '
              <li data-index="'.$i.'" style="background:#F1F1F1"> 暂无图片 </li>
              ';
            }
            ?>
          </ul>
        </div>
        <a class="slide-control slide-next"></a> </div>
      <div class="thumbnail"> <a class="slide-control slide-prev"><i></i></a>
        <div class="thumbslider">
          <ul class="slides clear">
            <li class="jump-item" data-index="prev" data-role="switch"> <span class="jump-title">上一分类</span> <span class="jump-name"></span> </li>
            <?php
            $i=0;
            foreach ($loupantupian as $value){
              echo '
              <li data-index="'.$i.'" data-role="page"> <img src="'.$value['url'].'" /> </li>
              ';
              $i++;
            }
            ?>
            <li class="jump-item" data-index="next" data-role="switch"> <span class="jump-title">下一分类</span> <span class="jump-name"></span> </li>
          </ul>
        </div>
        <a class="slide-control slide-next"><i></i></a> </div>
    </div>
    <div class="slider-wrap" data-type=101900000002 >
      <div class="photo-large"> <a class="slide-control slide-prev"></a>
        <div class="photoslier">
          <ul class="slides clear">
            <?php
            $i=0;
            foreach ($weizhitu as $value){
              echo '
              <li data-index="'.$i.'"> <img src="'.$value['url'].'" alt="'.$value['alt'].'" title="'.$value['alt'].'" /> </li>
              ';
              $i++;
            }
            ?>
          </ul>
        </div>
        <a class="slide-control slide-next"></a> </div>
      <div class="thumbnail"> <a class="slide-control slide-prev"><i></i></a>
        <div class="thumbslider">
          <ul class="slides clear">
            <li class="jump-item" data-index="prev" data-role="switch"> <span class="jump-title">上一分类</span> <span class="jump-name"></span> </li>
            <?php
            $i=0;
            foreach ($weizhitu as $value){
              echo '
              <li data-index="'.$i.'" data-role="page"> <img src="'.$value['url'].'" /> </li>
              ';
              $i++;
            }
            ?>
            <li class="jump-item" data-index="next" data-role="switch"> <span class="jump-title">下一分类</span> <span class="jump-name"></span> </li>
          </ul>
        </div>
        <a class="slide-control slide-next"><i></i></a> </div>
    </div>
    <div class="slider-wrap" data-type=102000000003 >
      <div class="photo-large"> <a class="slide-control slide-prev"></a>
        <div class="photoslier">
          <ul class="slides clear">
            <?php
            $i=0;
            foreach ($yangbantu as $value){
              echo '
              <li data-index="'.$i.'"> <img src="'.$value['url'].'" alt="'.$value['alt'].'" title="'.$value['alt'].'" /> </li>
              ';
              $i++;
            }
            ?>
          </ul>
        </div>
        <a class="slide-control slide-next"></a> </div>
      <div class="thumbnail"> <a class="slide-control slide-prev"><i></i></a>
        <div class="thumbslider">
          <ul class="slides clear">
            <li class="jump-item" data-index="prev" data-role="switch"> <span class="jump-title">上一分类</span> <span class="jump-name"></span> </li>
            <?php
            $i=0;
            foreach ($yangbantu as $value){
              echo '
              <li data-index="'.$i.'" data-role="page"> <img src="'.$value['url'].'" /> </li>
              ';
              $i++;
            }
            ?>
            <li class="jump-item" data-index="next" data-role="switch"> <span class="jump-title">下一分类</span> <span class="jump-name"></span> </li>
          </ul>
        </div>
        <a class="slide-control slide-next"><i></i></a> </div>
    </div>
    <div class="slider-wrap" data-type=101900000001 >
      <div class="photo-large"> <a class="slide-control slide-prev"></a>
        <div class="photoslier">
          <ul class="slides clear">
            <?php
            $i=0;
            foreach ($shijingtu as $value){
              echo '
              <li data-index="'.$i.'"> <img src="'.$value['url'].'" alt="'.$value['alt'].'" title="'.$value['alt'].'" /> </li>
              ';
              $i++;
            }
            ?>
          </ul>
        </div>
        <a class="slide-control slide-next"></a> </div>
      <div class="thumbnail"> <a class="slide-control slide-prev"><i></i></a>
        <div class="thumbslider">
          <ul class="slides clear">
            <li class="jump-item" data-index="prev" data-role="switch"> <span class="jump-title">上一分类</span> <span class="jump-name"></span> </li>
            <?php
            $i=0;
            foreach ($shijingtu as $value){
              echo '
              <li data-index="'.$i.'" data-role="page"> <img src="'.$value['url'].'" /> </li>
              ';
              $i++;
            }
            ?>
            <li class="jump-item" data-index="next" data-role="switch"> <span class="jump-title">下一分类</span> <span class="jump-name"></span> </li>
          </ul>
        </div>
        <a class="slide-control slide-next"><i></i></a> </div>
    </div>
    <div class="slider-wrap" data-type=102000000012 >
      <div class="photo-large"> <a class="slide-control slide-prev"></a>
        <div class="photoslier">
          <ul class="slides clear">
            <?php
            $i=0;
            foreach ($xiaoqutu as $value){
              echo '
              <li data-index="'.$i.'"> <img src="'.$value['url'].'" alt="'.$value['alt'].'" title="'.$value['alt'].'" /> </li>
              ';
              $i++;
            }
            if($i == 0){
              echo '
              <li data-index="'.$i.'" style="background:#F1F1F1"> 暂无图片 </li>
              ';
            }
            ?>
          </ul>
        </div>
        <a class="slide-control slide-next"></a> </div>
      <div class="thumbnail"> <a class="slide-control slide-prev"><i></i></a>
        <div class="thumbslider">
          <ul class="slides clear">
            <li class="jump-item" data-index="prev" data-role="switch"> <span class="jump-title">上一分类</span> <span class="jump-name"></span> </li>
            <?php
            $i=0;
            foreach ($xiaoqutu as $value){
              echo '
              <li data-index="'.$i.'" data-role="page"> <img src="'.$value['url'].'" /> </li>
              ';
              $i++;
            }
            ?>
            <li class="jump-item" data-index="next" data-role="switch"> <span class="jump-title">下一分类</span> <span class="jump-name"></span> </li>
          </ul>
        </div>
        <a class="slide-control slide-next"><i></i></a> </div>
    </div>
  </div>
</div>
<script src="{:C('app_ui')}js/fe.js"></script>
<script src="{:C('app_ui')}js/common.js"></script>
<script src="{:C('app_ui')}js/detailV3.js"></script>
<script>
  require(['xinfang/adddetail/xiangce'], function(module) {
    module.init({});
  });
</script>
<template file="Content/bottom.php"/>
<template file="Content/footer.php"/>
<template file="Content/sidebar.php"/>