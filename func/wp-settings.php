<?php

declare(strict_types=1);

/**
 * 特定のテーマ機能をサポートする
 */
function original_theme_setup(): void
{
  // コメントフォーム、検索フォーム等をHTML5のマークアップに
  add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);
  // タイトルタグ追加
  add_theme_support('title-tag');
  // 投稿キャプチャー画像を追加。
  add_theme_support('post-thumbnails');
  add_image_size('gallery', 290, 200, true);
  add_image_size('collection', 460, 99999);
  add_image_size('collection-thumb', 208, 99999);
  add_image_size('blog-thumb', 81, 81, true);
}
add_action('after_setup_theme', 'original_theme_setup');


/**
 * 固定ページのみ自動整形機能を無効化します。
 */
function disable_page_wpautop(): void
{
  if (is_page()) {
    remove_filter('the_content', 'wpautop');
  }
}
add_action('wp', 'disable_page_wpautop');


/**
 * 本文からの抜粋機能
 */
function custom_excerpt_length($length)
{
  if (is_home() || is_front_page()) {
    $return = 45;
  } else {
    $return = 150;
  }

  return $return;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);


/**
 * 本文からの抜粋末尾の文字列を指定する
 */
function custom_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');


/**
 * wordpressの不要な記述を削除
 */
function disable_emoji(): void
{
  remove_action('wp_head', 'print_emoji_detection_script', 7); // 特殊記号　画像変換を停止
  remove_action('wp_head', 'rest_output_link_wp_head');
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email'); // 短縮URLの表示を停止
  remove_action('wp_head', 'wp_shortlink_wp_head'); // 前後の記事URLの表示を停止
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Windows Live Writer とのリンクを停止
  remove_action('wp_head', 'wlwmanifest_link'); // RSDのリンクを停止
  remove_action('wp_head', 'rsd_link'); // DNSプリフェッチのリンクを停止
  remove_action('wp_head', 'wp_resource_hints', 2);
}
add_action('init', 'disable_emoji');


/**
 * クエリ書き換え
 */
function my_default_query($query): void
{
  if (is_admin() || !$query->is_main_query()) {
    return;
  }
  if (is_post_type_archive('catalog')) {
    $query->set('posts_per_page', 15);
  }
}
add_action('pre_get_posts', 'my_default_query', 1);


/**
 * 自動保存機能無効
 */
function disable_autosave(): void
{
  wp_deregister_script('autosave');
}
add_action('wp_print_scripts', 'disable_autosave');
if (!defined('WP_POST_REVISIONS')) {
  define('WP_POST_REVISIONS', false);
}

function custom_widgets_init(): void
{
  register_sidebar([
    'name' => 'Main Widget Area',
    'id' => 'sidebar-1',
    'description' => 'サイドバーに表示されます',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ]);
}
add_action('widgets_init', 'custom_widgets_init');


/**
 * トップのurl
 */
function add_admin_body_class($classes)
{
  $classes .= img_dir();

  return $classes;
}
add_filter('admin_body_class', 'add_admin_body_class');


/**
 * bodyにCSSクラスを追加
 */
function custom_class_names($classes)
{
  if (is_page()) {
    global $post;
    if (preg_match('/^[a-zA-Z0-9_-]+$/', $post->post_name)) {
      $classes[] = $post->post_name;
    }
  }

  return $classes;
}
add_filter('body_class', 'custom_class_names');