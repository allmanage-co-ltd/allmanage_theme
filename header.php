<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



  <header class="">
    <h1></h1>
    <nav></nav>
    <form method="get" id="searchform" action="<?php echo home(); ?>">
      <i class="fas fa-search"></i>
      <input type="text" value="" name="s" class="s" placeholder="サイト内投稿記事検索" />
      <input type="hidden" name="post_type" value="news-list">
      <button type="submit" class="s-btn-area">
        <div class="s-btn">検索</div>
      </button>
    </form>

    <div class="meilto">
      <a href="<?php echo home(); ?>contact"><i class="fas fa-envelope"></i>お問い合わせ</a>
    </div>

    <div class="recruitto">
      <a href="#store">RECRUIT<span>ご応募はこちら</span></a>
    </div>

    <nav class="drawer">
      <input id="hamburger" class="hamburger" type="checkbox" />
      <label class="hamburger" for="hamburger">
        <i></i>
        <text>
          <close>close</close>
          <open>menu</open>
        </text>
      </label>
      <section class="drawer-list">

        <div class="drawer-link">

        </div>
      </section>
    </nav>
  </header>