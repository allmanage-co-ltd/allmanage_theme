<?php

declare(strict_types=1);


/**
 * 画像までのパス
 */
function img_dir()
{
  return get_template_directory_uri() . '/img/';
}


/**
 * テーマまでの絶対パス
 */
function theme_dir()
{
  return get_template_directory() . '/';
}


/**
 * トップのurl
 */
function home()
{
  return esc_url(home_url('/'));
}


/**
 * 404へリダイレクト
 */
function to_404notfound()
{
  header("HTTP/1.0 404 Not Found");
  include_once theme_dir() . '404.php';
  exit;
}


/**
 * 多言語の場合のパス取得
 */
function get_language_uri()
{
  $lang = '';
  $uri = trim($_SERVER['REQUEST_URI'], '/');
  if (preg_match('#^([a-z]{2})(/|$)#', $uri, $m)) {
    $lang = $m[1];
  }

  return $lang;
}


/**
 * カテゴリー　リンクを表示
 */
function ahrcive_link($slug): void
{
  if (empty($slug)) {
    return;
  }
  $category_id = get_category_by_slug($slug);
  $category_link = get_category_link($category_id->cat_ID);
  echo esc_url($category_link);
}


/**
 * 親子関係のページ判定
 */
function is_tree($slug)
{
  global $post;
  if (empty($slug)) {
    return;
  }
  $postlist = get_posts(['posts_per_page' => 1, 'name' => $slug, 'post_type' => 'page']);
  $pageid = [];
  foreach ($postlist as $list) {
    $pageid[] = $list->ID;
  }
  if (is_page($slug)) {
    return true;
  }
  $anc = get_post_ancestors($post->ID);
  foreach ($anc as $ancestor) {
    if (is_page() && in_array($ancestor, $pageid, true)) {
      return true;
    }
  }

  return false;
}


/**
 * 固定ページで親をもっているか判定
 */
function is_subpage()
{
  global $post;
  if (is_page() && $post->post_parent) {
    $parentID = $post->post_parent;

    return $parentID;
  }

  return false;
}


/**
 * 多次元配列の値が空かどうか
 */
function custom_array_filter($var)
{
  $return = false;
  if (is_array($var)) {
    foreach ($var as $v) {
      if (!empty($v)) {
        $return = true;
      }
    }
  } elseif (!empty($var)) {
    $return = true;
  }

  return $return;
}


/**
 * 投稿の初めの画像を取得
 */
function catch_that_image()
{
  global $post;
  $image_get = preg_match_all('/<img.+class=[\'"].*wp-image-([0-9]+).*[\'"].*>/i', $post->post_content, $matches);
  $image_id = $matches[1][0];
  if ($image_id) {
    $image = wp_get_attachment_image_src($image_id, 'blog-thumb');
    $first_img = $image[0];
  }

  if (empty($first_img)) {
    // 記事内で画像がなかったときのためのデフォルト画像を指定
    $first_img = get_template_directory_uri() . '/img/common/damy.jpg';
  }

  return $first_img;
}