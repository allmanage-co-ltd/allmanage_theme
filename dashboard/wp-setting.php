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


function my_frontend_files()
{
  wp_enqueue_script('jquery');

  // 「wp-block-library-css」を削除
  wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'my_frontend_files');


/**
 * スタイル・スクリプトのバージョン情報を消す
 */
function remove_src_ver($src)
{
  if (strpos($src, 'ver='))
    $src = remove_query_arg('ver', $src);
  return $src;
}
add_filter('style_loader_src', 'remove_src_ver', 9999);
add_filter('script_loader_src', 'remove_src_ver', 9999);


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


/**
 * ビジュアルエディター OFF
 */
function disable_visual_editor_in_page()
{
  global $typenow;
  if ($typenow == 'mw-wp-form') {
    add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
}
function disable_visual_editor_filter()
{
  return false;
}
add_action('load-post.php', 'disable_visual_editor_in_page');
add_action('load-post-new.php', 'disable_visual_editor_in_page');


/**
 * WordPress自動ページ生成システム（毎回チェック版）
 *
 * 毎回のページ読み込み時にファイルをチェックし、
 * 対応するWordPressページがなければ自動生成する
 */
add_action('init', function () {
  // 管理画面でのみ実行（フロントエンドでの負荷を避ける）
  if (!is_admin() || !current_user_can('manage_options')) {
    return;
  }

  auto_create_pages_from_files();
});

// 親子関係修正
add_action('wp_loaded', function () {
  if (isset($_GET['fix_confirm_parent']) && current_user_can('manage_options')) {
    $contact = get_page_by_path('contact');
    $confirm = get_page_by_path('confirm');

    if ($contact && $confirm) {
      wp_update_post(['ID' => $confirm->ID, 'post_parent' => $contact->ID]);
      echo "修正完了: confirm → contact";
    } else {
      echo "エラー: ページが見つかりません";
    }
    die();
  }
});


/**
 * ファイルベースのページ自動生成
 */
function auto_create_pages_from_files()
{
  $base_dir = get_template_directory() . '/view/page';

  if (!is_dir($base_dir)) {
    return;
  }

  $created_pages = [];

  // 1. フォルダ内の全PHPファイルをスキャン
  $iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($base_dir, RecursiveDirectoryIterator::SKIP_DOTS)
  );

  foreach ($iterator as $file) {
    // .phpファイルのみ対象
    if ($file->getExtension() !== 'php') continue;

    $relative_path = str_replace($base_dir, '', dirname($file->getPathname()));
    $relative_path = trim($relative_path, '/\\');

    // ベースディレクトリ直下のファイルは後で処理
    if (empty($relative_path)) continue;

    $page_data = extract_page_data($file->getPathname(), $base_dir);

    if ($page_data) {
      $result = create_page_if_not_exists($page_data);
      if ($result) {
        $created_pages[] = $result;
      }
    }
  }

  // 2. ベースディレクトリ直下の単一.phpファイルをスキャン
  $php_files = glob($base_dir . '/*.php');
  foreach ($php_files as $php_file) {
    $page_data = extract_page_data($php_file, $base_dir);

    if ($page_data) {
      $result = create_page_if_not_exists($page_data);
      if ($result) {
        $created_pages[] = $result;
      }
    }
  }
}


/**
 * ファイルからページデータを抽出
 */
function extract_page_data($file_path, $base_dir)
{
  $contents = file_get_contents($file_path);

  if (!$contents) {
    return null;
  }

  // ヘッダー情報を抽出
  preg_match('/Page Title:\s*(.+)/', $contents, $title_match);
  preg_match('/Page Slug:\s*(.+)/', $contents, $slug_match);
  preg_match('/Page Parent:\s*(.+)/', $contents, $parent_match);

  $title  = trim($title_match[1] ?? '');
  $slug   = trim($slug_match[1] ?? '');
  $parent = trim($parent_match[1] ?? '');

  if (!$title || !$slug) {
    return null;
  }

  // テンプレートパスを計算
  $template_path = str_replace($base_dir, '/view/page', $file_path);
  $template_path = str_replace('\\', '/', $template_path); // Windows対応

  return [
    'title' => $title,
    'slug' => $slug,
    'parent' => $parent,
    'template_path' => $template_path,
    'file_path' => $file_path
  ];
}


/**
 * ページが存在しない場合に作成
 */
function create_page_if_not_exists($page_data)
{
  $existing_by_slug = get_posts([
    'name'        => $page_data['slug'],
    'post_type'   => 'page',
    'post_status' => ['publish', 'draft', 'private', 'trash'],
    'numberposts' => 1
  ]);

  $existing_by_title = get_posts([
    'title'       => $page_data['title'],
    'post_type'   => 'page',
    'post_status' => ['publish', 'draft', 'private'],
    'numberposts' => 1
  ]);

  $existing_by_path = get_page_by_path($page_data['slug'], OBJECT, 'page');

  if (!empty($existing_by_slug) || !empty($existing_by_title) || $existing_by_path) {
    $existing_page = $existing_by_slug[0] ?? $existing_by_title[0] ?? $existing_by_path;

    if ($page_data['parent'] !== '') {
      $expected_parent = get_posts([
        'name' => $page_data['parent'],
        'post_type' => 'page',
        'post_status' => 'publish',
        'numberposts' => 1
      ]);

      if (!empty($expected_parent) && $existing_page->post_parent != $expected_parent[0]->ID) {
        wp_update_post([
          'ID' => $existing_page->ID,
          'post_parent' => $expected_parent[0]->ID
        ]);
        error_log("Auto Page Generator: Updated parent relationship - {$page_data['slug']} → {$page_data['parent']}");
      }
    }

    return null;
  }

  $parent_id = 0;
  if ($page_data['parent'] !== '') {
    $parent_page = null;

    $parents_by_posts = get_posts([
      'name'        => $page_data['parent'],
      'post_type'   => 'page',
      'post_status' => 'publish',
      'numberposts' => 1
    ]);

    if (!empty($parents_by_posts)) {
      $parent_page = $parents_by_posts[0];
    } else {
      $parent_page = get_page_by_path($page_data['parent'], OBJECT, 'page');
    }

    if ($parent_page) {
      $parent_id = $parent_page->ID;
      error_log("Auto Page Generator: Found parent page - {$page_data['parent']} (ID: {$parent_id})");
    } else {
      error_log("Auto Page Generator: Parent page not found - {$page_data['parent']} for {$page_data['slug']}");
    }
  }

  $page_id = wp_insert_post([
    'post_title'  => $page_data['title'],
    'post_name'   => $page_data['slug'],
    'post_status' => 'publish',
    'post_type'   => 'page',
    'post_parent' => $parent_id,
  ]);

  if ($page_id && !is_wp_error($page_id)) {
    update_post_meta($page_id, '_wp_page_template', $page_data['template_path']);

    error_log("Auto Page Generator: Created page - {$page_data['title']} ({$page_data['slug']}) - Template: {$page_data['template_path']}");
    return $page_data['slug'];
  }

  return null;
}