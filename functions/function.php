<?php

declare(strict_types=1);

// 独自関数
// デバッグ用
function pr($data): void
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}

// デバイス判定
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
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate',          // Other iPhone browser
  ];
  $pattern = '/'.implode('|', $useragents).'/i';

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

// 画像までのパス
function img_dir()
{
  return get_template_directory_uri().'/img/';
}

// テーマまでの絶対パス
function theme_dir()
{
  return get_template_directory().'/';
}

// トップのurl
function home()
{
  return esc_url(home_url('/'));
}

// トップのurl
add_filter('admin_body_class', 'add_admin_body_class');

function add_admin_body_class($classes)
{
  $classes .= img_dir();

  return $classes;
}

// カテゴリー　リンクを表示
function ahrcive_link($slug): void
{
  if (empty($slug)) {
    return;
  }
  $category_id = get_category_by_slug($slug);
  $category_link = get_category_link($category_id->cat_ID);
  echo esc_url($category_link);
}

// 親子関係のページ判定
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

// 固定ページで親をもっているか判定
function is_subpage()
{
  global $post;
  if (is_page() && $post->post_parent) {
    $parentID = $post->post_parent;

    return $parentID;
  }

  return false;
}

// 多次元配列の値が空かどうか
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

// mainタグのクラスを取得する
function get_main_class()
{
  if (is_home() || is_front_page()) {
    return 'top-main';
  }

  return 'sub-main';
}

// 投稿の初めの画像を取得
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
    $first_img = 'src/img/common/default.jpg';
  }

  return $first_img;
}

// 特定のページの編集画面をカスタマイズ
function my_slider_page_style(): void
{
  if (($post = get_post()) && (9215 === $post->ID)) {
    echo '<style>
		.page-title-action{display:none;}
		#post-body-content{display:none;}


		</style>'; // styles
  }
  if (($post = get_post()) && (81 === $post->ID)) {
    echo '<style>
		.edit-post-visual-editor{display:none;}
		.interface-interface-skeleton__content{background-color:#fff!important;}
		</style>'; // styles
  }
}

add_action('admin_enqueue_scripts', 'my_slider_page_style');

add_filter('use_block_editor_for_post', static function ($use_block_editor, $post) {
  if ('page' === $post->post_type) {
    if (in_array($post->post_name, ['recruit'], true)) {
      remove_post_type_support('page', 'editor');

      return false;
    }
  }

  return $use_block_editor;
}, 10, 2);

function my_slider_page_script(): void
{
  if (($post = get_post()) && (9215 === $post->ID)) {
    echo '<script>
  $(".wp-heading-inline").text("スライダー画像を編集")
  </script>'.PHP_EOL;
  }
}
add_action('admin_print_footer_scripts', 'my_slider_page_script');

// お問い合わせフォームのバリデーション表示位置変更
function wpcf7_custom_item_error_position($items, $result)
{
  $class = 'wpcf7-custom-item-error';
  $names = ['privacy_policy'];

  if (isset($items['invalidFields'])) {
    foreach ($items['invalidFields'] as $k => $v) {
      $orig = $v['into'];
      $name = substr($orig, strrpos($orig, '.') + 1);
      if (in_array($name, $names, true)) {
        $items['invalidFields'][$k]['into'] = ".{$class}.{$name}";
      }
    }
  }

  return $items;
}
add_filter('wpcf7_ajax_json_echo', 'wpcf7_custom_item_error_position', 10, 2);

add_shortcode('hurl', 'shortcode_hurl');
function shortcode_hurl()
{
  return home_url('/');
}

function change_default_title($title)
{
  $screen = get_current_screen();
  if ('store-list' === $screen->post_type) {
    $title = '店舗名を入力';
  }

  return $title;
}
add_filter('enter_title_here', 'change_default_title');

function filter_site_upload_size_limit($size)
{
  // Set the upload size limit to 60 MB for users lacking the 'manage_options' capability.
  if (!current_user_can('manage_options')) {
    // 60 MB.
    $size = 60 * 1024 * 1024;
  }

  return $size;
}
add_filter('upload_size_limit', 'filter_site_upload_size_limit', 20);

// 求人ページのタイトルに店名を差し込む
function wp_custom_title_output($title)
{
  if (is_page('application')) {
    $store_id = $_GET['store'];
    $store_name = get_the_title($store_id);

    $newtitle = $store_name.' 募集要項詳細・求人応募フォーム';
    $title['title'] = $newtitle;

    return $title;
  }

  return $title;
}
add_filter('document_title_parts', 'wp_custom_title_output');
