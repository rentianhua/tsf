//弹出对话框
function omnipotent(id, linkurl, title, close_type, w, h) {
    if (!w) w = 700;
    if (!h) h = 500;
    Wind.use("artDialog", "iframeTools", function () {
        art.dialog.open(linkurl, {
            id: id,
            title: title,
            width: w,
            height: h,
            lock: true,
            fixed: true,
            background: "#CCCCCC",
            opacity: 0,
            button: [{
                name: '确定',
                callback: function () {
                    if (close_type == 1) {
                        return true;
                    } else {
                        var d = this.iframe.contentWindow;
                        var form = d.document.getElementById('dosubmit');
                        form.click();
                    }
                    return false;
                },
                focus: true
            }]
        });
    });

}

/**
swf上传完回调方法
uploadid dialog id
name dialog名称
textareaid 最后数据返回插入的容器id
funcName 回调函数
args 参数
module 所属模块
catid 栏目id
authkey 参数密钥，验证args
**/
function flashupload(uploadid, name, textareaid, funcName, args, module, catid, authkey) {
    var args = args ? '&args=' + args : '';
    var setting = '&module=' + module + '&catid=' + catid + '&authkey=' + authkey;
    var status = false;
    //检查是否有上传权限
    $.ajax({
        type: "GET",
        url: GV.DIMAUB + 'index.php?a=competence&m=Attachments&g=Attachment' + args + setting,
        dataType: "json",
        async: false,
        success: function (json) {
            if (json.status == false) {
                isalert(json.info || '没有上传权限！');
                status = false;
                return false;
            }
            status = true;
        }
    });
    if (status) {
        Wind.use("artDialog", "iframeTools", function () {
            art.dialog.open(GV.DIMAUB + 'index.php?a=swfupload&m=Attachments&g=Attachment' + args + setting, {
                title: name,
                id: uploadid,
                width: '650px',
                height: '420px',
                lock: true,
                fixed: true,
                background: "#CCCCCC",
                opacity: 0,
                ok: function () {
                    if (funcName) {
                        funcName.apply(this, [this, textareaid]);
                    } else {
                        submit_ckeditor(this, textareaid);
                    }
                },
                cancel: true
            });
        });
    }
}


function flashupload1(uploadid, name, textareaid, funcName, args, module, catid) {
	var args = args ? '&args=' + args : '';
     var setting = '&module=' + module + '&catid=' + catid;
    //检查是否有上传权限

    Wind.use("artDialog", "iframeTools", function () {
			
            art.dialog.open('index.php?a=swfupload1&m=Attachments&g=Attachment' + args + setting, {
                title: name,
                id: uploadid,
                width: '650px',
                height: '420px',
                lock: true,
                fixed: true,
                background: "#CCCCCC",
                opacity: 0,
                ok: function () {
                    if (funcName) {
                        funcName.apply(this, [this, textareaid]);
                    } else {
                        submit_ckeditor(this, textareaid);
                    }
                },
                cancel: true
            });
        });

}

//多图上传，SWF回调函数
function change_images(uploadid, returnid) {
    var d = uploadid.iframe.contentWindow;
    var in_content = d.$("#att-status").html().substring(1);
    var in_filename = d.$("#att-name").html().substring(1);
    var str = $('#' + returnid).html();
    var contents = in_content.split('|');
    var filenames = in_filename.split('|');
    $('#' + returnid + '_tips').css('display', 'none');
    if (contents == '') return true;
    $.each(contents, function (i, n) {
        var ids = parseInt(Math.random() * 10000 + 10 * i);
        var filename = filenames[i].substr(0, filenames[i].indexOf('.'));
        str += "<li style='line-height:124px' id='image" + ids + "'><input type='hidden' name='"+returnid+"_url[]' value='"+n+"'><img src='"+n+"' style='width:120px;height:80px;margin-bottom:-46px'><input type='text' name='" + returnid + "_alt[]' value='" + filename + "' style='width:160px;' class='input nick' onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('image" + ids + "')\">移除</a> </li>";
    });

    $('#' + returnid).html(str);
	$(".nick").keyup(function(){
		$(this).attr("value",$(this).val());	
	});
}

