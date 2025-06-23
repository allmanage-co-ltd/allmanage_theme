<?php get_header(); ?>
<section class="section-breadcrumb">
  <div class="container">
    <div class="breadcrumb-list">
      <ul class="breadcrumb">
        <li><a href="<?php echo home(); ?>">TOP</a></li>
        <li>&gt;</li>
        <li><a href="<?php echo home(); ?>news">最新情報</a></li>
        <li>&gt;</li>
        <?php if (isset($_GET['s']) && empty($_GET['s'])) { ?>
          <li>検索キーワード未入力</li>
        <?php } else { ?>
          <li><?php echo $_GET['s']; ?>の検索結果</li>
        <?php } ?>
      </ul>
    </div>
  </div>
</section>

<section class="section-04">
  <div class="container">
    <aside class="tgl-tb">
      <?php get_sidebar(); ?>
    </aside>
    <main>

      <h4 class="title">
        <?php if (isset($_GET['s']) && empty($_GET['s'])) {
          echo '検索キーワード未入力'; // 検索キーワードが未入力の場合のテキストを指定
        } else {
          echo '“' . $_GET['s'] . '”の検索結果：'; // 検索キーワードと該当件数を表示
        } ?>
        <?php if (isset($_GET['s']) && empty($_GET['s'])) {
          echo ' 全件表示';
        } else {
          echo $wp_query->found_posts . '件';
        } ?>
      </h4>
      <div class="item-area">
        <?php
        if (!empty($_GET['post_type'])) {
          global $query_string;
          query_posts($query_string . '&post_type=' . $_GET['post_type']);
        }
?>
        <?php if (have_posts()) { ?>
          <?php while (have_posts()) {
            the_post(); ?>
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

        <?php } else { ?>
          <p>検索キーワードに該当する記事がありませんでした。</p>
        <?php } ?>
      </div>
      <?php echo wp_pagination(); ?>
    </main>

  </div>
</section>
<?php
get_footer(); ?>