/**
 * ヘッダーの高さをグローバルCSS変数に格納
 * js-header-readyクラスをbodyに追加
 */
$(function () {
	function setHeaderHeight() {
		const $header = $("#header");
		if ($header.length) {
			const headerHeight = $header.outerHeight() + "px";
			$(":root").css("--header-height", headerHeight);
			$("body").addClass("js-header-ready");
		}
	}
	setHeaderHeight();
	$(window).on("resize load", setHeaderHeight);
});

var headerTag = $(".l-header");

$(window).on("load scroll", function () {
	var windowHeight = $(window).height(),
		winWidth = $(window).width(),
		winWidthSm = 941,
		topWindow = $(window).scrollTop();

	$(".js-anime").each(function () {
		var self = $(this);
		var targetPosition = self.offset().top;
		if (winWidth > winWidthSm) {
			triggerPosition = targetPosition - windowHeight + windowHeight / 5;
		} else {
			triggerPosition = targetPosition - windowHeight + windowHeight / 10;
		}
		if (topWindow > triggerPosition) {
			self.addClass("scrolled");
		}
	});
});

// $(window).on('load', function() {
// 	const url = $(location).attr('href'),
// 	headerHeight = $('header').outerHeight();

// 	if(url.indexOf("#") != -1){
// 		const anchor = url.split("#"),
// 		target = $('#' + anchor[anchor.length - 1]),
// 		position = Math.floor(target.offset().top) - headerHeight - 50;
// 		$("html, body").animate({scrollTop:position}, 500);
// 	}
// });

$(function () {
	var $header = $("#js-header");
	var scrollThreshold = 1;
	var $homeKv = $(".p-home_kv");
	var headerHeight = $header.outerHeight();
	var lastScrollTop = 0;
	var isHeaderHidden = false;
	var scrollThresholdHide = 400;
	var isLargeScreen = $(window).width() >= 992;

	function handleScroll() {
		if (!isLargeScreen) return;
		var scrollTop = $(window).scrollTop();
		// 最初のスクロールの挙動
		if (scrollTop > scrollThreshold) {
			$header.addClass("on");
		} else {
			$header.removeClass("on");
		}
		// スクロール方向を判定
		var isScrollingDown = scrollTop > lastScrollTop;
		if (scrollTop > scrollThresholdHide && !isHeaderHidden && isScrollingDown) {
			// 400pxを超えて、下スクロール中の場合
			$header.animate(
				{
					top: -headerHeight,
				},
				10,
			);
			isHeaderHidden = true;
		} else if (
			(scrollTop <= scrollThresholdHide || !isScrollingDown) &&
			isHeaderHidden
		) {
			// 400px以内に戻った、または上スクロール中の場合
			$header.animate(
				{
					top: 0,
				},
				10,
			);
			isHeaderHidden = false;
		}
		lastScrollTop = scrollTop;
	}

	function handleResize() {
		isLargeScreen = $(window).width() >= 992;
		headerHeight = $header.outerHeight();
		if (!isLargeScreen) {
			$header.css("top", "");
			isHeaderHidden = false;
		}
	}

	$(window).scroll(handleScroll);
	//$(window).resize(handleResize);

	// 初期化
	handleResize();
});

$(function () {
	var totop = $("#js-totop");
	totop.hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			totop.fadeIn();
		} else {
			totop.fadeOut();
		}
	});
	totop.click(function () {
		$("body, html").animate({ scrollTop: 0 }, 500);
		return false;
	});
});

$(".js-mvSlide").slick({
	fade: true,
	autoplay: true,
	autoplaySpeed: 6000,
	speed: 1200,
	arrows: false,
	dots: true,
	pauseOnFocus: false,
	pauseOnHover: false,
});

jQuery(function ($) {
	const $modal = $("#imgModal");
	const $img = $("#imgModal img");
	const scale = 2.5;

	let isDragging = false;
	let startX,
		startY,
		moveX = 0,
		moveY = 0;

	// サムネクリックでモーダル表示
	$(".item-image").on("click", function () {
		const src = $(this).find("img").attr("src");
		$img
			.attr("src", src)
			.removeClass("zoomed dragging")
			.css("transform", "translate(-50%, -50%) scale(1)");
		moveX = moveY = 0; // 中央リセット
		$modal.fadeIn();
	});

	// クリックで拡大/縮小切り替え
	$img.on("click", function (e) {
		if (!$img.hasClass("zoomed") && !isDragging) {
			$img
				.addClass("zoomed")
				.css(
					"transform",
					`translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px)) scale(${scale})`,
				);
		} else if (!isDragging) {
			$img
				.removeClass("zoomed")
				.css("transform", "translate(-50%, -50%) scale(1)");
			moveX = moveY = 0;
		}
	});

	// ドラッグ開始
	$img.on("mousedown", function (e) {
		if ($img.hasClass("zoomed")) {
			isDragging = true;
			$img.addClass("dragging");
			startX = e.pageX - moveX;
			startY = e.pageY - moveY;
			e.preventDefault();
		}
	});

	// ドラッグ移動
	$(document).on("mousemove", function (e) {
		if (isDragging) {
			moveX = e.pageX - startX;
			moveY = e.pageY - startY;
			$img.css(
				"transform",
				`translate(calc(-50% + ${moveX}px), calc(-50% + ${moveY}px)) scale(${scale})`,
			);
		}
	});

	// ドラッグ終了
	$(document).on("mouseup", function () {
		if (isDragging) {
			isDragging = false;
			$img.removeClass("dragging");
		}
	});

	// 背景クリックで閉じる
	$modal.on("click", function (e) {
		if (e.target.id === "imgModal") {
			$modal.fadeOut();
		}
	});
});
