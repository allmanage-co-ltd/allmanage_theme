<?php
get_header();

$type = 'news';
$tax = 'news_cat';

$current_term = get_queried_object();
$term_slug    = $current_term->slug;
$is_column_cat = is_tax($tax);
$is_taxonomy = $is_column_cat || $is_column_tag;
$taxonomy_name = '';

if ($is_column_cat) {
  $taxonomy_name = $tax;
}

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$args = [
  'post_type' => $type,
  'posts_per_page' => 12,
  'order' => 'DESC',
  'paged' =>  $paged,
];
if ($is_taxonomy && $current_term) {
  $args['tax_query'] = [[
    'taxonomy' => $taxonomy_name,
    'field'    => 'slug',
    'terms'    => $term_slug,
  ]];
}
$query = new WP_Query($args);
?>

<main class="p-news -archive">

  <div class="p-kv_under">
    <div class="p-kv_under__inner">
      <div class="c-inner">
        <div class="p-kv_under__ttl">
          <div class="en">NEWS</div>
          <div class="jp">お知らせ</div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-inner">
    <?php breadcrumb(); ?>
  </div>

  <section class="l-content -under">
    <div class="c-inner">
      <?php if ($query->have_posts()): ?>
      <ul class="">
        <?php while ($query->have_posts()): $query->the_post(); ?>
        <li class="">

        </li>
        <?php endwhile; ?>
        <?php
          $links = paginate_links(array(
            'total'        => $loop->max_num_pages,
            'current'      => $paged,
            'mid_size'     => 2,
            'prev_text'    => '←',
            'next_text'    => '→',
            'type'         => 'array',
          ));
          if ($links) :
          ?>
        <nav class="wp-pager" role="navigation" aria-label="ページナビゲーション">
          <ul class="wp-pager__list">
            <?php foreach ($links as $link) : ?>
            <li class="wp-pager__item"><?= $link; ?></li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </ul>
      <?php endif; ?>
      <?php else: ?>
      <p class="u-center u-mgt_xxl">
        投稿がありません
      </p>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php
get_footer();

?>