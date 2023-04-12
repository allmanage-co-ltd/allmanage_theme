<?php
global $wp_query;
$post_obj = $wp_query->get_queried_object();
$slug = $post_obj->post_name;
$cat_slug = $post_obj->category_nicename;
$tag_slug = $post_obj->slug;

$title = get_the_title();
$sub_title = $slug; ?>
<?php if (is_singular('store-list')) : ?>
<section class="section-mv_page">
	<h2 class="sub_title">店舗情報<span>STORE</span></h2>
</section>
<?php elseif (is_singular('news-list')) : ?>
<section class="section-mv_page">
	<h2 class="sub_title">NEWS<span><?php echo $title; ?></span></h2>
</section>
<?php elseif (is_search()) : ?>
<section class="section-mv_page">
	<h2>最新情報
		<span>NEWS</span>
	</h2>
</section>
<?php else : ?>
<section class="section-mv_page">
	<h2 class="sub_title"><?php echo $title; ?><span><?php echo $sub_title; ?></span></h2>
</section>
<?php endif; ?>