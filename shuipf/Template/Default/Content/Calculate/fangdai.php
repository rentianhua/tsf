<template file="Content/header.php"/>
<template file="Content/nav.php"/>
<link href="{:C('app_ui')}css/calculate_new.css" rel="stylesheet" />
    <script>
lilv_array = new Array;
//15年10月24日利率上限（1.1倍）
lilv_array[1] = new Array;
lilv_array[1][1] = new Array;
lilv_array[1][2] = new Array;
lilv_array[1][1][1] = 0.04785;
lilv_array[1][1][3] = 0.05225;
lilv_array[1][1][5] = 0.05225;
lilv_array[1][1][10] = 0.0539;
lilv_array[1][2][5] = 0.03025;
lilv_array[1][2][10] = 0.03575;
//15年10月24日利率下限（95折）
lilv_array[2] = new Array;
lilv_array[2][1] = new Array;
lilv_array[2][2] = new Array;
lilv_array[2][1][1] = 0.041325;
lilv_array[2][1][3] = 0.045125;
lilv_array[2][1][5] = 0.045125;
lilv_array[2][1][10] = 0.04655;
lilv_array[2][2][5] = 0.026125;
lilv_array[2][2][10] = 0.030875;
//15年10月24日利率下限（9折）
lilv_array[3] = new Array;
lilv_array[3][1] = new Array;
lilv_array[3][2] = new Array;
lilv_array[3][1][1] = 0.03915;
lilv_array[3][1][3] = 0.04275;
lilv_array[3][1][5] = 0.04275;
lilv_array[3][1][10] = 0.0441;
lilv_array[3][2][5] = 0.02475;
lilv_array[3][2][10] = 0.02925;
//15年10月24日利率下限（88折）
lilv_array[4] = new Array;
lilv_array[4][1] = new Array;
lilv_array[4][2] = new Array;
lilv_array[4][1][1] = 0.03828;
lilv_array[4][1][3] = 0.0418;
lilv_array[4][1][5] = 0.0418;
lilv_array[4][1][10] = 0.04312;
lilv_array[4][2][5] = 0.0242;
lilv_array[4][2][10] = 0.0286;
//15年10月24日利率下限（85折）
lilv_array[5] = new Array;
lilv_array[5][1] = new Array;
lilv_array[5][2] = new Array;
lilv_array[5][1][1] = 0.036975;
lilv_array[5][1][3] = 0.040375;
lilv_array[5][1][5] = 0.040375;
lilv_array[5][1][10] = 0.04165;
lilv_array[5][2][5] = 0.023375;
lilv_array[5][2][10] = 0.027625;
//15年10月24日利率下限（7折）
lilv_array[6] = new Array;
lilv_array[6][1] = new Array;
lilv_array[6][2] = new Array;
lilv_array[6][1][1] = 0.03045;
lilv_array[6][1][3] = 0.03325;
lilv_array[6][1][5] = 0.03325;
lilv_array[6][1][10] = 0.0343;
lilv_array[6][2][5] = 0.01925;
lilv_array[6][2][10] = 0.02275;
//15年10月24日基准利率
lilv_array[7] = new Array;
lilv_array[7][1] = new Array;
lilv_array[7][2] = new Array;
lilv_array[7][1][1] = 0.0435;
lilv_array[7][1][3] = 0.0475;
lilv_array[7][1][5] = 0.0475;
lilv_array[7][1][10] = 0.049;
lilv_array[7][2][5] = 0.0275;
lilv_array[7][2][10] = 0.0325;
//15年8月26日利率上限（1.1倍）
lilv_array[8] = new Array;
lilv_array[8][1] = new Array;
lilv_array[8][2] = new Array;
lilv_array[8][1][1] = 0.0506;
lilv_array[8][1][3] = 0.055;
lilv_array[8][1][5] = 0.055;
lilv_array[8][1][10] = 0.05665;
lilv_array[8][2][5] = 0.03025;
lilv_array[8][2][10] = 0.03575;
//15年8月26日利率下限（85折）
lilv_array[9] = new Array;
lilv_array[9][1] = new Array;
lilv_array[9][2] = new Array;
lilv_array[9][1][1] = 0.0391;
lilv_array[9][1][3] = 0.0425;
lilv_array[9][1][5] = 0.0425;
lilv_array[9][1][10] = 0.043775;
lilv_array[9][2][5] = 0.023375;
lilv_array[9][2][10] = 0.027625;
//15年8月26日利率下限（7折）
lilv_array[10] = new Array;
lilv_array[10][1] = new Array;
lilv_array[10][2] = new Array;
lilv_array[10][1][1] = 0.0322;
lilv_array[10][1][3] = 0.035;
lilv_array[10][1][5] = 0.035;
lilv_array[10][1][10] = 0.03605;
lilv_array[10][2][5] = 0.01925;
lilv_array[10][2][10] = 0.02275;
//15年8月26日基准利率
lilv_array[11] = new Array;
lilv_array[11][1] = new Array;
lilv_array[11][2] = new Array;
lilv_array[11][1][1] = 0.046;
lilv_array[11][1][3] = 0.05;
lilv_array[11][1][5] = 0.05;
lilv_array[11][1][10] = 0.0515;
lilv_array[11][2][5] = 0.0275;
lilv_array[11][2][10] = 0.0325;
//15年6月28日利率上限（1.1倍）
lilv_array[12] = new Array;
lilv_array[12][1] = new Array;
lilv_array[12][2] = new Array;
lilv_array[12][1][1] = 0.05335;
lilv_array[12][1][3] = 0.05775;
lilv_array[12][1][5] = 0.05775;
lilv_array[12][1][10] = 0.0594;
lilv_array[12][2][5] = 0.033;
lilv_array[12][2][10] = 0.0385;
//15年6月28日利率下限（85折）
lilv_array[13] = new Array;
lilv_array[13][1] = new Array;
lilv_array[13][2] = new Array;
lilv_array[13][1][1] = 0.041225;
lilv_array[13][1][3] = 0.044625;
lilv_array[13][1][5] = 0.044625;
lilv_array[13][1][10] = 0.0459;
lilv_array[13][2][5] = 0.0255;
lilv_array[13][2][10] = 0.02975;
//15年6月28日利率下限（7折）
lilv_array[14] = new Array;
lilv_array[14][1] = new Array;
lilv_array[14][2] = new Array;
lilv_array[14][1][1] = 0.03395;
lilv_array[14][1][3] = 0.03675;
lilv_array[14][1][5] = 0.03675;
lilv_array[14][1][10] = 0.0378;
lilv_array[14][2][5] = 0.021;
lilv_array[14][2][10] = 0.0245;
//15年6月28日基准利率
lilv_array[15] = new Array;
lilv_array[15][1] = new Array;
lilv_array[15][2] = new Array;
lilv_array[15][1][1] = 0.0485;
lilv_array[15][1][3] = 0.0525;
lilv_array[15][1][5] = 0.0525;
lilv_array[15][1][10] = 0.054;
lilv_array[15][2][5] = 0.03;
lilv_array[15][2][10] = 0.035;
//15年5月11日利率上限（1.1倍）
lilv_array[16] = new Array;
lilv_array[16][1] = new Array;
lilv_array[16][2] = new Array;
lilv_array[16][1][1] = 0.0561;
lilv_array[16][1][3] = 0.0605;
lilv_array[16][1][5] = 0.0605;
lilv_array[16][1][10] = 0.06215;
lilv_array[16][2][5] = 0.03575;
lilv_array[16][2][10] = 0.04125;
//15年5月11日利率下限（85折）
lilv_array[17] = new Array;
lilv_array[17][1] = new Array;
lilv_array[17][2] = new Array;
lilv_array[17][1][1] = 0.04335;
lilv_array[17][1][3] = 0.04675;
lilv_array[17][1][5] = 0.04675;
lilv_array[17][1][10] = 0.048025;
lilv_array[17][2][5] = 0.027625;
lilv_array[17][2][10] = 0.031875;
//15年5月11日利率下限（7折）
lilv_array[18] = new Array;
lilv_array[18][1] = new Array;
lilv_array[18][2] = new Array;
lilv_array[18][1][1] = 0.0357;
lilv_array[18][1][3] = 0.0385;
lilv_array[18][1][5] = 0.0385;
lilv_array[18][1][10] = 0.03955;
lilv_array[18][2][5] = 0.02275;
lilv_array[18][2][10] = 0.02625;
//15年5月11日基准利率
lilv_array[19] = new Array;
lilv_array[19][1] = new Array;
lilv_array[19][2] = new Array;
lilv_array[19][1][1] = 0.0510;
lilv_array[19][1][3] = 0.0550;
lilv_array[19][1][5] = 0.0550;
lilv_array[19][1][10] = 0.0565;
lilv_array[19][2][5] = 0.03250;
lilv_array[19][2][10] = 0.03750;
//15年3月1日利率上限（1.1倍）
lilv_array[20] = new Array;
lilv_array[20][1] = new Array;
lilv_array[20][2] = new Array;
lilv_array[20][1][1] = 0.0589;
lilv_array[20][1][3] = 0.0633;
lilv_array[20][1][5] = 0.0633;
lilv_array[20][1][10] = 0.0649;
lilv_array[20][2][5] = 0.0385;
lilv_array[20][2][10] = 0.0440;
//15年3月1日利率下限（85折）
lilv_array[21] = new Array;
lilv_array[21][1] = new Array;
lilv_array[21][2] = new Array;
lilv_array[21][1][1] = 0.0455;
lilv_array[21][1][3] = 0.0489;
lilv_array[21][1][5] = 0.0489;
lilv_array[21][1][10] = 0.0501;
lilv_array[21][2][5] = 0.0297;
lilv_array[21][2][10] = 0.0340;
//15年3月1日利率下限（7折）
lilv_array[22] = new Array;
lilv_array[22][1] = new Array;
lilv_array[22][2] = new Array;
lilv_array[22][1][1] = 0.0374;
lilv_array[22][1][3] = 0.0403;
lilv_array[22][1][5] = 0.0403;
lilv_array[22][1][10] = 0.0413;
lilv_array[22][2][5] = 0.0245;
lilv_array[22][2][10] = 0.0280;
//15年3月1日基准利率
lilv_array[23] = new Array;
lilv_array[23][1] = new Array;
lilv_array[23][2] = new Array;
lilv_array[23][1][1] = 0.0535;
lilv_array[23][1][3] = 0.0575;
lilv_array[23][1][5] = 0.0575;
lilv_array[23][1][10] = 0.0590;
lilv_array[23][2][5] = 0.0350;
lilv_array[23][2][10] = 0.0400;
//14年11月22日利率上限（1.1倍）
lilv_array[24] = new Array;
lilv_array[24][1] = new Array;
lilv_array[24][2] = new Array;
lilv_array[24][1][1] = 0.0616;
lilv_array[24][1][3] = 0.066;
lilv_array[24][1][5] = 0.066;
lilv_array[24][1][10] = 0.067;
lilv_array[24][2][5] = 0.0375;
lilv_array[24][2][10] = 0.0425;
//14年11月22日利率下限（85折）
lilv_array[25] = new Array;
lilv_array[25][1] = new Array;
lilv_array[25][2] = new Array;
lilv_array[25][1][1] = 0.0476;
lilv_array[25][1][3] = 0.051;
lilv_array[25][1][5] = 0.051;
lilv_array[25][1][10] = 0.052;
lilv_array[25][2][5] = 0.0375;
lilv_array[25][2][10] = 0.0425;
//14年11月22日利率下限（7折）
lilv_array[26] = new Array;
lilv_array[26][1] = new Array;
lilv_array[26][2] = new Array;
lilv_array[26][1][1] = 0.0392;
lilv_array[26][1][3] = 0.042;
lilv_array[26][1][5] = 0.042;
lilv_array[26][1][10] = 0.043;
lilv_array[26][2][5] = 0.0375;
lilv_array[26][2][10] = 0.0425;
//14年11月22日基准利率
lilv_array[27] = new Array;
lilv_array[27][1] = new Array;
lilv_array[27][2] = new Array;
lilv_array[27][1][1] = 0.0560;
lilv_array[27][1][3] = 0.0600;
lilv_array[27][1][5] = 0.0600;
lilv_array[27][1][10] = 0.0615;
lilv_array[27][2][5] = 0.0375;
lilv_array[27][2][10] = 0.0425;
//12年7月6日利率上限（1.1倍）
lilv_array[28] = new Array;
lilv_array[28][1] = new Array;
lilv_array[28][2] = new Array;
lilv_array[28][1][1] = 0.066;
lilv_array[28][1][3] = 0.06765;
lilv_array[28][1][5] = 0.0704;
lilv_array[28][1][10] = 0.07205;
lilv_array[28][2][5] = 0.0400;
lilv_array[28][2][10] = 0.0450;
//12年7月6日利率下限（85折）
lilv_array[29] = new Array;
lilv_array[29][1] = new Array;
lilv_array[29][2] = new Array;
lilv_array[29][1][1] = 0.051;
lilv_array[29][1][3] = 0.052275;
lilv_array[29][1][5] = 0.0544;
lilv_array[29][1][10] = 0.055675;
lilv_array[29][2][5] = 0.0400;
lilv_array[29][2][10] = 0.0450;
//12年7月6日利率下限（7折）
lilv_array[30] = new Array;
lilv_array[30][1] = new Array;
lilv_array[30][2] = new Array;
lilv_array[30][1][1] = 0.042;
lilv_array[30][1][3] = 0.04305;
lilv_array[30][1][5] = 0.0448;
lilv_array[30][1][10] = 0.04585;
lilv_array[30][2][5] = 0.0400;
lilv_array[30][2][10] = 0.0450;
//12年7月6日基准利率
lilv_array[31] = new Array;
lilv_array[31][1] = new Array;
lilv_array[31][2] = new Array;
lilv_array[31][1][1] = 0.0600;
lilv_array[31][1][3] = 0.0615;
lilv_array[31][1][5] = 0.0640;
lilv_array[31][1][10] = 0.0655;
lilv_array[31][2][5] = 0.0400;
lilv_array[31][2][10] = 0.0450;
//12年6月8日利率上限（1.1倍）
lilv_array[32] = new Array;
lilv_array[32][1] = new Array;
lilv_array[32][2] = new Array;
lilv_array[32][1][1] = 0.06941;
lilv_array[32][1][3] = 0.0704;
lilv_array[32][1][5] = 0.07315;
lilv_array[32][1][10] = 0.0748;
lilv_array[32][2][5] = 0.0420;
lilv_array[32][2][10] = 0.0470;
//12年6月8日利率下限（85折）
lilv_array[33] = new Array;
lilv_array[33][1] = new Array;
lilv_array[33][2] = new Array;
lilv_array[33][1][1] = 0.053635;
lilv_array[33][1][3] = 0.0544;
lilv_array[33][1][5] = 0.056525;
lilv_array[33][1][10] = 0.0578;
lilv_array[33][2][5] = 0.0420;
lilv_array[33][2][10] = 0.0470;
//12年6月8日利率下限（7折）
lilv_array[34] = new Array;
lilv_array[34][1] = new Array;
lilv_array[34][2] = new Array;
lilv_array[34][1][1] = 0.04417;
lilv_array[34][1][3] = 0.0448;
lilv_array[34][1][5] = 0.04655;
lilv_array[34][1][10] = 0.0476;
lilv_array[34][2][5] = 0.0420;
lilv_array[34][2][10] = 0.0470;
//12年6月8日基准利率
lilv_array[35] = new Array;
lilv_array[35][1] = new Array;
lilv_array[35][2] = new Array;
lilv_array[35][1][1] = 0.0631;
lilv_array[35][1][3] = 0.0640;
lilv_array[35][1][5] = 0.0665;
lilv_array[35][1][10] = 0.0680;
lilv_array[35][2][5] = 0.0420;
lilv_array[35][2][10] = 0.0470;
</script>

    <script type="text/javascript">
        function exc_zuhe(fmobj, v) {
            if (fmobj.name == "calc11") {
                if (v == 3) {
                    document.getElementById("calc11_zuhe").style.display = '';
                    document.getElementById("calc11_ctype").style.display = 'none';
                    document.getElementById("singlelv_li").style.display = "none";
                    document.getElementById("sdlv_li").style.display = '';
                    document.getElementById("gjlv_li").style.display = '';
                    fmobj.loanradiotype[2].checked = true;

                } else {
                    document.getElementById("calc11_zuhe").style.display = 'none';
                    document.getElementById("calc11_ctype").style.display = '';
                    document.getElementById("calc1_js_div1").style.display = '';
                    document.getElementById("calc1_js_div2").style.display = 'none';
                    document.getElementById("sdlv_li").style.display = 'none';
                    document.getElementById("gjlv_li").style.display = 'none';
                    document.getElementById("singlelv_li").style.display = '';
                    if (v == 1) {
                        document.getElementById("singlelv").value = document.getElementById("sdlv").value;
                        fmobj.loanradiotype[0].checked = true;
                    } else {
                        document.getElementById("singlelv").value = document.getElementById("gjlv").value;
                        fmobj.loanradiotype[1].checked = true;
                    }
                }
            }
        }
        function exc_js(fmobj, v) {

            if (fmobj.name == "calc11") {
                if (v == 1) {
                    document.getElementById("calc1_js_div1").style.display = '';
                    document.getElementById("calc1_js_div2").style.display = 'none';
                } else {
                    document.getElementById("calc1_js_div1").style.display = 'none';
                    document.getElementById("calc1_js_div2").style.display = '';
                }
            }
        }

        function loanreset(fmobj) {
            var loanradiotype = document.getElementsByName("loanradiotype");
            var strloanradiotype;

            for (var i = 0; i < loanradiotype.length; i++) {
                if (loanradiotype.item(i).checked) {
                    strloanradiotype = loanradiotype.item(i).getAttribute("value");
                    break;
                } else {
                    continue;
                }
            }
            fmobj.reset();
            exc_zuhe(fmobj, strloanradiotype);
        }
        function ext_loantotal(fmobj) {
            var loanradiotype = document.getElementsByName("loanradiotype"); //取房贷计算
            var price = parseInt(document.getElementById("price").value.toString()); //取房贷计算器单价
            var sqm = parseInt(document.getElementById("sqm").value.toString()); //面积
            var anjie = document.getElementById("anjie").value.toString(); //按揭成数
            var daikuan = parseInt(document.getElementById("daikuan").value.toString()); //贷款总数
            var years = document.getElementById("years").value.toString(); //按揭年数
            //var lilv = document.getElementById("lilv").value.toString(); //利率
            var radioben = document.getElementsByName("radioben"); //本金或者本息 1为本息，2为本金
            var strradioben;
            var loanTyep;
            for (var i = 0; i < loanradiotype.length; i++) {
                if (loanradiotype.item(i).checked) {
                    strRadiox = loanradiotype.item(i).getAttribute("value");
                    loanTyep = loanradiotype
                    break;
                } else {
                    continue;
                }
            }
            for (var i = 0; i < radioben.length; i++) {
                if (radioben.item(i).checked) {
                    strradioben = radioben.item(i).getAttribute("value");
                    break;
                } else {
                    continue;
                }
            }

            while ((k = fmobj.month_money2.length - 1) >= 0) {
                fmobj.month_money2.options.remove(k);
            }

            var month = years * 12;
            fmobj.month1.value = month + "(月)";
            fmobj.month2.value = month + "(月)";
            if (strRadiox == 3) { //判断是房贷计算 组合型
                //--  组合型贷款(组合型贷款的计算，只和商业贷款额、和公积金贷款额有关，和按贷款总额计算无关)
                if (!reg_Num(fmobj.zuhesy.value)) { alert("混合型贷款请填写商贷比例"); fmobj.zuhesy.focus(); return false; }
                if (!reg_Num(fmobj.zuhegjj.value)) { alert("混合型贷款请填写公积金比例"); fmobj.zuhegjj.focus(); return false; }
                if (fmobj.zuhesy.value == null) { fmobj.zuhesy.value = 0; }
                if (fmobj.zuhegjj.value == null) { fmobj.zuhegjj.value = 0; }
                var total_sy = fmobj.zuhesy.value;
                var total_gjj = fmobj.zuhegjj.value;
                fmobj.fangkuan_total1.value = "略"; //房款总额
                fmobj.fangkuan_total2.value = "略"; //房款总额
                fmobj.money_first1.value = 0; //首期付款
                fmobj.money_first2.value = 0; //首期付款
                //贷款总额
                var total_sy = parseInt(fmobj.zuhesy.value);
                var total_gjj = parseInt(fmobj.zuhegjj.value);
                var daikuan_total = total_sy + total_gjj;
                fmobj.daikuan_total1.value = daikuan_total;
                fmobj.daikuan_total2.value = daikuan_total;

                //月还款
                var lilv_sd = fmobj.sdlv.value / 100; //得到商贷利率
                var lilv_gjj = fmobj.gjlv.value / 100; //得到公积金利率


                var all_total2 = 0;
                var month_money2 = "";
                for (j = 0; j < month; j++) {
                    //调用函数计算: 本金月还款额
                    huankuan = getMonthMoney2(lilv_sd, total_sy, month, j) + getMonthMoney2(lilv_gjj, total_gjj, month, j);
                    all_total2 += huankuan;
                    huankuan = Math.round(huankuan * 100) / 100;
                    //fmobj.month_money2.options[j] = new Option( (j+1) +"月," + huankuan + "(元)", huankuan);
                    month_money2 += (j + 1) + "月," + huankuan + "(元)\n";
                }
                fmobj.month_money2.value = month_money2;
                //还款总额
                fmobj.all_total2.value = Math.round(all_total2 * 100) / 100;
                //支付利息款
                fmobj.accrual2.value = Math.round((all_total2 - daikuan_total) * 100) / 100;

                //2.本息还款
                //月均还款
                var month_money1 = getMonthMoney1(lilv_sd, total_sy, month) + getMonthMoney1(lilv_gjj, total_gjj, month); //调用函数计算
                fmobj.month_money1.value = Math.round(month_money1 * 100) / 100 + "(元)";
                //还款总额
                var all_total1 = month_money1 * month;
                fmobj.all_total1.value = Math.round(all_total1 * 100) / 100;
                //支付利息款
                fmobj.accrual1.value = Math.round((all_total1 - daikuan_total) * 100) / 100;
            } else {
                //--  商业贷款、公积金贷款
                var lilv = fmobj.singlelv.value / 100; //得到利率
                if (fmobj.jisuan_radio[0].checked == true) {
                    //------------ 根据单价面积计算
                    if (!reg_Num(fmobj.price.value)) { alert("请填写单价"); fmobj.price.focus(); return; }
                    if (!reg_Num(fmobj.sqm.value)) { alert("请填写面积"); fmobj.sqm.focus(); return; }
                    //房款总额
                    var fangkuan_total = fmobj.price.value * fmobj.sqm.value;
                    fmobj.fangkuan_total1.value = fangkuan_total;
                    fmobj.fangkuan_total2.value = fangkuan_total;
                    //贷款总额
                    var daikuan_total = (fmobj.price.value * fmobj.sqm.value) * (fmobj.anjie.value / 10);
                    fmobj.daikuan_total1.value = daikuan_total;
                    fmobj.daikuan_total2.value = daikuan_total;
                    //首期付款
                    var money_first = fangkuan_total - daikuan_total;
                    fmobj.money_first1.value = money_first
                    fmobj.money_first2.value = money_first;
                } else {
                    //------------ 根据贷款总额计算
                    if (fmobj.daikuan_total000.value.length == 0) { alert("请填写贷款总额"); fmobj.daikuan_total000.focus(); return false; }

                    //房款总额
                    fmobj.fangkuan_total1.value = "略";
                    fmobj.fangkuan_total2.value = "略";
                    //贷款总额
                    var daikuan_total = fmobj.daikuan_total000.value;
                    fmobj.daikuan_total1.value = daikuan_total;
                    fmobj.daikuan_total2.value = daikuan_total;
                    //首期付款
                    fmobj.money_first1.value = 0;
                    fmobj.money_first2.value = 0;
                }
                //1.本金还款
                //月还款
                var all_total2 = 0;
                var month_money2 = "";
                for (j = 0; j < month; j++) {
                    //调用函数计算: 本金月还款额
                    huankuan = getMonthMoney2(lilv, daikuan_total, month, j);
                    all_total2 += huankuan;
                    huankuan = Math.round(huankuan * 100) / 100;
                    //fmobj.month_money2.options[j] = new Option( (j+1) +"月," + huankuan + "(元)", huankuan);
                    month_money2 += (j + 1) + "月," + huankuan + "(元)\n";
                }

                fmobj.month_money2.value = month_money2;
                //还款总额
                fmobj.all_total2.value = Math.round(all_total2 * 100) / 100;
                //支付利息款
                fmobj.accrual2.value = Math.round((all_total2 - daikuan_total) * 100) / 100;


                //2.本息还款
                //月均还款
                var month_money1 = getMonthMoney1(lilv, daikuan_total, month); //调用函数计算
                fmobj.month_money1.value = Math.round(month_money1 * 100) / 100 + "(元)";
                //还款总额
                var all_total1 = month_money1 * month;
                fmobj.all_total1.value = Math.round(all_total1 * 100) / 100;
                //支付利息款
                fmobj.accrual1.value = Math.round((all_total1 - daikuan_total) * 100) / 100;

            }
            if (strradioben == 2) {
                fmobj.fangkuan_total1.value = fmobj.fangkuan_total2.value;
                fmobj.daikuan_total1.value = fmobj.daikuan_total2.value;
                fmobj.all_total1.value = fmobj.all_total2.value;
                fmobj.accrual1.value = fmobj.accrual2.value;
                fmobj.money_first1.value = fmobj.money_first2.value;
                fmobj.month1.value = fmobj.month2.value;
                fmobj.month_money3.value = fmobj.month_money2.value;
            }

            //布码:代码执行时机改为点击“开始计算”成功返回计算结果后
            var loanType, loanMonthMoney;
            if (strRadiox == 1) {
                loanType = "商业贷款";
            } else if (strRadiox == 2) {
                loanType = "公积金贷款";
            } else {
                loanType = "组合型贷款";
            }

            loanMonthMoney = fmobj.month_money1.value.replace("(元)", "");

            var mmlilv_sd = fmobj.sdlv.value / 100; //得到商贷利率
            var mmlilv_gjj = fmobj.gjlv.value / 100; //得到公积金利率
            //商业贷款
			if (strRadiox == 1) {
                if (strradioben == 1) {
                    //本金还款
                    
                } else if (strradioben == 2) {
                    //本息还款
                   
                }
            }
			//公积金贷款
            if (strRadiox == 2) {
                if (strradioben == 1) {
                    //本金还款
                  
                } else if (strradioben == 2) {
                    //本息还款
                  
                }
            }
			//组合型贷款
            if (strRadiox == 3) {
                if (strradioben == 1) {
                    //本金还款
                   
                } else if (strradioben == 2) {
                    //本息还款
                    
                }
            }
        }

        function ext_loanbenjin(fmobj, v) {
            if (fmobj.name == "calc11") {
                if (v == 2) {
                    document.getElementById("benxi").style.display = 'none';
                    document.getElementById("benjin").style.display = '';
                } else {
                    document.getElementById("benxi").style.display = '';
                    document.getElementById("benjin").style.display = 'none';
                }
            }
        }

        //验证是否为数字
        function reg_Num(str) {
            if (str.length == 0) { return false; }
            var Letters = "1234567890.";

            for (i = 0; i < str.length; i++) {
                var CheckChar = str.charAt(i);
                if (Letters.indexOf(CheckChar) == -1) { return false; }
            }
            return true;
        }
        //得到利率
        function getlilv(lilv_class, type, years) {
            var lilv_class = parseInt(lilv_class);
            if (years <= 5) {
                return lilv_array[lilv_class][type][5];
            } else {
                return lilv_array[lilv_class][type][10];
            }
        }

        //本金还款的月还款额(参数: 年利率 / 贷款总额 / 贷款总月份 / 贷款当前月0～length-1)
        function getMonthMoney2(lilv, total, month, cur_month) {
            var lilv_month = lilv / 12; //月利率
            //return total * lilv_month * Math.pow(1 + lilv_month, month) / ( Math.pow(1 + lilv_month, month) -1 );
            var benjin_money = total / month;
            return (total - benjin_money * cur_month) * lilv_month + benjin_money;


        }
        //本息还款的月还款额(参数: 年利率/贷款总额/贷款总月份)
        function getMonthMoney1(lilv, total, month) {
            var lilv_month = lilv / 12; //月利率
            return total * lilv_month * Math.pow(1 + lilv_month, month) / (Math.pow(1 + lilv_month, month) - 1);
        }


        function ShowLilvNew(fmobj, month, lt) {
            var loanradiostr = document.getElementsByName("loanradiotype");
            var loanradiotype;
            for (var i = 0; i < loanradiostr.length; i++) {
                if (loanradiostr.item(i).checked) {
                    loanradiotype = loanradiostr.item(i).getAttribute("value");
                    break;
                } else {
                    continue;
                }
            }
            var indexNumSd = getArrayIndexFromYear(month, 1); // 商贷
            var indexNumGj = getArrayIndexFromYear(month, 2); // 公积金
            if (loanradiotype == 1) {
                fmobj.singlelv.value = myround(lilv_array[lt][1][indexNumSd] * 100, 2);
            } else if (loanradiotype == 2) {
                fmobj.singlelv.value = myround(lilv_array[lt][2][indexNumGj] * 100, 2);
            } else {
                fmobj.singlelv.value = myround(lilv_array[lt][2][indexNumGj] * 100, 2);
            }
            fmobj.sdlv.value = myround(lilv_array[lt][1][indexNumSd] * 100, 2);
            fmobj.gjlv.value = myround(lilv_array[lt][2][indexNumGj] * 100, 2);
        }

        function myround(v, e) {
            var t = 1;
            e = Math.round(e);
            for (; e > 0; t *= 10, e--);
            for (; e < 0; t /= 10, e++);
            return Math.round(v * t) / t;
        }

        function getArrayIndexFromYear(year, dkType) {
            var indexNum = 0;
            if (dkType == 1) {
                if (year == 1) {
                    indexNum = 1;
                } else if (year > 1 && year <= 3) {
                    indexNum = 3;
                } else if (year > 3 && year <= 5) {
                    indexNum = 5;
                } else {
                    indexNum = 10;
                }
            } else if (dkType == 2) {
                if (year > 5) {
                    indexNum = 10;
                } else {
                    indexNum = 5;
                }
            }
            return indexNum;
        }

        function displaySubMenu(li) {
            var subMenu = li.getElementsByTagName("ul")[0];
            subMenu.style.display = "block";
        }
        function hideSubMenu(li) {
            var subMenu = li.getElementsByTagName("ul")[0];
            subMenu.style.display = "none";
        }
        function toggleCity() {
            $("#citydiv").toggle();
        }
    </script>
    
