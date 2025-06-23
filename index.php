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
      $args = [
        'post_type' => 'news',
        'paged' => $paged,
        'posts_per_page' => '3',
      ];
$the_query = new WP_Query($args);
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
                  <img src="http://placehold.jp/eeeeee/cccccc/280x200.png?text=No%20Image" alt="">
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
                <?php echo '<li>' . $slag_name . '</li>'; ?>
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
</section>
<section class="section-03">

  <h2><span></span></h2>

  <div class="contents-box">


  </div>
</section>


<?php
get_footer(); ?>