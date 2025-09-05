<?php
$bodyClass  = esc_attr(implode(' ', get_body_class()));
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta name="author" content="allmanage">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="format-detection" content="telephone=no">

  <link rel="icon" href="<?= img_dir() ?>/common/favicon.png">
  <link rel="apple-touch-icon" href="<?= img_dir() ?>/common/apple-touch-icon.png">

  <?php
  get_full_metadeta();
  get_gtags();
  get_jsonld();
  wp_head();
  ?>
</head>

<body class="<?= $bodyClass ?>">

  <header class="header" id="header">
    <div class="header-inner">
      <h1 class="header-logo">
        <a href="<?= home(); ?>">
          <img src="<?= get_template_directory_uri(); ?>/img/common/logo.png" alt="<?= get_bloginfo('name'); ?>">
        </a>
      </h1>

      <?php get_template_part('view/parts/header-navi'); ?>
    </div>
  </header>