<input id="cityName" type="hidden" value="北京"/>        
        <div class="box">
            <script>
                window.onload = function () {
                    //document.calc11.sqm.value = '';
                    //document.calc11.price.value = '';
                };
                var scaleImage = function (o, w, h) {
                    var img = new Image();
                    img.src = o.src;
                    if (img.width > 0 && img.height > 0) {
                        if (img.width / img.height >= w / h) {
                            if (img.width > w) {
                                o.width = w;
                                o.height = (img.height * w) / img.width;
                            } else {
                                o.width = img.width;
                                o.height = img.height;
                            }
                            o.alt = img.width + "x" + img.height;
                        } else {
                            if (img.height > h) {
                                o.height = h;
                                o.width = (img.width * h) / img.height;
                            } else {
                                o.width = img.width;
                                o.height = img.height;
                            }
                            o.alt = img.width + "x" + img.height;
                        }
                    }
                };
            </script>
            <div class="content">
                <!--left计算 begin-->
                <div class="leftbk0225">
                    <div class="leftbk0225a" style="position: relative;">
                        <p class="am-text-center am-text-lg">购房贷款计算器</p>
                        <!--计算器分类 begin-->
                        <div class="jsqtitle">
                            <ul>
                                <li class="jsqt03_hover">房贷计算器</li>
                                <li class="jsqt03"><a href="/index.php?g=content&m=calculate&a=shuifei">税费计算器</a></li>
                            </ul>
                        </div>
                        <!--计算器分类 end-->

                        <!--计算一 begin-->
                        <div id="calculate01" class="main">
                            <form id="calc11" name="calc11">
                                <table width="650" border="0" cellpadding="0" cellspacing="0" style="font-size:12px!important;">
                                    <tr>
                                        <td width="340" valign="top">
                                            <div class="mainl">
                                                <div class="h1">请您填写：</div>
                                                <div class="mainltr01">
                                                    <div class="mainltr01tr cnradio">
                                                        贷款类别：<input type="radio" name="loanradiotype" value="1" class="noborder" onclick="exc_zuhe(this.form, this.value);" checked="checked" />
                                                        商业贷款
                                                <input type="radio" name="loanradiotype" value="2" style="margin-left: 10px;" onclick="    exc_zuhe(this.form, this.value);" class="noborder" />
                                                        公积金贷款
                                                <input type="radio" name="loanradiotype" value="3" onclick="    exc_zuhe(this.form, this.value);" class="noborder" style="margin-left: 10px;" />
                                                        组合型贷款
											    <input type="hidden" name="type" value="1" id="type" />
                                                    </div>
                                                    <ul id="calc11_zuhe" style="display: none" class="calculator">
                                                        <li>&nbsp;&nbsp;商业性：<input id="zuhesy" name="total_sy" maxlength="8" size="8" type="text" class="guestbook01" />元</li>
                                                        <li>&nbsp;&nbsp;公积金：<input id="zuhegjj" name="total_gjj" maxlength="8" size="8" type="text" class="guestbook01" />元</li>
                                                    </ul>
                                                </div>
                                                <div id="calc11_ctype" class="calculator" style="padding: 5px 0 10px 20px">
                                                    <div class="h2">计算方式：</div>
                                                    <ul>
                                                        <li style="line-height: 30px; padding-left: 20px;" class="cnradio">
                                                            <input name="jisuan_radio" type="radio" class="noborder" id="calc11_radio1" onclick="exc_js(this.form, 1);" value="1" checked="true" />
                                                            根据面积、单价计算</li>
                                                        <span id="calc1_js_div1" style="display: block">
                                                            <li style="line-height: 30px; padding-left: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;单价：<input id="price" name="price" type="text" class="guestbook01" />元/平米</li>
                                                            <li style="line-height: 30px; padding-left: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;面积：<input id="sqm" name="sqm" type="text" class="guestbook01" />平方米</li>
                                                            <li style="line-height: 30px; padding-left: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;按揭成数：
														    <select size="1" id="anjie" style="color: #f00;">
                                                                <option value="9">9成</option>
                                                                <option value="8">8成</option>
                                                                <option value="7" selected="true">7成</option>
                                                                <option value="6">6成</option>
                                                                <option value="5">5成</option>
                                                                <option value="4">4成</option>
                                                                <option value="3">3成</option>
                                                                <option value="2">2成</option>
                                                            </select>
                                                            </li>
                                                        </span>
                                                        <li style="line-height: 30px; padding-left: 20px;" class="cnradio">
                                                            <input name="jisuan_radio" type="radio" class="noborder" id="calc11_radio2" onclick="exc_js(this.form, 2);" value="2" />
                                                            根据贷款总额计算</li>
                                                        <li id="calc1_js_div2" style="display: none">&nbsp;&nbsp;&nbsp;&nbsp;贷款总额：<input maxlength="8" size="10" name="daikuan_total000" id="daikuan" class="guestbook01" />元</li>
                                                    </ul>
                                                </div>
                                                <div class="mainltr01">
                                                    按揭年数：
											    <select id="years" size="1" name="years" style="color: #f00;" onchange="ShowLilvNew(this.form,this.value,document.calc11.lilv.value)">
                                                    <option value="1">1年（12期）</option>
                                                    <option value="2">2年（24期）</option>
                                                    <option value="3">3年（36期）</option>
                                                    <option value="4">4年（48期）</option>
                                                    <option value="5">5年（60期）</option>
                                                    <option value="6">6年（72期）</option>
                                                    <option value="7">7年（84期）</option>
                                                    <option value="8">8年（96期）</option>
                                                    <option value="9">9年（108期）</option>
                                                    <option value="10">10年（120期）</option>
                                                    <option value="11">11年（132期）</option>
                                                    <option value="12">12年（144期）</option>
                                                    <option value="13">13年（156期）</option>
                                                    <option value="14">14年（168期）</option>
                                                    <option value="15">15年（180期）</option>
                                                    <option value="16">16年（192期）</option>
                                                    <option value="17">17年（204期）</option>
                                                    <option value="18">18年（216期）</option>
                                                    <option value="19">19年（228期）</option>
                                                    <option value="20" selected="true">20年（240期）</option>
                                                    <option value="25">25年（300期）</option>
                                                    <option value="30">30年（360期）</option>
                                                </select>
                                                </div>
                                                <div class="mainltr01">
                                                    <div class="mainltr01tr">
                                                        贷款利率：
												    <select id="lilv" name="lilv" style="color: #f00;" onchange="ShowLilvNew(this.form,document.calc11.years.value,this.value)">
                                                        <option value="1" >15年10月24日利率上限（1.1倍）</option>
