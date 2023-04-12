<?php get_header(); ?>
<section class="section-breadcrumb">
	<div class="container">
		<?php breadcrumb(); ?>
	</div>
</section>
<section class="section-05">
	<div class="container">
		<?php
		$set_pref = $_GET['pref'];
		if (empty($set_pref)) {
			$set_pref = 'pref-01';
		}
		?>

		<main data-set_pref="<?php echo $set_pref; ?>">
			<ul class="pref-list">
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
				<li class="<?php echo $category->slug; ?>"><?php echo $category->name; ?>
				</li>
				<?php endforeach; ?>

				<?php
				$my_posts = get_posts(array(
					'post_type' => 'store-list',
					'meta_key' => 'new_open',
					'meta_value' => true,
				));
				$count = count($my_posts); ?>
				<?php if ($count !== 0) : ?>
				<li class="new_store">新店</li>
				<?php endif; ?>

			</ul>
			<div class="item-area">
				<?php

				$args = array(
					'post_type' => 'store-list',
					'posts_per_page' => -1 //15
				);
				$the_query = new WP_Query($args);
				if ($the_query->have_posts()) :
				?>

				<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php
						$terms = wp_get_object_terms($post->ID, 'pref-term');

						foreach ($terms as $term) {
							$slag_name = $term->name;
							$slug = $term->slug;
						}
						?>
				<?php
						$new_store = get_post_meta($post->ID, 'new_open', false);
						$app_group = get_post_meta($post->ID, 'app_group', true);
						if (is_array($app_group)) {
							$recruit_img = true;
						} else {
							$recruit_img = false;
						}
						if (!empty($new_store)) {
							foreach ($new_store as $value) {
								if ($value == '1') {
									$value = true;
								} else {
									$value = false;
								}
								$new_store_value = $value;
							}
						} else {
							$new_store_value = false;
						}

						$address = get_post_meta($post->ID, 'address', true);
						$new_store_text = nl2br(get_post_meta($post->ID, 'new-open_text', true));
						if ($new_store_value == 'new') {
							$new_store = 'true';
						} else {
							$new_store = 'false';
						}; ?>
				<div class="item-box" data-pref="<?php echo $slug; ?>" data-new_store="<?php echo $new_store; ?>">
					<div class="img-box">
						<?php if ($new_store == 'true') : ?>
						<p class="new_store_text">
							<?php echo $new_store_text; ?>
						</p>
						<?php endif; ?>
						<?php if ($recruit_img == true) : ?>
						<img src="<?php echo img_dir(); ?>page/recruit.png" class="recruit-img" alt="">
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>">
							<?php
										$store_id = $post->ID;
										$store_img = get_post_meta($store_id, 'store_img', true);
										$img_dir = wp_get_attachment_url($store_img);
										?>
							<?php if ($img_dir) : ?>
							<p><img class="img-fluid" src="<?php echo $img_dir; ?>" alt=""></p>
							<?php else : ?>
							<img src="http://placehold.jp/eeeeee/cccccc/420x260.png?text=No%20Image" class="img-fluid" alt="">
							<?php endif; ?>
						</a>
					</div>
					<div class="contents-box">
						<ul class="tag_area">

							<li><?php echo $slag_name; ?></li>
						</ul>
						<h4><?php the_title(); ?></h4>
						<dl>
							<dt>住所</dt>
							<dd><?php echo $address; ?></dd>
						</dl>
						<div class="btn_area">
							<a href="<?php the_permalink(); ?>" class="btn angle">店舗詳細</a>
							<a href="<?php the_permalink(); ?>?tab=tab-04" class="btn angle">MAP</a>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				<?php else : ?>

				<h3 class="text-center">公開中の店舗情報はありません</h3>

				<?php endif; ?>


			</div>
		</main>
	</div>
</section>



<?php
get_footer(); ?>