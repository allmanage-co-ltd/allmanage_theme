<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<?php do_action('tracking_code_head'); ?>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action('tracking_code_body'); ?>

	<?php
	if (is_page() || is_single() || is_search()) {
		$header_class = 'mv-in';
	}; ?>
	<?php if (!empty($header_class)) : ?>
	<header class="<?php echo $header_class; ?>">
		<?php else : ?>
		<header>
			<?php endif; ?>
			<h1>
				<?php if (is_page('recruit')) : ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<?php else : ?>
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php endif; ?>

						<img src="src/img/common/logo-w.png" alt="人と遊びの再創造 Re-Creation" class="img-fluid">
						<img class="b img-fluid" src="src/img/common/logo-b.png" alt="人と遊びの再創造 Re-Creation" class="img-fluid">
						<img class="r" src="src/img/common/logo-recruit.png" alt="人と遊びの再創造 Re-Creation" class="img-fluid">
					</a>

					<p class="recruit_title">ジャンジャングループ<span>採用情報サイト</span></p>

			</h1>

			<nav>

				<?php get_template_part('view/parts/menu-list'); ?>


			</nav>
			<form method="get" id="searchform" action="<?php echo home(); ?>">
				<i class="fas fa-search"></i>
				<input type="text" value="" name="s" class="s" placeholder="サイト内投稿記事検索" />
				<input type="hidden" name="post_type" value="news-list">
				<button type="submit" class="s-btn-area">
					<div class="s-btn">検索</div>
				</button>
			</form>
			</section>
			<div class="meilto">
				<a href="<?php echo home(); ?>contact"><i class="fas fa-envelope"></i>お問い合わせ</a>
			</div>
			<?php if (is_page('recruit')) : ?>
			<div class="recruitto">
				<a href="#store">RECRUIT<span>ご応募はこちら</span></a>
			</div>
			<?php endif; ?>
			<nav class="drawer">
				<input id="hamburger" class="hamburger" type="checkbox" />
				<label class="hamburger" for="hamburger">
					<i></i>
					<text>
						<close>close</close>
						<open>menu</open>
					</text>
				</label>
				<section class="drawer-list">

					<div class="drawer-link">
						<?php if (is_page('recruit')) : ?>
						<?php get_template_part('view/parts/menu-list-recruit'); ?>
						<?php else : ?>
						<?php get_template_part('view/parts/menu-list-mb'); ?>
						<?php endif; ?>
					</div>
				</section>
			</nav>
		</header>
		<?php if (is_home() || is_front_page()) : ?>
		<?php get_template_part('view/parts/mv-top'); ?>
		<?php else : ?>
		<?php if (is_page('recruit')) : ?>
		<?php get_template_part('view/parts/mv-recruit'); ?>
		<?php else : ?>
		<?php get_template_part('view/parts/mv-page'); ?>
		<?php endif; ?>
		<?php endif; ?>