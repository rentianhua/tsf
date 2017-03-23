function b() {
    h = $(window).height(),
    t = $(document).scrollTop();
    var e = $("#back-top").attr("daty-id");
    e ? t > h ? ($("#gotop").show(), $(".fix-right .tips,.fix-right .has-ask").show()) : ($("#gotop").hide(), $(".fix-right .tips,.fix-right .has-ask").hide()) : ($(".fix-right .tips,.fix-right .has-ask").show(), t > h ? $("#gotop").show() : $("#gotop").hide())
}
function ent() {
    var e;
    $(".ewm-close").click(function(t) {
        $(".sh-erweima").hide().addClass("hide"),
        $(this).hide();
        var n = $(".sh-erweima").attr("class");
        localStorage.setItem(e, JSON.stringify(n))
    });
    var t = localStorage.getItem(e);
    t ? t.indexOf("sh-erweima hide") >= 0 && $(".sh-erweima,.ewm-close").hide() : $(".sh-erweima,.ewm-close").show()
} !
function(e) {
    e.fn.scrollLoading = function(t) {
        var n = {
            attr: "data-url",
            container: e(window),
            callback: e.noop
        },
        a = e.extend({},
        n, t || {});
        a.cache = [],
        e(this).each(function() {
            var t = this.nodeName.toLowerCase(),
            n = e(this).attr(a.attr),
            o = {
                obj: e(this),
                tag: t,
                url: n
            };
            a.cache.push(o)
        });
        var o = function(t) {
            e.isFunction(a.callback) && a.callback.call(t.get(0))
        },
        r = function() {
            var t, n = a.container.height();
            t = e(window).get(0) === window ? e(window).scrollTop() : a.container.offset().top,
            e.each(a.cache,
            function(e, a) {
                var r = a.obj,
                i = a.tag,
                s = a.url;
                if (r) {
                    var c = r.offset().top - t,
                    l = c + r.height(); (c >= 0 && n > c || l > 0 && n >= l) && (s ? "img" === i ? o(r.attr("src", s)) : r.load(s, {},
                    function() {
                        o(r)
                    }) : o(r), a.obj = null)
                }
            })
        };
        r(),
        a.container.bind("scroll", r)
    }
} (jQuery),
function(e, t, n, a) {
    var o = e(t);
    e.fn.lazyload = function(r) {
        function i() {
            var t = 0;
            c.each(function() {
                var n = e(this);
                if (!l.skip_invisible || n.is(":visible")) if (e.abovethetop(this, l) || e.leftofbegin(this, l));
                else if (e.belowthefold(this, l) || e.rightoffold(this, l)) {
                    if (++t > l.failure_limit) return ! 1
                } else n.trigger("appear"),
                t = 0
            })
        }
        var s, c = this,
        l = {
            threshold: 0,
            failure_limit: 0,
            event: "scroll",
            effect: "show",
            container: t,
            data_attribute: "original",
            skip_invisible: !0,
            appear: null,
            load: null,
            placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
        };
        return r && (a !== r.failurelimit && (r.failure_limit = r.failurelimit, delete r.failurelimit), a !== r.effectspeed && (r.effect_speed = r.effectspeed, delete r.effectspeed), e.extend(l, r)),
        s = l.container === a || l.container === t ? o: e(l.container),
        0 === l.event.indexOf("scroll") && s.bind(l.event,
        function() {
            return i()
        }),
        this.each(function() {
            var t = this,
            n = e(t);
            t.loaded = !1,
            (n.attr("src") === a || n.attr("src") === !1) && n.is("img") && n.attr("src", l.placeholder),
            n.one("appear",
            function() {
                if (!this.loaded) {
                    if (l.appear) {
                        var a = c.length;
                        l.appear.call(t, a, l)
                    }
                    e("<img />").bind("load",
                    function() {
                        var a = n.attr("data-" + l.data_attribute);
                        n.hide(),
                        n.is("img") ? n.attr("src", a) : n.css("background-image", "url('" + a + "')"),
                        n[l.effect](l.effect_speed),
                        t.loaded = !0;
                        var o = e.grep(c,
                        function(e) {
                            return ! e.loaded
                        });
                        if (c = e(o), l.load) {
                            var r = c.length;
                            l.load.call(t, r, l)
                        }
                    }).attr("src", n.attr("data-" + l.data_attribute))
                }
            }),
            0 !== l.event.indexOf("scroll") && n.bind(l.event,
            function() {
                t.loaded || n.trigger("appear")
            })
        }),
        o.bind("resize",
        function() {
            i()
        }),
        /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && o.bind("pageshow",
        function(t) {
            t.originalEvent && t.originalEvent.persisted && c.each(function() {
                e(this).trigger("appear")
            })
        }),
        e(n).ready(function() {
            i()
        }),
        this
    },
    e.belowthefold = function(n, r) {
        var i;
        return i = r.container === a || r.container === t ? (t.innerHeight ? t.innerHeight: o.height()) + o.scrollTop() : e(r.container).offset().top + e(r.container).height(),
        i <= e(n).offset().top - r.threshold
    },
    e.rightoffold = function(n, r) {
        var i;
        return i = r.container === a || r.container === t ? o.width() + o.scrollLeft() : e(r.container).offset().left + e(r.container).width(),
        i <= e(n).offset().left - r.threshold
    },
    e.abovethetop = function(n, r) {
        var i;
        return i = r.container === a || r.container === t ? o.scrollTop() : e(r.container).offset().top,
        i >= e(n).offset().top + r.threshold + e(n).height()
    },
    e.leftofbegin = function(n, r) {
        var i;
        return i = r.container === a || r.container === t ? o.scrollLeft() : e(r.container).offset().left,
        i >= e(n).offset().left + r.threshold + e(n).width()
    },
    e.inviewport = function(t, n) {
        return ! (e.rightoffold(t, n) || e.leftofbegin(t, n) || e.belowthefold(t, n) || e.abovethetop(t, n))
    },
    e.extend(e.expr[":"], {
        "below-the-fold": function(t) {
            return e.belowthefold(t, {
                threshold: 0
            })
        },
        "above-the-top": function(t) {
            return ! e.belowthefold(t, {
                threshold: 0
            })
        },
        "right-of-screen": function(t) {
            return e.rightoffold(t, {
                threshold: 0
            })
        },
        "left-of-screen": function(t) {
            return ! e.rightoffold(t, {
                threshold: 0
            })
        },
        "in-viewport": function(t) {
            return e.inviewport(t, {
                threshold: 0
            })
        },
        "above-the-fold": function(t) {
            return ! e.belowthefold(t, {
                threshold: 0
            })
        },
        "right-of-fold": function(t) {
            return e.rightoffold(t, {
                threshold: 0
            })
        },
        "left-of-fold": function(t) {
            return ! e.rightoffold(t, {
                threshold: 0
            })
        }
    })
} (jQuery, window, document),
define("common/jquery.scrollLoading",
function() {}),
function(e) {
    e.fn.fixtop = function(t) {
        var n = e.extend({
            marginTop: 0,
            zIndex: 1e3,
            fixedWidth: "100%"
        },
        t),
        a = this.offset().top - n.marginTop,
        o = this,
        r = (o.height() + n.marginTop, e("<div/>").css({
            display: o.css("display"),
            width: o.outerWidth(!0),
            height: o.outerHeight(!0),
            "float": o.css("float")
        }));
        return e(window).scroll(function(t) {
            var i = a;
            e(this).scrollTop() > i && "fixed" != o.css("position") && (o.after(r), o.css({
                position: "fixed",
                top: n.marginTop + "px",
                "z-index": n.zIndex,
                width: n.fixedWidth
            }), void 0 !== n.fixed && n.fixed(o)),
            e(this).scrollTop() < i && "fixed" == o.css("position") && (r.remove(), o.css({
                position: "relative",
                top: "0px",
                "z-index": n.zIndex
            }), void 0 !== n.unfixed && n.unfixed(o))
        }),
        this
    }
} (jQuery),
define("common/fixtop",
function() {}),
$.stringFormat = function(e, t) {
    e = String(e);
    var n = Array.prototype.slice.call(arguments, 1),
    a = Object.prototype.toString;
    return n.length ? (n = 1 == n.length && null !== t && /\[object Array\]|\[object Object\]/.test(a.call(t)) ? t: n, e.replace(/#\{(.+?)\}/g,
    function(e, t) {
        var o = n[t];
        return "[object Function]" == a.call(o) && (o = o(t)),
        "undefined" == typeof o ? "": o
    })) : e
},
$.trimN = function(e) {
    return e.replace(/\n{2,}/gm, "\n")
},
$.fixedOldComment = function(e) {
    return e ? $.decodeHTML($.trimN(e.replace(/<[^>]+>/g, "\n"))) : e
},
$.replaceTpl = function(e, t, n) {
    var a = String(e),
    o = n || /#\{([^}]*)\}/gm,
    r = String.trim ||
    function(e) {
        return e.replace(/^\s+|\s+$/g, "")
    };
    return a.replace(o,
    function(e, n) {
        return e = t[r(n)]
    })
},
$.strHTML = function(e, t) {
    e = String(e);
    var n = Array.prototype.slice.call(arguments, 1),
    a = Object.prototype.toString;
    return n.length ? (n = 1 == n.length && null !== t && /\[object Array\]|\[object Object\]/.test(a.call(t)) ? t: n, e.replace(/#\{(.+?)\}/g,
    function(e, t) {
        var o = n[t];
        return "[object Function]" == a.call(o) && (o = o(t)),
        "undefined" == typeof o ? "": $.encodeHTML(o)
    })) : e
},
$.showIframeImg = function(e, t) {
    var n = "<style>body{margin:0;padding:0}img{width:#{0}px;height:#{1}px;}</style>",
    a = $(e),
    o = a.height(),
    r = a.width(),
    i = $.stringFormat(n, r, o),
    s = "frameimg" + Math.round(1e9 * Math.random());
    window.betafang[s] = "<head>" + i + '</head><body><img id="img-' + s + "\" src='" + t + "' /></body>",
    e.append('<iframe style="display:none" id="' + s + '" src="javascript:parent.betafang[\'' + s + '\'];" frameBorder="0" scrolling="no" width="' + r + '" height="' + o + '"></iframe>')
},
$.loadScript = function(e) {
    function t() {
        return o ? !1 : (o = !0, r.onload = null, r.onerror = null, a.complete && a.complete(), s.resolve(), void i.removeChild(r))
    }
    function n() {
        return o ? !1 : (o = !0, a.fail && a.fail(), i.removeChild(r), void s.reject())
    }
    var a = {
        url: "",
        charset: "utf-8",
        complete: $.noop,
        fail: $.noop
    };
    if ($.extend(a, e), !a.url) throw "url is requireed";
    var o = !1,
    r = document.createElement("script"),
    i = document.getElementsByTagName("head")[0],
    s = $.Deferred();
    return r.onload = t,
    r.onerror = n,
    r.onreadystatechange = function(e) {
        "complete" == r.readyState && t()
    },
    r.type = "text/javascript",
    r.src = a.url,
    r.charset = a.charset,
    i.appendChild(r),
    s
},
$.TextAreaUtil = function(e) {
    var t = document.selection,
    n = {
        getCursorPosition: function(e) {
            var n = 0;
            if (t) {
                e.focus();
                try {
                    var a = null;
                    a = t.createRange();
                    var o = a.duplicate();
                    o.moveToElementText(e),
                    o.setEndPoint("EndToEnd", a),
                    e.selectionStartIE = o.text.length - a.text.length,
                    e.selectionEndIE = e.selectionEndIE + a.text.length,
                    n = e.selectionStartIE
                } catch(r) {
                    n = e.value.length
                }
            } else(e.selectionStart || "0" == e.selectionStart) && (n = e.selectionStart);
            return n
        },
        getSelectedText: function(t) {
            var n = "",
            a = function(e) {
                return void 0 != e.selectionStart && void 0 != e.selectionEnd ? e.value.slice(e.selectionStart, e.selectionEnd) : ""
            };
            return n = e.getSelection ? a(t) : document.selection.createRange().text
        }
    };
    return n
} (window),
$.browser = $.browser || {},
$.browser.ie = /msie (\d+\.\d+)/i.test(navigator.userAgent) ? document.documentMode || +RegExp.$1: void 0;
var betafang = window.betafang || {};
$(function() { / msie(\d + \.\d + ) /i.test(navigator.userAgent) && $("body").addClass("ie", "ie" + (document.documentMode || +RegExp.$1)),
    $(".lj-lazy").lazyload(),
    $(".lazyload").scrollLoading();
    var e = $("#keyword-box,#keyword-box-01");
    e.closest("form").on("submit",
    function() {
        var e = $(this),
        t = e.attr("data-action") || e.attr("action"),
        n = e.find(".txt"),
        a = $.trim(n.val());
        return a == n.attr("placeholder") && (a = ""),
        t += encodeURIComponent(a),
        "_blank" != e.attr("target") ? (window.location.href = t, !1) : void e.attr("action", t)
    })
}),
define("common/base",
function() {});
var ajax = function() {
    var e = {},
    t = function() {};
    return e.get = function(e, n, a, o) {
        return a = a || t,
        o = o || t,
        e ? void $.getJSON(e, n,
        function(e) {
            0 === e.status ? a(e.data) : o(e)
        },
        function(e) {
            var t = {
                status: 500,
                statusInfo: "服务请求失败"
            };
            o(t)
        }) : !1
    },
    e.post = function(e, n, a, o) {
        return a = a || t,
        o = o || t,
        e ? void $.ajax({
            type: "POST",
            url: e,
            data: n,
            success: function(e) {
                0 === e.status ? a(e.data) : o(e)
            },
            failure: function(e) {
                var t = {
                    status: 500,
                    statusInfo: "服务请求失败"
                };
                o(t)
            },
            dataType: "json"
        }) : !1
    },
    e
} ();
define("common/ajax",
function() {}),
function() {
    function e(e, t) {
        var n = document.getElementsByTagName("head")[0],
        a = document.createElement("script");
        a.type = "text/javascript",
        a.src = e,
        t = t ||
        function() {},
        a.onload = a.onreadystatechange = function() {
            this.readyState && "loaded" !== this.readyState && "complete" !== this.readyState || (t(), a.onload = a.onreadystatechange = null, n && a.parentNode && n.removeChild(a))
        },
        n.insertBefore(a, n.firstChild)
    }
    function t(t, n, o) {
        var r = "cbk_" + Math.round(1e4 * Math.random()),
        i = a + "?from=" + n + "&to=4&x=" + t.lng + "&y=" + t.lat + "&callback=BMap.Convertor." + r;
        o = o ||
        function() {},
        e(i),
        BMap.Convertor[r] = function(e) {
            delete BMap.Convertor[r];
            var t = new BMap.Point(e.x, e.y);
            o(t)
        }
    }
    function n(t, n, o) {
        var r = a + "?from=" + n + "&to=4&mode=1",
        i = [],
        s = [],
        c = 20;
        o = o ||
        function() {};
        var l = function() {
            var t = "cbk_" + Math.round(1e4 * Math.random()),
            n = r + "&x=" + i.join(",") + "&y=" + s.join(",") + "&callback=BMap.Convertor." + t;
            e(n),
            i = [],
            s = [],
            BMap.Convertor[t] = function(e) {
                delete BMap.Convertor[t];
                var n = null,
                a = [];
                for (var r in e) if (n = e[r], 0 === n.error) {
                    var i = new BMap.Point(n.x, n.y);
                    a[r] = i
                } else a[r] = null;
                o(a)
            }
        };
        for (var u in t) u % c === 0 && 0 !== u && l(),
        i.push(t[u].lng),
        s.push(t[u].lat),
        u == t.length - 1 && l()
    }
    var a = "http://api.map.baidu.com/ag/coord/convert";
    window.BMap = window.BMap || {},
    BMap.Convertor = $({}),
    BMap.Convertor.translate = t,
    BMap.Convertor.translateMore = n
} ();
var LJFixed = function(e, t) {
    function n(t) {
        if (!o.isSupportPlaceHolder) {
            var n = e(t),
            a = n.attr("placeholder");
            "" === n.val() && n.val(a).addClass("placeholder"),
            n.focus(function() {
                n.val() === n.attr("placeholder") && n.val("").removeClass("placeholder")
            }).blur(function() {
                "" === n.val() && n.val(n.attr("placeholder")).addClass("placeholder")
            }).closest("form").submit(function() {
                n.val() === n.attr("placeholder") && n.val("")
            })
        }
    }
    function a() {
        e("input[placeholder],textarea[placeholder]").each(function() {
            var t = e(this);
            "password" != t.attr("type") && n(this)
        })
    }
    var o = {
        isSupportPlaceHolder: "placeholder" in t.createElement("input")
    };
    e(function() {
        a()
    }),
    e.fixPlaceholder = n;
    var r = {};
    return r.fixedPlaceHolder = n,
    r
} ($, document);
define("common/fixed",
function() {});
var Pagination = function(require) {
    function e(e, t, n) {
        var a = [];
        if (n = n || 6, t = t || 1, n >= e) for (var o = 0; e > o; o++) a.push(o + 1);
        else {
            a.push(1),
            t > 4 && a.push("");
            for (var r = Math.max(t - 2, 2), i = Math.min(t + 2, e - 1), o = r; i >= o; o++) a.push(o);
            e - 3 > t && a.push(""),
            a.push(e)
        }
        return a
    }
    function t(e, t, n, a) {
        function o(e) {
            if (a) {
                var t = a.replace(/\{page\}/g, e);
                return 1 === e && t.search("pg1") > -1 && (t = t.search("pg1/") > -1 ? t.replace(/pg1\//, "") : t.replace(/pg1/, "")),
                t
            }
            return "javascript:;"
        }
        var r = [];
        if (n = n || 1, e && e.length) {
            n > 1 && t > 6 && r.push('<a href="' + o(n - 1) + '" data-page="' + (n - 1) + '" >上一页</a>');
            for (var i = e.length,
            s = 0; i > s; s++) r.push(e[s] ? "<a " + (e[s] == n ? 'class="on"': "") + ' href="' + o(e[s]) + '" data-page="' + e[s] + '">' + e[s] + "</a>": "<span>...</span>");
            t > n && t > 6 && r.push('<a href="' + o(n + 1) + '" data-page="' + (n + 1) + '">下一页</a>')
        }
        return r.join("")
    }
    function n(n) {
        function a() {
            o(),
            s(),
            i(),
            r()
        }
        function o() {
            c.template = c.dom.attr("page-url");
            var e = c.dom.attr("target-wrapper");
            e && (c.targetWrapper = $(e));
            var t = c.dom.attr("page-data");
            t ? (t = $.parseJSON(t), $.extend(c, t)) : c.targetWrapper && (c.curPage = 1, c.totalPage = c.targetWrapper.children().length)
        }
        function r() {
            if (! (c.totalPage <= 1)) {
                var n = e(c.totalPage, c.curPage);
                n.length || c.dom.hide();
                var a = t(n, c.totalPage, c.curPage, c.template);
                if (c.dom.html(a), c.targetWrapper) {
                    var o = c.targetWrapper.children();
                    o.hide(),
                    o.eq(c.curPage - 1).show(),
                    c.targetWrapper.find(".lj-lazy").lazyload()
                }
            }
        }
        function i() {
            c.targetWrapper && l.on("showPage",
            function(e, t) {
                c.curPage = t,
                r()
            })
        }
        function s() {
            c.dom.delegate("[data-page]", "click",
            function() {
                var e = $(this).attr("data-page");
                l.trigger("showPage", parseInt(e))
            })
        }
        if (n) {
            var c = {
                dom: $(n),
                template: "",
                targetWrapper: "",
                totalPage: 0,
                curPage: 0
            },
            l = $({});
            return a(),
            l
        }
    }
    return $(function() {
        var e = $("[comp-module='page']");
        e.each(function() {
            n($(this))
        })
    }),
    n
} ();
define("common/pagination",
function() {}),
$(document).ready(function(e) {
    b(),
    ent(),
    $("#gotop").click(function() {
        $("html , body").animate({
            scrollTop: 0
        },
        1e3)
    })
}),
$(window).scroll(function(e) {
    b()
}),
define("common/backtop",
function() {}),
define("common/env",
function(require) {
    function e() {
        var e = $.parseURL(location.href);
        n.host = e.host,
        n.scheme = e.scheme,
        n.port = e.port;
        var t = n.host.substring(0, n.host.indexOf("."));
        0 === t.indexOf("dev") ? n.env = "dev": 0 === t.indexOf("test") && (n.env = "test")
    }
    function t(e) {
        var t = "";
        return e.scheme && (t += e.scheme + "://"),
        e.host && (t += e.host),
        e.port && (t += ":" + e.port),
        e.path && (t += "/" + e.path),
        e.query && (t += "?" + e.query),
        e.hash && (t += "#" + e.hash),
        t
    }
    var n = {
        host: "",
        scheme: "",
        port: "",
        env: "online"
    },
    a = {};
    return a.getEnv = function() {
        return n.env
    },
    a.fixedHost = function(e) {
        if (!e) return n.host;
        var t = e.substring(0, e.indexOf("."));
        switch (n.env) {
        case "dev":
        case "test":
            if (0 !== t.indexOf(n.env)) return n.env + e;
            break;
        case "online":
        }
        return e
    },
    a.fixedUrl = function(e) {
        var o = $.parseURL(e);
        return o.host ? (o.host = a.fixedHost(o.host), o.port = n.port, o.scheme || (o.scheme = n.scheme)) : (o.host = n.host, o.scheme = n.scheme, o.port = n.port),
        t(o)
    },
    a.isSameDomain = function(e) {
        var t = $.parseURL(e);
        return t.host == n.host
    },
    e(),
    a
}),
window.LJMessenger = function() {
    function e(e, t) {
        var n = "";
        if (arguments.length < 2 ? n = "target error - target and name are both requied": "object" != typeof e ? n = "target error - target itself must be window object": "string" != typeof t && (n = "target error - target name must be string type"), n) throw new Error(n);
        this.target = e,
        this.name = t
    }
    function t(e, t) {
        this.targets = {},
        this.name = e,
        this.listenFunc = [],
        n = t || n,
        "string" != typeof n && (n = n.toString()),
        this.initListen()
    }
    var n = "[LIANJIA_Messenger_CROSS]",
    a = "postMessage" in window;
    return a ? e.prototype.send = function(e) {
        this.target.postMessage(n + e, "*")
    }: e.prototype.send = function(e) {
        var t = window.navigator[n + this.name];
        if ("function" != typeof t) throw new Error("target callback function is not defined");
        t(n + e, window)
    },
    t.prototype.addTarget = function(t, n) {
        var a = new e(t, n);
        this.targets[n] = a
    },
    t.prototype.initListen = function() {
        var e = this,
        t = function(t) {
            if ("object" == typeof t && t.data && (t = t.data), t && "string" == typeof t && t.indexOf(n) >= 0) {
                t = t.slice(n.length);
                for (var a = 0; a < e.listenFunc.length; a++) e.listenFunc[a](t)
            }
        };
        a ? "addEventListener" in document ? window.addEventListener("message", t, !1) : "attachEvent" in document && window.attachEvent("onmessage", t) : window.navigator[n + this.name] = t
    },
    t.prototype.listen = function(e) {
        this.listenFunc.push(e)
    },
    t.prototype.clear = function() {
        this.listenFunc = []
    },
    t.prototype.send = function(e) {
        var t, n = this.targets;
        for (t in n) n.hasOwnProperty(t) && n[t].send(e)
    },
    t
} (),
"object" != typeof JSON && (JSON = {}),
function() {
    "use strict";
    function f(e) {
        return 10 > e ? "0" + e: e
    }
    function quote(e) {
        return escapable.lastIndex = 0,
        escapable.test(e) ? '"' + e.replace(escapable,
        function(e) {
            var t = meta[e];
            return "string" == typeof t ? t: "\\u" + ("0000" + e.charCodeAt(0).toString(16)).slice( - 4)
        }) + '"': '"' + e + '"'
    }
    function str(e, t) {
        var n, a, o, r, i, s = gap,
        c = t[e];
        switch (c && "object" == typeof c && "function" == typeof c.toJSON && (c = c.toJSON(e)), "function" == typeof rep && (c = rep.call(t, e, c)), typeof c) {
        case "string":
            return quote(c);
        case "number":
            return isFinite(c) ? String(c) : "null";
        case "boolean":
        case "null":
            return String(c);
        case "object":
            if (!c) return "null";
            if (gap += indent, i = [], "[object Array]" === Object.prototype.toString.apply(c)) {
                for (r = c.length, n = 0; r > n; n += 1) i[n] = str(n, c) || "null";
                return o = 0 === i.length ? "[]": gap ? "[\n" + gap + i.join(",\n" + gap) + "\n" + s + "]": "[" + i.join(",") + "]",
                gap = s,
                o
            }
            if (rep && "object" == typeof rep) for (r = rep.length, n = 0; r > n; n += 1)"string" == typeof rep[n] && (a = rep[n], o = str(a, c), o && i.push(quote(a) + (gap ? ": ": ":") + o));
            else for (a in c) Object.prototype.hasOwnProperty.call(c, a) && (o = str(a, c), o && i.push(quote(a) + (gap ? ": ": ":") + o));
            return o = 0 === i.length ? "{}": gap ? "{\n" + gap + i.join(",\n" + gap) + "\n" + s + "}": "{" + i.join(",") + "}",
            gap = s,
            o
        }
    }
    "function" != typeof Date.prototype.toJSON && (Date.prototype.toJSON = function() {
        return isFinite(this.valueOf()) ? this.getUTCFullYear() + "-" + f(this.getUTCMonth() + 1) + "-" + f(this.getUTCDate()) + "T" + f(this.getUTCHours()) + ":" + f(this.getUTCMinutes()) + ":" + f(this.getUTCSeconds()) + "Z": null
    },
    String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function() {
        return this.valueOf()
    });
    var cx, escapable, gap, indent, meta, rep;
    "function" != typeof JSON.stringify && (escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, meta = {
        "\b": "\\b",
        "	": "\\t",
        "\n": "\\n",
        "\f": "\\f",
        "\r": "\\r",
        '"': '\\"',
        "\\": "\\\\"
    },
    JSON.stringify = function(e, t, n) {
        var a;
        if (gap = "", indent = "", "number" == typeof n) for (a = 0; n > a; a += 1) indent += " ";
        else "string" == typeof n && (indent = n);
        if (rep = t, t && "function" != typeof t && ("object" != typeof t || "number" != typeof t.length)) throw new Error("JSON.stringify");
        return str("", {
            "": e
        })
    }),
    "function" != typeof JSON.parse && (cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g, JSON.parse = function(text, reviver) {
        function walk(e, t) {
            var n, a, o = e[t];
            if (o && "object" == typeof o) for (n in o) Object.prototype.hasOwnProperty.call(o, n) && (a = walk(o, n), void 0 !== a ? o[n] = a: delete o[n]);
            return reviver.call(e, t, o)
        }
        var j;
        if (text = String(text), cx.lastIndex = 0, cx.test(text) && (text = text.replace(cx,
        function(e) {
            return "\\u" + ("0000" + e.charCodeAt(0).toString(16)).slice( - 4)
        })), /^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) return j = eval("(" + text + ")"),
        "function" == typeof reviver ? walk({
            "": j
        },
        "") : j;
        throw new SyntaxError("JSON.parse")
    })
} (),
define("xd/crossRequest",
function(require) {
    function e(e, t) {
        var n = document.createElement("iframe");
        return n.id = e,
        n.name = e,
        n.src = t,
        n.style.cssText = "display:none;width:0px;height:0px;",
        n.width = 0,
        n.height = 0,
        n.title = "empty",
        document.body.appendChild(n),
        n
    }
    var t = new LJMessenger("LIANJIA_CROSS_MESSAGE", "LIANJIA-CROSS");
    t.listen(function(e) {
        e = JSON.parse(e);
        var n = e.name;
        t.targets[n] && ("state" == e.type ? (t.targets[n].readyState = "ready", t.targets[n].dealReady()) : t.targets[n].deal(e.data, e.success))
    });
    var n = {},
    a = function(e, t) {
        var n = this;
        n.domain = e,
        t = t || $.parseURL(e).host.replace(/\./g, "-"),
        n.name = t,
        n.init()
    };
    return $.extend(a.prototype, {
        init: function() {
            var n = this,
            a = n.domain + "/xd/api/?name=" + n.name,
            o = e(n.name, a);
            n.iframe = o.contentWindow,
            t.addTarget(n.iframe, n.name),
            n.reqArray = [],
            t.targets[n.name].deal = function(e, a) {
                t.targets[n.name].isRequest = !1;
                var o = n.reqArray.shift(),
                r = !1;
                try {
                    r = e
                } catch(i) {}
                a ? o.defer.resolve(r) : o.defer.reject(r),
                n.next()
            },
            t.targets[n.name].dealReady = function() {
                n.next()
            }
        },
        next: function() {
            var e = this;
            if (t.targets[e.name].readyState && e.reqArray.length && !t.targets[e.name].isRequest) {
                t.targets[e.name].isRequest = !0;
                var n = e.reqArray[0],
                a = {
                    type: "request",
                    data: n.request
                },
                o = JSON.stringify(a);
                t.targets[e.name].send(o)
            }
        },
        request: function(e) {
            var t = this,
            n = $.Deferred();
            return t.reqArray.push({
                defer: n,
                request: e
            }),
            t.next(),
            n
        }
    }),
    function(e, t) {
        return n[e] ? n[e] : n[e] = new a(e, t)
    }
}),
define("xd/Trans",
function(require) {
    var e = $.EventEmitter,
    t = require("xd/crossRequest"),
    n = require("common/env"),
    a = !1,
    o = e.extend({
        initialize: function(e) {
            var o = {
                url: "",
                type: "get",
                dataType: "json",
                args: {}
            };
            $.extend(o, e),
            o.url = n.fixedUrl(o.url),
            o.method = o.type;
            var r = this;
            if (r.opt = o, !a) {
                var i = n.fixedUrl($.parseURL(o.url).host);
                n.isSameDomain(i) ? r.isSame = !0 : r.crossRequest = t(i)
            }
        },
        request: function(e) {
            var t = this,
            n = t.opt;
            return $.extend(n.args, e),
            n.data = n.args,
            a || t.isSame ? $.ajax(n) : this.crossRequest.request(n)
        }
    });
    return o
}),
define("common/scrollCaller",
function(require) {
    function e() {
        for (var e = i.scrollTop(), t = s.length - 1; t >= 0; t--) try {
            s[t].call(i, e)
        } catch(n) {
            console.error && console.error(n.stack)
        }
    }
    function t() {
        r && clearTimeout(r),
        r = setTimeout(function() {
            e()
        },
        30)
    }
    function n(e) {
        e ? i.scroll(t) : i.unbind("scroll", t)
    }
    function a(e) {
        s.length || n(!0),
        s.push(e)
    }
    function o(e) {
        var t = $.inArray(e, s);
        t >= 0 && s.splice(t, 1),
        s.length || n(!1)
    }
    var r = !1,
    i = $(window),
    s = [];
    return function(e) {
        if (!e) throw "fun is required";
        return a(e),
        {
            destroy: function() {
                o(e)
            }
        }
    }
}),
define("common/lazyExecute",
function(require) {
    function e(e) {
        for (var n, a = !1,
        o = i.width(), s = window.innerHeight, c = 0, l = r.length; l > c; c++) n = r[c],
        a = t(n, e, o, s),
        a && !n.always && --n.times <= 0 && (r.splice(c, 1), l--, c--)
    }
    function t(e, t, n, a) {
        var o = $(e.el);
        t || (t = document.documentElement.scrollTop || document.body.scrollTop),
        n || (n = i.width()),
        a || (a = window.innerHeight);
        var r = o.offset(),
        s = r.top - e.marginTop,
        c = s + o.height() + e.marginBottom,
        l = t,
        u = t + a;
        return l > c || s > u ? !1 : (e.callback && e.callback(), !0)
    }
    function n() {
        a = o(function(t) {
            e(t)
        })
    }
    var a, o = require("common/scrollCaller"),
    r = [],
    i = $(window);
    return function(e) {
        var o = {
            el: "",
            marginTop: 0,
            marginBottom: 0,
            times: 1,
            always: !1,
            callback: $.noop
        };
        if ($.extend(o, e), o.el) {
            var i = t(o);
            if (!i || o.always) return r.push(o),
            a || n(),
            {
                destroy: function() {
                    var e = r.indexOf(o);
                    e >= 0 && r.splice(e, 1)
                },
                pause: function() {
                    var e = r.indexOf(o);
                    e >= 0 && r.splice(e, 1)
                },
                resume: function() {
                    var e = r.indexOf(o);
                    0 > e && r.push(o)
                }
            }
        }
    }
}),
define("common/footer",
function(require) {
    function e() {
        var e = $(".lianjia-link-box .tab");
        $(".link-list div").eq(0).show(),
        $(".link-footer div").eq(0).show(),
        e.delegate("span", "mouseover",
        function(e) {
            var t = $(e.currentTarget),
            n = t.index(),
            a = t.closest(".tab").next(".link-list");
            t.addClass("hover").siblings("span").removeClass("hover"),
            a.find("div").eq(n).show().siblings("div").hide()
        })
    }
    function t() {
        $(document.body).on("mousedown",
        function(e) {
            $(e.target).closest(".hot-sug,.search-txt ul,.del").length || ($(".hot-sug").hide(), p.css({
                height: "35px",
                overflow: "hidden",
                border: "0px",
                background: "none",
                left: "0px",
                top: "0px",
                display: "none"
            }))
        }),
        $("#keyword-box:text").click(function(e) {
            "" == $(this).val() ? $(e.target).next("div").show() : ($("#keyword-box").select(), $(e.target).next("div").show())
        }),
        $("#keyword-box").keydown(function(e) {
            $(e.target).next("div").hide()
        })
    }
    function n() {
        var e = $(".frauds-list .tab");
        $(".link-list div").eq(0).show(),
        e.delegate("span", "click",
        function(e) {
            var t = $(e.currentTarget),
            n = t.index(),
            a = t.closest(".tab").next(".link-list");
            t.addClass("hover").siblings("span").removeClass("hover"),
            a.find("div").eq(n).show().siblings("div").hide()
        })
    }
    function a() {
        var e = $(".hot-sug ul");
        e.eq(0).show(),
        g.click(function() {
            p.css({
                height: "auto",
                overflow: "auto",
                background: "#fff",
                border: "1px solid #ccc",
                left: "-1px",
                top: "-1px",
                display: "block"
            })
        }),
        "ershoufang" == g.attr("actdata") && $(".savesearch").show(),
        p.delegate("li label", "click",
        function(t) {
            var n = $(t.currentTarget),
            a = n.parent("li").index(),
            o = n.attr("actdata");
            o = o.split("=")[1],
            g.text(n.text()),
            g.attr("actdata", o),
            p.css({
                display: "none"
            });
            var r = $.queryToJson(n.attr("actData"));
            r && defaultSuggest.suggestView.model.trans.setArgs(r);
            var i = $(this).attr("formact"),
            s = n.attr("tra"),
            c = n.attr("tips");
            n.closest(".search-txt").find("form").attr({
                action: i,
                target: s
            }),
            n.closest(".search-txt").find("form").attr({
                "data-action": i
            }),
            n.closest(".search-txt").find(".autoSuggest").attr("placeholder", c),
            e.eq(a).show().siblings("ul").hide();
            var l = n.closest(".search-txt").find(".autoSuggest");
            "placeholder" in document.createElement("input") ? l.val("") : l.val(c),
            "ershoufang" == o ? $(".savesearch").show() : $(".savesearch").hide(),
            u()
        })
    }
    function o() {
        var e = $("#back-top");
        if (e.hasClass("fix-right-v2")) {
            var t = "";
            e.on("mouseenter", "li",
            function() {
                var e = $(this).find(".popup").eq(0);
                t = this.className,
                e.show(),
                e.stop().animate({
                    opacity: "1",
                    right: "38px"
                },
                200)
            }).on("mouseleave", "li",
            function() {
                var e = $(this).find(".popup").eq(0),
                n = this.className;
                t = "",
                e.stop().animate({
                    opacity: "0",
                    right: "48px"
                },
                200,
                function() {
                    n != t && e.hide()
                })
            })
        } else {
            var n = $("#back-top .tips li,#gotop");
            n.mouseenter(function() {
                $(this).find("span").css({
                    opacity: "1"
                }),
                $(this).css({
                    overflow: "inherit",
                    width: "auto"
                })
            }),
            n.mouseleave(function(e) {
                $(this).find("span").css({
                    opacity: "0"
                }),
                $(this).css({
                    overflow: "hidden",
                    width: "37px"
                })
            })
        }
    }
    function r() {
        var e = $(".feedback-box");
        $("#tel").val();
        e.delegate("#sub", "click",
        function() {
            var t = ($("#sub"), $("#tips")),
            n = "//www.lianjia.com/site/accuse/",
            a = ($("#count"), $("#tel").val()),
            o = $("#count").val();
            o = $.trim(o);
            var r = $("#count").attr("placeholder");
            if ("" == o || o == r) return $(".erro-tips").show(),
            !1;
            var i = {
                contact: a,
                content: o
            };
            $.ajax({
                type: "POST",
                url: n,
                dataType: "json",
                data: i,
                xhrFields: {
                    withCredentials: !0
                },
                crossDomain: !0,
                success: function(n) {
                    0 == n.status ? (t.html("反馈成功非常感谢您的反馈！"), e.delay(2e3).fadeOut().removeClass("bounceIn"), v.delay(2e3).fadeOut()) : t.html("反馈失败请重新填写！")
                }
            })
        }),
        e.delegate(".tab span", "click",
        function() {
            $(".complain .tab-box").eq($(this).index()).show().siblings().hide(),
            $(this).addClass("check").siblings().removeClass("check")
        });
        var t = '<li><span class="time">#{issue_time}</span><span class="name">#{customer_name}</span><span class="phone">#{customer_phone}</span><span class="type">#{trade_type}</span><span class="finish">#{issue_status}</span></li>';
        e.delegate(".ent", "click",
        function() {
            $("#tousu .btn-more").attr("href", "http://" + window.location.host.split(".").slice( - 3).join(".") + "/topic/tousu/");
            var e = ljConf.pageConfig.ajaxroot + "ajax/tousu/GetCityTousuBrief";
            $.ajax({
                url: e,
                dataType: "jsonp",
                data: {
                    city_id: ljConf.city_id
                }
            }).done(function(e) {
                var n = $(".feedback-box #list");
                n.html("");
                var e = e.data;
                if (e.data && e.data.length <= 0 && $("#tousu").hide(), e.data && 0 == e.code) {
                    for (var a = e.data,
                    o = "",
                    r = 0; r < a.length; r++) {
                        var i;
                        i = 1 == a[r].issue_status ? "未处理": 2 == a[r].issue_status ? "处理中": "已完成",
                        o += $.replaceTpl(t, {
                            issue_time: a[r].issue_time,
                            customer_name: a[r].customer_name,
                            customer_phone: a[r].customer_phone,
                            trade_type: a[r].trade_type,
                            issue_status: i
                        })
                    }
                    n.append(o)
                }
            })
        })
    }
    function i() {
        var e = ($("#feedback"), $(".feedback-box"));
        e.fadeOut().removeClass("bounceIn"),
        e.html(m),
        v.fadeOut()
    }
    function s() {
        var e = $("#feedback"),
        t = $(".feedback-box");
        e.click(function(e) {
            t.show(),
            t.addClass("bounceIn"),
            v.fadeIn(300),
            t.html(m)
        }),
        v.click(function(e) {
            i()
        }),
        t.delegate(".closebok", "click",
        function(e) {
            i()
        })
    }
    function c() {
        $("#back-top").on("click", "li",
        function() {
            var e = $(this).find("a").attr("data-url");
            if (e) if (window.loginData && 1 == window.loginData.code) window.open(e);
            else {
                var t = $(".btn-login");
                t.length > 0 ? t.trigger("click") : alert("请登录后使用，谢谢！")
            }
        })
    }
    function l(e, t) {
        searchHis = localStorage.getItem(e),
        searchHis = JSON.parse(searchHis),
        searchHis ? ($.each(searchHis,
        function(e, n) {
            n && n.name == t.name && searchHis.splice(e, 1)
        }), searchHis.unshift(t), saveQuery = searchHis.slice(0, 10)) : saveQuery = [t],
        localStorage.setItem(e, JSON.stringify(saveQuery))
    }
    function u() {
        var e = $(".btn");
        if ($(".search-tab .check").length > 0) {
            var t = $(".search-tab .check").attr("actdata"),
            n = e.attr("daty-id");
            menu = t + n,
            $("#keyword-box").on("formSelect",
            function(e, t) {
                $(this).val($(t).find(".hot-title i").text()),
                url = $(t).attr("actdata"),
                url = url.substring(url.indexOf("&url=") + 5, url.lastIndexOf("&title")),
                url = unescape(url),
                $(this).attr("url", url)
            }),
            e.click(function(e) {
                if ($("#keyword-box").attr("url")) {
                    var t = $("#keyword-box").val(),
                    n = $("#keyword-box").attr("url");
                    query = {
                        name: t,
                        url: n
                    },
                    l(menu, query)
                } else {
                    var a = $(".search-txt form").attr("data-action"),
                    t = $("#keyword-box").val(),
                    n = "http://" + window.location.host + a + t;
                    "" != t && (query = {
                        name: t,
                        url: n
                    },
                    l(menu, query))
                }
            });
            var a = $(".hot-sug");
            a.delegate("li a", "click",
            function(e) {
                var t = $(e.currentTarget);
                name = t.text(),
                url = t.attr("href"),
                query = {
                    name: name,
                    url: url
                },
                l(menu, query)
            });
            var o = $("#suggest-cont");
            o.delegate("ul li", "click",
            function(e) {
                var t = $(e.currentTarget);
                name = t.find(".hot-title i").text(),
                url = t.attr("actdata"),
                url = url.substring(url.indexOf("&url=") + 5, url.lastIndexOf("&title")),
                url = unescape(url),
                query = {
                    name: name,
                    url: url
                },
                l(menu, query)
            });
            var r = localStorage.getItem(menu);
            if (r = JSON.parse(r), null != r) {
                $("#keyword-box").val(r[0].name);
                var i = $(".hot-sug ul#" + t + " .list"),
                s = $(".hot-sug ul#" + t + " .hot-name"),
                c = i.html();
                s.text("搜索历史"),
                i.html(""),
                $.each(r,
                function(e, t) {
                    var n = '<li><a href="' + t.url + '" data-log_index="' + (e + 1) + '" data-log_value="' + t.name + '">' + $.encodeHTML(t.name) + "</a></li>";
                    i.append(n)
                });
                var u = $("#" + t + " .del");
                u.show(),
                u.click(function(e) {
                    localStorage.removeItem(menu),
                    i.html(""),
                    i.append(c),
                    s.text("热门搜索"),
                    u.hide(),
                    "" == texval
                })
            }
        }
    }
    function f() {
        var e = (g.attr("actdata"), $(".savesearch"));
        e.length && h({
            el: e,
            callback: function() {
                var e = ljConf.city_id,
                t = new $.ListView({
                    el: ".savesearch",
                    template: "#savesearch",
                    url: $.env.fixedUrl("http://ajax.lianjia.com/ajax/user/favorite/getSearchNotifyNum"),
                    type: "jsonp",
                    args: {
                        cityId: e
                    }
                });
                t.showloading = function() {},
                t.init()
            }
        });
        var t = $(".savesearch");
        t.find(".s-show");
        t.delegate(".more", "click",
        function(e) {
            var t = $(e.currentTarget),
            n = t.parent("ul");
            n.find(".list").css({
                height: "auto"
            }),
            t.hide()
        }),
        t.delegate(".s-show", "click",
        function(e) {
            var t = $(e.currentTarget);
            t.next(".cunn").toggle(),
            "none" == t.next(".cunn").css("display") ? t.find("label").removeClass("down") : t.find("label").addClass("down"),
            $(".sug-tips ul").hide()
        }),
        $(".savesearch .s-show").click(function() {}),
        $(document.body).on("mousedown",
        function(e) {
            $(e.target).closest(".savesearch").length || (t.find(".cunn").hide(), t.find("label").removeClass("down"))
        })
    }
    function d() {
        var e = $('[data-role="huodong-btn"]'),
        t = $('[data-role="huodong-mask"]'),
        n = $('[data-role="huodong-layer"]');
        e.length > 0 && (e.click(function() {
            t.fadeIn(500),
            n.addClass("bounceIn").show()
        }), n.click(function(e) {
            var a = $(e.target); (0 == a.closest('[data-role="huodong-wrap"]').length || a.closest(".close").length > 0) && (t.fadeOut(500), n.removeClass("bounceIn").fadeOut())
        }))
    }
    var h = require("common/lazyExecute"),
    p = $(".search-tab .tabs"),
    g = $(".search-tab .check"),
    m = $(".feedback-box").html(),
    v = $(".overlay_bg");
    return {
        init: function(i) {
            u(),
            t(),
            e(),
            a(),
            c(),
            d(),
            s(),
            r(),
            o(),
            f(),
            n()
        }
    }
}),
function() {
    $.listener = new $.EventEmitter(!0),
    $.env = require("common/env"),
    $(document.body).ready(function() {
        var n = $("#only");
        n.attr("data-city") && (n.attr("data-city").indexOf("su") >= 0 || n.attr("data-city").indexOf("jn") >= 0) && ($(".laisuzhou").addClass("laisuzhou-class"), $(document.body).delegate(".laisuzhou", "click",
        function(e) {
            return ! 1
        })),
        require("common/footer").init()
    })
} ();