<?php

declare(strict_types=1);

/**
 * フロント画面 css
 */
function my_front_style(): void
{
  $dir = get_template_directory_uri() . '/style/css/';
  $css_files = [
    'style.css?v=' . time(),
    'include.css?v=' . time(),
  ];

  // wp_enqueue_style('swiper',  'https://unpkg.com/swiper/swiper-bundle.min.css', false, '0.0.1');
  // wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap', false, '0.0.1');

  foreach ($css_files as $file) {
    wp_enqueue_style($file, $dir . $file, false, '0.1.0');
  }
}
add_action('wp_enqueue_scripts', 'my_front_style');


/**
 * フロント画面 js
 */
function my_front_script(): void
{
  $dir = get_template_directory_uri() . '/js/';
  $js_files = [
    'scripts.js?v=' . time(),
    'scripts_add.js?v=' . time(),
  ];

  wp_deregister_script('jquery');

  // wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true);
  wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js', [], false, true);

  foreach ($js_files as $file) {
    wp_enqueue_script($file, $dir . $file, ['jquery'], '0.1.0', true);
  }

  wp_localize_script(
    'app',
    'DATA',
    [
      'template' => get_template_directory_uri() . '/',
      'ajax' => admin_url('admin-ajax.php'),
    ]
  );

  // wp_add_inline_script( $handle, $inline_script );
}
add_action('wp_enqueue_scripts', 'my_front_script');
