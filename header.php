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


  <style>
    body:not(.home) {
        transition: padding-top 0.2s ease;
    }
    body.js-header-ready:not(.home) {
        padding-top: var(--header-height) !important;
    }
  </style>

  <script>
    function setHeaderHeight() {
        const $header = $('#header');
        if ($header.length) {
            const headerHeight = $header.outerHeight() + 'px';
            $(':root').css('--header-height', headerHeight);
            $('body').addClass('js-header-ready');
        }
    }

    $(function () {
        setHeaderHeight();
        $(window).on('resize load', setHeaderHeight);
    });
  </script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header class="" id="header">
    <h1>

    </h1>

    <nav>

    </nav>
  </header>