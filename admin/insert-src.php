<?php

declare(strict_types=1);

/**
 * 管理画面 css
 */
function my_admin_style(): void
{
  wp_enqueue_style('admin', get_template_directory_uri() . '/admin/index.css?v=' . time(), false, '1.0.1');
  wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.1.0/css/all.css');
}


/**
 * 管理画面 js
 */
function my_admin_script(): void
{
  wp_enqueue_media();
  wp_enqueue_script('admin', get_template_directory_uri() . '/admin/index.js?v=' . time(), ['jquery'], '1.0.2', true);
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