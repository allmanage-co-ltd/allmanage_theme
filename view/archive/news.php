<?php
get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$args = [
  'post_type' => '',
  'orderby' => '',
  'order' => 'DESC',
  'posts_per_page' => -1,
  'paged' =>  $paged,
];
$query = new WP_Query($args);
?>

<main class="">

  <div class="p-kv_under">
    <div class="p-kv_under__inner">
      <div class="c-inner">
        <div class="p-kv_under__ttl">
          <div class="en">Title</div>
          <div class="jp">タイトル</div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-inner">
    <?php breadcrumb(); ?>
  </div>

  <section>
    <?php if ($query->have_posts()): ?>
    <div class="">
      <?php while ($query->have_posts()): $query->the_post(); ?>
      <div class="">

      </div>
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
    </div>
    <?php endif; ?>
    <?php else: ?>
    <p class="u-center u-mgt_xxl">
      投稿がありません
    </p>
    <?php endif; ?>
  </section>

</main>

<?php
get_footer();

?>