$('.pref li').hover(function () {
	var pref = $(this).attr('data-img_list')
	$('.img-box').children('.' + pref).addClass('active')
}, function () {
	$('.img-box img').removeClass('active')
})

// $('.drawer-link form').attr('id', 'searchform-dw')
// $('.drawer-link form input').attr('id', 'ss')

$('#mv').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('header').removeClass('mv-in');
	} else {
		//表示領域から出た時
		$('header').addClass('mv-in');
	}
});

$('.recruit #mv').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('header').removeClass('mv-in');
	} else {
		//表示領域から出た時
		$('header').removeClass('mv-in');
	}
});
$('#mv-recruit').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.mv-staff').removeClass('mv-in');
		$('header').removeClass('mv-in');
	} else {
		//表示領域から出た時
		$('.mv-staff').addClass('mv-in');
	}
});
$('.recruit header').removeClass('mv-in');

$('#recruit_01').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.recruit-frame ul').addClass('in');
	} else {
		//表示領域から出た時
		$('.recruit-frame ul').removeClass('in');
	}
});
$('#recruit_02').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.section-recruit_02 h3').addClass('in');
	} else {
		//表示領域から出た時
		$('.section-recruit_02 h3').removeClass('in');
	}
});
$('#recruit_03').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.section-recruit_03 h3').addClass('in');
	} else {
		//表示領域から出た時
		$('.section-recruit_03 h3').removeClass('in');
	}
});
$('#recruit_02_01').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.section-recruit_02 .movie-box').addClass('in');
	} else {
		//表示領域から出た時
		$('.section-recruit_02 .movie-box').removeClass('in');
	}
});
$('#recruit_03_01').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.section-recruit_03 .movie-box').addClass('in');
	} else {
		//表示領域から出た時
		$('.section-recruit_03 .movie-box').removeClass('in');
	}
});
$('.section-mv').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.topto').addClass('out');
		$('.recruitto').removeClass('in');
	} else {
		//表示領域から出た時
		$('.topto').removeClass('out');
		$('.recruitto').addClass('in');
	}
});
$('#recruit_04').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
	} else {
		//表示領域から出た時
		$('.section-recruit_04 .contents').removeClass('right-on left-on');
	}
});
$('#recruit_07').on('inview', function (event, isInView) {
	if (isInView) {
		//表示領域に入った時
		$('.section-recruit_07').addClass('out');
	} else {
		//表示領域から出た時
		$('.section-recruit_07').removeClass('out');
	}
});
$('.tgl-tb h4').on('click', function () {
	$(this).next('ul').toggle('fast')
	$(this).toggleClass('open')

})
