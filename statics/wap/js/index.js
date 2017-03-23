(function(f) {
    var c = {};
    var i = function(k) {
        return c[k];
    };
    var r = function(k) {
        if (!c[k]) {
            var m = {
                exports: {}
            };
            try {
                f[k].call(m.exports, m, m.exports, r, i)
            } catch(e) {};
            c[k] = m.exports;
        }
        return c[k];
    };
    return r('a');
})({
    a: function(e, t, n, r) {
        $LMB.register("m_pages_ershoufangDetail",
        function(e, t) {
            var r = n("A");
            var i = r(e, t);
            var s = n("e");
            var o = n("E");
            var u = n("g");
            var a = u(e, t);
            var f = n("i");
            var l = n("I");
            var c;
            var h;
            var p;
            var d = function(e, t, n) {
                s.init({
                    container: e,
                    axisX: {
                        has: true,
                        scroll: true,
                        data: t
                    },
                    axisY: {
                        has: true,
                        title: "成交价（元/m²）",
                        unit: "",
                        count: 3
                    },
                    data: [{
                        type: "line",
                        data: n,
                        unit: "元/m²",
                        title: "成交价",
                        color: "#39ac6a"
                    }]
                })
            };
            var v = {
                init: function() {
                    v.initPlugin();
                    v.initRender();
                    v.checkOwner();
                    $ljBridge.ready(function(e, t) {
                        e.setPageTitle("在售房源详情")
                    })
                },
                initPlugin: function() {
                    p = $("#" + e).getMark();
                    h = o.init({
                        swipeSlide: function(e) {
                            p.one("img_index").html(e + 1)
                        }
                    });
                    var n = p.one("btn_follow").getData()[0];
                    c = f.init({
                        actBtn: p.one("btn_follow"),
                        followData: n,
                        unfollowData: n,
                        checkFollowData: {
                            code: n["house_code"],
                            type: n["house_type"]
                        }
                    },
                    t)
                },
                initRender: function() {
                    var e = p.one("chart");
                    var t = JSON.parse(e.getData("resblock_market"));
                    var n = t["price_trend_room_all"];
                    var r = [];
                    var i = [];
                    for (var s = 0,
                    o = n.length; s < o; s++) {
                        var u = n[s]["month"] || 0;
                        r.push(u + "月");
                        i.push(n[s]["sign_price"])
                    }
                    d(e, r, i)
                },
                checkOwner: function() {
                    var e = p.one("yezhutuiguang_mine");
                    var n = p.one("yezhutuiguang_public");
                    if (e.length && n.length) {
                        var r = e.attr("data-house-code");
                        l.isowner.request({
                            house_code: r
                        },
                        {
                            success: function(e) {
                                if (e.errno === 0) {
                                    if (e.data.is_owner == 0) {
                                        p.one("yezhutuiguang_mine").hide();
                                        p.one("yezhutuiguang_public").show()
                                    } else {
                                        p.one("yezhutuiguang_mine").show();
                                        p.one("yezhutuiguang_public").hide();
                                        p.one("yezhutuiguang_mine").find(".btn").on("tap",
                                        function() {
                                            window.onblur = function() {
                                                clearTimeout(e);
                                                window.onblur = function() {}
                                            };
                                            location.href = "lianjia:index";
                                            var e = setTimeout(function() {
                                                var e = navigator.userAgent.toLowerCase();
                                                if (e.indexOf("micromessenger") >= 0) {
                                                    location.href = "http://www.lianjia.com/client"
                                                } else {
                                                    if ($.os.android) {
                                                        location.href = "http://activitymo.homelink.com.cn/download/homelink/android/Android_homelinkmm.apk"
                                                    } else {
                                                        location.href = "https://itunes.apple.com/cn/app/id405882753?mt=8"
                                                    }
                                                }
                                                var n = t && t["args"];
                                                var r = location.pathname.slice(1).split("/");
                                                var i = "";
                                            },
                                            3e3)
                                        })
                                    }
                                }
                            }
                        })
                    }
                }
            };
            v.init();
            var m = {};
            m.destroy = function() {};
            return m
        })
    },
    A: function(e, t, n, r) {
        var i = n("b");
        var s = n("c");
        var o = n("C");
        var u = n("d");
        var a = n("D");
        e.exports = function(e, t) {
            var n = [];
            var r = i($("#" + e));
            var f = s($("#" + e), t);
            var l = u($("#" + e));
            var c = a($("#" + e));
            var h;
            $(window).on("load",
            function() {
                $ljBridge.ready(function(r) {
                    h = o($("#" + e), t);
                    n.push(h)
                })
            });
            n.push(r);
            n.push(f);
            n.push(l);
            n.push(c);
            return {
                destroy: function() {
                    for (var e = n.length - 1; e >= 0; e--) {
                        n[e].destroy && n[e].destroy()
                    }
                }
            }
        }
    },
    b: function(e, t, n, r) {
        var i = n("B");
        var s;
        var o = [];
        var u = {
            init: function(e) {
                u.initDoms(e);
                u.initLazy()
            },
            initDoms: function(e) {
                if (e) {
                    s = $(e).find(".lazyload")
                } else {
                    s = $(".lazyload")
                }
            },
            initLazy: function() {
                $.each(s,
                function(e, t) {
                    var n = i.init({
                        el: t,
                        "margin-top": 10,
                        callback: function() {
                            var e = $(t).attr("origin-src");
                            var n = $(t).attr("error-src");
                            if (e) {
                                var r = new Image;
                                r.src = e;
                                r.onload = function() {
                                    $(t).attr("src", e)
                                };
                                if (n) {
                                    r.onerror = function() {
                                        $(t).attr("src", n)
                                    }
                                }
                            }
                        }
                    });
                    o.push(n)
                })
            }
        };
        e.exports = function(e) {
            u.init(e);
            return {
                destroy: function() {
                    $.each(o,
                    function(e, t) {
                        t.destroy && t.destroy()
                    })
                }
            }
        }
    },
    B: function(e, t, n, r) {
        var i = [];
        var s = false;
        t.init = function(e) {
            var t = {
                el: "",
                marginTop: 0,
                marginBottom: 0,
                times: 1,
                always: false,
                callback: function() {}
            };
            var n = "测试用";
            var r;
            var o;
            var u = {
                execute: function() {
                    var e = false,
                    t;
                    for (var n = 0,
                    r = i.length; n < r; n++) {
                        t = i[n];
                        if (t.times > 0) {
                            e = u.executeInView(t)
                        }
                        if (e && !t.always) {
                            if (--t.times <= 0) {
                                i.splice(n, 1);
                                r--;
                                n--
                            }
                        }
                    }
                },
                executeInView: function(e) {
                    var t = $(e.el);
                    var n = o.width(),
                    r = o.height(),
                    i = document.documentElement.scrollTop || document.body.scrollTop;
                    var s = t.offset();
                    var u = s.top - e.marginTop,
                    a = u + s.height + e.marginBottom;
                    var f = i,
                    l = i + r;
                    if (a < f || u > l) {
                        return false
                    }
                    e.callback && e.callback();
                    return true
                }
            };
            var a = {
                scroll: function() {
                    if (r) {
                        clearTimeout(r)
                    }
                    r = setTimeout(function() {
                        u.execute()
                    },
                    30)
                }
            };
            var f = {
                init: function() {
                    f.initParam() && f.initView();
                    f.initEvent();
                    s = true
                },
                initParam: function() {
                    o = $(window);
                    $.extend(t, e);
                    if (!t.el) {
                        return false
                    }
                    return true
                },
                initView: function() {
                    var e = u.executeInView(t);
                    if (e && !t.always) {
                        return false
                    }
                    i.push(t);
                    return true
                },
                initEvent: function() {
                    if (!s) {
                        $(window).scroll(a.scroll)
                    }
                }
            };
            f.init();
            return {
                destroy: function() {
                    var e = i.indexOf(t);
                    if (e >= 0) {
                        i.splice(e, 1)
                    }
                    if (i.length == 0) {
                        $(window).unbind("scroll", a.scroll);
                        s = false
                    }
                },
                pause: function() {
                    var e = i.indexOf(t);
                    if (e >= 0) {
                        i.splice(e, 1)
                    }
                },
                resume: function() {
                    var e = i.indexOf(t);
                    if (e < 0) {
                        i.push(t)
                    }
                }
            }
        }
    },
    c: function(e, t, n, r) {
        var i;
        var s = {
            download: function() {
                try {} catch(n) {}
                var r = navigator.userAgent.toLowerCase();
                if (r.indexOf("micromessenger") >= 0) {
                    window.open("http://www.lianjia.com/client")
                } else {
                    if ($.os.android) {
                        window.open("http://activitymo.homelink.com.cn/download/homelink/android/Android_homelinkmm.apk")
                    } else {
                        window.open("https://itunes.apple.com/cn/app/id405882753?mt=8")
                    }
                }
            }
        };
        var o;
        var u = false;
        var a = {
            init: function(e) {
                a.initDoms(e);
                a.bind()
            },
            initDoms: function(e) {
                o = $(e).getMark()
            },
            bind: function() {
                o.one("download_app").on("tap", s.download)
            }
        };
        e.exports = function(e, t) {
            if (u) return;
            u = true;
            i = t && t["args"];
            a.init(e);
            return {
                destroy: function() {
                    o.one("download_app").off("tap", s.download);
                    u = false
                }
            }
        }
    },
    C: function(e, t, n, r) {
        var i = function() {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame ||
            function(e) {
                window.setTimeout(e, 1e3 / 60)
            }
        } ();
        var s;
        var o = false;
        var u;
        var a = [];
        var f;
        var l = function() {
            var e = location.pathname.slice(1).split("/");
            var t = "";
            var n = {};
        };
        var c = function() {
            var e = location.href;
            if (e != u) {
                try {
                    if (/newsarticle/img.test(navigator.userAgent)) {
                    } else {
                        l()
                    }
                    if (window.location.hostname == "m.lianjia.com") {
                        ga("send", "event", "Click", e, "1")
                    }
                    _czc.push(["_trackEvent", "click", e, "1"]);
                } catch(t) {}
                u = e
            }
            i(c)
        };
        var h = function(e, t, n) {
            var r = document;
            var i = "readyState";
            var s = "onreadystatechange";
            var o;
            var u;
            var f = +(new Date);
            var l = document.createElement("script");
            l.src = e;
            l.async = 1;
            document.getElementsByTagName("head")[0].appendChild(l);
            a.push(l);
            l.onload = l[s] = function() {
                if (o || l[i] && !/^c|loade/.test(l[i])) return;
                l.onload = l.onerror = l[s] = null;
                o = 1;
                u && clearTimeout(u);
                if (n && n() || !n) {
                    t && t("success", +(new Date) - f)
                } else {
                    t && t("load succ,but run error", +(new Date) - f)
                }
            };
            l.onerror = function() {
                l.onload = l.onerror = l[s] = null;
                o = 1;
                u && clearTimeout(u);
                t && t("error", 8e4)
            };
            u = setTimeout(function() {
                l.onload = l.onerror = l[s] = null;
                o = 1;
                t && t("timeout", 8e3)
            },
            8e3)
        };
        var p = {
            init: function(e, t) {
                f = t && t["args"];
                p.initDoms(e);
                p.bind()
            },
            initDoms: function(e) {
                s = $(e).getMark();
                u = location.href;
                window.__UDL_CONFIG = {};
                window["GoogleAnalyticsObject"] = "ga";
                window["ga"] = window["ga"] ||
                function() { (window["ga"].q = window["ga"].q || []).push(arguments)
                };
                window["ga"].l = 1 * new Date;
                var t = window["ga"].toString();
                switch (window.location.hostname) {
                case "m.lianjia.com":
                    ga("create", "UA-55871942-1", "auto");
                    ga("create", "UA-34859395-1", "auto", {
                        name: "past"
                    });
                    ga("create", "UA-61982569-1", "auto", {
                        name: "new"
                    });
                    ga("create", "UA-75975739-1", "auto", {
                        name: "newsarticle"
                    });
                    break
                }
                ga("create", "UA-55876525-1", "auto", {
                    name: "global"
                });
                ga("create", "UA-60608360-1", "auto", {
                    name: "new_global"
                });
                var n = n || [];
                n.push(["_setAccount", "1253491255"]);
            },
            bind: function() {
                c()
            }
        };
        e.exports = function(e, t) {
            if (o) return;
            o = true;
            p.init(e, t);
            return {
                destroy: function() {
                    window.$ULOG && (window.$ULOG = undefined);
                    $(a).remove();
                    o = false
                }
            }
        }
    },
    d: function(e, t, n, r) {
        var i = {
            foot_nav: function(e) {
                var t = $(e.el);
                var n = t.index();
                var r = s.get("foot_nav");
                var i = s.get("foot_navs");
                r.eq(a).removeClass("active");
                t.addClass("active");
                i.eq(a).removeClass("active");
                i.eq(n).addClass("active");
                a = n
            }
        };
        var s;
        var o = false;
        var u;
        var a = 0;
        var f = {
            init: function(e) {
                f.initDoms(e);
                f.bind()
            },
            initDoms: function(e) {
                s = $(e).getMark();
                u = $(e).de()
            },
            bind: function() {
                u.add("foot_nav", "tap", i.foot_nav)
            }
        };
        e.exports = function(e) {
            if (o) return;
            o = true;
            f.init(e);
            return {
                destroy: function() {
                    u.remove("foot_nav", "tap", i.foot_nav);
                    u.destroy();
                    o = false
                }
            }
        }
    },
    D: function(e, t, n, r) {
        function s(e) {
            if (e && e.tagName && e.tagName.toLowerCase() === "a") return e;
            if (e && e.parentNode) {
                return s(e.parentNode)
            }
            return false
        }
        var i = [{
            urlRule: /\/ershoufang\/(\w{1,15})\.html/,
            getScheme: function(e, t) {
                return "ershou/detail?houseCode=" + t[1]
            }
        },
        {
            urlRule: /\/xiaoqu\/(\d+)\/?$/,
            getScheme: function(e, t) {
                return "community/detail?communityid=" + t[1]
            }
        },
        {
            urlRule: /\/fangjia/,
            getScheme: function(e, t) {
                return "loveme"
            }
        },
        {
            urlRule: /dianpu\.lianjia\.com/,
            getScheme: function(e, t) {
                return "loveme"
            }
        },
        {
            urlRule: /\/yezhu\/?$/,
            getScheme: function(e, t) {
                return "sellHouse/main"
            }
        }];
        var o = false;
        e.exports = function(e) {
            if (o === true) return;
            $ljBridge.ready(function(t, n) {
                function o(e) {
                    var n = s(e.target);
                    if (n) {
                        for (var r = 0,
                        o = i.length; r < o; r++) {
                            var u = i[r];
                            var a = n.pathname;
                            var f = a.match(u.urlRule);
                            if (f && f.length) {
                                var l = u.getScheme(a, f);
                                l = t.getSchemeLink(l);
                                t.actionWithUrl(l);
                                e.preventDefault();
                                return false
                            }
                        }
                    }
                }
                var r = n.isLianjiaApp;
                if (r) {
                    $(e).on("click", o)
                }
            });
            o = true;
            return {
                destroy: function() {
                    $(e).off("click", action);
                    o = false
                }
            }
        }
    },
    e: function(e, t, n, r) {
        t.init = function(e) {
            var t = {
                container: $(document.body),
                axisX: {
                    has: true,
                    scroll: true,
                    data: []
                },
                axisY: {
                    has: true,
                    min: 0,
                    unit: "",
                    count: 3,
                    title: ""
                },
                data: []
            };
            var n = t.container;
            var r = 0;
            var i = 0;
            var s = 0;
            var o = 0;
            var u = [];
            var a = [];
            var f = [];
            var l;
            var c = {
                getUnitHeight: function(e) {
                    if (t.axisY.min === 1) {
                        return o / (e - i)
                    } else {
                        return o / e
                    }
                },
                getHeight: function(e, n) {
                    if (e == 0) return 0;
                    var r = c.getUnitHeight(e);
                    var s;
                    if (t.axisY.min === 1) {
                        var o = i * r;
                        s = n * r - o
                    } else {
                        s = n * r
                    }
                    return s
                },
                getDistance: function(e, t, n, r) {
                    var i = s / e;
                    var o = c.getHeight(r, t) - c.getHeight(r, n);
                    if (t == 0 && n == 0) {
                        return i
                    }
                    return Math.sqrt(i * i + o * o)
                },
                getAngle: function(e, t, n, r) {
                    var i = s / e;
                    var o = (t - n) * c.getUnitHeight(r);
                    var u = Math.sqrt(i * i + o * o);
                    var a = Math.asin(o / u) / Math.PI * 180;
                    return a
                },
                getMax: function(e) {
                    var n = [];
                    for (var r = 0,
                    i = t.data.length; r < i; r++) {
                        if (t.data[r].type === e) {
                            n.push.apply(n, t.data[r].data)
                        }
                        if (e === undefined) {
                            n.push.apply(n, t.data[r].data)
                        }
                        if (r === i - 1) {
                            Array.max = function(e) {
                                return Math.max.apply(Math, e)
                            };
                            var s = Array.max(n);
                            s = s * 1.08;
                            return s
                        }
                    }
                },
                getMin: function() {
                    var e = [];
                    for (var n = 0,
                    r = t.data.length; n < r; n++) {
                        e.push.apply(e, t.data[n].data);
                        if (n === r - 1) {
                            Array.min = function(e) {
                                return Math.min.apply(Math, e)
                            };
                            return Array.min(e) * .98
                        }
                    }
                }
            };
            var h = {
                addAxisY: function(e) {
                    var t = "";
                    var n = e.count;
                    var r = e.unit;
                    var s = c.getMax(e.type);
                    var o = e.min && e.min === 1 ? (s - i) / n: s / n;
                    var u;
                    var a = e.tofix;
                    if (a) {
                        u = o.toFixed(a)
                    } else {
                        u = Math.round(o)
                    }
                    if (e.min && e.min === 1) {
                        var f = i;
                        for (var l = 0; l <= n; l++) {
                            var h = i + u * l;
                            if (a) {
                                h = h.toFixed(a)
                            }
                            t += "<li><span>" + h + r + "</span></li>";
                            if (l === n) {
                                if (e.title && e.title !== "") {
                                    t += '<li class="title"><span>' + e.title + "</span></li>"
                                }
                                return t
                            }
                        }
                    } else {
                        for (var l = 0; l <= n; l++) {
                            var h = u * l;
                            if (a) {
                                h = h.toFixed(a)
                            }
                            t += "<li><span>" + h + r + "</span></li>";
                            if (l === n) {
                                if (e.title) {
                                    t += '<li class="title"><span>' + e.title + "</span></li>"
                                }
                                return t
                            }
                        }
                    }
                },
                addAxisX: function(e) {
                    var t = e.length;
                    var n = "";
                    for (var r = 0; r < t; r++) {
                        n += '<li class="chart_item">' + e[r] + "</li>";
                        if (r === t - 1) {
                            return n
                        }
                    }
                },
                addBar: function(e) {
                    var t = e.data.length;
                    var n = c.getMax(e.type);
                    for (var r = 0; r < t; r++) {
                        var i = e.data[r] || 0;
                        var s = c.getHeight(n, i);
                        if (a[r] === undefined) {
                            a[r] = ""
                        }
                        var o = '<span class="bar" data-info="' + e.title + ":" + i + e.unit + '" style="background-color:' + e.color + ";height:" + s + 'px;"></span>';
                        a[r] += o
                    }
                },
                addLine: function(e) {
                    var t = e.data.length;
                    var n = c.getMax(e.type);
                    for (var r = 0; r < t; r++) {
                        var i = e.data[r] || 0;
                        var s = e.data[r + 1] || 0;
                        var o = c.getHeight(n, i);
                        var a = "";
                        if (u[r] === undefined) {
                            u[r] = ""
                        }
                        if (r === t - 1) {
                            a = '<span class="dot" data-info="' + e.title + ":" + i + e.unit + '" style="background-color:' + e.color + ";bottom:" + o + 'px;"></span>'
                        } else {
                            var f = c.getAngle(t, i, s, n);
                            var l = c.getDistance(t, i, s, n);
                            a = '<span class="dot" data-info="' + e.title + ":" + i + e.unit + '" style="background-color:' + e.color + ";bottom:" + o + 'px;">' + '<span class="line" style="background-color:' + e.color + ";-webkit-transform: rotate(" + f + "deg);transform: rotate(" + f + "deg);width: " + l + 'px;"></span></span>'
                        }
                        u[r] += a
                    }
                },
                addSign: function(e) {
                    var t = '<span class="sign_item"><i class="sign ' + e.type + '" style="background:' + e.color + ';"></i><span class="sign_txt">' + e.title + "</span></span>";
                    f.push(t)
                },
                showInfo: function(e) {
                    var t = this;
                    var r = n.find(".tip");
                    var i = $(t).find(".bar,.dot");
                    var s = n.width();
                    var u = 0;
                    var a = n.find(".scroll")[0];
                    if (a) u = a.scrollLeft;
                    var f = "";
                    for (var l = 0,
                    c = i.length; l < c; l++) {
                        var h = i.eq(l).attr("data-info").split(":");
                        f += "<em>" + h[0] + "：</em><span>" + h[1] + "</span>" + "<br>"
                    }
                    if (r.length > 0) {
                        r.html(f)
                    } else {
                        r = $('<div class="tip">' + f + "</div>").appendTo(n)
                    }
                    var p = r.width() || s / 3;
                    var d = r.height() || s / 3;
                    var v = t.offsetLeft + parseInt($(document.documentElement).css("font-size")) || 0;
                    var m = t.offsetTop + parseInt($(document.documentElement).css("font-size")) || 0;
                    v = v - u;
                    v = v > s - p ? s - p: v;
                    m = m > o - d ? o - d: m;
                    $(t).siblings(".chart_item").removeClass("choosed");
                    $(t).addClass("choosed");
                    r.css({
                        left: v + "px",
                        top: m + "px"
                    });
                    $(document).on("tap",
                    function(e) {
                        var n = $(e.target);
                        if (!n.is(".chart_box") && n.closest(".chart_box").length < 1) {
                            $(t).removeClass("choosed");
                            r && r.remove()
                        }
                    })
                }
            };
            var p = {
                init: function(e) {
                    p.initParam(e);
                    p.initRender();
                    p.initEvent()
                },
                initParam: function(e) {
                    if (e) {
                        $.extend(t, e)
                    }
                },
                initRender: function() {
                    var e = t;
                    n = e.container;
                    var l = n.find(".scroll")[0];
                    var p = l ? l.scrollLeft: 0;
                    if (e.data.length < 1) return;
                    u = [];
                    a = [];
                    f = [];
                    var d = 0;
                    for (var v = 0,
                    m = e.data.length; v < m; v++) {
                        var g = e.data[v];
                        d = Math.max(d, g.data.length)
                    }
                    var y = d <= 6 || !e.axisX.scroll ? 1 : d / 6;
                    var b = Math.round(y * 100);
                    s = (n.width() - parseInt($(document.documentElement).css("font-size")) * 2) * b / 100;
                    o = n.height();
                    r = c.getMax();
                    if (e.axisY.min === 1) {
                        i = c.getMin()
                    }
                    if (e.axisX.has) {
                        var w = h.addAxisX(e.axisX.data)
                    }
                    if (e.axisY.has) {
                        var E = h.addAxisY(e.axisY)
                    }
                    for (var v = 0,
                    m = e.data.length; v < m; v++) {
                        var g = e.data[v];
                        if (m > 1 || e.axisY.title == "") {
                            h.addSign(g);
                            n.css({
                                margin: "2rem 0 4rem"
                            })
                        } else {
                            n.css({
                                margin: "3rem 0 2rem"
                            })
                        }
                        switch (g.type) {
                        case "bar":
                            h.addBar(g);
                            break;
                        case "line":
                            h.addLine(g)
                        }
                    }
                    var S = "";
                    for (var x = 0; x < d; x++) {
                        var T = u[x] || "";
                        var N = a[x] || "";
                        S += '<li class="chart_item">' + N + T + "</li>";
                        if (x == d - 1) {
                            var C = '<ul class="chartY">' + E + "</ul>" + '<div class="sign_box">' + f.join("") + "</div>" + '<div class="scroll">' + '<div class="data_box" style="width:' + b + '%;"><ul class="chart_data">' + S + "</ul></div>" + '<div class="title_box" style="width:' + b + '%;"><ul class="chartX">' + w + "</ul></div>" + "</div>";
                            n.html(C);
                            if (p) {
                                var k = n.find(".scroll")[0];
                                if (k) k.scrollLeft = p
                            }
                        }
                    }
                },
                resize: function() {
                    clearTimeout(l);
                    l = setTimeout(function() {
                        p.initRender();
                    },
                    1e3 / 60)
                },
                initEvent: function() {
                    n.on("click", ".data_box .chart_item", h.showInfo);
                    $(window).on("resize", p.resize)
                }
            };
            p.init(e);
            var d = {};
            d.add = function(e) {};
            d.destroy = function() {
                n.off("click", ".data_box .chart_item", h.showInfo);
                $(window).off("resize", p.resize)
            };
            return d
        }
    },
    E: function(e, t, n, r) {
        var i = n("f");
        var s = null;
        var o = n("F");
        t.init = function(e) {
            var t = {
                deAction: "viewImage",
                formatMoredata: function(e) {
                    var t = {};
                    for (var n = 0; n < e.length; n++) {
                        t[e[n].type] = t[e[n].type] || [];
                        t[e[n].type].push(e[n])
                    }
                    var r = [];
                    r.push(e);
                    for (var n in t) {
                        r.push(t[n])
                    }
                    return r
                },
                beforeShow: function() {},
                afterShow: function() {},
                beforeHide: function() {},
                afterHide: function() {},
                swipeSlide: function() {}
            };
            var n = {};
            var r = {};
            var u;
            var a;
            var f;
            var l = "全部";
            var c;
            var h;
            var p;
            var d = "transition";
            var v = "transform";
            var m = "transform-origin";
            var g;
            var y = +(new Date);
            var b = o.init();
            var w = {
                getPinchTarget: function(e) {
                    var t = e.evt.target;
                    if (t.tagName.toUpperCase() !== "LI") {
                        t = t.parentNode
                    }
                    return t
                },
                setCss: function(e, t, n) {
                    var r = {};
                    r["transition"] = 1;
                    r["transform"] = 1;
                    r["transform-origin"] = 1;
                    if (r[t]) {
                        $(e).css(t, n);
                        if (n.indexOf("transform") >= 0) {
                            n = "-webkit-" + n
                        }
                        $(e).css("-webkit-" + t, n)
                    } else {
                        $(e).css(t, n)
                    }
                }
            };
            var E = {
                touchstart: function(e) {
                    if (!e.evt || !e.evt.touches) return;
                    h = parseInt($(e.el).data("offset"));
                    if (!h) {
                        $(e.el).data("offset", 0);
                        h = 0
                    }
                    if (e.evt.touches.length == 1) {
                        c = "tap";
                        w.setCss(e.el, d, "none");
                        n.startData = {
                            clientX: e.evt.touches[0].clientX,
                            clientY: e.evt.touches[0].clientY
                        };
                        n.stopData = {
                            clientX: e.evt.touches[0].clientX,
                            clientY: e.evt.touches[0].clientY
                        };
                        var t = e.evt["timeStamp"] || +(new Date);
                        if (u && a) {
                            if (t - u < 500) {
                                c = "doubletap"
                            }
                        }
                        u = t
                    } else if (e.evt.touches.length == 2 && a) {
                        try {
                            c = "pinch";
                            e.el = w.getPinchTarget(e);
                            w.setCss(e.el, d, "none");
                            var i = e.evt.touches[0];
                            var s = e.evt.touches[1];
                            var o;
                            if (!r || r.scale == undefined) {
                                r.startData = {};
                                r.scale = 1;
                                r.startData.scale = r.scale;
                                r.startData.offsetX = 0;
                                r.startData.offsetY = 0;
                                r.startData.clientX = (i.clientX + s.clientX) / 2;
                                r.startData.clientY = (i.clientY + s.clientY) / 2;
                                r.startData.distance = Math.sqrt((i.clientX - s.clientX) * (i.clientX - s.clientX) + (i.clientY - s.clientY) * (i.clientY - s.clientY));
                                w.setCss(e.el, m, r.startData.clientX + "px " + r.startData.clientY + "px")
                            } else {
                                var f = (r.startData.clientX * (r.scale - 1) - r.startData.offsetX + (i.clientX + s.clientX) / 2) / r.scale;
                                var l = (r.startData.clientY * (r.scale - 1) - r.startData.offsetY + (i.clientY + s.clientY) / 2) / r.scale;
                                var p = (i.clientX + s.clientX) / 2 - f;
                                var g = (i.clientY + s.clientY) / 2 - l;
                                w.setCss(e.el, v, "translate3d(0px, 0px, 0px)");
                                w.setCss(e.el, m, f + "px " + l + "px");
                                w.setCss(e.el, v, "translate3d(" + p + "px, " + g + "px, 0px) scale(" + r.scale + ")");
                                r.startData.offsetX = p;
                                r.startData.offsetY = g;
                                r.startData.clientX = f;
                                r.startData.clientY = l;
                                r.startData.distance = Math.sqrt((i.clientX - s.clientX) * (i.clientX - s.clientX) + (i.clientY - s.clientY) * (i.clientY - s.clientY))
                            }
                        } catch(y) {}
                    }
                },
                touchmove: function(e) {
                    h = parseInt($(e.el).data("offset"));
                    if (c == "tap" || c == "swipe") {
                        c = "swipe";
                        var t = {
                            clientX: n.stopData.clientX,
                            clientY: n.stopData.clientY
                        };
                        n.stopData.clientX = e.evt.touches[0].clientX;
                        n.stopData.clientY = e.evt.touches[0].clientY;
                        if (r && r.scale && r.scale != 1) {
                            e.evt.preventDefault();
                            e.el = w.getPinchTarget(e);
                            var i = $(e.el.parentNode).width() / $(e.el.parentNode).children().length;
                            if (n.startData.clientX - e.evt.touches[0].clientX - r.startData.offsetX > i - r.startData.clientX) {
                                var s = h - i;
                                n.stopData.clientX = t.clientX;
                                if (Math.abs(s) >= $(e.el.parentNode).width()) {
                                    var o = n.stopData.clientY - n.startData.clientY + r.startData.offsetY;
                                    var u = n.stopData.clientX - n.startData.clientX + r.startData.offsetX;
                                    w.setCss(e.el, d, "none");
                                    w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px) scale(" + r.scale + ")");
                                    return
                                }
                                if (!p) {
                                    var o = n.stopData.clientY - n.startData.clientY + r.startData.offsetY;
                                    var u = n.stopData.clientX - n.startData.clientX + r.startData.offsetX;
                                    w.setCss(e.el, d, "none");
                                    w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px) scale(" + r.scale + ")");
                                    return
                                }
                                w.setCss(e.el, d, v + " 0.5s ease");
                                w.setCss(e.el, v, "translate3d(0px, 0px, 0px)");
                                w.setCss(e.el.parentNode, d, v + " 0.5s ease");
                                w.setCss(e.el.parentNode, v, "translate3d(" + s + "px, 0px, 0px)");
                                $(e.el.parentNode).data("offset", s);
                                r = {};
                                c = null
                            } else if (e.evt.touches[0].clientX - n.startData.clientX + r.startData.offsetX > r.startData.clientX) {
                                var s = h + i;
                                n.stopData.clientX = t.clientX;
                                if (h >= 0) {
                                    var o = n.stopData.clientY - n.startData.clientY + r.startData.offsetY;
                                    var u = n.stopData.clientX - n.startData.clientX + r.startData.offsetX;
                                    w.setCss(e.el, d, "none");
                                    w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px) scale(" + r.scale + ")");
                                    return
                                }
                                if (!p) {
                                    var o = n.stopData.clientY - n.startData.clientY + r.startData.offsetY;
                                    var u = n.stopData.clientX - n.startData.clientX + r.startData.offsetX;
                                    w.setCss(e.el, d, "none");
                                    w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px) scale(" + r.scale + ")");
                                    return
                                }
                                w.setCss(e.el, d, v + " 0.5s ease");
                                w.setCss(e.el, v, "translate3d(0px, 0px, 0px)");
                                w.setCss(e.el.parentNode, d, v + " 0.5s ease");
                                w.setCss(e.el.parentNode, v, "translate3d(" + s + "px, 0px, 0px)");
                                $(e.el.parentNode).data("offset", s);
                                r = {};
                                c = null
                            } else {
                                var o = e.evt.touches[0].clientY - n.startData.clientY + r.startData.offsetY;
                                var u = e.evt.touches[0].clientX - n.startData.clientX + r.startData.offsetX;
                                p = false;
                                w.setCss(e.el, d, "none");
                                w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px) scale(" + r.scale + ")")
                            }
                        } else {
                            if ($(e.el).attr("noswipe") == 1 || $(e.el).children().length <= 1) return;
                            e.evt.preventDefault();
                            var u = e.evt.touches[0].clientX - n.startData.clientX + h;
                            var o = 0;
                            w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px)")
                        }
                    } else if (c == "pinch") {
                        e.evt.preventDefault();
                        e.el = w.getPinchTarget(e);
                        p = false;
                        var a = e.evt.touches[0];
                        var f = e.evt.touches[1];
                        var l = Math.sqrt((a.clientX - f.clientX) * (a.clientX - f.clientX) + (a.clientY - f.clientY) * (a.clientY - f.clientY));
                        r.startData.scale = l / r.startData.distance * r.scale;
                        var u = r.startData.offsetX;
                        var o = r.startData.offsetY;
                        w.setCss(e.el, v, "translate3d(" + u + "px, " + o + "px, 0px) scale(" + r.startData.scale + ")")
                    }
                },
                touchend: function(e) {
                    h = parseInt($(e.el).data("offset"));
                    g && clearTimeout(g);
                    p = true;
                    if (c == "tap" && !a) {
                        $ljBridge.ready(function(n, r) {
                            var s = r.isLianjiaApp || r.isLinkApp;
                            t.beforeShow(e);
                            try {
                                var o = JSON.parse($(e.el).attr("data-info"));
                                if (!o || o.length == 0) {
                                    return false
                                }
                            } catch(u) {
                                return false
                            }
                            var f = t["formatMoredata"](o);
                            var l = i({
                                renderData: f,
                                dataAct: t["deAction"]
                            });
                            $(document.body).append(l);
                            a = $("section[data-mark=img_layer]");
                            a.find(".imgview-imglist")[0].style.display = "";
                            if (f.length != 1) {
                                $(a.find(".imgview-imglist")[0]).attr("data-mark", "layer_全部");
                                $(a.find(".imgview-tag .type")[0]).html("全部");
                                $(a.find(".imgview-title")[0]).html("全部");
                                $(a.find(".imgview-tag")[0]).attr("data-mark", "layer_tab_全部")
                            }
                            $(a.find(".imgview-tag")[0]).addClass("focus");
                            var c = a.find("[data-act=" + t["deAction"] + "]");
                            c = $(c[0]);
                            var p = c.width() / c.children().length;
                            var d = $(e.el).width() / $(e.el).children().length;
                            var m = h / d * p;
                            var g = e.el.getAttribute("data-show-offset");
                            if (g) {
                                m = -(g | 0) * p
                            }
                            c.data("offset", m);
                            w.setCss(c, v, "translate3d(" + m + "px, 0px, 0px)");
                            a.on("touchmove", E.stopDefaultscroll);
                            if (s) {
                                $(a.find(".imgview-header")[0]).hide();
                                location.hash = "imgvw=" + y;
                                setTimeout(function() {
                                    $(window).on("hashchange", E.hashchange)
                                },
                                1e3)
                            }
                            t.afterShow(e, a)
                        })
                    } else if (c == "tap") {
                        if (!r || !r.scale || r.scale == 1) {
                            g = setTimeout(function() {
                                E.exit(e)
                            },
                            600)
                        }
                    } else if (c == "swipe") {
                        if (r && r.scale && r.scale != 1) {
                            r.startData.offsetY = n.stopData.clientY - n.startData.clientY + r.startData.offsetY;
                            r.startData.offsetX = n.stopData.clientX - n.startData.clientX + r.startData.offsetX;
                            return
                        }
                        if ($(e.el).attr("noswipe") == 1 || $(e.el).children().length <= 1) return;
                        w.setCss(e.el, d, v + " 0.5s ease");
                        var s = e.evt["timeStamp"] || +(new Date);
                        var o = n.stopData.clientX - n.startData.clientX;
                        var f = $(e.el).width() / $(e.el).children().length;
                        if (s - u < 1e3) {
                            if (o > 0) {
                                h = h + f;
                                if (h > 0) {
                                    h = 0
                                }
                            } else {
                                var l = h - f;
                                if (Math.abs(l) < $(e.el).width()) {
                                    h = l
                                }
                            }
                            $(e.el).data("offset", h);
                            w.setCss(e.el, v, "translate3d(" + h + "px, 0px, 0px)")
                        } else {
                            if (Math.abs(o) > f / 2) {
                                if (o > 0) {
                                    h = h + f;
                                    if (h > 0) {
                                        h = 0
                                    }
                                } else {
                                    var l = h - f;
                                    if (Math.abs(l) < $(e.el).width()) {
                                        h = l
                                    }
                                }
                            }
                            $(e.el).data("offset", h);
                            w.setCss(e.el, v, "translate3d(" + h + "px, 0px, 0px)")
                        }
                        if (!a) {
                            t["swipeSlide"](Math.abs(h / f), e.el)
                        }
                        n.stopData = u = null
                    } else if (c == "doubletap") {
                        e.el = w.getPinchTarget(e);
                        w.setCss(e.el, d, v + " 0.5s ease");
                        if (r && r.scale && r.scale != 1) {
                            r = {};
                            w.setCss(e.el, v, "translate3d(0px, 0px, 0px)")
                        } else {
                            p = false;
                            r.startData = {
                                clientX: n.startData.clientX,
                                clientY: n.startData.clientY,
                                offsetX: 0,
                                offsetY: 0
                            };
                            r.scale = 2;
                            w.setCss(e.el, m, n.startData.clientX + "px " + n.startData.clientY + "px");
                            w.setCss(e.el, v, "translate3d(0px, 0px, 0px) scale(2)")
                        }
                        u = null
                    } else if (c == "pinch") {
                        e.el = w.getPinchTarget(e);
                        if (r.startData.scale <= 1) {
                            w.setCss(e.el, d, v + " 0.5s ease");
                            w.setCss(e.el, v, "translate3d(0px, 0px, 0px)");
                            r = {}
                        } else {
                            r.scale = r.startData.scale
                        }
                    }
                },
                changetab: function(e) {
                    var t = $(e.el).find(".type")[0].innerHTML;
                    if (t == l) return;
                    $("[data-mark=layer_tab_" + t + "]").addClass("focus");
                    $("[data-mark=layer_tab_" + l + "]").removeClass("focus");
                    $("[data-mark=layer_" + t + "]").show();
                    $("[data-mark=layer_" + l + "]").hide();
                    $(".imgview-title").html(t);
                    l = t
                },
                exit: function(e) {
                    e.evt.preventDefault();
                    t["beforeHide"](a);
                    $(window).off("hashchange", E.hashchange);
                    a.remove();
                    a = null;
                    t["afterHide"]()
                },
                stopDefaultscroll: function(e) {
                    e.preventDefault()
                },
                hashchange: function(e) {
                    t["beforeHide"](a);
                    a.remove();
                    $(window).off("hashchange", E.hashchange);
                    a = null;
                    t["afterHide"]()
                }
            };
            var S = {
                init: function() {
                    S.initParam();
                    if (s && s[t.deAction]) return;
                    S.initEvent();
                    s = s || {};
                    s[t.deAction] = true
                },
                initParam: function() {
                    $.extend(t, e)
                },
                initEvent: function() {
                    f = $(document.body).de();
                    f.add(t.deAction, "touchstart", E.touchstart);
                    f.add(t.deAction, "touchmove", E.touchmove);
                    f.add(t.deAction, "touchend", E.touchend);
                    if (!s) {
                        f.add("tab_tag", "tap", E.changetab);
                        f.add("imgviewer_exit", "tap", E.exit)
                    }
                }
            };
            S.init();
            return {
                swipe: function(e, n) {
                    w.setCss(e, d, v + " 0.5s ease");
                    var r = $(e).width() / $(e).children().length;
                    if (n > $(e).children().length - 1) {
                        n = $(e).children().length - 1
                    }
                    var i = 0 - n * r;
                    $(e).data("offset", i);
                    w.setCss(e, v, "translate3d(" + i + "px, 0px, 0px)");
                    t["swipeSlide"](n, e)
                },
                hide: function() {
                    t["beforeHide"](a);
                    a.remove();
                    a = null;
                    t["afterHide"]()
                },
                destroy: function() {
                    if (a) {
                        a.remove();
                        a = null
                    }
                    f.remove(t.deAction, "touchstart", E.touchstart);
                    f.remove(t.deAction, "touchmove", E.touchmove);
                    f.remove(t.deAction, "touchend", E.touchend);
                    f.remove("tab_tag", "touchend", E.changetab);
                    f.remove("imgviewer_exit", "touchend", E.exit);
                    f.destroy && f.destroy();
                    f = undefined;
                    s = null
                }
            }
        }
    },
    f: function(e, t, n, r) {
        e.exports = function(e, t, n) {
            t = t ||
            function(e) {
                return e
            };
            var r = "",
            i = t('<section class="layer-fixed" data-mark="img_layer">\n    <div class="imgview-wrap">\n        <header class="imgview-header"><span data-act="imgviewer_exit" class="imgview-back"><i class="icon_fanhui2">退出</i></span><span class="imgview-title">'),
            s = t('</span></header>\n        <div class="imgview-view">\n            <div class="imgview-imgbox">\n            '),
            o = t('                <ul class="imgview-imglist" data-act="'),
            u = t('" data-mark="layer_'),
            a = t('" style="width: '),
            f = t('00%;display: none;">\n                '),
            l = t('                    <li class="imgview-li"><img src="'),
            c = t('"></li>\n              '),
            h = t("                </ul>\n            "),
            p = t('            </div>\n        </div>\n        <footer class="imgview-pages" data-act="scroll">\n        '),
            d = t('        	   <span class="imgview-tag" data-act="tab_tag" data-mark="layer_tab_'),
            v = t('"><span class="type">'),
            m = t("</span><span>("),
            g = t(")</span></span>\n            "),
            y = t("        </footer>\n    </div>\n</section>");
            r += i;
            r += e.renderData[0][0].type;
            r += s;
            for (e.renderData.i = 0, e.renderData.len = e.renderData.length; e.renderData.i < e.renderData.len; e.renderData.i++) {
                e.list = e.renderData[e.renderData.i];
                r += o;
                r += e.dataAct;
                r += u;
                r += e.list[0].type;
                r += a;
                r += e.list.length;
                r += f;
                for (e.list.i = 0, e.list.len = e.list.length; e.list.i < e.list.len; e.list.i++) {
                    e.value = e.list[e.list.i];
                    r += l;
                    r += e.value.url;
                    r += c
                }
                r += h
            }
            r += p;
            for (e.renderData.i = 0, e.renderData.len = e.renderData.length; e.renderData.i < e.renderData.len; e.renderData.i++) {
                e.list = e.renderData[e.renderData.i];
                if (e.list[0].type) {
                    r += d;
                    r += e.list[0].type;
                    r += v;
                    r += e.list[0].type;
                    r += m;
                    r += e.list.len;
                    r += g
                }
            }
            r += y;
            return r
        }
    },
    F: function(e, t, n, r) {
        t.init = function(e) {
            var t = {
                deEl: document.body,
                deAction: "scroll",
                beforeSroll: function() {},
                afterScroll: function() {},
                inertia: false,
                direction: "x"
            };
            var n = {};
            var r;
            var i;
            var s;
            var o;
            if ($.browser.webkit) {
                i = "-webkit-transition";
                s = "-webkit-transform";
                o = "-webkit-transform-origin"
            } else {
                i = "transition";
                s = "transform";
                o = "transform-origin"
            }
            var u = {
                touchstart: function(e) {
                    if (!e.evt || !e.evt.touches) return;
                    currentOffset = parseInt($(e.el).data("offset"));
                    if (!currentOffset) {
                        $(e.el).data("offset", 0);
                        currentOffset = 0
                    }
                    $(e.el).css(i, "none");
                    n.startData = {
                        clientX: e.evt.touches[0].clientX,
                        clientY: e.evt.touches[0].clientY
                    };
                    n.stopData = {
                        clientX: e.evt.touches[0].clientX,
                        clientY: e.evt.touches[0].clientY
                    };
                    t.beforeSroll(e)
                },
                touchmove: function(e) {
                    currentOffset = parseInt($(e.el).data("offset"));
                    if ($(e.el).attr("noswipe") == 1 || $(e.el).children().length <= 1) return;
                    e.evt.preventDefault();
                    var r = {
                        clientX: n.stopData.clientX,
                        clientY: n.stopData.clientY
                    };
                    n.stopData.clientX = e.evt.touches[0].clientX;
                    n.stopData.clientY = e.evt.touches[0].clientY;
                    var i, o;
                    if (t["direction"] == "x") {
                        i = e.evt.touches[0].clientX - n.startData.clientX + currentOffset;
                        o = 0;
                        var u = $(e.el).width() - $(e.el.parentNode).width();
                        if (Math.abs(i) > u + 30) {
                            return
                        }
                        if (i > 30) {
                            return
                        }
                    } else {
                        i = 0;
                        o = e.evt.touches[0].clientY - n.startData.clientY + currentOffset;
                        var a = $(e.el).height();
                        if (Math.abs(o) > a + 30) {
                            return
                        }
                        if (o > 30) {
                            return
                        }
                    }
                    $(e.el).css(s, "translate3d(" + i + "px, " + o + "px, 0px)")
                },
                touchend: function(e) {
                    currentOffset = parseInt($(e.el).data("offset"));
                    if (t["direction"] == "x") {
                        currentOffset = n.stopData.clientX - n.startData.clientX + currentOffset;
                        var r = $(e.el).width() - $(e.el.parentNode).width();
                        var o = false;
                        if (Math.abs(currentOffset) > r) {
                            currentOffset = -r;
                            o = true
                        }
                        if (currentOffset > 0) {
                            currentOffset = 0;
                            o = true
                        }
                        if (o) {
                            $(e.el).css(i, s + " 0.5s ease");
                            $(e.el).css(s, "translate3d(" + currentOffset + "px, 0px, 0px)")
                        }
                    } else {
                        currentOffset = n.stopData.clientY - n.startData.clientY + currentOffset;
                        var u = $(e.el).height();
                        var o = false;
                        if (Math.abs(currentOffset) > u) {
                            currentOffset = -u;
                            o = true
                        }
                        if (currentOffset > 0) {
                            currentOffset = 0;
                            o = true
                        }
                        if (o) {
                            $(e.el).css(i, s + " 0.5s ease");
                            $(e.el).css(s, "translate3d(0px, " + currentOffset + "px, 0px)")
                        }
                    }
                    $(e.el).data("offset", currentOffset);
                    t.afterScroll(e)
                }
            };
            var a = {
                init: function() {
                    a.initParam();
                    a.initEvent()
                },
                initParam: function() {
                    $.extend(t, e)
                },
                initEvent: function() {
                    r = $(t.deEl).de();
                    r.add(t.deAction, "touchstart", u.touchstart);
                    r.add(t.deAction, "touchmove", u.touchmove);
                    r.add(t.deAction, "touchend", u.touchend)
                }
            };
            a.init();
            return {
                destroy: function() {},
                setOffset: function(e, n) {
                    var r = e;
                    if (t["direction"] == "x") {
                        var i = $(n).width() - $(n.parentNode).width();
                        if (Math.abs(e) > i) {
                            r = -i
                        }
                        if (e > 0) {
                            r = 0
                        }
                        $(n).css(s, "translate3d(" + r + "px, 0px, 0px)")
                    } else {
                        var o = $(n).height() - $(n.parentNode).height();
                        if (Math.abs(e) > o) {
                            r = -o
                        }
                        if (e > 0) {
                            r = 0
                        }
                        $(n).css(s, "translate3d(0px, " + r + "px, 0px)")
                    }
                    $(n).data("offset", r)
                }
            }
        }
    },
    g: function(e, t, n, r) {
        var i = n("G");
        var s = false;
        var o;
        var u = navigator.userAgent.toLowerCase().indexOf("micromessenger") >= 0;
        var a, f;
        var l = n("h");
        var c;
        var h;
        if ($ljBridge) {
            $ljBridge.ready(function(e, t) {
                var n = t.isLianjiaApp || t.isLinkApp;
                if (n) h = e
            })
        }
        var p = function(e, t) {
            var n = location.pathname.slice(1).split("/");
            var r = "";
            var i = {};
            if (t) {
                i["ljweb_el"] = t
            }
        };
        var d = {
            sendSMS: function(e) {
                try {
                    if (/newsarticle/img.test(navigator.userAgent)) {
                    }
                    p("message_click", e.data.ucid || "");
                    i({
                        ljweb_id: "20001",
                        ljweb_el: e.data.ucid || "",
                        ljweb_bl: "agentmessage",
                        rebuild: function(e) {
                            e["ljweb_mod"] = e["ljweb_channel_key"] + "_detail_diamond-first"
                        }
                    },
                    f)
                } catch(t) {}
                if (h) {
                    h.actionWithUrl("lianjia://func/sendmessage?telephone=" + e.data.tel + "&message=" + encodeURIComponent(e.data.content) + "&agent_id=" + (e.data.ucid || ""));
                    return
                }
                var n = e.data;
                var r = "";
                if ($.os.ios) {
                    if (!u) {
                        if (parseInt($.os.version) >= 8) {
                            r = "sms:" + n.tel + "/&body=" + encodeURIComponent(n.content)
                        } else {
                            r = "sms:" + n.tel + "/;body=" + encodeURIComponent(n.content)
                        }
                    } else {
                        r = "sms:" + n.tel;
                        if (!n.tel) {
                            r = ""
                        }
                    }
                } else if ($.os.android) {
                    r = "sms:" + n.tel + "?body=" + encodeURIComponent(n.content)
                }
                if (r) {
                    if (n.hasUrl) {
                        var s = n.url || location.href;
                        r += s
                    }
                    window.open(r)
                }
            },
            telphone: function(e) {
                if (!e.data.tel) {
                    c.showError("热线暂时不可用，请您稍后再试");
                    return false
                }
                try {
                    if (/newsarticle/img.test(navigator.userAgent)) {
                    }
                    p("phone_click", e.data.ucid || "");
                    i({
                        ljweb_id: "20001",
                        ljweb_el: e.data.ucid || "",
                        ljweb_bl: "agentphone",
                        rebuild: function(e) {
                            e["ljweb_mod"] = e["ljweb_channel_key"] + "_detail_diamond-first"
                        }
                    },
                    f)
                } catch(t) {}
                var n = e.data;
                var r = n.tel && n.tel.replace("-", ",").replace("转", ",");
                if (r) {
                    if (h) {
                        h.actionWithUrl("lianjia://phonenum/customerservices?telephone=" + r.replace(",", "转"));
                        return
                    }
                    location.href = "tel:" + r
                }
            },
            headimg: function(e) {
                i({
                    ljweb_id: "20001",
                    ljweb_el: e.data.ucid || "",
                    ljweb_bl: "agent",
                    rebuild: function(e) {
                        e["ljweb_mod"] = e["ljweb_channel_key"] + "_detail_diamond-first"
                    }
                },
                f)
            }
        };
        var v = {
            init: function(e) {
                if (s) return;
                var t = $("#" + e).find("[data-act=telphone]").attr("data-query");
                t = t && $.queryToJson(t);
                if (!t) {
                    t = $("#" + e).find("[data-act=sendSMS]").attr("data-query");
                    t = t && $.queryToJson(t)
                }
                if (t) {
                    i({
                        ljweb_id: "20001",
                        ljweb_el: t.ucid || "",
                        ljweb_bl: "agent_show",
                        rebuild: function(e) {
                            e["ljweb_mod"] = e["ljweb_channel_key"] + "_detail_diamond-first"
                        }
                    },
                    f)
                }
                s = true;
                v.bind(e);
                c = l.init()
            },
            bind: function(e) {
                o = $("#" + e).de();
                o.add("sendSMS", "click", d.sendSMS);
                o.add("telphone", "click", d.telphone);
                o.add("headimg", "click", d.headimg)
            },
            destroy: function() {
                o.remove("sendSMS", "click", d.sendSMS);
                o.remove("telphone", "click", d.telphone);
                o.remove("headimg", "click", d.headimg);
                o.destroy && o.destroy()
            }
        };
        e.exports = function(e, t) {
            a = t && t["args"];
            f = t;
            v.init(e);
            return {
                destroy: v.destroy
            }
        }
    },
    G: function(e, t, n, r) {
        var i = {
            ljweb_group: "SEARCH_M",
            ljweb_id: "",
            ljweb_mod: "",
            ljweb_bl: "",
            ljweb_el: "",
            ljweb_index: "",
            ljweb_value: "",
            ljweb_url: "",
            ljweb_sample: "",
            ljweb_ref: document.referrer
        };
        e.exports = function(e, t) {
            var n = t && t["args"];
            $.extend(i, e);
            var r = location.pathname.slice(1).split("/");
            var s = "";
            var o;
            var u; (function() {
                if (!window.$ULOG) {
                    u = setTimeout(arguments.callee, 1e3);
                    return
                }
                u && clearTimeout(u);
                i.ljweb_cid = s;
                i.ljweb_channel_key = "";
                o && (i.ljweb_channel = o);
                if (i.rebuild) {
                    i.rebuild(i);
                    delete i["rebuild"]
                }
            })()
        }
    },
    h: function(e, t, n, r) {
        var i = n("H");
        t.init = function() {
            var e = {
                ani: "fadeIn",
                type: "error",
                content: "操作失败",
                delay: 1e3
            };
            var t = {
                init: function(e) {
                    if (t.myToast) {
                        $(t.myToast).remove()
                    }
                    t.initParam(e);
                    t.initRender();
                    t.initEvent()
                },
                initParam: function(t) {
                    t && $.extend(e, t)
                },
                initRender: function() {
                    var n = e.ani;
                    var r = e.type;
                    var s = e.content;
                    var o = i({
                        ani: n,
                        type: r,
                        content: s
                    });
                    t.myToast = $(o).appendTo(document.body)
                },
                initEvent: function() {
                    if (e.delay > 0) {
                        var n = setTimeout(function() {
                            clearTimeout(n);
                            $(t.myToast).remove()
                        },
                        e.delay)
                    }
                }
            };
            var n = {};
            n.show = function(e) {
                t.init(e)
            };
            n.showSuccess = function(e) {
                t.init({
                    type: "success",
                    content: e
                })
            };
            n.showError = function(e) {
                t.init({
                    type: "error",
                    content: e
                })
            };
            n.showWarn = function(e) {
                t.init({
                    type: "warn",
                    content: e
                })
            };
            n.showWithoutIcon = function(e) {
                t.init({
                    type: null,
                    content: e
                })
            };
            n.destroy = function() {};
            return n
        }
    },
    H: function(e, t, n, r) {
        e.exports = function(e, t, n) {
            t = t ||
            function(e) {
                return e
            };
            var r = "",
            i = t('<div class="toast '),
            s = t('">\n<div class="content '),
            o = t("content_without_icon"),
            u = t('">'),
            a = t('<div class="icon_box"><i class="icon_'),
            f = t('"></i></div>'),
            l = t('<div class="info_box">'),
            c = t("</div>\n</div>\n</div>");
            r += i;
            r += e.ani;
            r += s;
            if (!e.type) {
                r += o
            }
            r += u;
            if (e.type) {
                r += a;
                r += e.type;
                r += f
            }
            r += l;
            r += e.content;
            r += c;
            return r
        }
    },
    i: function(e, t, n, r) {
        var i = n("I");
        var s = n("h");
        var o = n("G");
        t.init = function(e, t) {
            var n;
            var r;
            var u = {
                actBtn: "",
                beforeFollow: function() {},
                afterFollow: function() {},
                beforeUnFollow: function() {},
                afterUnFollow: function() {},
                followTrans: i.follow,
                followData: {},
                unfollowTrans: i.unfollow,
                unfollowData: {},
                unfollowClass: "icon_guanzhu",
                followClass: "icon_guanzhu_d",
                canUnfollow: true,
                followText: "取消关注",
                unfollowText: "关注",
                checkFollowTrans: i.isFavorite,
                checkFollowData: {}
            };
            var a;
            var f;
            var l;
            var c = {
                follow: function(e) {
                    if (!document.cookie.match(/lianjia_token=([^;]+)/)) {
                        if (f) {
                            if (a) {
                                a.actionLogin(encodeURIComponent(location.href))
                            }
                        } else {
                            location.href = "/my/login?redirect=" + encodeURIComponent(location.href)
                        }
                        return false
                    }
                    if (r) return;
                    var i = l.one("follow_icon");
                    var s = l.one("follow_text");
                    o({
                        ljweb_bl: "btn",
                        ljweb_el: i.hasClass(u["followClass"]) ? "0": "1",
                        rebuild: function(e) {
                            e["ljweb_mod"] = e["ljweb_channel_key"] + "_detail_fav";
                            if (e["ljweb_channel_key"] == "m_pages_xiaoquDetail") {
                                e["ljweb_id"] = "10007"
                            } else {
                                e["ljweb_id"] = "10006"
                            }
                        }
                    },
                    t);
                    if (i.hasClass(u["followClass"])) {
                        if (u["canUnfollow"]) {
                            r = true;
                            u.beforeUnFollow();
                            u["unfollowTrans"].request(u["unfollowData"], {
                                success: function(e) {
                                    r = false;
                                    if (e.errno === 0) {
                                        i.removeClass(u["followClass"]);
                                        i.addClass(u["unfollowClass"]);
                                        s.html(u["unfollowText"]);
                                        u.afterUnFollow()
                                    } else {
                                        n.showError("取消关注失败")
                                    }
                                },
                                error: function() {
                                    r = false;
                                    n.showError("取消关注失败")
                                }
                            })
                        }
                    } else if (i.hasClass(u["unfollowClass"])) {
                        r = true;
                        u.beforeFollow();
                        u["followTrans"].request(u["followData"], {
                            success: function(e) {
                                r = false;
                                if (e.errno === 0) {
                                    i.removeClass(u["unfollowClass"]);
                                    i.addClass(u["followClass"]);
                                    s.html(u["followText"]);
                                    u.afterFollow()
                                } else if (e.errno == 20001) {
                                    if (f) {
                                        if (a) {
                                            a.actionLogin(encodeURIComponent(location.href))
                                        }
                                    } else {
                                        location.href = "/my/login?redirect=" + encodeURIComponent(location.href)
                                    }
                                } else {
                                    n.showError("关注失败")
                                }
                            },
                            error: function() {
                                r = false;
                                n.showError("关注失败")
                            }
                        })
                    }
                }
            };
            var h = {
                checkIsFollow: function() {
                    u["checkFollowTrans"].request(u["checkFollowData"], {
                        success: function(e) {
                            if (e.errno === 0 && e.data && (e.data[u["checkFollowData"]["code"]] || e.data.user_info.is_follow)) {
                                var t = l.one("follow_icon");
                                var n = l.one("follow_text");
                                t.removeClass(u["unfollowClass"]);
                                t.addClass(u["followClass"]);
                                n.html(u["followText"])
                            }
                        },
                        error: function() {}
                    })
                }
            };
            var p = {
                init: function() {
                    p.initParam();
                    p.initEvent();
                    $ljBridge.ready(function(e, t) {
                        a = e;
                        f = t.isLianjiaApp || t.isLinkApp;
                        h.checkIsFollow()
                    })
                },
                initParam: function() {
                    $.extend(u, e);
                    if (!u["actBtn"]) {
                        throw "must have a node"
                    }
                    l = $(u["actBtn"]).getMark();
                    n = s.init()
                },
                initEvent: function() {
                    $(u["actBtn"]).on("tap", c.follow)
                }
            };
            p.init();
            return {
                destroy: function() {
                    n.destroy();
                    $(u["actBtn"]).off("tap", c.follow)
                }
            }
        }
    },
    I: function(e, t, n, r) {
        var i = true;
        var s = i ? "http://devm.lianjia.com:9002": "http://m.api.lianjia.com";
        t.citys = $.trans("/mapi/dict/city/Info", {},
        function(e) {
            return e
        });
        t.xuequfang_citys = $.trans("/mapi/xuequfang/xuequ/index", {},
        function(e) {
            return e
        });
        t.follow = $.trans("/mapi/user/house/follow", {},
        function(e) {
            return e
        });
        t.unfollow = $.trans("/mapi/user/house/unFollow", {},
        function(e) {
            return e
        });
        t.newHouseFollow = $.trans("/mapi/newhouse/followproject", {},
        function(e) {
            return e
        });
        t.newHouseUnfollow = $.trans("/mapi/newhouse/unfollowproject", {},
        function(e) {
            return e
        });
        t.isFavoriteNewHouse = $.trans("/mapi/newhouse/apiresblockinfo", {},
        function(e) {
            return e
        });
        t.communityfollow = $.trans("/mapi/user/community/follow", {},
        function(e) {
            return e
        });
        t.communityunfollow = $.trans("/mapi/user/community/unFollow", {},
        function(e) {
            return e
        });
        t.isFavorite = $.trans("/api/isfavorite", {},
        function(e) {
            return e
        });
        t.xinfang_youhui = $.trans("/mapi/newhouse/recordphone", {},
        function(e) {
            return e
        });
        t.lvju_youhui = $.trans("/api/lvju/recordphone/", {},
        function(e) {
            return e
        });
        t.load_more = function() {
            return $.trans(location.href, {},
            function(e) {
                return e
            })
        };
        t.baike_more = function(e, t) {
            return $.trans("/" + e + "/baike/" + t, {},
            function(e) {
                return e
            })
        };
        t.search_sug = $.trans("/mapi/house/suggestion/index", {},
        function(e) {
            return e
        });
        t.searchfangjia_sug = $.trans("/mapi/house/suggestion/indexdata", {},
        function(e) {
            return e
        });
        t.searchxinfang_sug = $.trans("/api/sug/xinfang", {},
        function(e) {
            return e
        });
        t.searchzhongxue_sug = $.trans("/api/sug/zhongxue", {},
        function(e) {
            return e
        });
        t.searchxiaoxue_sug = $.trans("/api/sug/xiaoxue", {},
        function(e) {
            return e
        });
        t.school2resblock = $.trans("/api/sug/school2resblocks", {},
        function(e) {
            return e
        });
        t.resblock2school = $.trans("/api/sug/resblock2schools", {},
        function(e) {
            return e
        });
        t.wenda_sug = function(e) {
            return $.trans("/bj/wenda/sug/" + e + "/", {},
            function(e) {
                return e
            })
        };
        t.questionDetail = $.trans("/mapi/channel/wenda/questionDetail", {},
        function(e) {
            return e
        });
        t.setFavorite = $.trans("/mapi/channel/wenda/setFavorite", {},
        function(e) {
            return e
        });
        t.wendaZuiwen = $.trans("/mapi/channel/wenda/uploadExtraQuestion", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.wendaZuida = $.trans("/mapi/channel/wenda/uploadExtraAnswer", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.wendaHuifu = $.trans("/mapi/channel/wenda/uploadAnswer", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.wendaLike = $.trans("/mapi/channel/wenda/like", {},
        function(e) {
            return e
        });
        t.wendaFollow = $.trans("/mapi/user/wenda/follow", {},
        function(e) {
            return e
        });
        t.wendaUnfollow = $.trans("/mapi/user/wenda/unFollow", {},
        function(e) {
            return e
        });
        t.getUserInfo = $.trans("/mapi/user/account/getClientInfoByAccessToken", {},
        function(e) {
            return e
        });
        t.getUserInfo = $.trans("/mapi/user/account/getClientInfoByAccessToken", {},
        function(e) {
            return e
        });
        t.getMonthData = function(e, t) {
            return $.trans("/" + e + "/report/resblock/trend/" + t, {},
            function(e) {
                return e
            })
        };
        t.users = function(e, t) {
            return $.trans(e, {
                type: t
            },
            function(e) {
                return e
            })
        };
        t.userLogout = $.trans("/mapi/user/account/logout", {},
        function(e) {
            return e
        });
        t.yezhu_avgprice = $.trans("/mapi/house/community/getAvgPrice", {},
        function(e) {
            return e
        });
        t.yezhu_getcities = $.trans("/mapi/house/house/getcities4msite", {},
        function(e) {
            return e
        });
        t.yezhu_getNearbyCommunities = $.trans("/mapi/house/house/getNearbyCommunities", {},
        function(e) {
            return e
        });
        t.yezhu_community = $.trans("/mapi/house/suggestion/community", {},
        function(e) {
            return e
        });
        t.yezhu_getcities_v2 = $.trans("//api.map.baidu.com/geocoder/v2/", {
            dataType: "jsonp"
        },
        function(e) {
            return e
        });
        t.yezhu_getcities_v1 = $.trans("//api.map.baidu.com/geoconv/v1/", {
            dataType: "jsonp"
        },
        function(e) {
            return e
        });
        t.yezhu_getbuildings = $.trans("/mapi/house/house/getbuildings", {},
        function(e) {
            return e
        });
        t.yezhu_getUnits = $.trans("/mapi/house/house/getUnits", {},
        function(e) {
            return e
        });
        t.yezhu_getHouses = $.trans("/mapi/house/house/getHouses", {},
        function(e) {
            return e
        });
        t.yezhu_verifycode = $.trans("/mapi/owner/delegate/sendverifycodefordelegate", {},
        function(e) {
            return e
        });
        t.yezhu_VoiceVerifyCode = $.trans("/mapi/owner/delegate/sendVoiceVerifyCodefordelegate", {},
        function(e) {
            return e
        });
        t.yezhu_submit = $.trans("/mapi/owner/delegate/submit", {},
        function(e) {
            return e
        });
        t.my_followHouse = $.trans("/mapi/user/house/followedListV3", {},
        function(e) {
            return e
        });
        t.my_followNewHouse = $.trans("/mapi/newhouse/followProjectlist", {},
        function(e) {
            return e
        });
        t.my_followResblock = $.trans("/mapi/user/community/followedList", {},
        function(e) {
            return e
        });
        t.my_seeRecord = $.trans("/mapi/user/house/seeRecordV2", {},
        function(e) {
            return e
        });
        t.getFangjia = function(e, t) {
            return $.trans("/" + e + "/fangjia/trend/" + t, {},
            function(e) {
                return e
            })
        };
        t.getSupplyData = function(e, t) {
            return $.trans("/" + e + "/fangjia/supply?duration=" + t, {},
            function(e) {
                return e
            })
        };
        t.redianLike = $.trans("/api/redian/like", {},
        function(e) {
            return e
        });
        t.getTiwenTags = $.trans("/mapi/channel/wenda/tags", {},
        function(e) {
            return e
        });
        t.ask = $.trans("/mapi/channel/wenda/ask", {},
        function(e) {
            return e
        });
        t.weeklyReportZan = $.trans("/api/YezhuWeeklyReport/like", {},
        function(e) {
            return e
        });
        t.baike_sug = function(e, t) {
            return $.trans("/" + e + "/baike/suggest/?query=" + t, {},
            function(e) {
                return e
            })
        };
        t.baike_index = function(e, t) {
            return $.trans("/" + e + "/baike/" + t, {},
            function(e) {
                return e
            })
        };
        t.overSeaEsfSendMessage = $.trans("/api/oversea/message/", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.overSeaLectureJoin = $.trans("/api/oversea/join/", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.overseaNationSearch = $.trans("/api/sug/OverseaErshoufang/", {},
        function(e) {
            return e
        });
        t.lvjuCity = $.trans("/you/", {},
        function(e) {
            return e
        });
        t.xuequfangQiugou = $.trans("/mapi/xuequfang/qiugou/Submit", {},
        function(e) {
            return e
        });
        t.trade_checkAuth = $.trans("/mapi/te/auth/checkAuth", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.trade_sendVerifycode = $.trans("/mapi/te/auth/sendMobileVerifyCode", {},
        function(e) {
            return e
        });
        t.trade_userverify = $.trans("/mapi/te/auth/checkSecurity", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.trade_bind = $.trans("/mapi/te/auth/bindRelation", {},
        function(e) {
            return e
        });
        t.trade_unbind = $.trans("/mapi/te/auth/unbind", {},
        function(e) {
            return e
        });
        t.trade_list = $.trans("/mapi/te/start/list", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.trade_detail = $.trans("/mapi/te/info/detail", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.trade_feedback = $.trans("/mapi/te/info/feedBack", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.lvjuArticle = function(e) {
            return $.trans("/" + e + "/you/gaikuang/", {},
            function(e) {
                return e
            })
        };
        t.orderAndPay = $.trans("/mapi/marketing/market/orderAndPay", {},
        function(e) {
            return e
        });
        t.saveAddress = $.trans("/mapi/marketing/market/saveAddress", {},
        function(e) {
            return e
        });
        t.isowner = $.trans("/api/isowner", {},
        function(e) {
            return e
        });
        t.followJingjiren = $.trans("/mapi/user/agent/follow", {},
        function(e) {
            return e
        });
        t.unfollowJingjiren = $.trans("/mapi/user/agent/unfollow", {},
        function(e) {
            return e
        });
        t.isFollowJingjiren = $.trans("/mapi/user/agent/isfollowed", {},
        function(e) {
            return e
        });
        t.xiaoquSug = $.trans("/mapi/house/suggestion/index", {},
        function(e) {
            return e
        });
        t.xiaoquDianping = $.trans("/api/xiaoqucomment", {
            type: "POST"
        },
        function(e) {
            return e
        });
        t.xiaoquDianpingVerifyCode = $.trans("/api/SendMobileVerifyCode", {},
        function(e) {
            return e
        })
    }
});