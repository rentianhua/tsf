define("imgFullscreen",
function() {
    $.fn.fullscreen = function(e) {
        function t(e, t) {
            var n = new Image;
            n.src = e,
            n.onload = function() {
                t({
                    width: n.width,
                    height: n.height
                })
            }
        }
        function n() {
            $(".imgFullscreen").remove()
        }
        function a() {
            $(".imgFullscreen .preview img").hide(),
            $(".imgFullscreen .btn-loading").show()
        }
        function i() {
            $(".imgFullscreen .preview img").show(),
            $(".imgFullscreen .btn-loading").hide()
        }
        function o(e) {
            n();
            var t = "";
            t = '<div class="imgFullscreen"><div class="preview"><img src="" alt=""></div><div class="btn-prev"></div><div class="btn-next"></div><div class="btn-close"></div><div class="btn-loading"></div><ul class="thumbnail">',
            $.each(e,
            function(e, n) {
                t += '<li><img src="' + n + '" alt=""></li>'
            }),
            t += "</ul>",
            $("body").append(t)
        }
        var r = {
            dataImgPrefix: "src",
            selectorWrapImg: "li"
        },
        s = $.extend({},
        r, e);
        return this.each(function() {
            function e() {
                r(),
                $(".imgFullscreen .thumbnail li").eq(u).click()
            }
            function r() {
                var e = $(".imgFullscreen .btn-prev"),
                t = $(".imgFullscreen .btn-next");
                e.removeClass("disabled"),
                t.removeClass("disabled"),
                0 == u && e.addClass("disabled"),
                u == c - 1 && t.addClass("disabled")
            }
            var l = $(this).find("img"),
            c = l.length,
            u = 0,
            d = [],
            f = [];
            l.each(function() {
                d.push($(this).attr("src")),
                f.push($(this).data(s.dataImgPrefix))
            }),
            $(this).find(s.selectorWrapImg).click(function() {
                u = $(this).index(),
                o(d),
                e()
            }),
            $("body").on("click", ".imgFullscreen .btn-close",
            function() {
                n()
            }),
            $("body").on("click", ".imgFullscreen .btn-prev",
            function() {
                return 0 == u ? ($(this).addClass("disabled"), !1) : (u--, void e())
            }),
            $("body").on("click", ".imgFullscreen .btn-next",
            function() {
                return u == c - 1 ? ($(this).addClass("disabled"), !1) : (u++, void e())
            }),
            $("body").on("click", ".imgFullscreen .thumbnail li",
            function() {
                u = $(this).index();
                var e = f[u],
                n = $(".imgFullscreen .preview img");
                $(this).addClass("active").siblings().removeClass("active"),
                a(),
                r(),
                t(e,
                function() {
                    n.attr("src", e),
                    i()
                })
            })
        })
    }
}),
define("ershoufang/sellDetail/anchorFollow",
function(require) {
    function e(e) {
        if (e) {
            var t = e.indexOf("#");
            if (!~~t) return e.substring(t + 1)
        }
    }
    var t = $(window);
    return function(n, a) {
        function i() {
            for (var t, a, i = n.find("a"), o = i.length, r = 0; o > r; r++) t = i.eq(r).attr("href"),
            (t = e(t)) && (a = $("#" + t), a.length && (l.hashId.push(a), l.hash.push(i.eq(r))))
        }
        function o() {
            function e(e) {
                s.trigger("show", {
                    hash: l.hash[e],
                    dest: l.hashId[e]
                })
            }
            function n(t) {
                if (l.hashId.length) {
                    for (var n = 0,
                    i = 0; i < l.hashId.length; i++) if ("none" !== l.hashId[i].css("display")) {
                        var o = l.hashId[i].offset().top;
                        t + c > o + a && (n = i)
                    }
                    e(n)
                }
            }
            require(["common/scrollCaller"],
            function(e) {
                e(function(e) {
                    n(e)
                })
            }),
            n(t.scrollTop())
        }
        function r() {
            i(),
            l.hashId && o()
        }
        var s = $({}),
        l = {
            hash: [],
            hashId: []
        };
        a = a || 0;
        var c = n.height();
        return r(),
        s
    }
}),
define("ershoufang/sellDetail/comp/imgScroll",
function(require) {
    return function(e) {
        var t, n = e.images.children().first().width(),
        a = [],
        i = !1,
        o = function(n) {
            i || t == n || (e.showImg.hide(), e.showDesc.hide(), e.loading.show(), i = !0, n = n > a.length - 1 || 0 > n ? 0 : n, r(a[n].src,
            function() {
                e.loading.hide(),
                e.showImg.show(),
                e.showDesc.show(),
                e.showImg.attr("src", a[n].src),
                e.showImg.data("index", n),
                e.showDesc.html(a[n].desc),
                e.showImg.attr("alt", a[n].desc),
                i = !1
            }))
        },
        r = function(e, t) {
            var n = document.createElement("img");
            n.src = e,
            n.onload = t
        },
        s = function(a) {
            if (t !== a) {
                e.images.children(":eq(" + a + ")").addClass("selected"),
                e.images.children(":eq(" + t + ")").removeClass("selected"),
                a -= e.selectPosition,
                0 > a && (a = 0);
                var i = a * n + a * e.spacing;
                e.images.animate({
                    scrollLeft: i
                },
                250)
            }
        },
        l = function(e) {
            0 !== a.length && (s(e), o(e), t = e)
        },
        c = function(t) {
            var n = "disable";
            return a.length <= 1 ? (e.pre.addClass("disable"), void e.next.addClass("disable")) : (e.pre.removeClass(n), void e.next.removeClass(n))
        };
        return e.images.children().each(function(e) {
            var t = $(this);
            t.data("index", e),
            a.push({
                src: t.data("src"),
                desc: t.data("desc")
            })
        }),
        l(0),
        c(0),
        e.pre.on("click",
        function() {
            if (0 === t) var e = a.length - 1;
            else var e = t - 1;
            l(e),
            c(e)
        }),
        e.next.on("click",
        function() {
            if (t === a.length - 1) var e = 0;
            else var e = t + 1;
            l(e),
            c(e)
        }),
        e.images.children().on("click",
        function() {
            var e = $(this).data("index");
            l(e),
            c(e)
        }),
        {
            setPage: function(e) {
                l(e),
                c(e)
            }
        }
    }
}),
define("ershoufang/component/imgbanner",
function(require) {
    return function() {
        var e = require("ershoufang/sellDetail/comp/imgScroll"),
        t = function() {
            var t = e({
                showImg: $(".bigImg .list img"),
                showDesc: $(".bigImg .slide .desc"),
                pre: $(".bigImg .pre"),
                next: $(".bigImg .next"),
                images: $(".bigImg .slide ul"),
                spacing: 10,
                loading: $(".bigImg .loading"),
                selectPosition: 4
            });
            $("#topImg .imgContainer img").on("click",
            function() {
                t.setPage($(this).data("index")),
                $(".bigImg").show()
            }),
            $(".housePic .list>div").on("click",
            function() {
                t.setPage($(this).data("index")),
                $(".bigImg").show()
            }),
            $(".bigImg .close").on("click",
            function() {
                $(".bigImg").hide()
            }),
            $(document).keydown(function(e) {
                37 == e.keyCode && $(".bigImg .pre").click(),
                39 == e.keyCode && $(".bigImg .next").click()
            })
        };
        e({
            showImg: $("#topImg .imgContainer img"),
            showDesc: $("#topImg .imgContainer span"),
            pre: $("#topImg .pre"),
            next: $("#topImg .next"),
            images: $("#topImg ul"),
            spacing: 8,
            loading: $("#topImg .loading"),
            selectPosition: 2
        }),
        t()
    }
}),

