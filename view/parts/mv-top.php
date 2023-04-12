<?php
$mv_type = get_post_meta(81, 'media_select', true);
$mv_img = wp_get_attachment_url(get_post_meta(81, 'mv_img', true));
$mv_img2 = wp_get_attachment_url(get_post_meta(81, 'mv_img2', true));
$mv_img3 = wp_get_attachment_url(get_post_meta(81, 'mv_img3', true));
$mv_movie = wp_get_attachment_url(get_post_meta(81, 'mv_movie', true));
$mv_poster = wp_get_attachment_url(get_post_meta(81, 'mv_poster', true));
$main_title = get_post_meta(81, 'main_title', true);
$sub_title = get_post_meta(81, 'sub_title', true);
//スライダー画像が1枚だけかどうか判定
if (!empty($mv_img2) || !empty($mv_img3)) {
	$mv_check = 'slider';
} else {
	$mv_check = 'single';
}
?>

<!-- 表示設定で画像を選択、登録画像が1枚の場合（固定画像表示） -->
<?php if ($mv_type == 'img' && $mv_check == 'single') : ?>
<section class="section-mv">
	<img src="<?php echo $mv_img; ?>" alt="">
	<div class="text">
		<h2 style="color: #fff;"><?php echo $main_title; ?></h2>
		<p><?php echo $sub_title; ?></p>
	</div>
	<span class="anchor" id="mv"></span>
</section>
<?php endif; ?>

<!-- 表示設定で画像を選択、登録画像が複数の場合（スライダー表示） -->
<?php if ($mv_type == 'img' && $mv_check == 'slider') : ?>
<div class="swiper-container">
	<div class="swiper-wrapper">
		<?php if ($mv_img) : ?>
		<div class="swiper-slide"><img class="img-fluid" src="<?php echo $mv_img; ?>" alt=""></div>
		<?php endif; ?>
		<?php if ($mv_img2) : ?>
		<div class="swiper-slide"><img class="img-fluid" src="<?php echo $mv_img2; ?>" alt=""></div>
		<?php endif; ?>
		<?php if ($mv_img3) : ?>
		<div class="swiper-slide"><img class="img-fluid" src="<?php echo $mv_img3; ?>" alt=""></div>
		<?php endif; ?>
	</div>
	<div class="swiper-pagination"></div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
	<span class="anchor" id="mv"></span>
</div>
<?php endif; ?>

<!-- 表示設定で動画を選択（背景動画表示） -->
<?php if ($mv_type == 'movie') : ?>
<section class="section-mv">
	<video poster="<?php echo $mv_poster ;?>" muted src="<?php echo $mv_movie; ?>" playsinline muted autoplay loop>
		<img src="<?php echo $mv_img; ?>" alt="">
	</video>
	<span class="anchor" id="mv"></span>
</section>

<?php endif; ?>