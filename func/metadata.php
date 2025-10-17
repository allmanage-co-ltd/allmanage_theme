<?php

/**
 * WordPressの自動title出力を無効化
 */
add_action('init', function () {
  remove_theme_support('title-tag');
});

/**
 * タイトルを動的に取得する関数
 */
function get_site_title()
{
  $title = '';
  $name = get_bloginfo('name');
  switch (true) {
    case is_home() || is_front_page():
      // トップページ
      $title = $name;
      break;

    case is_single():
      // シングルページ
      $title = get_the_title() . ' | ' . $name;
      break;

    case is_search():
      // 検索結果ページ
      $search_query = get_search_query();
      if ($search_query != '') {
        $title = $search_query . 'の検索結果 | ' . $name;
      } else {
        $title = '検索結果ページ | ' . $name;
      }
      break;

    case is_archive() || is_category() || is_tag() || is_tax():
      // アーカイブ、カテゴリー、タグ、タクソノミーページ
      $term_name = '';
      if (is_category()) {
        $term_name = single_cat_title('', false);
      } elseif (is_tag()) {
        $term_name = single_tag_title('', false);
      } elseif (is_tax()) {
        $term_name = single_term_title('', false);
      } elseif (is_author()) {
        $term_name = get_the_author();
      } elseif (is_date()) {
        if (is_year()) {
          $term_name = get_the_date('Y年');
        } elseif (is_month()) {
          $term_name = get_the_date('Y年n月');
        } elseif (is_day()) {
          $term_name = get_the_date('Y年n月j日');
        }
      } else {
        $term_name = post_type_archive_title('', false);
      }
      $title = $term_name . ' | ' . $name;
      break;

    default:
      // 下層ページ（固定ページなど）
      $title = get_the_title() . ' | ' . $name;
      break;
  }

  return $title;
}


/**
 * ディスクリプションを動的に取得する関数
 */
function get_site_description()
{
  $description = '';
  $default = get_bloginfo('description');

  switch (true) {
    case is_home() || is_front_page():
      // トップページ
      $description = $default;
      break;

    case is_single():
      // シングルページ - 抜粋を100文字で取得
      $post = get_post();
      if (!empty($post->post_excerpt)) {
        // 手動抜粋がある場合
        $description = $post->post_excerpt;
      } else {
        // 自動抜粋を作成
        $content = strip_tags($post->post_content);
        $content = str_replace(array("\r\n", "\r", "\n"), '', $content);
        $description = mb_substr($content, 0, 100);
      }
      break;

    case is_search():
      // 検索結果ページ
      $description = $default;
      break;

    case is_archive() || is_category() || is_tag() || is_tax():
      // アーカイブ、カテゴリー、タグ、タクソノミーページ
      $term_description = '';
      if (is_category() || is_tag() || is_tax()) {
        $term_description = term_description();
      }

      if (!empty($term_description)) {
        $description = strip_tags($term_description);
        $description = mb_substr($description, 0, 100);
      } else {
        $description = $default;
      }
      break;

    default:
      // 下層ページ（固定ページなど）
      $description = $default;
      break;
  }

  return $description;
}


/**
 * OGP画像を取得する関数
 */
function get_site_ogp()
{
  $default_image = get_template_directory_uri() . '/img/common/ogp.jpg';
  $ogp_image = '';

  switch (true) {
    case is_single():
      // 投稿ページ - アイキャッチ画像があれば使用
      if (has_post_thumbnail()) {
        $ogp_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
      } else {
        $ogp_image = $default_image;
      }
      break;

    case is_page():
      // 固定ページ - アイキャッチ画像があれば使用
      if (has_post_thumbnail()) {
        $ogp_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
      } else {
        $ogp_image = $default_image;
      }
      break;

    default:
      // その他のページ - デフォルト画像
      $ogp_image = $default_image;
      break;
  }

  return $ogp_image;
}

/**
 * headにタイトルとディスクリプションを出力する関数
 */
function get_site_title_desc()
{
  $title = get_site_title();
  $description = get_site_description();
  echo <<<HTML
        <title>{$title}</title>
        <meta name="description" content="{$description}">

    HTML;
}

/**
 * headに全てのメタデータを出力する関数
 */
function get_full_metadeta()
{
  $title = get_site_title();
  $description = get_site_description();
  $ogp_image = get_site_ogp();
  $current_url = home_url(add_query_arg(array(), $_SERVER['REQUEST_URI']));
  $site_name = get_bloginfo('name');
  $og_type = is_front_page() ? 'website' : 'article';

  $published_time = '';
  $modified_time = '';

  if (is_single()) {
    $published_time = get_the_date('c');
    $modified_time = get_the_modified_date('c');
  }

  echo <<<HTML
        <title>{$title}</title>
        <meta name="description" content="{$description}">

        <meta property="og:type" content="{$og_type}">
        <meta property="og:url" content="{$current_url}">
        <meta property="og:title" content="{$title}">
        <meta property="og:description" content="{$description}">
        <meta property="og:image" content="{$ogp_image}">
        <meta property="og:site_name" content="{$site_name}">
        <meta property="og:locale" content="ja_JP">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:url" content="{$current_url}">
        <meta name="twitter:title" content="{$title}">
        <meta name="twitter:description" content="{$description}">
        <meta name="twitter:image" content="{$ogp_image}">
    HTML;

  if (is_single() && !empty($published_time)) {
    echo <<<HTML

        <meta property="article:published_time" content="{$published_time}">
        <meta property="article:modified_time" content="{$modified_time}">

    HTML;
  }

  echo <<<HTML

        <link rel="canonical" href="{$current_url}">

    HTML;
}

/**
 * headにGA4タグを出力する関数
 * get_gtags();
 */
function get_gtags()
{
  $gtags = include config_dir() . '/gtag.php';
  if (!empty($gtags)) {
    foreach ($gtags as $gtag) {
      echo <<<HTML

            <!-- Google tag (gtag.js) -->
            <script async="" src="https://www.googletagmanager.com/gtag/js?id={$gtag}"></script>

            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', "{$gtag}");
            </script>

        HTML;
    }
  }
}


/**
 * headにJSON-LD構造化データを出力する関数
 */
function get_jsonld()
{
  $site_name = get_bloginfo('name');
  $site_url = home_url();
  $logo_url = get_template_directory_uri() . '/img/common/logo.png';

  if (is_front_page()) {
    // トップページ用の組織情報
    $json_ld = array(
      '@context' => 'https://schema.org',
      '@type' => 'Organization',
      'name' => $site_name,
      'url' => $site_url,
      'logo' => $logo_url,
      'description' => get_site_description(),
      'address' => array(
        '@type' => 'PostalAddress',
        'addressCountry' => 'JP'
      )
    );
  } elseif (is_single()) {
    // 投稿ページ用の記事情報
    $json_ld = array(
      '@context' => 'https://schema.org',
      '@type' => 'Article',
      'headline' => get_the_title(),
      'description' => get_site_description(),
      'image' => get_site_ogp(),
      'datePublished' => get_the_date('c'),
      'dateModified' => get_the_modified_date('c'),
      'author' => array(
        '@type' => 'Organization',
        'name' => $site_name
      ),
      'publisher' => array(
        '@type' => 'Organization',
        'name' => $site_name,
        'logo' => array(
          '@type' => 'ImageObject',
          'url' => $logo_url
        )
      )
    );
  } else {
    return;
  }

  $encoded_jsonld = json_encode($json_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

  echo <<<HTML

        <script type="application/ld+json">
            {$encoded_jsonld}
        </script>


    HTML;
}