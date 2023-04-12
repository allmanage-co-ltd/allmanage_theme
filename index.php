<?php get_header(); ?>

<section class="section-01">
	<div class="contents-box">
		<h2 class="sub_title">NEWS<span>最新情報</span></h2>
		<div class="item-header">
			<h2>NEWS<span>最新情報</span></h2>
			<div class="btn_area">
				<a href="<?php echo home(); ?>news" class="btn angle">一覧を見る</a>
			</div>
		</div>
		<div class="item-area">
			<?php
			$args = array(
				'post_type' => 'news-list',
				'paged' => $paged,
				'posts_per_page' => '3'
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) :
			?>
			<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
			<div class="item-box">
				<div class="img-box">
					<a href="<?php the_permalink(); ?>">
						<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('full'); ?>
						<?php else : ?>
						<img src="http://placehold.jp/eeeeee/cccccc/280x200.png?text=No%20Image" alt="">
						<?php endif; ?></a>
				</div>
				<time><?php the_time('Y.m.d'); ?></time>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<ul class="tag_area">
					<?php
							$terms = wp_get_object_terms($post->ID, 'store-term');
							$news_terms = wp_get_object_terms($post->ID, 'news-term');
							foreach ($terms as $term) {
								$slag_name = $term->name;
							}
							?>
					<?php if ($slag_name) : ?>
					<?php echo '<li>' . $slag_name . '</li>'; ?>
					<?php endif; ?>

					<?php foreach ($news_terms as $news_term) : ?>
					<?php
								$news_name = $news_term->name;

								?>
					<li><?php echo $news_name; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php else : ?>

			<h3 class="text-center">公開中の新着情報はありません</h3>

			<?php endif; ?>

		</div>
	</div>
</section>
<section class="section-02">
	<div class="contents-box">
		<div class="item-header">
			<h2>RECRUIT<span>採用情報</span></h2>
			<div class="btn_area">
				<a href="<?php echo home(); ?>recruit" class="btn angle">採用情報はこちら</a>
			</div>
		</div>
		<div class="item-area">
			<img class="img-fluid" src="<?php echo img_dir(); ?>page/img-01.png" alt="">
		</div>
	</div>
	<div class="contents-box">
		<div class="item-header">
			<h2>LOCATION<span>出店用地募集</span></h2>
			<p>エスエープランニングでは出店させていただける土地を随時募集致しております。</p>
			<div class="btn_area">
				<a href="<?php echo home(); ?>for_opening" class="btn angle">詳しくはこちら</a>
				<a href="<?php echo home(); ?>contact" class="btn angle">お問合せはこちら</a>
			</div>
		</div>
		<div class="item-area">
			<img class="img-fluid" src="<?php echo img_dir(); ?>page/img-02.png" alt="">
		</div>
	</div>
</section>
<section class="section-03">

	<h2>STORE<span>店舗情報</span></h2>

	<div class="contents-box">
		<div class="img-box">
			<img class="img-base img-fluid" src="<?php echo img_dir(); ?>page/map-01.png" alt="">
			<img class="pref-01 img-fluid" src="<?php echo img_dir(); ?>page/pref-01.png" alt="">
			<img class="pref-02 img-fluid" src="<?php echo img_dir(); ?>page/pref-02.png" alt="">
			<img class="pref-03 img-fluid" src="<?php echo img_dir(); ?>page/pref-03.png" alt="">
			<img class="pref-04 img-fluid" src="<?php echo img_dir(); ?>page/pref-04.png" alt="">
			<img class="pref-05 img-fluid" src="<?php echo img_dir(); ?>page/pref-05.png" alt="">
			<img class="pref-06 img-fluid" src="<?php echo img_dir(); ?>page/pref-06.png" alt="">
		</div>
		<div class="item-box">
			<h3>―　エリアを選択してください　―</h3>
			<ul class="pref">
				<?php
				$args = array(
					'parent' => 0,
					'orderby' => 'term_order',
					'order' => 'DISC',
					'post_type' => 'store-list',
					'taxonomy' => 'pref-term',
					'hide_empty' => '0'
				);
				$categories = get_categories($args);
				?>
				<?php foreach ($categories as $category) : ?>
				<li data-img_list="<?php echo $category->slug; ?>"><a
						href="<?php echo home(); ?>store?pref=<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
				</li>
				<?php endforeach; ?>

			</ul>
		</div>
	</div>
</section>


<?php
get_footer(); ?>