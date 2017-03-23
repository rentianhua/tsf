var global_jjd = "";
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
        $LMB.register("m_pages_mapPos",
        function(e, t) {
            var r = n("A");
            var i = r(e, t);
            var s = n("e");
            var o = n("E");
            var u;
            var a;
            var f;
            var l = {
                init: function() {
                    l.initPlugin();
                    l.shareHide()
                },
                initPlugin: function() {
                    f = $("#" + e).getMark();
                    a = s.init({
                        el: f.one("types_container"),
                        point: global_jjd.split(",")
                    });
                    u = o.init()
                },
                shareHide: function() {
                    $ljBridge.ready(function(e) {
                        e.setRightButton("[]")
                    })
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
        var i = false;
        var s = "C106a48023d9606dcdad761cbc070095";
        var o = 3e3;
        t.init = function(e) {
            var t = {};
            var n = {
                el: "",
                point: []
            };
            var r;
            var u = {
                loadMapScript: function(e) {
                    if (i || window.BMap && BMap.Map) {
                        i = true;
                        e();
                        return
                    }
                    i = true;
                    var t = document.createElement("script");
                    t.src = "//api.map.baidu.com/api?v=1.5&ak=" + s + "&callback=mapInitialize";
                    document.body.appendChild(t);
                    window.mapInitialize = function() {
                        e()
                    }
                },
                initMapLayer: function() {
                    function e(e, t, n) {
                        this._point = e;
                        this.type = t;
                        this.text = n
                    }
                    e.prototype = new BMap.Overlay;
                    var n;
                    e.prototype.initialize = function(e) {
                        var r = this;
                        r._map = e;
                        var i = r._div = document.createElement("div");
                        i.className = "hover-point";
                        i.innerHTML = '<div class="hover-box"><span class="hover-icon ' + r.type + '"></span><i class="i-left"></i><div class="text">' + r.text + "</div></div>";
                        var s = BMap.Overlay.getZIndex(this._point.lat);
                        i.style.zIndex = s;
                        if (!n) {
                            n = s
                        } else {
                            n = Math.max(n, s)
                        }
                        t.map.getPanes().labelPane.appendChild(i);
                        var o = $(i);
                        o.on("touchend click",
                        function(e) {
                            i.style.zIndex = n;
                            n++;
                            o.parent().find(".hover-point").removeClass("on");
                            o.addClass("on")
                        });
                        return i
                    };
                    e.prototype.draw = function() {
                        var e = this._map;
                        var t = e.pointToOverlayPixel(this._point);
                        this._div.style.left = t.x - 11 + "px";
                        this._div.style.top = t.y - 35 + "px"
                    };
                    t.MapLayer = e
                },
                clickSearch: function(e) {
                    var n = $.queryToJson(e.attr("data-query"));
                    t.curType = n.className;
                    t.search.searchNearby(n.type, t.point, o);
                    e.parent().children().removeClass("on");
                    e.addClass("on");
                    return false
                },
                renderLayer: function(e) {
                    t.map.clearOverlays();
                    var n = new BMap.Marker(t.point);
                    t.map.addOverlay(n);
                    t.map.centerAndZoom(t.point, 15);
                    e.forEach(function(e, n) {
                        t.map.addOverlay(new t.MapLayer(e.point, t.curType, e.title))
                    })
                }
            };
            var a = {
                actSearch: function(e) {
                    var t = $(e.el);
                    u.clickSearch(t);
                    return false
                }
            };
            var f = {
                init: function() {
                    f.initParam();
                    f.initMap();
                    f.bind()
                },
                initParam: function() {
                    $.extend(n, e);
                    t.$el = $(n.el)
                },
                initMap: function() {
                    u.loadMapScript(function() {
                        t.map = new BMap.Map("map-content");
                        var e = new BMap.Point(n.point[0], n.point[1]);
                        t.point = e;
                        t.map.centerAndZoom(e, 15);
                        var r = new BMap.Marker(e);
                        t.map.addOverlay(r);
                        t.search = new BMap.LocalSearch(t.map);
                        t.search.setSearchCompleteCallback(function(e) {
                            var n = [];
                            if (t.search.getStatus() == BMAP_STATUS_SUCCESS) {
                                for (var r = 0; r < e.getCurrentNumPois(); r++) {
                                    n.push(e.getPoi(r))
                                }
                            } else {
                                console.error("searchfail")
                            }
                            u.renderLayer(n)
                        });
                        u.initMapLayer(t);
                        var i = t.$el.find("[data-act=actSearch]").eq(0);
                        u.clickSearch(i)
                    }); ! n.ableMove && document.addEventListener("touchmove",
                    function(e) {
                        e.preventDefault()
                    },
                    false)
                },
                bind: function() {
                    r = t.$el.de();
                    r.add("actSearch", "tap", a.actSearch)
                }
            };
            f.init();
            var l = {};
            l.clickSearch = u.clickSearch;
            return l
        }
    },
    E: function(e, t, n, r) {
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
    }
});