$(function() {
	// 顶部二维码鼠标滑过显示
	$("#img71popu").hover(function() {
		$(".erpopup").toggle();
	});

	// 搜索框样式
	$(".inp_nsearch").focus(
			function() {
				$(".inp_nsearch").val("").removeClass("inp_nsearch").addClass(
						"inp_nsearchcur");
				;
			});

	// 左侧导航菜单显示
	var catelistsli = $(".fp-catelists").find("li");
	var ptcatebox = $(".fp-catelistbox").find(".ptcatebox ");

	catelistsli.hover(function() {
		// alert($(this).index());
		// alert(_this3.index());
		var _this3 = $(this)
		right_nav_timer = setTimeout(function() {
			mq = _this3.index();
			ptcatebox.eq(mq).fadeIn().siblings(".ptcatebox").fadeOut();
			catelistsli.eq(mq).addClass("on").siblings().removeClass("on");
			$(".fp-module-box .lnpage").hide();
			// alert(mq);
		}, 250);

	}, function() {
		clearTimeout(right_nav_timer);
	});
	$("div:not(.fp-catelistbox)") && $("div:not(.ptcatebox)").hover(function() {
		ptcatebox.fadeOut();
		catelistsli.removeClass("on");
		$(".fp-module-box .lnpage").fadeIn('slow');
	});
	$(".closebox").click(function() {
		ptcatebox.fadeOut();
		catelistsli.removeClass("on");
		$(".fp-module-box .lnpage").fadeIn('slow');

	});

	// 海报显示隐藏
	var bnpagea = $(".lnpage").find("a");
	var categorydiv = $(".category-menu-pannel").find(".menubox");
	var catedivlength = categorydiv.length;
	var last = catedivlength - 1;
	var cur = 0;
	var timer;

	function autoPlay() {
		if (cur == last) {
			cur = 0;
		} else {
			cur++;
		}
		categorydiv.eq(cur).fadeIn('fast').siblings(".menubox").fadeOut('slow');
		bnpagea.removeClass("oncur");
		bnpagea.eq(cur).addClass("oncur");

	}
	timer = setInterval(autoPlay, 2000);
	$(".fp-category-menu").hover(function() {
		clearInterval(timer);
	}, function() {
		timer = setInterval(autoPlay, 2000);
	});

	bnpagea.hover(function() {
		var _this2 = $(this);
		bottom_nav_timer = setTimeout(function() {
			// mq=_this2.index();
			var mq = cur;
			cur = _this2.index();
			if (cur == mq) {
				return;
			}

			categorydiv.eq(cur).fadeIn('fast').siblings(".menubox").fadeOut(
					'slow');
			bnpagea.eq(cur).addClass("oncur").siblings().removeClass("oncur");
		}, 250);

	}, function() {
		clearTimeout(bottom_nav_timer);
	});

	// 内页左侧菜单列表显示
	$(".nbar .fp-catelistbox").css({
		'position' : 'absolute',
		'left' : 0,
		'display' : 'none'
	});
	$(".barhover").hover(function() {
		$(".fp-catelistbox").toggle();
	});
	;

	// 首页品牌专栏
	var bccBoxli = $(".bccBox-ul").find(".bccBox-li");
	var bccBoxwidth = bccBoxli.width();
	var bcclength = bccBoxli.length;
	var curbrand = 0;
	var tmp = bcclength - 1;
	// alert(bcclength);
	$(".bccBox-ul").css('width', bccBoxwidth * bcclength);

	$(".bccLeft").click(function() {
		if (!$(".bccBox-ul").is(":animated")) {
			if (curbrand == tmp) {
				curbrand = 0;
			} else {
				curbrand++;
			}
			var juli = -curbrand * bccBoxwidth;
			$(".bccBox-ul").animate({
				'left' : juli
			}, 500);
		}

	});
	$(".bccRight").click(function() {
		if (!$(".bccBox-ul").is(":animated")) {
			if (curbrand == 0) {
				curbrand = tmp;
			} else {
				curbrand--;
			}
			var juli = -curbrand * bccBoxwidth;
			$(".bccBox-ul").animate({
				'left' : juli
			}, 500);
		}

	});

	// 右侧top按钮
	if (navigator.userAgent.indexOf("MSIE 6.0") < 0) {
		var wid = $(window).width();
		var widb = (wid - 1176) / 2
		var widleft = widb + 1176 + 20;
		if (wid < 1176) {
			$(".fixdTop").css('left', 1196)
		} else {
			$(".fixdTop").css('left', widleft);
		}
		$(window).bind('scroll load resize', function() {
			var scroll_top = $(document).scrollTop();
			if (scroll_top == 0) {
				$(".fixdTop").fadeOut();
			} else {
				$(".fixdTop").fadeIn();
			}
		});
		$(".fixdTop a").click(function() {
			$("html,body").animate({
				scrollTop : 0
			}, 500);
		});
	} else {
		$(".fixdTop").hide();
	}

});