var TB = TB || {};
TB.Header = function() {
	var g = function(v) {
		return typeof (v) != "string" ? v : document.getElementById(v)
	}, s = navigator.userAgent.toLowerCase(), o = /msie/.test(s)
			&& !/opera/.test(s), l = o && !/msie 7/.test(s)
			&& !/msie 8/.test(s);
	var i = {
		trim : function(v) {
			return v.replace(/^\s+|\s+$/g, "")
		},
		hasClass : function(w, v) {
			w = g(w);
			if (!w || !v || !w.className) {
				return false
			}
			return (" " + w.className + " ").indexOf(" " + v + " ") > -1
		},
		addClass : function(w, v) {
			w = g(w);
			if (!w || !v) {
				return
			}
			if (this.hasClass(w, v)) {
				return
			}
			w.className += " " + v
		},
		removeClass : function(w, v) {
			w = g(w);
			if (!this.hasClass(w, v)) {
				return
			}
			w.className = w.className.replace(new RegExp(v, "g"), "");
			if (!this.trim(w.className)) {
				w.removeAttribute(o ? "className" : "class")
			}
		},
		getElementsByClassName : function(w, B, v, A) {
			if (!g(v)) {
				return
			}
			var x = [], z = g(v).getElementsByTagName(B), y = 0;
			for (; y < z.length; y++) {
				if (i.hasClass(z[y], w)) {
					x[x.length] = z[y];
					arguments[3] && arguments[3].call(z[y])
				}
			}
			return x
		}
	};
	function a(x) {
		if (!x) {
			return;
		}
		var w = i.getElementsByClassName("menu-bd", "div", x)[0];
		if (!w) {
			return;
		}
		x.menulist = w;
		x.onmouseenter = function() {
			i.addClass(this.parentNode, "hover");
		};
		x.onmouseleave = function() {
			i.removeClass(this.parentNode, "hover");
		}
	}
	return {
		init : function(w) {
			if (l) {
				var v = i.getElementsByClassName("menu", "div", "site-nav",
						function() {
							a(this)
						})
			}
		}
	}
}();