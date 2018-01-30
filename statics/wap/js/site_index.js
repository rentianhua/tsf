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
        $LMB.register("m_pages_siteCityIndex",
        function(e, t) {
            var r = n("A");
            var i = n("e");
            var s = n("F")(e, t);
            var o = r(e, t);
            var u = 0;
            var a;
            var f = $("#" + e).getMark();
            var l = {
                init: function() {
                    l.initPlugin();
                    l.autoAd()
                },
                initPlugin: function() {
                    imagePlugin = i.init({
                        swipeSlide: function(e, t) {
                            $(".dotlists .dot").each(function(t, n) {
                                if (t == e) {
                                    $(n).addClass("active")
                                } else {
                                    $(n).removeClass("active")
                                }
                            })
                        }
                    });
                    a = f.one("ad_container").children().length - 1
                },
                autoAd: function() {
                    setTimeout(function() {
                        u++;
                        if (u > a) {
                            u = 0
                        }
                        imagePlugin.swipe(f.one("ad_container")[0], u);
                        setTimeout(l.autoAd, 2e3)
                    },
                    2e3)
                }
            };
            l.init();
            var c = {};
            c.destroy = function() {};
            return c
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
                setTimeout(function() {
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
                },
                500)
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
                try {
                    var e = location.pathname.slice(1).split("/");
                    var t = "";
                    if (i && e[0] == i["cur_city_short"]) {
                        t = i["cur_city_id"]
                    } else if (i && e[0] == i["nation"]["short"]) {
                        t = i["nation"]["nation_id"]
                    }
                    $ULOG.send("10043", {
                        pid: "lianjiamweb",
                        key: window.location.href,
                        action: {
                            ljweb_group: "BIGDATA_M",
                            ljweb_mod: "download_click",
                            ljweb_ref: document.referrer,
                            ljweb_cid: t,
                            ljweb_channel_key: i["js_ns"]
                        }
                    })
                } catch(n) {}
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
        window.LJLOGS = {};
        var l = function() {
            var e = location.pathname.slice(1).split("/");
            var t = "";
            if (f && e[0] == f["cur_city_short"]) {
                t = f["cur_city_id"]
            } else if (f && e[0] == f["nation"]["short"]) {
                t = f["nation"]["nation_id"]
            }
            var n = {
                pid: "lianjiamweb",
                key: window.location.href,
                action: {
                    ljweb_group: "BIGDATA_M",
                    ljweb_mod: "pv",
                    ljweb_ref: document.referrer,
                    ljweb_cid: t,
                    ljweb_channel_key: f["js_ns"]
                }
            };
            if (f["js_ns"] == "m_pages_siteSearch") {
                switch (f["cur_channel_id"]) {
                case "ershoufang":
                    n["action"]["ljweb_channel"] = "ershoufang";
                    break;
                case "zufang":
                    n["action"]["ljweb_channel"] = "zufang";
                    break;
                case "xinfang":
                    n["action"]["ljweb_channel"] = "xinfang";
                    break;
                case "sold":
                    n["action"]["ljweb_channel"] = "chengjiao";
                    break;
                case "jingjiren":
                    n["action"]["ljweb_channel"] = "jingjiren";
                    break;
                case "school":
                case "middleschool":
                    n["action"]["ljweb_channel"] = "xuequfang";
                    break;
                case "fangjia":
                    n["action"]["ljweb_channel"] = "fangjia";
                    break;
                default:
                    n["action"]["ljweb_channel"] = f["cur_channel_id"]
                }
            }
            $ULOG.send("10043", n)
        };
        var c = function() {
            var e = location.href;
            if (e != u) {
                try {
                    if (/newsarticle/img.test(navigator.userAgent)) {
                        try {
                            try {
                                window.$ULOG.send("10011", {
                                    pid: "lianjiamweb",
                                    key: window.location.href
                                })
                            } catch(t) {}
                        } catch(n) {}
                    } else {
                        $ULOG.send("1,3");
                        l()
                    }
                    if (window.location.hostname == "m.lianjia.com") {
                        ga("send", "event", "Click", e, "1")
                    }
                    LJLOGS.ga();
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
                window.__UDL_CONFIG = {
                    pid: "lianjiamweb"
                };
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
                LJLOGS.ga = function() {
                    var e = location.pathname;
                    ga("send", "pageview", e);
                    ga("past.send", "pageview", e);
                    ga("new.send", "pageview", e);
                    ga("global.send", "pageview", e);
                    ga("new_global.send", "pageview", e);
                    if (/newsarticle/img.test(navigator.userAgent)) {
                        ga("newsarticle.send", "pageview", e)
                    }
                };
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
        var i = n("E");
        var s = null;
        var o = n("f");
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
    E: function(e, t, n, r) {
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
    f: function(e, t, n, r) {
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
    F: function(e, t, n, r) {
        function s() {
            var e = location.href.split("?")[1];
            if (e === undefined) return {};
            e = e.split("#")[0] || "";
            return $.queryToJson(e)
        }
        var i;
        e.exports = function(e, t) {
            function a() {
                var e = $("" + '<div class="download_fixed">' + '<a href="javascript:;" data-mark="download_close_btn" class="close">关闭</a>' + '<a href="http://www.taoshenfang.com/index.php?a=lists&catid=16" data-mark="download_tip_btn">' + '<div class="logo">掌上淘深房</div>' + '<div class="slog"><p class="title">淘深房APP</p><p class="sub-title">市场行情，一手掌握!</p></div>' + '<div class="btn">免费下载</div>' + "</a>" + "</div>");
                var t = e.getMark();
                t.one("download_close_btn").on("tap", f);
                t.one("download_tip_btn").on("tap", l);
                return e
            }
            function f() {
                i.remove();
                i = null;
                try {
                    localStorage.setItem("app_closeTime", Date.now())
                } catch(e) {}
                ga("send", "event", "Click", "closeapp_sy_/" + r, "1")
            }
            function l() {
                try {
                    var e = location.pathname.slice(1).split("/");
                    var t = "";
                    if (o && e[0] == o["cur_city_short"]) {
                        t = o["cur_city_id"]
                    } else if (o && e[0] == o["nation"]["short"]) {
                        t = o["nation"]["nation_id"]
                    }
                    $ULOG.send("10043", {
                        pid: "lianjiamweb",
                        key: window.location.href,
                        action: {
                            ljweb_group: "BIGDATA_M",
                            ljweb_mod: "download_click",
                            ljweb_ref: document.referrer,
                            ljweb_cid: t,
                            ljweb_channel_key: o["js_ns"]
                        }
                    })
                } catch(n) {}
                var i = navigator.userAgent.toLowerCase();
                if (i.indexOf("micromessenger") >= 0) {
                    //window.open("http://www.lianjia.com/client")
                } else {
                    if ($.os.android) {
                        //window.open("http://activitymo.homelink.com.cn/download/homelink/android/Android_homelinkmm.apk")
                    } else {
                        //window.open("https://itunes.apple.com/cn/app/id405882753?mt=8")
                    }
                }
                ga("send", "event", "Click", "downloadappfc_sy_/" + r, "1")
            }
            var n = t["args"];
            var r = n && n["cur_city_short"];
            var o = t && t["args"];
            var u;
            var c;
            try {
                c = localStorage.getItem("app_closeTime")
            } catch(h) {}
            if (c && Date.now() - c < 24 * 3600) return;
            var p = location.href.match(/[\?&](from=([a-zA-Z0-9_]*))/);
            if (p) {
                document.cookie = "lj_" + p[1]
            }
            if (/newsarticle/img.test(navigator.userAgent)) {
                document.cookie = "lj_from=show"
            }
            var d = (document.cookie.match(/(?:^| )lj_from(?:(?:=([^;]*))|;|$)/) || [])[1] || "";
            if (s()["utm_source"] != "zhidahao" && d != "show") {
                $ljBridge.ready(function(t, n) {
                    u = n.isLianjiaApp || n.isLinkApp;
                    if (u) return;
                    if (!i) i = a();
                    $("#" + e).append(i)
                })
            }
            return {
                destroy: function() {
                    if (i) {
                        i.remove();
                        i = null
                    }
                }
            }
        }
    }
});