//编辑器ue附件上传
function ueAttachment(uploadid, returnid) {
    var d = uploadid.iframe.contentWindow;
    var in_content = d.$("#att-status").html().substring(1);
    if (in_content == '') {
        return false;
    }
    in_content = in_content.split("|");
    var i;
    var in_filename = d.$("#att-name").html().substring(1);
    var filenames = in_filename.split('|');

    eval("var ue = editor" + returnid);

    for (i = 0; i < in_content.length; i++) {
        ue.execCommand('inserthtml', '<a href="' + in_content[i] + '" target="_blank">附件：' + filenames[i] + '</a>');
    }

}

//多文件上传回调
function change_multifile(uploadid, returnid) {
    var d = uploadid.iframe.contentWindow;
    var in_content = d.$("#att-status").html().substring(1);
    var in_filename = d.$("#att-name").html().substring(1);
    var str = '';
    var contents = in_content.split('|');
    var filenames = in_filename.split('|');
    $('#' + returnid + '_tips').css('display', 'none');
    if (contents == '') return true;
    $.each(contents, function (i, n) {
        var ids = parseInt(Math.random() * 10000 + 10 * i);
        var filename = filenames[i].substr(0, filenames[i].indexOf('.'));
        str += "<li id='multifile" + ids + "'><input type='text' name='" + returnid + "_fileurl[]' value='" + n + "' style='width:310px;' class='input'> <input type='text' name='" + returnid + "_filename[]' value='" + filename + "' style='width:160px;' class='input' onfocus=\"if(this.value == this.defaultValue) this.value = ''\" onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('multifile" + ids + "')\">移除</a> </li>";
    });
    $('#' + returnid).append(str);
}

//缩图上传回调
function thumb_images(uploadid, returnid) {
    //取得iframe对象
    var d = uploadid.iframe.contentWindow;
    //取得选择的图片
    var in_content = d.$("#att-status").html().substring(1);
    if (in_content == '') return false;
    if (!IsImg(in_content)) {
        isalert('选择的类型必须为图片类型！');
        return false;
    }

    if ($('#' + returnid + '_preview').attr('src')) {
        $('#' + returnid + '_preview').attr('src', in_content);
    }
    $('#' + returnid).val(in_content);
}

//提示框 alert
function isalert(content, icon) {
    if (content == '') {
        return;
    }
    icon = icon || "error";
    Wind.use("artDialog", function () {
        art.dialog({
            id: icon,
            icon: icon,
            fixed: true,
            lock: true,
            background: "#CCCCCC",
            opacity: 0,
            content: content,
            cancelVal: '确定',
            cancel: true
        });
    });
}

//图片使用dialog查看
function image_priview(img) {
    if (img == '') {
        return;
    }
    if (!IsImg(img)) {
        isalert('选择的类型必须为图片类型！');
        return false;
    }
    Wind.use("artDialog", function () {
        art.dialog({
            title: '图片查看',
            fixed: true,
            width: "600px",
            height: '420px',
            id: "image_priview",
            lock: true,
            background: "#CCCCCC",
            opacity: 0,
            content: '<img src="' + img + '" />',
            time: 5
        });
    });
}

//添加/修改文章时，标题加粗
function input_font_bold() {
    if ($('#title').css('font-weight') == '700' || $('#title').css('font-weight') == 'bold') {
        $('#title').css('font-weight', 'normal');
        $('#style_font_weight').val('');
    } else {
        $('#title').css('font-weight', 'bold');
        $('#style_font_weight').val('bold');
    }
}

//移除相关文章
function remove_relation(sid, id) {
    var relation_ids = $('#relation').val();
    if (relation_ids != '') {
        $('#' + sid).remove();
        var r_arr = relation_ids.split('|');
        var newrelation_ids = '';
        $.each(r_arr, function (i, n) {
            if (n != id) {
                if (i == 0) {
                    newrelation_ids = n;
                } else {
                    newrelation_ids = newrelation_ids + '|' + n;
                }
            }
        });
        $('#relation').val(newrelation_ids);
    }
}

