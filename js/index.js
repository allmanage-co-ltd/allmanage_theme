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
