<ul>
	<li><a href="<?php echo home(); ?>">ホーム</a></li>
	<li><a href="<?php echo home(); ?>recruit">採用情報</a></li>
	<li class="company_info"><a href="<?php echo home(); ?>company"><i class="fas fa-angle-down"></i>会社概要</a>
		<div class="d_menu single-menu">
			<ul>
				<li><a href="<?php echo home(); ?>our_mission">経営者の想い・企業としての使命</a></li>
				<li><a href="<?php echo home(); ?>feature">事業の特徴と強み</a></li>
				<li><a href="<?php echo home(); ?>mission">ミッション</a></li>
				<li><a href="<?php echo home(); ?>csr">CSR活動</a></li>
			</ul>
		</div>
	</li>
	<li><a href="<?php echo home(); ?>for_opening">出店用地募集</a></li>
	<li class="store_info"><a href="<?php echo home(); ?>store"><i class="fas fa-angle-down"></i>店舗情報</a>
		<?php
						$my_posts = get_posts(array(
							'post_type' => 'store-list',
							'meta_key' => 'new_open',
							'meta_value' => true, 
						));
						$count = count($my_posts);
		?>
		<div class="d_menu <?php if($count == 0){echo 'old_only';} ;?>">
			<h3><i class="fas fa-search"></i>店舗を探す</h3>
			<div class="contents">
				<section>
					<h4>関東</h4>
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
				</section>
				<section class="new_open">
					<h4>ニューオープンの店舗</h4>
					<ul>
						<?php
						$args = array(
							'post_type' => 'store-list',
							'posts_per_page' => '2',
							'meta_key' => 'new_open', // カスタムフィールドの項目名
							'meta_value' => true, // カスタムフィールドの値

						);
						$the_query = new WP_Query($args);?>
						<?php if ($the_query->have_posts()) :; ?>
						<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
						<?php $address = get_post_meta($post->ID, 'address', true); ?>
						<li><a href="<?php the_permalink(); ?>"><time><?php the_time('Y.m.d'); ?></time>
								<p><?php echo the_title(); ?><br>
									<?php echo $address; ?></p>
								<i class="fas fa-chevron-circle-right"></i>
							</a></li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						<?php else : ?>
						<li>ニューオープンの情報はありません</li>
						<?php endif; ?>
					</ul>
				</section>
			</div>
		</div>
	</li>
</ul>