//显示相关文章
function show_relation(modelid, id) {
    $.getJSON(GV.DIMAUB + "index.php?a=public_getjson_ids&m=Content&g=Content&modelid=" + modelid + "&id=" + id, function (json) {
        var newrelation_ids = '';
        if (json.data == null) {
            isalert('没有添加相关数据！');
            return false;
        }
        $.each(json.data, function (i, n) {
            newrelation_ids += "<li id='" + n.sid + "'>·<span>" + n.title + "</span><a href='javascript:;' class='close' onclick=\"remove_relation('" + n.sid + "'," + n.id + ")\"></a></li>";
        });

        $('#relation_text').html(newrelation_ids);
    });
}

//图片上传回调
function submit_images(uploadid, returnid) {
    var d = uploadid.iframe.contentWindow;
    var in_content = d.$("#att-status").html().substring(1);
    var in_content = in_content.split('|');
    IsImg(in_content[0]) ? $('#' + returnid).attr("value", in_content[0]) : alert('选择的类型必须为图片类型');
}

//图片上传回调
function submit_images2(uploadid, returnid) {
    var d = uploadid.iframe.contentWindow;
    var in_content = d.$("#att-status").html().substring(1);
    var x = in_content.split('|').length;
    for (var i = 0; i < x; i++) {
        in_content = in_content.replace('|',',');
    }
    $('#' + returnid).attr("value", in_content);
}

//单文件上传回调
function submit_attachment(uploadid, returnid) {
    var d = uploadid.iframe.contentWindow;
    var in_content = d.$("#att-status").html().substring(1);
    var in_content = in_content.split('|');
    $('#' + returnid).attr("value", in_content[0]);
}

//移除ID
function remove_id(id) {
    $('#' + id).remove();
}

//输入长度提示
function strlen_verify(obj, checklen, maxlen) {
    var v = obj.value,
        charlen = 0,
        maxlen = !maxlen ? 200 : maxlen,
        curlen = maxlen,
        len = strlen(v);
    var charset = 'utf-8';
    for (var i = 0; i < v.length; i++) {
        if (v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
            curlen -= charset == 'utf-8' ? 2 : 1;
        }
    }
    if (curlen >= len) {
        $('#' + checklen).html(curlen - len);
    } else {
        obj.value = mb_cutstr(v, maxlen, true);
    }
}

//长度统计
function strlen(str) {
    return ($.browser.msie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

function mb_cutstr(str, maxlen, dot) {
    var len = 0;
    var ret = '';
    var dot = !dot ? '...' : '';

    maxlen = maxlen - dot.length;
    for (var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
        if (len > maxlen) {
            ret += dot;
            break;
        }
        ret += str.substr(i, 1);
    }
    return ret;
}

//移除指定id内容
function remove_div(id) {
    $('#' + id).remove();
}

//转向地址
function ruselinkurl() {
    if ($('#islink').is(':checked') == true) {
        $('#linkurl').attr('disabled', null);
        return false;
    } else {
        $('#linkurl').attr('disabled', 'true');
    }
}

//验证地址是否为图片
function IsImg(url) {
    var sTemp;
    var b = false;
    var opt = "jpg|gif|png|bmp|jpeg";
    var s = opt.toUpperCase().split("|");
    for (var i = 0; i < s.length; i++) {
        sTemp = url.substr(url.length - s[i].length - 1);
        sTemp = sTemp.toUpperCase();
        s[i] = "." + s[i];
        if (s[i] == sTemp) {
            b = true;
            break;
        }
    }
    return b;
}

//验证地址是否为Flash
function IsSwf(url) {
    var sTemp;
    var b = false;
    var opt = "swf";
    var s = opt.toUpperCase().split("|");
    for (var i = 0; i < s.length; i++) {
        sTemp = url.substr(url.length - s[i].length - 1);
        sTemp = sTemp.toUpperCase();
        s[i] = "." + s[i];
        if (s[i] == sTemp) {
            b = true;
            break;
        }
    }
    return b;
}

//添加地址
function add_multifile(returnid) {
    var ids = parseInt(Math.random() * 10000);
    var str = "<li id='multifile" + ids + "'><input type='text' name='" + returnid + "_fileurl[]' value='' style='width:310px;' class='input'> <input type='text' name='" + returnid + "_filename[]' value='附件说明' style='width:160px;' class='input'> <a href=\"javascript:remove_div('multifile" + ids + "')\">移除</a> </li>";
    $('#' + returnid).append(str);
}