define("ershoufang/sellDetail/detailV3",
function(require) {
    function t(e, t, n) {
        var a = n.length - e;
        if (0 >= a) return n;
        if (t >= n.length) return [];
        var i = t + e - n.length;
        return i > 0 ? n.slice(t).concat(n.slice(0, i)) : n.slice(t, t + e)
    }
    
    Number.prototype.toFixed = function(e) {
        return Math.round(this * Math.pow(10, e)) / Math.pow(10, e)
    },
    require("imgFullscreen");
    
    return function(t) {
        var r = require("ershoufang/sellDetail/anchorFollow"),
        l = require("ershoufang/component/imgbanner"),
        c = require("ershoufang/component/detailHeader");
		//点击详情
        $("#lookdetail").click(function(e) {
            $("#taxm").trigger("click")
        }),
       
        $(".bigImg ul li").each(function(e, t) {});
        
		//浮动的联系经纪人
        var h = function() {
            var e = $(".agbox");
            e.fixtop({
                fixed: function() {
                    $(".agbox").fadeTo(300, 1),
                    $(".myAgent").fadeTo(300, 1),
                    $(".agbox").css({
                        position: "fixed",
                        top: "95px",
                        width: "1150px"
                    }),
                    $(".myAgent").css({
                        width: "380px",
                        position: "absolute",
                        top: "0px"
                    }),
                    $(".agbox").css({
                        "z-index": "998"
                    })
                },
                unfixed: function() {
                    $(".agbox").css({
                        opacity: "0",
                        top: "95px",
                        width: "1150px"
                    }),
                    $(".myAgent").css({
                        opacity: "0",
                        width: "380px",
                        position: "absolute",
                        top: "0px"
                    })
                }
            }),
            $(window).scroll(function() {
                var e = $(window).scrollTop(),
                t = ($(".agbox").offset().top, $(".footer").offset().top);
                e >= t - 450 ? $(".agbox").css({
                    top: t - e - 350
                }) : $(".agbox").css({
                    top: "95px"
                })
            });
            var t = $(".tab-wrap");
            t.fixtop({
                fixedWidth: "100%",
                fixed: function() {
                    $(".tab-wrap").fadeTo(300, 1),
                    $(".tab-wrap").css({
                        "z-index": "1000"
                    })
                },
                unfixed: function() {
                    $(".tab-wrap").css({
                        opacity: "0",
                        width: "1150px",
                        position: "relative",
                        top: "-61px",
                        "z-index": "-1"
                    })
                }
            }),
            t.on("click", "a",
            function(e) {
                var n = $(this),
                a = $(n.attr("href")).position();
                e.preventDefault(),
                t.find("a").removeClass("on"),
                n.addClass("on"),
                $("html,body").scrollTop(a.top - 84)
            });
            var n = r(t, -84);
            n.on("show",
            function(e, n) {
                t.find("a").removeClass("on"),
                n.hash.addClass("on")
            })
        },
        p = function(e) {},
        g = function() {},
        m = function() {}
        y = function(e, n, a, i) {},
        S = function(e) {};
        0 === t.isRemove && p(t.houseId),
        "370101" === t.cityId && ($("#dealPrice").hide(), $('a[href="#dealPrice"]').parent().hide(), $(".title-wrapper i").hide()),
        "440100" === t.cityId && ($(".dealRecord").hide(), $('a[href="#dealPrice"]').parent().hide(), $(".title-wrapper i").hide()),
        h(),
        S({
            container: $(".housePic .container"),
            content: $(".housePic .list"),
            moreBtn: $(".housePic .more")
        });
        var k = function() {},
        L = function() {},
        O = $("#introduction").position(),
        _ = !1,
        j = function() { ! _ && $(this).scrollTop() + 100 > O.top && (L(), k(), _ = !0)
        };
        $(window).scroll(j),
        j(),
        g(),
        m(),
        l(),
        t.hasDaikan && a(t.houseId, t.ucid, t.defaultImg)
    }
}),
    define("xinfang/adddetail/xiangce",
        function(require) {
            function t(t) {
                function i() {
                    1 >= c ? (d.addClass("disable"), r.addClass("disable")) : n[0].style.marginLeft.slice(0, -1) / 100 == "-" + (f - 1) ? (d.removeClass("disable"), r.addClass("disable")) : "0" === n[0].style.marginLeft.slice(0, 1) ? (d.addClass("disable"), r.removeClass("disable")) : (d.removeClass("disable"), r.removeClass("disable")),
                        b >= c ? (s.addClass("disable"), l.addClass("disable")) : a[0].style.marginLeft.slice(0, -1) / 100 == "-" + m ? (s.removeClass("disable"), l.addClass("disable")) : "0" === a[0].style.marginLeft.slice(0, 1) ? (s.addClass("disable"), l.removeClass("disable")) : (s.removeClass("disable"), l.removeClass("disable"))
                }
                function e() {
                    v.thumbContainer.on("click", ".slide-prev:not(.disable)",
                        function() {
                            var t = a[0].style.marginLeft.slice(0, -1) / 100;
                            t++,
                                v.slideHandler(a, -t)
                        }),
                        v.thumbContainer.on("click", ".slide-next:not(.disable)",
                            function() {
                                var t = a[0].style.marginLeft.slice(0, -1) / 100;
                                t--,
                                    v.slideHandler(a, -t)
                            }),
                        v.photoContainer.on("click", ".slide-prev",
                            function() {
                                var t = Number(n.find("li[data-index=" + v.current + "]").attr("data-index"));
                                v.slideHandler(n, t - 1)
                            }),
                        v.photoContainer.on("click", ".slide-next",
                            function() {
                                var t = Number(n.find("li[data-index=" + v.current + "]").attr("data-index"));
                                v.slideHandler(n, t + 1)
                            }),
                        v.thumbContainer.on("click", "li[data-index]",
                            function() {
                                var t = $(this).attr("data-index");
                                v.slideHandler(n, t)
                            }),
                        v.thumbContainer.on("mouseenter", "li[data-index]",
                            function() {
                                $(this).css({
                                    opacity: 1
                                })
                            }),
                        v.thumbContainer.on("mouseleave", "li[data-index]",
                            function() {
                                var t = $(this).attr("data-index");
                                t != v.current && $(this).css({
                                    opacity: .5
                                })
                            })
                }
                this.photoContainer = $(t.photoContainer),
                    this.thumbContainer = $(t.thumbContainer);
                var n = this.photoContainer.find(".slides"),
                    a = this.thumbContainer.find(".slides"),
                    d = this.photoContainer.find(".slide-prev"),
                    r = this.photoContainer.find(".slide-next"),
                    s = this.thumbContainer.find(".slide-prev"),
                    l = this.thumbContainer.find(".slide-next"),
                    o = 0,
                    h = 0;
                this.leftEnd = function() {},
                    this.rightEnd = function() {},
                    t.rangeData.leftEndTitle ? (a.find('[data-index="prev"]').show().find(".jump-name").html(t.rangeData.leftEndTitle), this.leftEnd = t.rangeData.leftEnd ||
                        function() {},
                        o++) : a.find('[data-index="prev"]').hide(),
                    t.rangeData.rightEndTitle ? (a.find('[data-index="next"]').show().find(".jump-name").html(t.rangeData.rightEndTitle), this.rightEnd = t.rangeData.rightEnd ||
                        function() {},
                        h++) : a.find('[data-index="next"]').hide();
                var c = a.children().length,
                    f = c - a.find('[data-role="switch"]').length,
                    u = a.children().outerWidth() + 15,
                    p = a.parent(".thumbslider").width(),
                    m = 0,
                    b = 0;
                this.current = 0;
                var g = !0,
                    v = this;
                this.picAmount = f,
                    function() {
                        n.width(100 * c + "%"),
                            n.children("li").width(100 / c + "%"),
                            a.width(c * u),
                            b = Math.floor(p / u),
                            m = Math.floor((c - 1) / b),
                            e()
                    } (),
                    this.slideHandler = function(t, e, n, d) {
                        console.log(e);
                        var r = e;
                        if (e = +(e || 0), isNaN(e)) switch (r) {
                            case "prev":
                                v.leftEnd();
                                break;
                            case "next":
                                v.rightEnd()
                        } else {
                            if (!g) return;
                            if (0 > e) v.leftEnd();
                            else if (e > f - 1) v.rightEnd();
                            else {
                                g = !1;
                                var s = "-" + 100 * e + "%",
                                    l = n ? 0 : 500;
                                /photo/.test(t.parent()[0].className) && (v.current = e),
                                    a.find("li[data-index=" + v.current + "]").css({
                                        opacity: 1
                                    }).siblings().css({
                                        opacity: .5
                                    }),
                                    t.animate({
                                            marginLeft: s
                                        },
                                        l,
                                        function() {
                                            if (/photo/.test(t.parent()[0].className)) {
                                                var e = Math.floor((v.current + 1 + (o - 1)) / b);
                                                a.animate({
                                                        marginLeft: -100 * e + "%"
                                                    },
                                                    0,
                                                    function() {
                                                        i(),
                                                        d && d(),
                                                            g = !0
                                                    })
                                            } else i(),
                                            d && d(),
                                                g = !0
                                        })
                            }
                        }
                    }
            }
            function i(t) {
                var i = {
                    leftEndTitle: "",
                    leftEnd: null,
                    rightEndTitle: "",
                    rightEnd: null
                };
                return t.prev().length && (i.leftEndTitle = t.prev().text(), i.leftEnd = function() {
                    n(l - 1, -1)
                }),
                t.next().length && (i.rightEndTitle = t.next().text(), i.rightEnd = function() {
                    n(l + 1, 1)
                }),
                    i
            }
            function e() {
                var e = $(".photo-type").find("li[class=current]"),
                    n = e.attr("data-type");
                return l = +e.attr("data-index"),
                    $(".photo-type").on("click", "li",
                        function(e, a) {
                            $(this).addClass("current").siblings().removeClass("current"),
                                n = $(this).attr("data-type"),
                                l = +$(this).attr("data-index"),
                            d[n].hasBuilt || (d[n].slider = new t({
                                photoContainer: ".slider-wrap[data-type=" + n + "] .photo-large",
                                thumbContainer: ".slider-wrap[data-type=" + n + "] .thumbnail",
                                rangeData: i($(this))
                            }), d[n].hasBuilt = 1),
                                a && -1 === a.dir ? d[n].slider.switchTo(d[n].slider.picAmount - 1, !0) : d[n].slider.switchTo(0, !0),
                                $(".slider-wrap[data-type=" + n + "]").attr("data-role", "current").css({
                                    visibility: "visible",
                                    "z-index": "1"
                                }).siblings().attr("data-role", "").css({
                                    visibility: "hidden",
                                    "z-index": "0"
                                })
                        }),
                    n
            }
            function n(t, i) {
                var e = $(".photo-type").find('li[data-index="' + t + '"]');
                e.trigger("click", {
                    dir: i
                })
            }
            function a(n) {
                var a = e(),
                    r = n.curId,
                    s = $(".slider-wrap[data-role=current]"),
                    l = s.find(".photo-large .slides").find('img[data-id="' + r + '"]').closest("li").attr("data-index"),
                    o = $(".photo-type").find("li[class=current]");
                d[a].slider = new t({
                    photoContainer: ".slider-wrap[data-role=current] .photo-large",
                    thumbContainer: ".slider-wrap[data-role=current] .thumbnail",
                    rangeData: i(o)
                }),
                    d[a].hasBuilt = 1,
                    d[a].slider.switchTo(l, !0,
                        function() {
                            $("#loading").hide(),
                                $(".slider-wrap[data-role=current]").css("visibility", "visible")
                        })
            }
            for (var d = {},
                     r = $(".photo-type").children().length, s = 0; r > s; s++) d[$($(".photo-type").children()[s]).attr("data-type")] = {
                hasBuilt: 0,
                slider: null
            };
            window.sl = d,
                $(".photo-large").on("mouseenter",
                    function() {
                        $(this).find(".slide-control").css("visibility", "visible")
                    }),
                $(".photo-large").on("mouseleave",
                    function() {
                        $(this).find(".slide-control").css("visibility", "hidden")
                    }),
                t.prototype.switchTo = function(t, i, e) {
                    this.slideHandler(this.photoContainer.find(".slides"), t, i, e)
                };
            var l = 0;
            return {
                init: a
            }
        });