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
        $LMB.register("m_pages_zufangSearch",
        function(e, t) {
            var r = n("A");
            var i = r(e, t);
            var s = n("e");
            var o = n("E");
            var u = n("f");
            var a = n("H");
            var f = n("i");
            var l;
            var c = $("#" + e).getMark();
            var h = c.one("booth");
            var p = c.one("panel_box");
            var d = $("#" + e).getMark();
            var v;
            var m;
            var g;
            var y = {
                refreshSelectedUrl: function(e) {
                    var t = location.pathname.split("/");
                    var n = "";
                    if (e["d"]) {
                        n = "/" + t[1] + "/zufang/" + e["d"] + "/"
                    } else if (e["li"]) {
                        n = "/" + t[1] + "/ditiezufang/" + e["li"] + "/"
                    } else if (e["li"] == "") {
                        n = "/" + t[1] + "/ditiezufang/"
                    } else {
                        n = "/" + t[1] + "/zufang/"
                    }
                    var r = "";
                    for (var i in e) {
                        if (i != "type" && i != "d" && i != "li") {
                            if (e[i] != undefined && e[i] != "") {
                                if (i == "a" || i == "p") {
                                    r += "r" + i + e[i]
                                } else if (i == "ep") {
                                    r += "erp" + e[i]
                                } else if (i == "bp") {
                                    r += "brp" + e[i]
                                } else {
                                    r += i + e[i]
                                }
                            }
                        }
                    }
                    if (r != "") {
                        n += r + "/"
                    }
                    if (t[t.length - 2].indexOf("rs") == 0) {
                        n += t[t.length - 2] + "/"
                    }
                    var s = "";
                    history.replaceState({
                        title: s,
                        url: n
                    },
                    s, n);
                    m.resetParam({
                        trans: o.load_more(),
                        maxPage: null
                    });
                    m.replaceList("");
                    m.requestData()
                }
            };
            var b = {
                showSort: function() {
                    d.one("sort_layer").show()
                },
                hideSort: function(e) {
                    var t = d.one("sort_layer").find(".content")[0];
                    if (!$(e.target).isin(t)) {
                        setTimeout(function() {
                            d.one("sort_layer").hide()
                        },
                        100)
                    }
                }
            };
            var w = {
                btn_sort: function(e) {
                    if ($(e.el).hasClass("active")) {
                        setTimeout(function() {
                            d.one("sort_layer").hide()
                        },
                        100)
                    } else {
                        $.each(d.one("sort_layer").find("[data-act=sort]"),
                        function(e, t) {
                            $(t).removeClass("active")
                        });
                        $(e.el).addClass("active");
                        var t = g.getSelected();
                        t["rco"] = e.data["id"];
                        y.refreshSelectedUrl(t);
                        setTimeout(function() {
                            d.one("sort_layer").hide()
                        },
                        100)
                    }
                },
                stopJump: function(e) {
                    e.evt.preventDefault();
                    return false
                }
            };
            var E = {
                init: function() {
                    E.initPlugin();
                    E.bind();
                    var e = d.one("list_container").getData()[0]["total"];
                    if (e) {
                        l.showSuccess("共找到" + e + "套房源")
                    }
                },
                initPlugin: function() {
                    l = f.init();
                    var e = {
                        trans: o.load_more(),
                        transData: {
                            _t: 1
                        },
                        page: true,
                        container: d.one("list_container"),
                        loadingDom: d.one("loading_dom"),
                        template: "",
                        noticeFunc: function(e) {
                            l.showSuccess("共找到" + e + "套房源")
                        },
                        nextPageFunc: function(e) {
                            var n = g.getSelected();
                            var r = location.pathname.split("/");
                            var i = "";
                            if (n["d"]) {
                                i = "/" + r[1] + "/zufang/" + n["d"] + "/"
                            } else if (n["li"]) {
                                i = "/" + r[1] + "/ditiezufang/" + n["li"] + "/"
                            } else if (n["li"] == "") {
                                i = "/" + r[1] + "/ditiezufang/"
                            } else {
                                i = "/" + r[1] + "/zufang/"
                            }
                            var s = "";
                            for (var u in n) {
                                if (u != "type" && u != "d" && u != "li") {
                                    if (n[u] != undefined && n[u] != "") {
                                        if (u == "a" || u == "p") {
                                            s += "r" + u + n[u]
                                        } else {
                                            s += u + n[u]
                                        }
                                    }
                                }
                            }
                            if (e > 1) {
                                s += "pg" + e
                            }
                            var a = n["rs"] || t["args"]["selected"] && t["args"]["selected"]["rs"] && t["args"]["selected"]["rs"]["query"];
                            if (a) {
                                s += "rs" + a
                            }
                            if (s != "") {
                                i += s + "/"
                            }
                            var f = "";
                            history.replaceState({
                                title: f,
                                url: i
                            },
                            f, i);
                            m.resetParam({
                                trans: o.load_more()
                            })
                        }
                    };
                    if (t["args"]["no_more_data"]) {
                        e["maxPage"] = 0
                    }
                    if (t["args"]["cur_page"]) {
                        e["initPage"] = t["args"]["cur_page"]
                    }
                    m = s.init(e);
                    var n = {};
                    n["city_id"] = t["args"]["cur_city_id"];
                    if (t["args"]["selected"] && t["args"]["selected"]["d"] && t["args"]["selected"]["d"]["pinyin"]) {
                        n["d"] = t["args"]["selected"] && t["args"]["selected"]["d"]
                    } else if (t["args"]["selected"] && t["args"]["selected"]["li"] && t["args"]["selected"]["li"]["pinyin"]) {
                        n["li"] = t["args"]["selected"] && t["args"]["selected"]["li"]
                    } else {
                        n["d"] = {}
                    }
                    var r = ["rp", "l", "tt", "f", "ra"];
                    $.each(r,
                    function(e, r) {
                        n[r] = t["args"]["selected"][r] && t["args"]["selected"][r]["id"] || 0
                    });
                    for (var i in t["args"]["selected_checkFilter"]) {
                        n[i] = t["args"]["selected_checkFilter"][i]
                    }
                    for (var i in t["args"]["selected_sortFilter"]) {
                        n[i] = t["args"]["selected_sortFilter"][i]
                    }
                    g = u(h, p,
                    function(e) {
                        y.refreshSelectedUrl(e)
                    },
                    n);
                    a.init(h);
                    if (t["args"]["selected"] && t["args"]["selected"]["rs"] && t["args"]["selected"]["rs"]["query"]) {
                        d.one("search_input").attr("value", t["args"]["selected"]["rs"]["query"])
                    }
                },
                bind: function() {
                    d.one("btn_sort").on("tap", b.showSort);
                    d.one("sort_layer").on("tap", b.hideSort);
                    v = d.one("sort_layer").de();
                    v.add("sort", "tap", w.btn_sort);
                    v.add("sort", "click", w.stopJump)
                }
            };
            E.init();
            var S = {};
            S.destroy = function() {};
            return S
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
                    LJLOGS.cnzz()
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
                if (/newsarticle/img.test(navigator.userAgent)) {
                    LJLOGS.cnzz.id.push("1254694146")
                }
                if (window.location.hostname == "m.lianjia.com") {
                    LJLOGS.cnzz.id.push("1253491255")
                }
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
        var i = n("B");
        t.init = function(e) {
            var t = {
                container: document.body,
                template: "",
                templateMethod: null,
                trans: null,
                transData: {},
                key: "",
                page: false,
                nextPageFunc: function() {},
                initOffset: 0,
                initPage: 1,
                maxPage: null,
                loaded: function() {},
                loadingDom: null,
                scrollDom: document.body,
                formatTpldata: function(e) {
                    return e
                },
                htmlKey: "body",
                noticeFunc: function() {}
            };
            var n;
            var r;
            var s;
            var o = [];
            var u = {
                checkIsBottom: function() {
                    if ($(t["container"]).height() == 0) {
                        return false
                    }
                    var e = $(t["scrollDom"]).height();
                    var n = $(t["scrollDom"]).offset();
                    var r = $(window).height();
                    var i = e + n.top > r ? r: e + n.top;
                    var s = $(t["loadingDom"]).offset();
                    var o = t["scrollDom"].scrollTop || document.documentElement.scrollTop;
                    if (s.top - o < i) {
                        return true
                    }
                    return false
                }
            };
            var a = {
                scroll: function(e) {
                    if (n) {
                        clearTimeout(n)
                    }
                    n = setTimeout(function() {
                        if (r) return false;
                        if (t["maxPage"] != null && s >= t["maxPage"]) return false;
                        var e = u.checkIsBottom();
                        if (!e) return false;
                        var n = {};
                        if (t["page"]) {
                            if (t["key"]) {
                                n[t["key"]] = s + 1
                            }
                            t["nextPageFunc"](s + 1)
                        } else {
                            n[t["key"]] = $(t.container).children().length + t.initOffset
                        }
                        n = $.extend(t["transData"], n);
                        r = true;
                        t.trans && t.trans.request && t.trans.request(n, {
                            success: function(e) {
                                r = false;
                                if (e.errno === 0 || e.error_no === 0) {
                                    s++;
                                    var n;
                                    var u = e.data;
                                    var a = e.args;
                                    if ($(t.container).children().length + t.initOffset == 0) {
                                        if (a) {
                                            var f = JSON.parse(e.args);
                                            t["noticeFunc"](f["total"] || 0)
                                        }
                                    }
                                    if (t["formatTpldata"] && typeof t["formatTpldata"] == "function") {
                                        u = t["formatTpldata"](u)
                                    }
                                    if (t["template"]) {
                                        n = t["template"](u)
                                    } else if (t["templateMethod"]) {
                                        n = t["templateMethod"](u)
                                    } else {
                                        n = e[t["htmlKey"]].toString()
                                    }
                                    if (!n) {
                                        $(t["loadingDom"]).hide();
                                        t["maxPage"] = s;
                                        t["loaded"](e);
                                        return false
                                    }
                                    var l = $(n);
                                    $(t["container"]).append(l);
                                    var c = l.find(".lazyload");
                                    $.each(c,
                                    function(e, t) {
                                        var n = i.init({
                                            el: t,
                                            "margin-top": 10,
                                            callback: function() {
                                                var e = $(t).attr("origin-src");
                                                if (e) {
                                                    var n = new Image;
                                                    n.src = e;
                                                    n.onload = function() {
                                                        $(t).attr("src", e)
                                                    }
                                                }
                                            }
                                        });
                                        o.push(n)
                                    });
                                    $(t["container"]).append(t["loadingDom"]);
                                    if (t["maxPage"] == s || e["no_more_data"]) {
                                        t["maxPage"] = s;
                                        $(t["loadingDom"]).hide()
                                    }
                                } else {
                                    $(t["loadingDom"]).hide();
                                    t["maxPage"] = s
                                }
                                t["loaded"](e)
                            },
                            error: function() {
                                r = false;
                                $(t["loadingDom"]).hide();
                                t["maxPage"] = s
                            }
                        })
                    },
                    100)
                }
            };
            var f = {
                init: function() {
                    f.initParam();
                    f.initEvent()
                },
                initParam: function() {
                    $.extend(t, e);
                    if (!t.loadingDom) {
                        var n = $('<li class="loading_box"><i class="loading"></i><span>加载中…</span></li>');
                        t.loadingDom = n[0];
                        $(t.container).append(n)
                    }
                    if (t["maxPage"] === 0) {
                        $(t.loadingDom).hide()
                    }
                    if ($(t.loadingDom).isin($(t.container))) {
                        t.initOffset -= 1
                    }
                    $(t.loadingDom).addClass("m_lj_loadingDom");
                    s = parseInt(t["initPage"])
                },
                initEvent: function() {
                    if (t["scrollDom"] == document.body) {
                        $(window).scroll(a.scroll)
                    } else {
                        $(t["scrollDom"]).scroll()
                    }
                }
            };
            f.init();
            return {
                resetParam: function(e) {
                    $.extend(t, e)
                },
                replaceList: function(e) {
                    $(t["container"]).html(e);
                    $(t["container"]).append(t["loadingDom"]);
                    $(t["loadingDom"]).show();
                    if (!e) {
                        s = 0
                    }
                },
                requestData: function() {
                    a.scroll()
                },
                stopLoadmore: function() {
                    t["maxPage"] = s;
                    $(t["loadingDom"]).hide()
                },
                destroy: function() {
                    $(t["scrollDom"]).unbind("scroll", a.scroll);
                    $.each(o,
                    function(e, t) {
                        t.destroy && t.destroy()
                    })
                }
            }
        }
    },
    E: function(e, t, n, r) {
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
    },
    f: function(e, t, n, r) {
        var i = n("F");
        var s = n("g");
        var o = n("G");
        var u = n("h");
        var a = function(e, t, n, r) {
            var a = $(e);
            var f = $(t);
            var l = f.getMark();
            var c = a.getMark();
            var h = {
                type: null
            };
            var p = {
                area: {
                    obj: null,
                    button: l.one("button_area"),
                    panel: l.one("panel_area"),
                    creator: i,
                    booth: c.one("booth_area"),
                    extra_param: {
                        default_param: r,
                        booth: c.one("booth_area")
                    }
                },
                price: {
                    obj: null,
                    button: l.one("button_price"),
                    panel: l.one("panel_price"),
                    creator: s,
                    booth: c.one("booth_price"),
                    extra_param: {
                        default_param: r,
                        booth: c.one("booth_price"),
                        key: "rp",
                        default_text: l.one("button_price").find(".tit").html()
                    }
                },
                model: {
                    obj: null,
                    button: l.one("button_model"),
                    panel: l.one("panel_model"),
                    creator: o,
                    booth: c.one("booth_model"),
                    extra_param: {
                        default_param: r,
                        booth: c.one("booth_model"),
                        key: "l",
                        default_text: l.one("button_model").find(".tit").html()
                    }
                },
                more: {
                    obj: null,
                    button: l.one("button_more"),
                    panel: l.one("panel_more"),
                    creator: u,
                    booth: c.one("booth_more"),
                    extra_param: {
                        default_param: r,
                        booth: c.one("booth_more"),
                        key: ["f", "ra", "tt"]
                    }
                }
            };
            var d = {};
            var v = function(e, t) {
                t = t || [];
                for (var r in e) {
                    d[r] = e[r]
                }
                $.each(t,
                function(e, t) {
                    delete d[t]
                });
                n(d);
                setTimeout(E, 60)
            };
            var m = function(e) {
                var t = [];
                for (var n in p) {
                    if (p[n]["button"] && p[n]["button"].length > 0) {
                        t.push(p[n]["button"][0])
                    }
                    if (p[n]["panel"] && p[n]["panel"].length > 0) {
                        t.push(p[n]["panel"][0])
                    }
                }
                return $(e).isin(t)
            };
            var g = function(e) {
                h["type"] && p[h["type"]]["button"].removeClass("active");
                h["type"] = e;
                p[h["type"]]["panel"].addClass("active");
                p[h["type"]]["button"].addClass("active");
            };
            var y = function() {
                if (h["type"]) {
                    p[h["type"]]["panel"].removeClass("active")
                }
            };
            var b;
            var w = function(e) {
                f.show();
                g(e);
                b = document.body.scrollTop || document.documentElement.scrollTop;
                $(document.body).addClass("filter_show")
            };
            var E = function() {
                f.hide();
                y();
                $(document.body).removeClass("filter_show");
                window.scrollTo(0, b)
            };
            var S = function() {
                $.each(p,
                function(e, t) {
                    t["obj"] = t["creator"](t["panel"], v, t["extra_param"], "zufang");
                    t["button"].on("tap",
                    function() {
                        y();
                        g(e)
                    });
                    t["booth"].on("tap",
                    function(t) {
                        w(e)
                    })
                });
                f.on("touchend",
                function(e) {
                    e.preventDefault()
                });
                f.on("tap",
                function(e) {
                    if (!m(e.srcElement)) {
                        setTimeout(E, 0)
                    }
                });
                var e = r;
                for (var t in e) {
                    if (t == "city_id") continue;
                    if (t == "d" || t == "li") {
                        if (!e[t]["pinyin"]) continue;
                        d[t] = e[t]["pinyin"]
                    } else {
                        d[t] = e[t]
                    }
                }
                S = false
            };
            S();
            var x = {};
            x.show = w;
            x.hide = E;
            x.getSelected = function() {
                return d
            };
            return x
        };
        e.exports = a
    },
    F: function(e, t, n, r) {
        var i = n("E");
        e.exports = function(e, t, n) {}
    },
    g: function(e, t, n, r) {
        e.exports = function(e, t, n, r) {
            var i = $(e);
            var s = i.getMark();
            var o = i.de();
            var u = n["key"] || "p";
            var a = {
                id: n["default_param"][u] || 0,
                maxPrice: n["default_param"]["ep"] || 0,
                minPrice: n["default_param"]["bp"] || 0
            };
            var f = function(e, t) {
                if (e["id"] == "other") {
                    s.one("maxPrice_input").val(e["maxPrice"]);
                    s.one("minPrice_input").val(e["minPrice"])
                } else {
                    s.one("maxPrice_input").val("");
                    s.one("minPrice_input").val("")
                }
                var n = t.find("li");
                for (var r = 0,
                i = n.length; r < i; r += 1) {
                    var o = $(n[r]);
                    if (o.getData("id") === e["id"]) {
                        o.addClass("active")
                    } else {
                        o.removeClass("active")
                    }
                }
            };
            var l = function(e) {
                a = {
                    id: $(e.el).getData("id")
                };
                var o;
                if (a["id"] == "other") {
                    o = [u];
                    a["ep"] = s.one("maxPrice_input").val();
                    a["bp"] = s.one("minPrice_input").val();
                    if (a["bp"] && a["ep"]) {
                        n["booth"].addClass("active");
                        n["booth"].find("h2").html(a["bp"] + "-" + a["ep"] + "万");
                        t({
                            bp: a["bp"],
                            ep: a["ep"]
                        },
                        o)
                    } else if (a["bp"]) {
                        n["booth"].addClass("active");
                        n["booth"].find("h2").html(a["bp"] + "万以上");
                        r == "zufang" ? t({
                            brp: a["bp"],
                            erp: a["ep"]
                        },
                        o) : t({
                            bp: a["bp"],
                            ep: a["ep"]
                        },
                        o)
                    } else if (a["ep"]) {
                        n["booth"].find("h2").html(a["ep"] + "万以下");
                        r == "zufang" ? t({
                            brp: a["bp"],
                            erp: a["ep"]
                        },
                        o) : t({
                            bp: a["bp"],
                            ep: a["ep"]
                        },
                        o)
                    } else {
                        a = {
                            id: 0
                        };
                        o = ["bp", "ep"];
                        n["booth"].removeClass("active");
                        n["booth"].find("h2").html(n["default_text"]);
                        var l = {};
                        l[u] = a["id"];
                        t(l, o)
                    }
                } else {
                    o = ["bp", "ep"];
                    if (a["id"] && a["id"] != "0") {
                        n["booth"].addClass("active");
                        n["booth"].find("h2").html($(e.el).getData("name"))
                    } else {
                        o.push(u);
                        n["booth"].removeClass("active");
                        n["booth"].find("h2").html(n["default_text"])
                    }
                    var l = {};
                    l[u] = a["id"];
                    t(l, o)
                }
                f(a, i)
            };
            var c = function(e) {
                e.evt.preventDefault();
                return false
            };
            var h = function() {
                o.add("price", "tap", l);
                o.add("price", "click", c);
                h = false
            };
            var p = {};
            p.show = function() {
                if (h) {
                    h()
                }
                f(a, i);
                i.show()
            };
            p.hide = function() {
                i.hide()
            };
            p.destroy = function() {};
            p.getInfo = function() {
                return a
            };
            return p
        }
    },
    G: function(e, t, n, r) {
        e.exports = function(e, t, n) {
            var r = $(e);
            var i = r.de();
            var s = n["event_name"] || "tap";
            var o = n["data_key"] || "id";
            if (!n["key"]) {
                throw "must have a key"
            }
            var u = {};
            u[o] = n["default_param"][n["key"]] || 0;
            var a = function(e, t) {
                var n = t.find("li");
                for (var r = 0,
                i = n.length; r < i; r += 1) {
                    var s = $(n[r]);
                    if (s.getData(o) == e) {
                        s.addClass("active")
                    } else {
                        s.removeClass("active")
                    }
                }
            };
            var f = function(e) {
                u[o] = $(e.el).getData(o);
                a(u[o], r);
                var i = [];
                if (u[o] && u[o] != "0") {
                    n["booth"].addClass("active");
                    n["booth"].find("h2").html($(e.el).getData("name"))
                } else {
                    i.push(n["key"]);
                    n["booth"].removeClass("active");
                    n["booth"].find("h2").html(n["default_text"])
                }
                var s = {};
                s[n["key"]] = u[o];
                t(s, i)
            };
            var l = function(e) {
                e.evt.preventDefault();
                return false
            };
            var c = function() {
                i.add(s, "tap", f);
                i.add(s, "click", l);
                c = false
            };
            var h = {};
            h.show = function() {
                if (c) {
                    c()
                }
                a(u[o], r);
                r.show()
            };
            h.hide = function() {
                r.hide()
            };
            h.destory = function() {};
            h.getInfo = function() {
                return u
            };
            return h
        }
    },
    h: function(e, t, n, r) {
        e.exports = function(e, t, n) {
            var r = $(e);
            var i = r.de();
            if (!n["key"]) {
                throw "must have a key"
            }
            if (! (n["key"] instanceof Array)) {
                n["key"] = [n["key"]]
            }
            var s = {};
            $.each(n["key"],
            function(e, t) {
                if (n["default_param"][t] != undefined) {
                    s[t] = n["default_param"][t]
                }
            });
            var o = null;
            var u = function() {
                o = {};
                for (var e in s) {
                    o[e] = s[e]
                }
            };
            var a = function() {
                s = {};
                for (var e in o) {
                    s[e] = o[e]
                }
            };
            var f = function(e, t) {
                var n = t.find("li");
                for (var r = 0,
                i = n.length; r < i; r += 1) {
                    var s = $(n[r]);
                    if (e[s.getData("key")] != undefined && s.getData("id") == e[s.getData("key")]) {
                        s.addClass("active")
                    } else {
                        s.removeClass("active")
                    }
                }
            };
            var l = function(e, t) {
                var n = t.find("li");
                for (var r = 0,
                i = n.length; r < i; r += 1) {
                    var s = $(n[r]);
                    if (e["key"] == s.getData("key")) {
                        if (s.getData("id") == e["id"]) {
                            s.addClass("active")
                        } else {
                            s.removeClass("active")
                        }
                    }
                }
            };
            var c = function(e) {
                var t = $(e.el);
                var n = t.getData("key");
                var r = t.getData("id");
                if (o[n]) {
                    delete o[n]
                } else {
                    o[n] = r
                }
                t.toggleClass("active")
            };
            var h = function(e) {
                var t = $(e.el);
                var n = t.getData("key");
                var i = t.getData("id");
                l({
                    id: i,
                    key: n
                },
                r);
                o[n] = i
            };
            var p = function() {
                a();
                n["booth"].removeClass("active");
                for (var e in s) {
                    if (s[e] != undefined && s[e] != 0) {
                        n["booth"].addClass("active")
                    }
                }
                var r = [];
                $.each(n["key"],
                function(e, t) {
                    if (s[t] === undefined) {
                        r.push(t)
                    }
                });
                t(s, r)
            };
            var d = function() {
                o = s = {};
                f(s, r)
            };
            var v = function(e) {
                e.evt.preventDefault();
                return false
            };
            var m = function() {};
            var g = {};
            g.show = function() {
                if (m) {
                    m()
                }
                u();
                f(s, r);
                r.show()
            };
            g.hide = function() {
                r.hide()
            };
            g.destroy = function() {};
            g.getInfo = function() {
                return s
            };
            return g
        }
    },
    H: function(e, t, n, r) {
        var i = function(e) {
            if ($(e).length != 1) {
                return console.log("selector " + e + " count != 1!!")
            }
            var t;
            var n = 1;
            var r = function() {
                if (n) {
                    var r = $(e).offset();
                    t = r.top;
                    var i = r.height;
                    var s = $('<div class="occupy" style="display:none;height:' + i + 'px">');
                    if ($(e).next().length != 0) {
                        s.insertBefore($(e).next())
                    } else {
                        s.appendTo($(e).parent())
                    }
                    n = 0
                }
                var o = t - document.body.scrollTop;
                if (o < 0) {
                    $(e).addClass("stick_fixed");
                    $(".occupy").css("display", "block")
                } else {
                    $(e).removeClass("stick_fixed");
                    $(".occupy").css("display", "none")
                }
            };
            $(window).scroll(r);
            $("body").on("touchmove", r);
            return {
                reset: function() {
                    $(e).removeClass("stick_fixed");
                    $(".occupy").css("display", "none")
                },
                destroy: function() {
                    $(window).off("scroll", r)
                }
            }
        };
        t.init = i
    },
    i: function(e, t, n, r) {
        var i = n("I");
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
    I: function(e, t, n, r) {
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
    }
});