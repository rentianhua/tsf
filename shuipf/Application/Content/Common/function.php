<?php

// +----------------------------------------------------------------------
// |内容模块自定义函数
// +----------------------------------------------------------------------

function images($field) {
    //取得图片列表
    $pictures = $_POST[$field . '_url'];
    //取得图片说明
    $pictures_alt = isset($_POST[$field . '_alt']) ? $_POST[$field . '_alt'] : array();
    $array = $temp = array();
    if (!empty($pictures)) {
        foreach ($pictures as $key => $pic) {
            $temp['url'] = $pic;
            $temp['alt'] = $pictures_alt[$key];
            $array[$key] = $temp;
        }
    }
    $array = serialize($array);
    return $array;
}

function unimages($field, $value, $modelid) {
	
	$u['modelid'] = $modelid;
	$u['field'] = $field;
	$fieldinfo = M('model_field') ->where($u)->find();
	
	//错误提示
    $errortips = $fieldinfo['errortips'];
    //长度
    if ($fieldinfo['minlength']) {
        //验证规则
        $this->formValidateRules['info[' . $field . ']'] = array("required" => true);
        //验证不通过提示
        $this->formValidateMessages['info[' . $field . ']'] = array("required" => $errortips ? $errortips : $fieldinfo['name'] . "不能为空！");
    }
    //字段扩展配置
    $setting = unserialize($fieldinfo['setting']);
    $list_str = '';
	
    if ($value) {
        $value = unserialize(html_entity_decode($value, ENT_QUOTES));
        if (is_array($value)) {
            foreach ($value as $_k => $_v) {
                $list_str .= "<div id='image_{$field}_{$_k}' style='padding:1px;line-height:118px'><input type='hidden' name='{$field}_url[]' value='{$_v['url']}' ondblclick='image_priview(this.value);' class='input'><img src='{$_v['url']}' style='width:120px;height:80px;margin-bottom:-12px;margin-right:10px;'><input type='text' name='{$field}_alt[]' value='{$_v['alt']}' style='width:160px;' class='input'> <a href=\"javascript:remove_div('image_{$field}_{$_k}')\">移除</a></div>";
            }
        }
    } else {
        $list_str .= "<center><div class='onShow' id='nameTip'>您最多每次可以同时上传 <font color='red'>{$setting['upload_number']}</font> 张</div></center>";
    }
	
    $string = '<input name="info[' . $field . ']" type="hidden" value="1">
		<fieldset class="blue pad-10">';
    $string .= $list_str;
    $string .= '<div id="' . $field . '" class="picList"></div>
		</fieldset>
		<div class="bk10"></div>
		';
    //模块
	
    $module = "content";
    //生成上传附件验证
    $authkey = upload_key("{$setting['upload_number']},{$setting['upload_allowext']},{$setting['isselectimage']},,,{$setting['watermark']}");
    $string .= $str . "<a herf='javascript:void(0);' onclick=\"javascript:flashupload1('{$field}_images', '图片上传','{$field}',change_images,'{$setting['upload_number']},{$setting['upload_allowext']},{$setting['isselectimage']},,,{$setting['watermark']}','{$module}','6')\" class=\"btn am-btn am-btn-danger am-round\"><span class=\"add\"></span>选择图片 </a>";
    return $string;
}

//是否关注
function isGZ($fromid, $fromtable, $username){
  $u["fromid"] =  $fromid;
  $u["fromtable"] = $fromtable;
  $u["username"] = $username;
  $rs = M('guanzhu') -> where($u) -> find();

  if($rs){
    $zt = 1;
  }else{
    $zt = 0;
  }
  return $zt;
}

//关注人数
function gznum($fromid, $fromtable){
  $u["fromid"] =  $fromid;
  $u["fromtable"] = $fromtable;
  $rs = M('guanzhu') -> where($u) -> count();
  return $rs;
}

//是否预约
function isYY($fromid, $fromtable, $username){
  $u["fromid"] =  $fromid;
  $u["fromtable"] = $fromtable;
  $u["username"] = $username;
  $u["_string"] = "CONCAT(yuyuedate,' ',SPLIT_STR(yuyuetime,'-',2)) >= CURDATE() and zhuangtai<>'已取消'";
  $rs = M('yuyue') -> where($u) -> find();

  if($rs){
    $yy = 1;
  }else{
    $yy = 0;
  }
  return $yy;
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

//根据小区id获取小区名称
function getxiaoquName($id){
	if($id){
  $name = M('xiaoqu') -> where('id='.$id) -> getField('title');
  return $name;		
		}else{
	return "";
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

//当前用户是否申请了转机号码
function hasvtel($id){	
	$vtel = M('member')->where('userid='.$id)->getfield('zhuanjie');
	return $vtel;
}

//获取房源发布人的信息
function getfaburen($username){
	if($username){
		$u['username'] = $username;
		$rs = M('member') -> where($u) -> field('userid,modelid,zhuanjie,vtel') -> find();
		if($rs){
			if($rs['modelid'] == 35){
				$db=M('member_normal');
			}else{
				$db=M('member_agent');				
			}
			$rs['realname'] = $db -> where('userid='.$rs['userid']) -> getfield('realname');
			return $rs;
		}else{
			return "";
		}
	}else{
		return "";
	}	
}

//获取经纪人等级
function getdengji($userid){
	if($userid){
		$rs = M('member_agent') -> where('userid='.$userid) -> getfield('dengji');
		return $rs;
	}else{
		return "";
	}
}

//判断新房是否有优惠券
function hasyhq($id){
	$rs = M('yhquan') -> where('new_id='.$id) -> find();
	if($rs){
		$r = true;
	}else{
		$r = false;	
	}
	return $r;
}

//获取当前楼盘的购买优惠券人数
function yigounum($id){
	if($id){
		$n = M('coupon') -> where('house_id='.$id) -> count();
		return $n;
	}else{
		return '';	
	}
}
//获取当前楼盘的购买优惠券人信息
function yigouinfo($id){
	if($id){
		$r = M('coupon') -> where('pay_status=1 and house_id='.$id) -> field('buyname,buytel,coupon_name') ->select();
		foreach($r as $k=>$v){
			$r[$k]['buyname'] = substr_replace($v['buyname'], '*', 3, 3);
			$r[$k]['buytel'] = substr_replace($v['buytel'], '****', 3, 4);
		}
		return $r;
	}else{
		return '';	
	}
}

//根据id返回楼盘名称
function getnewName($id){
	if($id){
  $name = M('new') -> where('id='.$id) -> field('title,url') -> find();
  return $name;		
		}else{
	return "";
  }
}