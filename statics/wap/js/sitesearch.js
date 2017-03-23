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
        $LMB.register("m_pages_siteSearch",
        function(e, t) {
            var r = n("A");
            var i = r(e, t);
            var s = n("e");
            var o = n("E");
            var u = n("f");
            var a = n("F");
            var f = {};
            var l;
            var c;
            var h;
            var p;
            var d = {
                ershoufang: "二手房",
                zufang: "出租房",
                jingjiren: "经纪人",
                sold: "查成交",
                xinfang: "新房",
                school: "小学",
                fangjia: "房价",
                middleschool: "中学"
            };
            var v = {
                ershoufang: "请输入小区或商圈名称",
                zufang: "请输入小区或商圈名称",
                jingjiren: "请输入商圈、小区或经纪人的姓名、电话",
                sold: "请输入小区或商圈名称",
                xinfang: "请输入楼盘名和区域",
                school: "请输入小学名称",
                fangjia: "请输入区域、商圈或小区名",
                middleschool: "请输入中学名称"
            };
            var m = {
                ershoufang: "ershoufang/",
                zufang: "zufang/",
                jingjiren: "jingjiren/",
                sold: "chengjiao/",
                xinfang: "loupan/",
                school: "xuequfang/",
                fangjia: "fangjia/",
                middleschool: "xuequfang/scht1"
            };
            var g = {
                ershoufang: o.search_sug,
                zufang: o.search_sug,
                jingjiren: o.search_sug,
                sold: o.search_sug,
                xinfang: o.searchxinfang_sug,
                school: o.searchxiaoxue_sug,
                fangjia: o.searchfangjia_sug,
                middleschool: o.searchzhongxue_sug
            };
            var y;
            var b;
            var w = ["dg", "fs", "hui", "sy", "yt", "zs", "zh", "yz", "nt", "wf", "wx", "wz", "ts", "jx", "ty", "hk", "lin", "xz"];
            if ($.inArray(t["args"]["cur_city_short"], w) !== -1) {
                v.xinfang = "请输入楼盘名"
            }
            var E = {
                formatSug: function(e) {
                    var t = "";
                    for (var n = 0; n < e.length; n++) {
                        if (l["channel_id"] == "xinfang") {
                            var r = "";
                            if (e[n].type == "project") {
                                r = '<div class="count">' + (e[n].pre_unit_price ? e[n].pre_unit_price + "元/m²": "") + "</div>"
                            } else if (e[n].type == "district") {
                                r = '<div class="count">' + (e[n].count ? e[n].count + "套": "") + "</div>"
                            }
                            t += '<li class="li_item" data-act="action_jump" data-info=' + "'" + JSON.stringify(e[n]) + "'" + '><div class="box_col text_cut">' + e[n]["name"] + "</div>" + r + "</li>"
                        } else if (l["channel_id"] == "fangjia") {
                            var i = e[n]["resblock_alias"] ? e[n]["resblock_alias"] : "";
                            t += '<li class="li_item" data-act="action_jump" data-info=' + "'" + JSON.stringify(e[n]) + "'" + '><div class="box_col text_cut">' + e[n]["text"] + '</div><div class="count">' + i + "</div></li>"
                        } else {
                            if (e[n]["resblock_alias"] != null) {
                                t += '<li class="li_item" data-act="action_jump" data-info=' + "'" + JSON.stringify(e[n]) + "'" + '><div class="box_col text_cut">' + e[n]["text"] + '<span style="color:#a8a8a8;">' + (e[n]["resblock_alias"] ? " (" + e[n]["resblock_alias"] + ") ": " ") + (e[n]["region"] || "") + "</span>" + '</div><div class="count">' + e[n]["count"] + "套</div></li>"
                            } else {
                                t += '<li class="li_item" data-act="action_jump" data-info=' + "'" + JSON.stringify(e[n]) + "'" + '><div class="box_col text_cut">' + e[n]["text"] + " " + '<span style="color:#a8a8a8;">' + (e[n]["region"] || "") + "</span>" + '</div><div class="count">' + e[n]["count"] + "套</div></li>"
                            }
                        }
                    }
                    h.one("history_list").html(t);
                    h.one("clearHistory_panel").hide()
                },
                formatHistory: function() {
                    var e = u.get("searchHistory");
                    if (e) {
                        e = JSON.parse(e);
                        if (e[l["city_id"]]) {
                            var t = "";
                            for (var n = e[l["city_id"]].length - 1; n >= 0; n--) {
                                if (e[l["city_id"]][n]["channel"] == l["channel_id"] && !/\/fangjia\//.test(e[l["city_id"]][n]["m_url"]) || l["channel_id"] == "fangjia" && e[l["city_id"]][n]["channel"] == "sold" && /\/fangjia\//.test(e[l["city_id"]][n]["m_url"])) t += '<li class="li_item" data-act="action_jump" data-history="1" data-info=' + "'" + JSON.stringify(e[l["city_id"]][n]) + "'" + "><span>" + a(e[l["city_id"]][n]["text"]) + "</span></li>";
                                else if (e[l["city_id"]][n]["type"] == "project") t += '<li class="li_item" data-act="action_jump" data-history="1" data-info=' + "'" + JSON.stringify(e[l["city_id"]][n]) + "'" + "><span>" + a(e[l["city_id"]][n]["name"]) + "</span></li>"
                            }
                            h.one("history_list").html(t);
                            if (t) {
                                h.one("clearHistory_panel").show()
                            } else {
                                h.one("clearHistory_panel").hide()
                            }
                            return true
                        }
                    }
                    h.one("clearHistory_panel").hide();
                    return false
                }
            };
            var S = {
                keypress: function(e) {
                    if (e && e.keyCode == 13) {
                        S.action_search();
                        return false
                    }
                },
                blur: function() {
                    b && clearInterval(b)
                },
                focus: function() {
                    s({
                        ljweb_id: "10008",
                        ljweb_mod: "m_pages_siteSearch_list_search",
                        ljweb_bl: "search",
                        ljweb_value: h.one("search_input").val()
                    },
                    t);
                    b && clearInterval(b);
                    b = setInterval(function() {
                        var e = {
                            query: h.one("search_input").val()
                        };
                        if (y == e["query"]) return;
                        y = e["query"];
                        $.extend(e, l);
                        if (!f[e["channel_id"]] || !f[e["channel_id"]][e["query"]]) {
                            f[e["channel_id"]] = f[e["channel_id"]] || {};
                            p && clearTimeout(p);
                            p = setTimeout(function() {
                                g[e["channel_id"]].request(e, {
                                    success: function(t) {
                                        if (t.errno == 0) {
                                            var n;
                                            if (e["channel_id"] == "middleschool" || e["channel_id"] == "school") {
                                                n = [];
                                                for (var r = 0; r < t["data"]["list"].length; r++) {
                                                    var i = {};
                                                    i.channel = e["channel_id"];
                                                    i.count = t["data"]["list"][r].house_count;
                                                    i.m_url = t["data"]["list"][r].view_url;
                                                    i.text = t["data"]["list"][r].school_name;
                                                    n.push(i)
                                                }
                                            } else if (e["channel_id"] == "xinfang") {
                                                n = t.data.list
                                            } else {
                                                n = t["data"]["groups"][0]["items"]
                                            }
                                            f[e["channel_id"]][e["query"]] = n;
                                            E.formatSug(n)
                                        }
                                    },
                                    error: function(e) {}
                                })
                            },
                            500)
                        } else {
                            E.formatSug(f[e["channel_id"]][e["query"]])
                        }
                    },
                    100)
                },
                action_select: function(e) {
                    var t = v[e.data["channel_id"]];
                    $.extend(l, e.data);
                    h.one("search_type").html(e.el.innerHTML);
                    h.one("search_input").attr("placeholder", t);
                    h.one("dropdown_panel").toggle();
                    E.formatHistory()
                },
                action_search: function() {
                    var e = h.one("search_input").val();
                    if (!e) return;
                    var n = m[l["channel_id"]];
                    var r = "/" + t["args"]["cur_city_short"] + "/" + n + "rs" + e + "/";
                    var i = {
                        channel: l["channel_id"],
                        m_url: r,
                        text: e
                    };
                    var s = u.get("searchHistory");
                    if (s) {
                        s = JSON.parse(s);
                        if (s[l["city_id"]]) {
                            var o = [];
                            for (var a = 0; a < s[l["city_id"]].length; a++) {
                                if (i["m_url"] === undefined) {
                                    o.push(s[l["city_id"]][a])
                                } else if (i["m_url"] != s[l["city_id"]][a]["m_url"]) {
                                    o.push(s[l["city_id"]][a])
                                }
                            }
                            o.push(i);
                            s[l["city_id"]] = o
                        } else {
                            s[l["city_id"]] = [i]
                        }
                    } else {
                        s = {};
                        s[l["city_id"]] = [i]
                    }
                    u.save("searchHistory", s);
                    location.replace(r)
                },
                togglePanel: function() {
                    h.one("dropdown_panel").toggle()
                },
                hidePanel: function(e) {
                    if ($(e.target).isin(h.one("dropdown_panel")) || e.target == h.one("search_type")[0]) return;
                    h.one("dropdown_panel").hide()
                },
                action_jump: function(e) {
                    var n = e.el.getAttribute("data-info");
                    var r = JSON.parse(n);
                    var i = $("[data-act=action_jump]").indexOf(e.el);
                    s({
                        ljweb_id: $(e.el).data("history") ? "10004": "10003",
                        ljweb_mod: "m_pages_siteSearch_list_search",
                        ljweb_bl: "search",
                        ljweb_el: r["text"] || r["name"],
                        ljweb_value: h.one("search_input").val(),
                        ljweb_url: r.m_url ? r.m_url: r.url,
                        ljweb_index: i + 1
                    },
                    t);
                    var o = u.get("searchHistory");
                    if (o) {
                        o = JSON.parse(o);
                        if (o[l["city_id"]]) {
                            var a = [];
                            for (var f = 0; f < o[l["city_id"]].length; f++) {
                                if (r["m_url"] === undefined && r["url"] === undefined) {
                                    a.push(o[l["city_id"]][f])
                                } else if (r["m_url"]) {
                                    if (r["m_url"] != o[l["city_id"]][f]["m_url"]) {
                                        a.push(o[l["city_id"]][f])
                                    }
                                } else if (r["url"]) {
                                    if (r["url"] != o[l["city_id"]][f]["url"]) {
                                        a.push(o[l["city_id"]][f])
                                    }
                                }
                            }
                            a.push(r);
                            o[l["city_id"]] = a
                        } else {
                            o[l["city_id"]] = [r]
                        }
                    } else {
                        o = {};
                        o[l["city_id"]] = [r]
                    }
                    u.save("searchHistory", o);
                    if (l["channel_id"] == "xinfang") {
                        location.replace(r.url)
                    } else {
                        location.replace(r.m_url)
                    }
                },
                action_clearHistory: function() {
                    var e = u.get("searchHistory");
                    if (e) {
                        e = JSON.parse(e);
                        var t = [];
                        if (e[l["city_id"]]) {
                            for (var n = 0; n < e[l["city_id"]].length; n++) {
                                if (e[l["city_id"]][n]["channel"] != l["channel_id"]) {
                                    t.push(e[l["city_id"]][n])
                                }
                            }
                            e[l["city_id"]] = t
                        }
                    }
                    u.save("searchHistory", e);
                    h.one("history_list").html("");
                    h.one("clearHistory_panel").hide()
                }
            };
            var x = {
                init: function() {
                    x.initParam();
                    x.bind();
                    h.one("search_input")[0].focus();
                    h.one("search_input")[0].select()
                },
                initParam: function() {
                    h = $("#" + e).getMark();
                    var n = document.cookie.match(/lianjia_uuid=([^;]+)/);
                    n = n && n[1] || "";
                    l = {
                        city_id: t["args"]["cur_city_id"],
                        channel_id: t["args"]["cur_channel_id"] || "ershoufang",
                        device_id: n
                    };
                    h.one("search_input").attr("placeholder", v[l["channel_id"]]);
                    h.one("search_input").val(t["args"]["rs"]);
                    y = t["args"]["rs"];
                    if (h.one("search_type")) {
                        h.one("search_type").html(d[l["channel_id"]])
                    }
                    E.formatHistory()
                },
                bind: function() {
                    c = $("#" + e).de();
                    c.add("action_select", "click", S.action_select);
                    c.add("action_jump", "tap", S.action_jump);
                    c.add("action_clearHistory", "tap", S.action_clearHistory);
                    h.one("search_input").on("focus", S.focus);
                    h.one("search_input").on("blur", S.blur);
                    h.one("search_input").on("keypress", S.keypress);
                    h.one("search_type").on("tap", S.togglePanel);
                    $(document.body).on("tap", S.hidePanel);
                    c.add("action_search", "tap", S.action_search)
                },
                destroy: function() {}
            };
            x.init();
            var T = {};
            T.destroy = function() {};
            return T
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
            if (r[0] == n["cur_city_short"]) {
                s = n["cur_city_id"]
            } else if (r[0] == n["nation"]["short"]) {
                s = n["nation"]["nation_id"]
            }
            var o;
            if (n["js_ns"] == "m_pages_siteSearch") {
                switch (n["cur_channel_id"]) {
                case "ershoufang":
                    o = "ershoufang";
                    break;
                case "zufang":
                    o = "zufang";
                    break;
                case "xinfang":
                    o = "xinfang";
                    break;
                case "sold":
                    o = "chengjiao";
                    break;
                case "jingjiren":
                    o = "jingjiren";
                    break;
                case "school":
                case "middleschool":
                    o = "xuequfang";
                    break;
                case "fangjia":
                    o = "fangjia";
                    break;
                default:
                    o = n["cur_channel_id"]
                }
            }
            var u; (function() {
                if (!window.$ULOG) {
                    u = setTimeout(arguments.callee, 1e3);
                    return
                }
                u && clearTimeout(u);
                i.ljweb_cid = s;
                i.ljweb_channel_key = n["js_ns"];
                o && (i.ljweb_channel = o);
                if (i.rebuild) {
                    i.rebuild(i);
                    delete i["rebuild"]
                }
                $ULOG.send("10043", {
                    pid: "lianjiamweb",
                    key: window.location.href,
                    action: i
                })
            })()
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
        var i = window.localStorage,
        s = window.sessionStorage;
        t.save = function(e, t, n) {
            if (typeof t == "object") {
                t = JSON.stringify(t)
            }
            try {
                if (n) {
                    s.setItem(e, t)
                } else {
                    i.setItem(e, t)
                }
            } catch(r) {
                try {
                    if (n) {
                        s.remove(e);
                        s.setItem(e, t)
                    } else {
                        i.remove(e);
                        i.setItem(e, t)
                    }
                } catch(r) {
                    return false
                }
            }
            return true
        };
        t.get = function(e, t, n) {
            var r = null;
            try {
                if (t) {
                    r = s.getItem(e);
                    n && s.removeItem(e)
                } else {
                    r = i.getItem(e);
                    n && i.removeItem(e)
                }
            } catch(o) {}
            return r
        };
        t.remove = function(e, t) {
            try {
                if (t) {
                    s.removeItem(e)
                } else {
                    i.removeItem(e)
                }
                return true
            } catch(n) {
                return false
            }
        }
    },
    F: function(e, t, n, r) {
        e.exports = function(t) {
            return (t + "").replace(/\&/g, "&amp;").replace(/"/g, "&quot;").replace(/\</g, "&lt;").replace(/\>/g, "&gt;").replace(/\'/g, "&#39;").replace(/\u00A0/g, "&nbsp;").replace(/(\u0020|\u000B|\u2028|\u2029|\f)/g, "&#32;")
        }
    }
});