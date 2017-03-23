<?php

/**
 * 获取wap访问的内容信息地址
 * @param type $data
 * @return string
 */
function geturl($data) {
    if (!is_array($data)) {
        return '';
    }
    return U('Wap/Index/shows', array('catid' => $data['catid'], 'id' => $data['id']));
}

/**
 * 获取栏目地址
 * @param type $catid 栏目id
 * @return string
 */
function caturl($catid) {
    if (empty($catid)) {
        return '';
    }
	$category = getCategory($catid);
    if ($category['modelid'] ==9999 && $catid != 52) {
        return  $category['url'];
 
    } else{
		if($catid == 52){
			return U('Wap/Jingjiren/list_jjr'); 
		}else{
         return U('Wap/Index/lists', array('catid' => $catid)); 
		}
    }
}

//根据pid获取地区列表
function get_area_list($id){
if($id){
  $list = M('area') -> where('pid='.$id) -> Field('id,name')->select();
  return $list;		
		}else{
	return "";
  }
}

//根据小区id获取小区名称
function getxiaoquName($id){
	if($id){
  $name = M('xiaoqu') -> where('id='.$id) -> getField('title');
  return $name;		
		}else{
	return "";
  }
}
//根据id返回区域名称
function getareaName($id){
	if($id){
  $name = M('area') -> where('id='.$id) -> getField('name');
  return $name;		
		}else{
	return "";
  }
}