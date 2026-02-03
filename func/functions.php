<?php

declare(strict_types=1);

$get_url_array = include theme_dir() . '/config/permalink.php';

/**
 * デバッグ用
 */
function pr($data): void
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}


/**
 * 画像までのパス
 */
function img_dir()
{
  return get_template_directory_uri() . '/img/';
}


/**
 * テーマまでのパス
 */
function theme_dir()
{
  return get_template_directory() . '/';
}


/**
 * 設定ファイルへのパス
 */
function config_dir()
{
  return get_template_directory() . '/config';
}


/**
 * トップのurl
 */
function home()
{
  return esc_url(home_url('/'));
}


/**
 * パーマリンクを取得する関数
 */
function get_url($key)
{
  global $get_url_array;
  return esc_url($get_url_array[$key]) ?? '#';
}

/**
 *
 */
function is_local()
{
  $host = $_SERVER['HTTP_HOST'];

  if (empty($host)) {
    return false;
  }

  $localhosts = [
    'localhost',
    '127.0.0.1',
    'web-checker',
  ];

  foreach ($localhosts as $localhost) {
    if (strpos($host, $localhost) !== false) {
      return true;
    }
  }

  return false;
}

/**
 * ページ情報を取得する関数
 */
function getPageInfo($case = 'original')
{
  // アーカイブページの場合
  if (is_post_type_archive()) {
    $post_type = get_post_type();
    $post_type_obj = get_post_type_object($post_type);
    $title = $post_type_obj->labels->name;
    $slug = $post_type;
  } else {
    // 通常ページ：コメントから抽出
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
    $file = $backtrace[0]['file'];
    $content = file_get_contents($file);

    preg_match('/Page Title:\s*(.+)/', $content, $titleMatch);
    preg_match('/Page Slug:\s*(.+)/', $content, $slugMatch);

    $title = isset($titleMatch[1]) ? trim($titleMatch[1]) : '';
    $slug = isset($slugMatch[1]) ? trim($slugMatch[1]) : '';
  }

  // スラッグの変換
  switch ($case) {
    case 'upper':
      // UpperCamelCase
      $slug = str_replace(['-', '_'], ' ', $slug);
      $slug = ucwords($slug);
      $slug = str_replace(' ', '', $slug);
      break;
    case 'lower':
      // lowerCamelCase
      $slug = str_replace(['-', '_'], ' ', $slug);
      $slug = ucwords($slug);
      $slug = str_replace(' ', '', $slug);
      $slug = lcfirst($slug);
      break;
    case 'all':
      // 全大文字（ハイフン・アンダースコアは半角スペースに）
      $slug = str_replace(['-', '_'], ' ', $slug);
      $slug = strtoupper($slug);
      break;
    case 'original':
    default:
      // ハイフンとアンダースコアを半角スペースに
      $slug = str_replace(['-', '_'], ' ', $slug);
      break;
  }

  return [
    'title' => $title,
    'slug' => $slug
  ];
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


function is_iphone()
{
  $is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
  if ($is_iphone) {
    return true;
  }

  return false;
}


function is_android()
{
  $is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
  if ($is_android) {
    return true;
  }

  return false;
}


function is_ipad()
{
  $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
  if ($is_ipad) {
    return true;
  }

  return false;
}


function is_kindle()
{
  $is_kindle = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle');
  if ($is_kindle) {
    return true;
  }

  return false;
}


function is_mobile()
{
  $useragents = [
    'iPhone', // iPhone
    'iPod', // iPod touch
    'Android', // 1.5+ Android
    'dream', // Pre 1.5 Android
    'CUPCAKE', // 1.5+ Android
    'blackberry9500', // Storm
    'blackberry9530', // Storm
    'blackberry9520', // Storm v2
    'blackberry9550', // Storm v2
    'blackberry9800', // Torch
    'webOS', // Palm Pre Experimental
    'incognito', // Other iPhone browser
    'webmate', // Other iPhone browser
  ];
  $pattern = '/' . implode('|', $useragents) . '/i';

  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


function isBot()
{
  $bot_list = [
    'Googlebot',
    'Yahoo! Slurp',
    'Mediapartners-Google',
    'msnbot',
    'bingbot',
    'MJ12bot',
    'Ezooms',
    'pirst; MSIE 8.0;',
    'Google Web Preview',
    'ia_archiver',
    'Sogou web spider',
    'Googlebot-Mobile',
    'AhrefsBot',
    'YandexBot',
    'Purebot',
    'Baiduspider',
    'UnwindFetchor',
    'TweetmemeBot',
    'MetaURI',
    'PaperLiBot',
    'Showyoubot',
    'JS-Kit',
    'PostRank',
    'Crowsnest',
    'PycURL',
    'bitlybot',
    'Hatena',
    'facebookexternalhit',
    'NINJA bot',
    'YahooCacheSystem',
  ];
  $is_bot = false;
  foreach ($bot_list as $bot) {
    if (false !== stripos($_SERVER['HTTP_USER_AGENT'], $bot)) {
      $is_bot = true;

      break;
    }
  }

  return $is_bot;
}


/**
 * 検索キーワード分割
 *
 * $keywords = split_search_keywords($search_query);
 */
function split_search_keywords(string $search_query): array
{
  if ($search_query === '') {
    return [];
  }

  return preg_split(
    '/[\s　]+/u',
    trim($search_query),
    -1,
    PREG_SPLIT_NO_EMPTY
  );
}

/**
 * 文字列にキーワードが含まれるか判定する
 *
 * $title_match   = has_keyword_match($title, $keywords);
 * $content_match = has_keyword_match($content, $keywords);
 */
function has_keyword_match(string $text, array $keywords): bool
{
  foreach ($keywords as $keyword) {
    if (stripos($text, $keyword) !== false) {
      return true;
    }
  }
  return false;
}

/**
 * 共通のハイライト関数
 */
function highlight_keywords(string $text, array $keywords): string
{
  if (empty($keywords)) {
    return $text;
  }

  $pattern = '/' . implode('|', array_map(function ($keyword) {
    return preg_quote($keyword, '/');
  }, $keywords)) . '/iu';

  return preg_replace(
    $pattern,
    '<mark class="c-highlight">$0</mark>',
    $text
  );
}

/**
 * タイトル用の出力（the_title互換）
 *
 * <?php output_highlighted_title($keywords, $title_match); ?>
*/
function output_highlighted_title(array $keywords, bool $title_match): void
{
if (!$title_match || empty($keywords)) {
the_title();
return;
}

echo highlight_keywords(esc_html(get_the_title()), $keywords);
}

/**
* 本文用の出力（the_content互換）
* <?php output_highlighted_content($keywords, $content_match); ?>
*/
function output_highlighted_content(array $keywords, bool $content_match): void
{
if ($content_match) {
$content = apply_filters('the_content', get_the_content());
echo highlight_keywords($content, $keywords);
} else {
the_content();
}
}