<option value="2" >15年10月24日利率下限（95折）</option>
<option value="3" >15年10月24日利率下限（9折）</option>
<option value="4" >15年10月24日利率下限（88折）</option>
<option value="5" >15年10月24日利率下限（85折）</option>
<option value="6" >15年10月24日利率下限（7折）</option>
<option value="7" selected="selected">15年10月24日基准利率</option>
<option value="8" >15年8月26日利率上限（1.1倍）</option>
<option value="9" >15年8月26日利率下限（85折）</option>
<option value="10" >15年8月26日利率下限（7折）</option>
<option value="11" >15年8月26日基准利率</option>
<option value="12" >15年6月28日利率上限（1.1倍）</option>
<option value="13" >15年6月28日利率下限（85折）</option>
<option value="14" >15年6月28日利率下限（7折）</option>
<option value="15" >15年6月28日基准利率</option>
<option value="16" >15年5月11日利率上限（1.1倍）</option>
<option value="17" >15年5月11日利率下限（85折）</option>
<option value="18" >15年5月11日利率下限（7折）</option>
<option value="19" >15年5月11日基准利率</option>
<option value="20" >15年3月1日利率上限（1.1倍）</option>
<option value="21" >15年3月1日利率下限（85折）</option>
<option value="22" >15年3月1日利率下限（7折）</option>
<option value="23" >15年3月1日基准利率</option>
<option value="24" >14年11月22日利率上限（1.1倍）</option>
<option value="25" >14年11月22日利率下限（85折）</option>
<option value="26" >14年11月22日利率下限（7折）</option>
<option value="27" >14年11月22日基准利率</option>
<option value="28" >12年7月6日利率上限（1.1倍）</option>
<option value="29" >12年7月6日利率下限（85折）</option>
<option value="30" >12年7月6日利率下限（7折）</option>
<option value="31" >12年7月6日基准利率</option>
<option value="32" >12年6月8日利率上限（1.1倍）</option>
<option value="33" >12年6月8日利率下限（85折）</option>
<option value="34" >12年6月8日利率下限（7折）</option>
<option value="35" >12年6月8日基准利率</option>


                                                    </select>
                                                    </div>
                                                    <ul>
                                                        <li id="singlelv_li" style="display: block">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="singlelv" type="text" class="red guestbook01" value="4.90" />
                                                            %</li>
                                                        <li id="sdlv_li" style="display: none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商&nbsp;&nbsp;&nbsp;  业： 
                                                            <input id="sdlv" type="text" class="red guestbook01" value="4.90" />
                                                            % </li>
                                                        <li id="gjlv_li" style="display: none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;公 积 金：  
                                                            <input id="gjlv" type="text" class="red guestbook01" value="3.25" />
                                                            %</li>
                                                    </ul>
                                                </div>
                                                <div class="mainltr01 cnradio">还款方式：<input id="dengeben1" type="radio" name="radioben" value="1" checked onclick="ext_loanbenjin(this.form, this.value)" />
                                                    等额本息
                                                    <input id="dengeben2" type="radio" name="radioben" value="2" onclick="    ext_loanbenjin(this.form, this.value)" />
                                                    等额本金</div>
                                                <div class="mainltr02">
                                                    <input type="button" onclick="ext_loantotal(document.calc11)" class="am-btn am-btn-default" value="计算购房贷款">&nbsp;&nbsp;
                                                <input type="button" onclick="loanreset(document.calc11);" class="am-btn am-btn-default" value="重新填写贷款条件">
                                                </div>
                                            </div>
                                        </td>
                                        <td width="285" valign="top">
                                            <div class="mainr">
                                                <div class="h1">查看结果：</div>
                                                <div class="mainrtr01">
                                                    <ul>
                                                        <li>&nbsp;&nbsp;房款总额：<input id="fangkuan_total1" name="fangkuan_total1" type="text" class="guestbook02" readonly />元</li>
                                                        <li>&nbsp;&nbsp;贷款总额：<input name="daikuan_total1" type="text" class="guestbook02" readonly />元</li>
                                                        <li>&nbsp;&nbsp;还款总额：<input name="all_total1" type="text" class="guestbook02" readonly />元</li>
                                                        <li style="padding-left: 0px;">支付利息款：<input name="accrual1" type="text" class="guestbook02" readonly />元</li>
                                                        <li>&nbsp;&nbsp;首期付款：<input name="money_first1" type="text" class="guestbook02" readonly />元</li>
                                                        <li>&nbsp;&nbsp;贷款月数：<input name="month1" type="text" class="guestbook02" readonly /></li>
                                                        <li id="benxi">&nbsp;&nbsp;月均还款：<input name="month_money1" type="text" class="guestbook02" readonly />元</li>
                                                        <li id="benjin" style="display: none;">&nbsp;&nbsp;月均金额：<textarea class="inputwidthnew" name="month_money3" rows="3" cols="16"></textarea>
                                                            元</li>
                                                    </ul>
                                                    <div id="calc1_benjin" style="display: none;">
                                                        <input type="hidden" name="fangkuan_total2" />
                                                        <input type="hidden" name="daikuan_total2" />
                                                        <input type="hidden" name="all_total2" />
                                                        <input type="hidden" name="accrual2" />
                                                        <input type="hidden" name="money_first2" />
                                                        <input type="hidden" name="month2" />
                                                        <input type="hidden" name="month_money2" />
                                                    </div>

                                                    <div class="mainrtr01tr am-text-center">*以上结果仅供参考 </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <!--计算 end-->
                    </div>
                </div>
                <!--left计算 end-->

                <div class="clear"></div>
            </div>
        </div>
<template file="Content/bottom.php"/>
<template file="Content/sidebar.php"/> 
<template file="Content/footer.php"/>
