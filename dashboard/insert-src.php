<?php

declare(strict_types=1);

/**
 * 管理画面 css
 */
function my_admin_style(): void
{
  wp_enqueue_style(
    'admin',
    get_template_directory_uri() . '/dashboard/assets/dashboard.css?v=' . time(),
    [],
    '1.0.1'
  );
  wp_enqueue_style(
    'fontawesome',
    'https://use.fontawesome.com/releases/v5.1.0/css/all.css'
  );
}
add_action('admin_enqueue_scripts', 'my_admin_style');
add_action('login_enqueue_scripts', 'my_admin_style');

/**
 * 管理画面 js
 */
function my_admin_script(): void
{
  wp_enqueue_media();
  wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js', [], false, true);

  wp_enqueue_script(
    'admin',
    get_template_directory_uri() . '/dashboard/assets/dashboard.js?v=' . time(),
    ['jquery'],
    '1.0.2',
    true
  );

  $js_array = [
    'theme' => theme_dir(),
    'home'  => home(),
    'img'   => img_dir(),
  ];
  wp_localize_script('admin', 'admin', $js_array);
}
add_action('admin_enqueue_scripts', 'my_admin_script');