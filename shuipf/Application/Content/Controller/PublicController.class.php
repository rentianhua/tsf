<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 网站前台
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Content\Controller;

use Common\Controller\Base;
use Content\Model\ContentModel;

class PublicController extends Base {
  //显示楼盘相册
  public function showxc() {
    $catid = I('get.catid', 0, 'intval');
    $id = I('get.id', 0, 'intval');
    $page = intval($_GET[C("VAR_PAGE")]);
    $page = max($page, 1);
    //获取当前栏目数据
    $category = getCategory($catid);
    if (empty($category)) {
      send_http_status(404);
      exit;
    }
    //反序列化栏目配置
    $category['setting'] = $category['setting'];
    //检查是否禁止访问动态页
    if ($category['setting']['showoffmoving']) {
      send_http_status(404);
      exit;
    }
    //模型ID
    $modelid = $category['modelid'];
    $data = ContentModel::getInstance($modelid)->relation(true)->where(array("id" => $id, 'status' => 99))->find();
    if (empty($data)) {
      send_http_status(404);
      exit;
    }
    ContentModel::getInstance($modelid)->dataMerger($data);
    //分页方式
    if (isset($data['paginationtype'])) {
      //分页方式
      $paginationtype = $data['paginationtype'];
      //自动分页字符数
      $maxcharperpage = (int) $data['maxcharperpage'];
    } else {
      //默认不分页
      $paginationtype = 0;
    }
    //tag
    tag('html_shwo_buildhtml', $data);
    $content_output = new \content_output($modelid);
    //获取字段类型处理以后的数据
    $output_data = $content_output->get($data);
    $output_data['id'] = $id;
    $output_data['title'] = strip_tags($output_data['title']);
    //SEO
    $seo_keywords = '';
    if (!empty($output_data['keywords'])) {
      $seo_keywords = implode(',', $output_data['keywords']);
    }
    $seo = seo($catid, $output_data['title'], $output_data['description'], $seo_keywords);

    //内容页模板
    $template = $output_data['template'] ? $output_data['template'] : $category['setting']['show_template'];
    //去除模板文件后缀
    $newstempid = explode(".", $template);
    $template = $newstempid[0];
    unset($newstempid);
    //分页处理
    $pages = $titles = '';
    //分配解析后的文章数据到模板
    $this->assign($output_data);
    //seo分配到模板
    $this->assign("SEO", $seo);
    //栏目ID
    $this->assign("catid", $catid);
    //分页生成处理
    //分页方式 0不分页 1自动分页 2手动分页
    if ($data['paginationtype'] > 0) {
      $urlrules = $this->Url->show($data, $page);
      //手动分页
      $CONTENT_POS = strpos($output_data['content'], '[page]');
      if ($CONTENT_POS !== false) {
        $contents = array_filter(explode('[page]', $output_data['content']));
        $pagenumber = count($contents);
        $pages = page($pagenumber, 1, $page, array(
            'isrule' => true,
            'rule' => $urlrules['page'],
        ))->show("default");
        //判断[page]出现的位置是否在第一位
        if ($CONTENT_POS < 7) {
          $content = $contents[$page];
        } else {
          $content = $contents[$page - 1];
        }
        //分页
        $this->assign("pages", $pages);
        $this->assign("content", $content);
      }
    } else {
      $this->assign("content", $output_data['content']);
    }
    $this->display();
  }

  //显示更多楼盘动态
  public function alldongtai()
  {
    if(IS_GET){
      $list = M('loupandongtai') -> where("new_id=".$_GET['id']) -> order('inputtime desc') -> select();
      $this->assign("list", $list);
    }
    $this -> display();
  }

  //小区搜索
  public function searchXiaoqu()
  {
    if(IS_POST){
//      $u['title'] = array('like',$_POST['title']);
//      $u['area'] = $_POST['area'];
      $where='(title like "%'.$_POST['title'].'%") AND (area = '.$_POST['area'].')';
      $info = M('xiaoqu') -> where($where) -> field('title') -> select();
      if($info){
        $this->ajaxReturn($info);
      }
    }
  }
}