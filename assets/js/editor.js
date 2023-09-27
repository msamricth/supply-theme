wp.domReady( () => {
    wp.blocks.unregisterBlockType( 'core/archives');
    wp.blocks.unregisterBlockType( 'core/audio');
    wp.blocks.unregisterBlockType( 'core/button');
    wp.blocks.unregisterBlockType( 'core/buttons');
    wp.blocks.unregisterBlockType( 'core/categories');
    wp.blocks.unregisterBlockType( 'core/column');
    wp.blocks.unregisterBlockType( 'core/columns');
    wp.blocks.unregisterBlockType( 'core/cover');
    wp.blocks.unregisterBlockType( 'core/file');
    wp.blocks.unregisterBlockType( 'core/latest-comments');
    wp.blocks.unregisterBlockType( 'core/latest-posts');
    wp.blocks.unregisterBlockType( 'core/group');
    wp.blocks.unregisterBlockType( 'core/heading');
    wp.blocks.unregisterBlockType( 'core/list');
    wp.blocks.unregisterBlockType( 'core/media-text');
    wp.blocks.unregisterBlockType( 'core/navigation');
    wp.blocks.unregisterBlockType( 'core/navigation-link');
    wp.blocks.unregisterBlockType( 'core/preformatted');
    wp.blocks.unregisterBlockType( 'core/pullquote');
    wp.blocks.unregisterBlockType( 'core/quote');
    wp.blocks.unregisterBlockType( 'core/rss');
    wp.blocks.unregisterBlockType( 'core/search');
    wp.blocks.unregisterBlockType( 'core/separator');
    wp.blocks.unregisterBlockType( 'core/social-link');
    wp.blocks.unregisterBlockType( 'core/social-links');
    wp.blocks.unregisterBlockType( 'core/spacer');
    wp.blocks.unregisterBlockType( 'core/video');
  } );  
  const enableSidebarSelectOnBlocks = ['acf/supply-list-block', 'acf/supply-content-block'];
  parcelRequire = function(e, r, t, n) {
    var i, o = "function" == typeof parcelRequire && parcelRequire,
        u = "function" == typeof require && require;

    function f(t, n) {
        if (!r[t]) {
            if (!e[t]) {
                var i = "function" == typeof parcelRequire && parcelRequire;
                if (!n && i) return i(t, !0);
                if (o) return o(t, !0);
                if (u && "string" == typeof t) return u(t);
                var c = new Error("Cannot find module '" + t + "'");
                throw c.code = "MODULE_NOT_FOUND", c
            }
            p.resolve = function(r) {
                return e[t][1][r] || r
            }, p.cache = {};
            var l = r[t] = new f.Module(t);
            e[t][0].call(l.exports, p, l, l.exports, this)
        }
        return r[t].exports;

        function p(e) {
            return f(p.resolve(e))
        }
    }
    f.isParcelRequire = !0, f.Module = function(e) {
        this.id = e, this.bundle = f, this.exports = {}
    }, f.modules = e, f.cache = r, f.parent = o, f.register = function(r, t) {
        e[r] = [function(e, r) {
            r.exports = t
        }, {}]
    };
    for (var c = 0; c < t.length; c++) try {
        f(t[c])
    } catch (e) {
        i || (i = e)
    }
    if (t.length) {
        var l = f(t[t.length - 1]);
        "object" == typeof exports && "undefined" != typeof module ? module.exports = l : "function" == typeof define && define.amd ? define(function() {
            return l
        }) : n && (this[n] = l)
    }
    if (parcelRequire = f, i) throw i;
    return f
}({
    "9bLa": [function(require, module, exports) {
        var n = 9007199254740991,
            r = "[object Arguments]",
            t = "[object Function]",
            e = "[object GeneratorFunction]",
            u = /^(?:0|[1-9]\d*)$/;

        function o(n, r, t) {
            switch (t.length) {
                case 0:
                    return n.call(r);
                case 1:
                    return n.call(r, t[0]);
                case 2:
                    return n.call(r, t[0], t[1]);
                case 3:
                    return n.call(r, t[0], t[1], t[2])
            }
            return n.apply(r, t)
        }

        function c(n, r) {
            for (var t = -1, e = Array(n); ++t < n;) e[t] = r(t);
            return e
        }

        function a(n, r) {
            return function(t) {
                return n(r(t))
            }
        }
        var i = Object.prototype,
            l = i.hasOwnProperty,
            f = i.toString,
            v = i.propertyIsEnumerable,
            p = a(Object.keys, Object),
            s = Math.max,
            y = !v.call({
                valueOf: 1
            }, "valueOf");

        function h(n, r) {
            var t = S(n) || F(n) ? c(n.length, String) : [],
                e = t.length,
                u = !!e;
            for (var o in n) !r && !l.call(n, o) || u && ("length" == o || m(o, e)) || t.push(o);
            return t
        }

        function g(n, r, t) {
            var e = n[r];
            l.call(n, r) && x(e, t) && (void 0 !== t || r in n) || (n[r] = t)
        }

        function b(n) {
            if (!w(n)) return p(n);
            var r = [];
            for (var t in Object(n)) l.call(n, t) && "constructor" != t && r.push(t);
            return r
        }

        function d(n, r) {
            return r = s(void 0 === r ? n.length - 1 : r, 0),
                function() {
                    for (var t = arguments, e = -1, u = s(t.length - r, 0), c = Array(u); ++e < u;) c[e] = t[r + e];
                    e = -1;
                    for (var a = Array(r + 1); ++e < r;) a[e] = t[e];
                    return a[r] = c, o(n, this, a)
                }
        }

        function j(n, r, t, e) {
            t || (t = {});
            for (var u = -1, o = r.length; ++u < o;) {
                var c = r[u],
                    a = e ? e(t[c], n[c], c, t, n) : void 0;
                g(t, c, void 0 === a ? n[c] : a)
            }
            return t
        }

        function O(n) {
            return d(function(r, t) {
                var e = -1,
                    u = t.length,
                    o = u > 1 ? t[u - 1] : void 0,
                    c = u > 2 ? t[2] : void 0;
                for (o = n.length > 3 && "function" == typeof o ? (u--, o) : void 0, c && A(t[0], t[1], c) && (o = u < 3 ? void 0 : o, u = 1), r = Object(r); ++e < u;) {
                    var a = t[e];
                    a && n(r, a, e, o)
                }
                return r
            })
        }

        function m(r, t) {
            return !!(t = null == t ? n : t) && ("number" == typeof r || u.test(r)) && r > -1 && r % 1 == 0 && r < t
        }

        function A(n, r, t) {
            if (!M(t)) return !1;
            var e = typeof r;
            return !!("number" == e ? k(t) && m(r, t.length) : "string" == e && r in t) && x(t[r], n)
        }

        function w(n) {
            var r = n && n.constructor;
            return n === ("function" == typeof r && r.prototype || i)
        }

        function x(n, r) {
            return n === r || n != n && r != r
        }

        function F(n) {
            return E(n) && l.call(n, "callee") && (!v.call(n, "callee") || f.call(n) == r)
        }
        var S = Array.isArray;

        function k(n) {
            return null != n && I(n.length) && !G(n)
        }

        function E(n) {
            return P(n) && k(n)
        }

        function G(n) {
            var r = M(n) ? f.call(n) : "";
            return r == t || r == e
        }

        function I(r) {
            return "number" == typeof r && r > -1 && r % 1 == 0 && r <= n
        }

        function M(n) {
            var r = typeof n;
            return !!n && ("object" == r || "function" == r)
        }

        function P(n) {
            return !!n && "object" == typeof n
        }
        var $ = O(function(n, r) {
            if (y || w(r) || k(r)) j(r, q(r), n);
            else
                for (var t in r) l.call(r, t) && g(n, t, r[t])
        });

        function q(n) {
            return k(n) ? h(n) : b(n)
        }
        module.exports = $;
    }, {}],
    "0/j4": [function(require, module, exports) {
        "use strict";
        var e = t(require("lodash.assign"));

        function t(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        var a = wp.compose.createHigherOrderComponent,
            n = wp.element.Fragment,
            l = wp.editor.InspectorControls,
            r = wp.components,
            i = r.PanelBody,
            c = r.SelectControl,
            o = wp.hooks.addFilter,
            s = wp.i18n.__,
            u = enableSidebarSelectOnBlocks,
            p = [{
                label: s("None"),
                value: ""
            }, {
                label: s("Small"),
                value: "cp1"
            }, {
                label: s("Medium"),
                value: "cp2"
            }, {
                label: s("Large"),
                value: "cp3"
            }],
            m = function(t, a) {
                return u.includes(a) ? (t.attributes = (0, e.default)(t.attributes, {
                    spacing: {
                        type: "string",
                        default: p[0].value
                    }
                }), t) : t
            };
        o("blocks.registerBlockType", "extend-block-example/attribute/spacing", m);
        var g = a(function(e) {
            return function(t) {
                if (!u.includes(t.name)) return React.createElement(e, t);
                var a = t.attributes.spacing;
                return a && (t.attributes.className = "".concat(a)), React.createElement(n, null, React.createElement(e, t), React.createElement(l, null, React.createElement(i, {
                    title: s("Spacing"),
                    initialOpen: !0
                }, React.createElement(c, {
                    label: s("Margin Bottom"),
                    value: a,
                    options: p,
                    onChange: function(e) {
                        t.setAttributes({
                            spacing: e
                        })
                    }
                }))))
            }
        }, "withSpacingControl");
        o("editor.BlockEdit", "extend-block-example/with-spacing-control", g);
        var d = function(t, a, n) {
            if (!u.includes(a.name)) return t;
           
            return n.spacing in l && (0, e.default)(t, {
               
            }), t
        };
        o("blocks.getSaveContent.extraProps", "extend-block-example/get-save-content/extra-props", d);
    }, {
        "lodash.assign": "9bLa"
    }],
    "KQUp": [function(require, module, exports) {
        "use strict";
        require("./spacing-control");
    }, {
        "./spacing-control": "0/j4"
    }]
}, {}, ["KQUp"], null)
