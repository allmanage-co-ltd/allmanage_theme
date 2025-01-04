<?php get_header(); ?>
<section class="section-breadcrumb">
  <div class="container">
    <?php breadcrumb(); ?>
  </div>
</section>
<section class="section-04">
  <div class="container">
    <aside class="tgl-tb">
      <?php get_sidebar(); ?>
    </aside>
    <main>
      <div class="item-area">
        <?php
        $get_cate = $_GET['cate'];
$get_term = $_GET['term'];
$get_year = (int) $_GET['set_year'];
$get_month = (int) $_GET['set_month'];

if ($get_cate || $get_term) {
  // 絞り込み条件を追加
  $taxquery_taxonomy = [
    'taxonomy' => $get_term,
    'terms' => $get_cate,
    'field' => 'slug',
  ];
}

$args = [
  'post_type' => 'news-list',
  'paged' => $paged,
  'posts_per_page' => '15',
  'year' => $get_year,
  'monthnum' => $get_month,
  'tax_query' => [
    'relation' => 'AND',
    $taxquery_taxonomy,
  ],
];

$the_query = new WP_Query($args);
$max_num_pages = $the_query->max_num_pages;
if ($the_query->have_posts()) {
  ?>

          <?php while ($the_query->have_posts()) {
            $the_query->the_post(); ?>

            <div class="item-box">
              <div class="img-box">
                <a href="<?php the_permalink(); ?>">
                  <?php if (has_post_thumbnail()) { ?>
                    <?php the_post_thumbnail('full'); ?>
                  <?php } else { ?>
                    <img src="http://placehold.jp/eeeeee/cccccc/280x200.png?text=No%20Image" class="img-fluid" alt="">
                  <?php } ?></a>
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
                <?php if ($slag_name) { ?>
                  <?php echo '<li>'.$slag_name.'</li>'; ?>
                <?php } ?>

                <?php foreach ($news_terms as $news_term) { ?>
                  <?php
              $news_name = $news_term->name;

                  ?>
                  <li><?php echo $news_name; ?></li>
                <?php } ?>
              </ul>
            </div>
          <?php } ?>
          <?php wp_reset_postdata(); ?>
        <?php } else { ?>

          <h3 class="text-center">公開中の新着情報はありません</h3>

        <?php } ?>


      </div>
      <div class="pagenation">
        <?php
        if ($the_query->max_num_pages > 1) {
          echo paginate_links([
            'base' => home_url('/news/').'%_%',
            'format' => 'page/%#%/',
            'current' => max(1, $paged),
            'mid_size' => 1,
            'next_text' => '>',
            'prev_text' => '<',
            'total' => $the_query->max_num_pages,
          ]);
        }
wp_reset_postdata(); ?>
      </div>
    </main>
  </div>
</section>



<?php
get_footer(); ?>