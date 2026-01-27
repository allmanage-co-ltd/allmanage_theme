<?php
get_header();

$search_query = get_search_query();

if (!empty($search_query)) {
  $paged = max(1, get_query_var('paged'), get_query_var('page'));
  $query = new WP_Query([
    'post_type' => '',
    's' => $search_query,
    'posts_per_page' => 10,
    'paged' => $paged,
    // 'tax_query' => [[
    //     'taxonomy' => '',
    //     'field'    => 'slug',
    //     'terms'    => '',
    // ]],
  ]);
}

$count = $query->found_posts;
?>

<main class="p-search -archive">

  <div class="p-kv_under">
    <div class="p-kv_under__inner">
      <div class="c-inner">
        <div class="p-kv_under__ttl">
          <div class="en">SEARCH</div>
          <div class="jp">検索結果</div>
        </div>
      </div>
    </div>
  </div>

  <div class="c-inner">
    <?php breadcrumb(); ?>
  </div>

  <section class="l-content -under">
    <div class="c-inner">

    </div>
  </section>

</main>

<?php
get_footer();

?>