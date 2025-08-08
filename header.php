<?php
$permalink_file = get_template_directory() . '/config/permalink.php';

if (file_exists($permalink_file)) {
  include_once $permalink_file;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">
  <?php
  echo set_head_meta([
    // 'GA4-XXXXXXXXX-1',
  ]);
  wp_head();
  ?>
</head>

<body <?php body_class(); ?>>

  <header class="header" id="header">
    <div class="header-inner">
      <h1 class="header-logo">
        <a href="<?= home(); ?>">
          <img src="<?= get_template_directory_uri(); ?>/img/common/logo.png" alt="<?= get_bloginfo('name'); ?>">
        </a>
      </h1>

      <?php
      get_template_part('view/parts/header-navi');
      ?>
    </div>
  </header>