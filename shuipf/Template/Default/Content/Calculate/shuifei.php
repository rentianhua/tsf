<template file="Content/header.php"/>
<template file="Content/nav.php"/>

<link href="{:C('app_ui')}css/calculate_new.css" rel="stylesheet" />
	    <script type="text/javascript">
		    function checkformt3() {
		        if (document.formt3.dj3.value == "" || document.formt3.mj3.value == "") {
		            alert("请填写单价和面积");
		            return;
		        } else {
		            runjs3(document.formt3);
		        }
		    }
	    </script>
        <script type="text/javascript">
            ///只能输入数字和小数点后两位小数
            function clearNoNum(obj) {
                obj.value = obj.value.replace(/[^\d.]/g, "");  //清除“数字”和“.”以外的字符  
                obj.value = obj.value.replace(/^\./g, "");  //验证第一个字符是数字而不是.  
                obj.value = obj.value.replace(/\.{2,}/g, "."); //只保留第一个. 清除多余的  
                obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
                obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');//只能输入两个小数  
            }
	    </script>
	    <script type="text/javascript">
		    function exc_yj(fmobj) {
		        var jzfs = document.getElementById("jzfs").value.toString();
		        if (jzfs == "差价") {
		            document.getElementById("chajia").style.display = '';
		        } else {
		            document.getElementById("chajia").style.display = 'none';
		        }

		    }

		    function exc_yxz(fmobj) {
		        var housexz = document.getElementById("housexz").value.toString();
		        if (housexz == "经济适用房") {
		            document.getElementById("nianxian").style.display = 'none';
		        } else {
		            document.getElementById("nianxian").style.display = '';
		        }

		    }

		    function ext_total(fmobj) {
		        var houseprice = parseFloat(document.getElementById("houseprice").value.toString()); //房屋总价
		        var housedw = document.getElementById("housedw").value.toString(); //总价单位
		        var houseyprice = parseFloat(document.getElementById("houseyprice").value.toString()); //房屋原价
		        var fwdj = parseFloat(document.getElementById("dj").value.toString());  //房屋单价
		        var houseypricedw = document.getElementById("houseypricedw").value.toString(); //原价单位
		        var housearea = parseFloat(document.getElementById("housearea").value.toString()); //房屋面积
		        if (isNaN(fwdj)) {
		            alert("房屋单价必须有正确的值！");
		            return;
		        }
		        if (isNaN(housearea)) {
		            alert("房屋面积必须有正确的值！");
		            return;
		        }
		        var housexz = document.getElementById("housexz").value.toString();//房屋性质
		        var strjzfs = document.getElementById("jzfs").value.toString();//计价方式
		        var housenx = document.getElementById("housenx").value.toString();//房产年限
		        var radioQ = document.getElementsByName("radioQ");//是否首套住房
		        var only = document.getElementsByName("only");//是否唯一住房
		        var strRadiox; //是否满5年
		        var strRadioq; //是否首套住房
		        var strOnly; //是否唯一住房
		        for (var i = 0; i < radiox.length; i++) {
		            if (radiox.item(i).checked) {
		                strRadiox = radiox.item(i).getAttribute("value");
		                break;
		            } else {
		                continue;
		            }
		        }
		        for (var i = 0; i < radioQ.length; i++) {
		            if (radioQ.item(i).checked) {
		                strRadioq = radioQ.item(i).getAttribute("value");
		                break;
		            } else {
		                continue;
		            }
		        }
		        for (var i = 0; i < only.length; i++) {
		            if (only.item(i).checked) {
		                strOnly = only.item(i).getAttribute("value");
		                break;
		            } else {
		                continue;
		            }
		        }
		        //总价处理
		        if (housedw == "万元") {
		            houseprice = houseprice * 10000
		        }
		        if (houseypricedw == "万元") {
		            houseyprice = houseyprice * 10000
		        }
		        var qishui = 0; //契税
		        var yyshu = 0; //营业税
		        var grsdshui = 0; //个人所得税
		        var gbshui = 5; //工本税
		        var yhshui = 0; //印花税
		        var zhdijikuai = 0; //综合地价款
		        if (housexz == "普通住宅") {
		            if (strRadioq == "是") {
		                if (housearea < 90) {
		                    qishui = houseprice * 1 / 100;
		                } else if (90 < housearea < 140 || housearea == 90) {
		                    qishui = houseprice * 1.5 / 100;
		                } if (housearea > 140 || housearea == 140) {
		                    qishui = houseprice * 3 / 100;
		                }
		            } else {
		                qishui = houseprice * 3 / 100;
		            }
		            if (strRadiox == "是") {

		                if (housearea > 140 || housearea == 140) {
		                    if (strjzfs == "总价") {
		                        yyshui = houseprice * 56 / 1000;
		                    } else {
		                        yyshui = houseprice - houseyprice;
		                        yyshui = yyshui * 56 / 1000;
		                    }

		                } else {
		                    yyshui = 0;
		                }
		                if (strOnly == "是") {
		                    grsdshui = 0;
		                } else {
		                    if (strjzfs == "总价") {
		                        grsdshui = houseprice * 1 / 100;
		                    } else {
		                        grsdshui = houseprice - houseyprice;
		                        grsdshui = grsdshui * 20 / 100;
		                    }

		                }

		            } else {
		                if (strjzfs == "总价") {
		                    grsdshui = houseprice * 1 / 100;
		                } else {
		                    grsdshui = houseprice - houseyprice;
		                    grsdshui = grsdshui * 20 / 100;
		                }

		                yyshui = houseprice * 56 / 1000;
		            }

		            zhdijikuai = 0;
		        }
		        else if (housexz == "非普通住宅") {
		            qishui = houseprice * 3 / 100;
		            if (strjzfs == "总价") {
		                yyshui = houseprice * 56 / 1000;
		            } else {
		                yyshui = houseprice - houseyprice;
		                yyshui = yyshui * 56 / 1000;
		            }
		            if (strRadiox == "是" && strRadioq == "是") {
		                if (strjzfs == "总价") {
		                    grsdshui = houseprice * 1 / 100;
		                } else {

		                    grsdshui = houseprice - houseyprice;
		                    grsdshui = grsdshui * 20 / 100;
		                }
		            } else {

		                if (strjzfs == "总价") {
		                    grsdshui = houseprice * 1 / 100;
		                } else {

		                    grsdshui = houseprice - houseyprice;
		                    grsdshui = grsdshui * 20 / 100;
		                }
		            }
		            zhdijikuai = 0;
		        } else {
		            if (strRadioq == "是") {
		                if (housearea < 90) {
		                    qishui = houseprice * 1 / 100;
		                } else if (90 < housearea < 140 || housearea == 90) {
		                    qishui = houseprice * 1.5 / 100;
		                } if (housearea > 140 || housearea == 140) {
		                    qishui = houseprice * 3 / 100;
		                }
		            } else {
		                qishui = houseprice * 3 / 100;
		            }
		            zhdijikuai = houseprice * 10 / 100;
		            if (housearea > 140 || housearea == 140) {
		                yyshui = houseprice * 56 / 1000;
		            } else {
		                yyshui = 0;

		            }
		            yhshui = 0;
		            if (strOnly == "是") {
		                grsdshui = 0;

		            } else {
		                if (strjzfs == "总价") {
		                    grsdshui = houseprice * 1 / 100;
		                } else {
		                    grsdshui = houseprice - houseyprice;
		                    grsdshui = grsdshui * 20 / 100;
		                }
		            }
		            gbshui = 5;
		        }
		        fmobj.qishui.value = qishui;
		        fmobj.yyshui.value = yyshui;
		        fmobj.yhshui.value = yhshui;
		        fmobj.grsdshui.value = grsdshui;
		        fmobj.gbshui.value = gbshui;
		        fmobj.zhdijikuai.value = zhdijikuai;
		        fmobj.heji.value = qishui + yyshui + yhshui + grsdshui + gbshui + zhdijikuai;

		        var dj33 = parseFloat(fwdj);
		        var mj33 = parseFloat(housearea);
		        var fkz3 = dj33 * mj33;
		        yh = fkz3 * 0.0005;
		        if (dj33 <= 9432) q1 = fkz3 * 0.015
		        else if (dj33 > 9432) q1 = fkz3 * 0.03
		        if (mj33 <= 120) fw1 = 500;
		        else if (120 < mj33 <= 5000) fw1 = 1500;
		        if (mj33 > 5000) fw1 = 5000
		        gzh = fkz3 * 0.003
		        fmobj.yh.value = Math.round(yh * 100, 5) / 100
		        fmobj.fkz3.value = Math.round(fkz3 * 100, 5) / 100
		        fmobj.q.value = Math.round(q1 * 100, 5) / 100
		        fmobj.gzh.value = Math.round(gzh * 100, 5) / 100
		        fmobj.wt.value = Math.round(gzh * 100, 5) / 100
		        fmobj.fw.value = Math.round(fw1 * 100, 5) / 100

		    }

		    function ext_totalEX(fmobj) {
		        ext_ReSet(fmobj);//清理数据
		        var typeradiox = document.getElementsByName("typeRadio");
		        var strRadiox;

		        for (var i = 0; i < typeradiox.length; i++) {
		            if (typeradiox.item(i).checked) {
		                strRadiox = typeradiox.item(i).getAttribute("value");
		                break;
		            } else {
		                continue;
		            }
		        }
				if (strRadiox == "2") {
		            var City = "城市";//City 城市
		            var Area = parseFloat(document.getElementById("housearea").value.toString());//Area 房屋面积(两位小数)
		            var Price = parseFloat(document.getElementById("houseprice").value.toString());//Price 房屋总价
		            var housedw = document.getElementById("housedw").value.toString(); //总价单位
		            //总价处理
		            if (housedw == "万元") {
		                Price = Price * 10000
		            }

		            var CaculateType = 0;//CaculateType 计征方式(1全额 2差额)
		            var jzfs = document.getElementById("jzfs").value.toString();
		            if (jzfs == "总价") {
		                CaculateType = 1;
		            } else if (jzfs == "差价") {
		                CaculateType = 2;
		            }

		            var HouseType = 0;//HouseType 房产性质(1普通住宅 2经济适用房 3非普通住宅)
		            var housexz = document.getElementById("housexz").value.toString();
		            if (housexz == "普通住宅") {
		                HouseType = 1
		            } else if (housexz == "经济适用房") {
		                HouseType = 2
		            } else if (housexz == "非普通住宅") {
		                HouseType = 3
		            }

		            var IsFirstHouse = 0;//IsFirstHouse 是否首套房(首套房1 非首套房2)
		            var radioQ = document.getElementsByName("radioQ");//是否首套住房
		            for (var i = 0; i < radioQ.length; i++) {
		                if (radioQ.item(i).checked) {
		                    strRadioq = radioQ.item(i).getAttribute("value");
		                    break;
		                } else {
		                    continue;
		                }
		            }
		            if (strRadioq == "是") {
		                IsFirstHouse = 1;
		            }
		            else if (strRadioq == "否") {
		                IsFirstHouse = 2;
		            }

		            var IsOnlyHouse = 0;//IsOnlyHouse 卖房家庭唯一住房(唯一住宅1 多套住宅2)
		            var only = document.getElementsByName("only");//是否唯一住房
		            for (var i = 0; i < only.length; i++) {
		                if (only.item(i).checked) {
		                    strOnly = only.item(i).getAttribute("value");
		                    break;
		                } else {
		                    continue;
		                }
		            }
		            if (strOnly == "是") {
		                IsOnlyHouse = 1;
		            }
		            else if (strOnly == "否") {
		                IsOnlyHouse = 2;
		            }

		            var YearType = 0;//YearType 房产购置年限(1:2年以内 2:2-5年 3:5年以上)
		            var housenx = document.getElementById("housenx").value.toString();
		            if (housenx == "2年以内") {
		                YearType = 1;
		            } else if (housenx == "2-5年") {
		                YearType = 2
		            } else if (housenx == "5年以上") {
		                YearType = 3
		            }
                    
		            var vurl = "http://8.fang.com/ajax/sfjisuan.aspx?City=" + City + "&Area=" + Area + "&Price=" + Price + "&CaculateType=" + CaculateType + "&HouseType=" + HouseType + "&IsFirstHouse=" + IsFirstHouse + "&IsOnlyHouse=" + IsOnlyHouse + "&YearType=" + YearType;
		            jQuery.ajax({
		                type: "get",
		                dataType: "jsonp",
		                jsonp:"callback",
		                url: vurl,
		                success: function (result) {
		                    if (result != null) {
		                        if (result.Code == "100") {
		                            alert("计算成功");
		                            fmobj.qishui.value = result.qishui;
		                            fmobj.yyshui.value = result.yingyeshui;
		                            fmobj.yhshui.value = result.yinhuashui;
		                            fmobj.grsdshui.value = result.geshui;
		                            fmobj.gbshui.value = result.gongbenyinhuashui;
		                            fmobj.zhdijikuai.value = result.zonghedijiakuan;
		                            fmobj.heji.value = result.heji;

		                            return;
		                        }
		                        else {
		                            if (result != null) {
		                                alert("计算失败" + result.Message);
		                            }
		                            alert("计算失败");
		                        }
		                    }
		                    else {
		                        alert("计算失败");
		                    }
		                    //var json = eval("(" + result + ")");
		                }
		            });
		        }
		    }

            //清理数据
		    function ext_ReSet(fmobj) {
		        fmobj.qishui.value = "";
		        fmobj.yyshui.value = "";
		        fmobj.yhshui.value = "";
		        fmobj.grsdshui.value = "";
		        fmobj.gbshui.value = "";
		        fmobj.zhdijikuai.value = "";
		        fmobj.heji.value = "";
		    }

		    function getreset(fmobj) {
		        var typeradiox = document.getElementsByName("typeRadio");
		        var strRadiox;

		        for (var i = 0; i < typeradiox.length; i++) {
		            if (typeradiox.item(i).checked) {
		                strRadiox = typeradiox.item(i).getAttribute("value");
		                break;
		            } else {
		                continue;
		            }
		        }
		        fmobj.reset();
		        exc_sf(fmobj, strRadiox);
		    }

		    function sfzj(fmobj) {
		        var housedw = document.getElementById("housedw").value.toString(); //总价单位
		        var mj = fmobj.housearea.value;
		        var djj = fmobj.dj.value;

		        //总价处理
		        if (housedw == "万元") {
		            fmobj.houseprice.value = mj * djj / 10000;
		        } else {

		            fmobj.houseprice.value = mj * djj;
		        }
		    }
                </script>	    
        <script>
            lilv_array = new Array;
            //12年6月8日基准利率
            lilv_array[1] = new Array;
            lilv_array[1][1] = new Array;
            lilv_array[1][2] = new Array;
            lilv_array[1][1][1] = 0.0631;//商贷1年 6.31%
            lilv_array[1][1][3] = 0.0640;//商贷1～3年 6.4%
            lilv_array[1][1][5] = 0.0665;//商贷 3～5年 6.65%
            lilv_array[1][1][10] = 0.0680;//商贷 5-30年 6.8%
            lilv_array[1][2][5] = 0.0420;//公积金 1～5年 4.2%
            lilv_array[1][2][10] = 0.0470;//公积金 5-30年 4.7%
            //12年6月8日利率下限（7折）
            lilv_array[2] = new Array;
            lilv_array[2][1] = new Array;
            lilv_array[2][2] = new Array;
            lilv_array[2][1][1] = 0.04417;//商贷1年 4.411%
            lilv_array[2][1][3] = 0.0448;//商贷1～3年 4.48%
            lilv_array[2][1][5] = 0.04655;//商贷 3～5年 4.655%
            lilv_array[2][1][10] = 0.0476;//商贷 5-30年 4.76%
            lilv_array[2][2][5] = 0.0420;//公积金 1～5年 4.2%
            lilv_array[2][2][10] = 0.0470;//公积金 5-30年 4.7%
            //12年6月8日利率下限（85折）
            lilv_array[3] = new Array;
            lilv_array[3][1] = new Array;
            lilv_array[3][2] = new Array;
            lilv_array[3][1][1] = 0.053635;//商贷1年 5.3635%
            lilv_array[3][1][3] = 0.0544;//商贷1～3年 5.44%
            lilv_array[3][1][5] = 0.056525;//商贷 3～5年 5.6525%
            lilv_array[3][1][10] = 0.0578;//商贷 5-30年 5.78%


            lilv_array[3][2][5] = 0.0420;//公积金 1～5年 4.2%
            lilv_array[3][2][10] = 0.0470;//公积金 5-30年 4.7%
            //12年6月8日利率上限（1.1倍）
            lilv_array[4] = new Array;
            lilv_array[4][1] = new Array;
            lilv_array[4][2] = new Array;
            lilv_array[4][1][1] = 0.06941;//商贷1年 6.941%
            lilv_array[4][1][3] = 0.0704;//商贷1～3年 7.04%
            lilv_array[4][1][5] = 0.07315;//商贷 3～5年 7.320%
            lilv_array[4][1][10] = 0.0748;//商贷 5-30年 7.48%
            lilv_array[4][2][5] = 0.0420;//公积金 1～5年 4.2%
            lilv_array[4][2][10] = 0.0470;//公积金 5-30年 4.7%
            //12年7月6日基准利率
            lilv_array[5] = new Array;
            lilv_array[5][1] = new Array;
            lilv_array[5][2] = new Array;
            lilv_array[5][1][1] = 0.0600;//商贷1年 6%
            lilv_array[5][1][3] = 0.0615;//商贷1～3年 6.20%
            lilv_array[5][1][5] = 0.0640;//商贷 3～5年 6.4%
            lilv_array[5][1][10] = 0.0655;//商贷 5-30年 6.55%
            lilv_array[5][2][5] = 0.0400;//公积金 1～5年 4%
            lilv_array[5][2][10] = 0.0450;//公积金 5-30年 4.5%
            //12年7月6日利率下限（7折）
            lilv_array[6] = new Array;
            lilv_array[6][1] = new Array;
            lilv_array[6][2] = new Array;
            lilv_array[6][1][1] = 0.042;//商贷1年 4.2%
            lilv_array[6][1][3] = 0.04305;//商贷1～3年 4.305%
            lilv_array[6][1][5] = 0.0448;//商贷 3～5年 4.48%
            lilv_array[6][1][10] = 0.04585;//商贷 5-30年 4.585%
            lilv_array[6][2][5] = 0.0400;//公积金 1～5年 4%
            lilv_array[6][2][10] = 0.0450;//公积金 5-30年 4.5%
            //12年7月6日利率下限（85折）
            lilv_array[7] = new Array;
            lilv_array[7][1] = new Array;
            lilv_array[7][2] = new Array;
            lilv_array[7][1][1] = 0.051;//商贷1年 5.1%
            lilv_array[7][1][3] = 0.052275;//商贷1～3年 5.2275%
            lilv_array[7][1][5] = 0.0544;//商贷 3～5年 5.44%
            lilv_array[7][1][10] = 0.055675;//商贷 5-30年 5.5675%
            lilv_array[7][2][5] = 0.0400;//公积金 1～5年 4%
            lilv_array[7][2][10] = 0.0450;//公积金 5-30年 4.5%
            //12年7月6日利率上限（1.1倍）
            lilv_array[8] = new Array;
            lilv_array[8][1] = new Array;
            lilv_array[8][2] = new Array;
            lilv_array[8][1][1] = 0.066;//商贷1年 6.6%
            lilv_array[8][1][3] = 0.06765;//商贷1～3年 6.765%
            lilv_array[8][1][5] = 0.0704;//商贷 3～5年 7.04%
            lilv_array[8][1][10] = 0.07205;//商贷 5-30年 7.205%
            lilv_array[8][2][5] = 0.0400;//公积金 1～5年 4%
            lilv_array[8][2][10] = 0.0450;//公积金 5-30年 4.5%
        </script>	
        <div class="box">
			<div class="content">
				    <!--left计算 begin-->
				    <div class="leftbk0225">
					    <div class="leftbk0225a" style="position:relative;">
						    <p class="am-text-center am-text-lg">税费计算器</p>
						    <!--计算器分类 begin-->
                        <div class="jsqtitle">
                            <ul>
                                <li class="jsqt03"><a href="index.php?g=content&m=calculate&a=fangdai">房贷计算器</a></li>       <li class="jsqt03_hover">税费计算器</li>
                            </ul>
                        </div>
                        
                            <!--二手房 start-->
						    <div id="calculate01" class="main">
							    <form name="calc1">
							    <ul class="am-avg-sm-1 am-avg-md-1 am-avg-lg-2">
									<li>
									<table width="650" border="0" cellpadding="0" cellspacing="0">
									    <tr>
										    <td width="330" valign="top">
											    <div class="mainl">
												    <div class="h1">请您填写：</div>
												    <div class="dkjsqline" style="padding-left:80px;">
                                                        <div class="dkjsqradio cnradio"  style="display: none">
                                                        <input name="typeRadio" value="2" onclick="exc_sf(this.form, this.value);" checked="checked" type="radio" /> 二手房
                                                        </div>
                                                    </div>
												    <div class="mainltr01">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="32%" style="text-align:right; padding-right:5px;">房屋面积：</td>
															    <td>
															    <input id="housearea" onblur="sfzj(this.form)" class="guestbook01" type="text" onkeyup="clearNoNum(this)"> 平米
															    </td>
														    </tr>
													    </table>
												    </div>
												    <div class="mainltr01">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="32%" style="text-align:right; padding-right:5px;">房屋单价：</td>
															    <td>
															    <input id="dj" class="guestbook01" onblur="sfzj(this.form)" type="text" onkeyup="clearNoNum(this)">元/平米
															    </td>
														    </tr>
													    </table>
												    </div>
												    <!-- 操作区开始 -->
												
												    <div class="mainltr01" id="housezj">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="32%" style="text-align:right; padding-right:5px;">房屋总价：</td>
															    <td width="13%"><input id="houseprice" name="mj3" type="text" class="guestbook01" /></td>
															    <td>
															    <select name="select" id="housedw">
															      <option selected="selected" value="万元">万元</option>
										                          <option value="元">元</option>

															    </select>
															    </td>
														    </tr>
													    </table>
												    </div>
												    <div id="jizheng" class="mainltr01">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="32%" style="text-align:right; padding-right:5px;">计征方式：</td>
															    <td>
															    <select id="jzfs" onclick="exc_yj(this.form)">
												                <option value="总价" selected="selected">总价</option>
												                <option value="差价">差价</option>
												              </select></td>
														    </tr>
													    </table>
												    </div>
			  									    <div id="chajia" class="mainltr01" style="display: none;">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="32%" style="text-align:right; padding-right:5px;">房屋原价：</td>
															    <td width="18%"><input id="houseyprice" name="mj3" type="text" class="guestbook01" /></td>
															    <td>
															    <select name="select" id="houseypricedw">
															      <option selected="selected" value="万元">万元</option>
										                          <option value="元">元</option>
															    </select>
															    </td>
														    </tr>
													    </table>
												    </div>
												    <div id="xingzhi" class="mainltr01">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="32%" style="text-align:right; padding-right:5px;">房产性质：</td>
															    <td>
															      <select id="housexz" onclick="exc_yxz(this.form)" style="width: 112px;">
													              <option selected="selected" value="普通住宅">普通住宅</option>
													              <option value="非普通住宅">非普通住宅</option>
													              <option value="经济适用房">经济适用房</option>
													              </select></td>
														    </tr>
													    </table>
												    </div>
												    <div id="nianxian" class="mainltr01">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="39%" style="text-align:right; padding-right:5px;">房产购置年限：</td>
															    <td>
															      <select id="housenx" style="width: 112px;">
													              <option selected="selected" value="2年以内">2年以内</option>
													              <option value="2-5年">2-5年</option>
													              <option value="5年以上">5年以上</option>
													              </select></td>
														    </tr>
													    </table>
												    </div>
												    <div id="shoutao" class="mainltr01 cnradio" style="padding-left:30px;">买房家庭首次购房：  
												     <input name="radioQ" value="是" checked="checked" type="radio"> 是    
												    <input name="radioQ" value="否" type="radio"> 否</div>
												    <div id="weiyi" class="mainltr01 cnradio" style="padding-left:30px;">卖房家庭唯一住房：   
												    <input name="only" value="是" checked="checked" type="radio"> 是     
												    <input name="only" value="否" type="radio"> 否</div>
												    <div class="mainltr02">												    
												    <input class="am-btn am-btn-default"  onclick="ext_totalEX(this.form)" value="开始计算" type="button">
												    <input class="am-btn am-btn-default" onclick="getreset(this.form)"  value="重新填写" type="button">
												    </div>
												    <!-- 操作区结束 -->
											    </div>
										    </td>										    
									    </tr>
								    </table>
									</li>
									<li>
									<table width="650" border="0" cellpadding="0" cellspacing="0">
									    <tr>										    
										    <td width="285" valign="top">
											    <div class="mainr">
												    <div class="h1">查看结果：</div>
												    <div id="calc1_esf" class="mainrtr01">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="20%" style="text-align:right; padding-right:5px;">契 税：</td>
															    <td width="53%"><input id="qishui" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">营 业 税：</td>
															    <td><input id="yyshui" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">印 花 税：</td>
															    <td><input id="yhshui" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">个人所得税：</td>
															    <td><input id="grsdshui" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">工本印花税：</td>
															    <td><input id="gbshui" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">综合地价款：</td>
															    <td><input id="zhdijikuai" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">合 计：</td>
															    <td><input id="heji" type="text" class="guestbook01" readonly />元</td>
														    </tr>
													    </table>
												    </div>
												
												    <div class="mainrtr01" id="calc1_xf" style="display: none;">
													    <table width="100%" border="0" cellpadding="0" cellspacing="0">
														    <tr>
															    <td width="11%" style="text-align:right; padding-right:5px;">房款总款：</td>
															    <td width="53%"><input id="fkz3" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">印 花 税：</td>
															    <td><input id="yh" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">公 证 费：</td>
															    <td><input id="gzh" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">契　　税：</td>
															    <td><input id="q" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">委托办理产权手续费：</td>
															    <td><input id="wt" type="text" class="guestbook01" readonly />元</td>
														    </tr>
														    <tr>
															    <td style="text-align:right; padding-right:5px;">房屋买卖手续费：</td>
															    <td><input id="fw" type="text" class="guestbook01" readonly />元</td>
														    </tr>
													    </table>
												    </div>
												    <div class="mainrtr01tr" style="padding-left:50px;">*以上结果仅供参考 </div>
											    </div>
										    </td>
									    </tr>
								    </table>
									</li>
								</ul>
								    
							    </form>
						    </div>
                            <!--二手房 end-->
                        
                            
					    </div>

				    </div>
				    <!--left计算 end-->
				    <div class="clear"></div>
			    </div>
		    </div>
		    
<template file="Content/bottom.php"/>
<template file="Content/sidebar.php"/> 
<template file="Content/footer.php"/>
