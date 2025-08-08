<?php

declare(strict_types=1);

/**
 * フロント画面 css
 */
function my_front_style(): void
{
  $dir = get_template_directory_uri() . '/style/css/';
  $css_files = [
    'style.css',
  ];

  // wp_enqueue_style('swiper',  'https://unpkg.com/swiper/swiper-bundle.min.css', false, '0.0.1');
  // wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap', false, '0.0.1');

  foreach ($css_files as $file) {
    wp_enqueue_style($file, $dir . $file, false, '0.1.0');
  }
}


/**
 * フロント画面 js
 */
function my_front_script(): void
{
  $dir = get_template_directory_uri() . '/js/';
  $js_files = [
    'index.js',
    'jquery.inview.min.js',
  ];

  wp_deregister_script('jquery');

  // wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], false, true);
  wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', [], false, true);

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


/**
 * フロント画面で使用したいcss・jsを読み込む
 */
function add_front_theme(): void
{
  add_action('wp_enqueue_scripts', 'my_front_style');
  add_action('wp_enqueue_scripts', 'my_front_script');
}
add_action('after_setup_theme', 'add_front_theme');


/**
 * 管理画面 css
 */
function my_admin_style(): void
{
  wp_enqueue_style('admin', get_template_directory_uri() . '/admin/index.css', false, '1.0.1');
  wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.1.0/css/all.css');
}


/**
 * 管理画面 js
 */
function my_admin_script(): void
{
  wp_enqueue_media();
  wp_enqueue_script('admin', get_template_directory_uri() . '/admin/index.js', ['jquery'], '1.0.2', true);
  $js_array = [
    'theme' => theme_dir(),
    'home' => home(),
    'img' => img_dir(),
  ];
  wp_localize_script('admin', 'admin', $js_array);
}
add_action('admin_menu', 'add_dashboard');


/**
 * 管理画面で使用したいcss・jsを読み込む
 */
function add_dashboard(): void
{
  add_action('admin_enqueue_scripts', 'my_admin_style');
  add_action('admin_enqueue_scripts', 'my_admin_script');
}