$.widget("ui.datepicker_thai", {
    _init: function () {
        function u(a, b, c, d) {
            return 0 == s ? 1 == q ? c + d + a + d + b : c + d + b + d + a : 0 == q ? 1 == r ? a + d + b + d + c : a + d + c + d + b : 1 == q ? b + d + a + d + c : b + d + c + d + a
        }
        var a = this.element,
            b = null,
            c = null,
            d = null,
            g = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
            h = !(!this.options || !this.options.yearTh),
            i = !(!this.options || !this.options.langTh),
            j = !(!this.options || !this.options.changeYear);
        !this.options || this.options.changeMonth;
        a.datepicker(this.options);
        var l = a.datepicker("widget"),
            m = !1,
            n = 10;
        a.find(".ui-datepicker-inline").length > 0 && (m = !0);
        var o = a.datepicker("option", "dateFormat"),
            p = " ",
            q = 0,
            r = 1,
            s = 2; - 1 != o.indexOf("-") ? p = "-" : -1 != o.indexOf("/") && (p = "/");
        var t = o.split(p);
        "yy" == t[0] ? "mm" == t[1] ? (s = 0, r = 1, q = 2) : (s = 0, r = 2, q = 1) : "dd" == t[0] ? "mm" == t[1] ? (s = 2, r = 1, q = 0) : (s = 1, r = 2, q = 0) : "dd" == t[1] ? (s = 2, r = 0, q = 1) : (s = 1, r = 0, q = 2), i && (a.datepicker("option", "dayNamesMin", ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"]), a.datepicker("option", "monthNamesShort", g), a.datepicker("option", "monthNames", g)), h && (0 == m && (a.datepicker("option", "beforeShow", function () {
            if (setTimeout(function () {
                    $.each(l.find(".ui-datepicker-year"), function (a, b) {
                        l.find(".ui-datepicker-year").eq(a).find(":selected").length > 0 ? $.each($(".ui-datepicker-year:eq(" + a + ") option"), function (b, c) {
                            var d = parseInt($(".ui-datepicker-year:eq(" + a + ") option").eq(b).val()) + 543;
                            $(".ui-datepicker-year:eq(" + a + ") option").eq(b).text(d)
                        }) : h && setTimeout(function () {
                            c = l.find(".ui-datepicker-year").eq(a).text(), d = parseInt(c) + 543, l.find(".ui-datepicker-year").eq(a).text(d)
                        }, n)
                    })
                }, n), "" != a.val()) {
                var ee = a.val();
                var e = a.val().split(p);
                e[s] = parseInt(e[s]) - 543;
                var f = u(e[q], e[r], e[s], p);
                a.val(f), 
                b = a.val()
            }
            setTimeout(function () {
                $.each($(".ui-datepicker-year option"), function (a, b) {
                    var c = parseInt($(".ui-datepicker-year option").eq(a).val()) + 543;
                    $(".ui-datepicker-year option").eq(a).text(c)
                })
            }, n)
        }), a.datepicker("option", "onChangeMonthYear", function () {
            j ? $.each(l.find(".ui-datepicker-year"), function (a, b) {
                l.find(".ui-datepicker-year").eq(a).find(":selected").length > 0 ? $.each($(".ui-datepicker-year:eq(" + a + ") option"), function (b, c) {
                    var d = parseInt($(".ui-datepicker-year:eq(" + a + ") option").eq(b).val()) + 543;
                    $(".ui-datepicker-year:eq(" + a + ") option").eq(b).text(d)
                }) : h && setTimeout(function () {
                    c = l.find(".ui-datepicker-year").eq(a).text(), d = parseInt(c) + 543, l.find(".ui-datepicker-year").eq(a).text(d)
                }, n)
            }) : h && $.each(l.find(".ui-datepicker-year"), function (a, b) {
                l.find(".ui-datepicker-year").eq(a).find(":selected").length > 0 ? $.each($(".ui-datepicker-year:eq(" + a + ") option"), function (b, c) {
                    var d = parseInt($(".ui-datepicker-year:eq(" + a + ") option").eq(b).val()) + 543;
                    $(".ui-datepicker-year:eq(" + a + ") option").eq(b).text(d)
                }) : h && setTimeout(function () {
                    c = l.find(".ui-datepicker-year").eq(a).text(), d = parseInt(c) + 543, l.find(".ui-datepicker-year").eq(a).text(d)
                }, n)
            }), setTimeout(function () {
                $.each($(".ui-datepicker-year option"), function (a, b) {
                    var c = parseInt($(".ui-datepicker-year option").eq(a).val()) + 543;
                    $(".ui-datepicker-year option").eq(a).text(c)
                })
            }, n)
        }), a.datepicker("option", "onSelect", function (c, d) {
            b = a.val();
            var e = c.split(p);
            e[s] = parseInt(e[s]) + 543;
            var f = u(e[q], e[r], e[s], p);
            a.val(f)
        }), a.datepicker("option", "onClose", function () {
            if (j || $.each(l.find(".ui-datepicker-year"), function (a, b) {
                    c = l.find(".ui-datepicker-year").eq(a).text(), d = parseInt(c) - 543, h && setTimeout(function () {
                        l.find(".ui-datepicker-year").eq(a).text(d)
                    }, n)
                }), "" != a.val() && a.val() == b) {
                var e = b.split(p);
                e[s] = parseInt(e[s]) + 543;
                var f = u(e[q], e[r], e[s], p);
                a.val(f)
            }
        })), 1 == m && ($.each(a.find(".ui-datepicker-year"), function (b, e) {
            a.find(".ui-datepicker-year").eq(b).find(":selected").length > 0 ? $.each($(".ui-datepicker-year:eq(" + b + ") option"), function (a, c) {
                var d = parseInt($(".ui-datepicker-year:eq(" + b + ") option").eq(a).val()) + 543;
                $(".ui-datepicker-year:eq(" + b + ") option").eq(a).text(d)
            }) : h && setTimeout(function () {
                c = a.find(".ui-datepicker-year").eq(b).text(), d = parseInt(c) + 543, a.find(".ui-datepicker-year").eq(b).text(d)
            }, n)
        }), setTimeout(function () {
            $.each($(".ui-datepicker-year option"), function (a, b) {
                var c = parseInt($(".ui-datepicker-year option").eq(a).val()) + 543;
                $(".ui-datepicker-year option").eq(a).text(c)
            })
        }, n), a.datepicker("option", "onChangeMonthYear", function (b, e, f) {
            $.each(a.find(".ui-datepicker-year"), function (b, e) {
                a.find(".ui-datepicker-year").eq(b).find(":selected").length > 0 ? $.each($(".ui-datepicker-year:eq(" + b + ") option"), function (a, c) {
                    var d = parseInt($(".ui-datepicker-year:eq(" + b + ") option").eq(a).val()) + 543;
                    $(".ui-datepicker-year:eq(" + b + ") option").eq(a).text(d)
                }) : h && setTimeout(function () {
                    c = a.find(".ui-datepicker-year").eq(b).text(), d = parseInt(c) + 543, a.find(".ui-datepicker-year").eq(b).text(d)
                }, n)
            }), setTimeout(function () {
                $.each($(".ui-datepicker-year option"), function (a, b) {
                    var c = parseInt($(".ui-datepicker-year option").eq(a).val()) + 543;
                    $(".ui-datepicker-year option").eq(a).text(c)
                })
            }, n)
        }), a.datepicker("option", "onSelect", function (b, e) {
            $.each(a.find(".ui-datepicker-year"), function (b, e) {
                a.find(".ui-datepicker-year").eq(b).find(":selected").length > 0 ? $.each($(".ui-datepicker-year:eq(" + b + ") option"), function (a, c) {
                    var d = parseInt($(".ui-datepicker-year:eq(" + b + ") option").eq(a).val()) + 543;
                    $(".ui-datepicker-year:eq(" + b + ") option").eq(a).text(d)
                }) : h && setTimeout(function () {
                    c = a.find(".ui-datepicker-year").eq(b).text(), d = parseInt(c) + 543, a.find(".ui-datepicker-year").eq(b).text(d)
                }, n)
            }), setTimeout(function () {
                $.each($(".ui-datepicker-year option"), function (a, b) {
                    var c = parseInt($(".ui-datepicker-year option").eq(a).val()) + 543;
                    $(".ui-datepicker-year option").eq(a).text(c)
                })
            }, n)
        })))
    }
});