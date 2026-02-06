<?php

namespace App\Hook;

use App\Service\Metadata;

/**-----------------------------------
 *
 *----------------------------------*/
class SetupTheme extends Hook
{
  public function __construct() {}

  /**
   *
   */
  public function boot(): void
  {
    add_action('init', [$this, 'session_start']);
    add_action('wp_head', [$this, 'metadata_add']);
    add_action('init', [$this, 'remove_wp_features']);
    add_filter('excerpt_more', [$this, 'custom_excerpt_more']);
    add_filter('excerpt_length', [$this, 'custom_excerpt_length'], 999);
    add_action('after_setup_theme', [$this, 'theme_support_add']);
  }

  /**
   *
   */
  public function session_start(): void
  {
    // セッション有効期限: 30日
    ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 30);
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 30);
    // XSS対策
    ini_set('session.cookie_httponly', '1');
    // CSRF対策
    ini_set('session.cookie_samesite', 'Lax');
    // 未知のセッションIDを拒否
    ini_set('session.use_strict_mode', '1');
    // セッション名
    session_name('APPSESSID');
    // start
    session_start();
  }

  /**
   * headを設定
   */
  public function metadata_add(): void
  {
    echo Metadata::get_base();
    echo Metadata::get_full();
    echo Metadata::get_gtags();
    echo Metadata::get_jsonld();
  }

  /**
   * 特定のテーマ機能をサポートする
   */
  public function theme_support_add(): void
  {
    // コメントフォーム、検索フォーム等をHTML5のマークアップに
    add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);

    // タイトルタグ追加
    // add_theme_support('title-tag');

    // 投稿キャプチャー画像を追加。
    add_theme_support('post-thumbnails');
    add_image_size('gallery', 290, 200, true);
    add_image_size('collection', 460, 99999);
    add_image_size('collection-thumb', 208, 99999);
    add_image_size('blog-thumb', 81, 81, true);
  }

  /**
   * 特定のテーマ機能を削除する
   */
  public function remove_wp_features(): void
  {
    // デフォルトタイトルタグを削除
    remove_theme_support('title-tag');

    // 絵文字関連の機能を無効化
    remove_filter('the_content_feed', 'wp_staticize_emoji'); // RSSフィード内の絵文字を画像化する機能を停止
    remove_filter('comment_text_rss', 'wp_staticize_emoji'); // RSSコメント内の絵文字を画像化する機能を停止
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email'); // メール内の絵文字を画像化する機能を停止
    remove_action('wp_head', 'print_emoji_detection_script', 7); // 絵文字検出用JavaScriptの出力を停止
    remove_action('admin_print_scripts', 'print_emoji_detection_script'); // 管理画面の絵文字検出用JavaScriptを停止
    remove_action('wp_print_styles', 'print_emoji_styles'); // フロントエンドの絵文字用CSSを停止
    remove_action('admin_print_styles', 'print_emoji_styles'); // 管理画面の絵文字用CSSを停止

    // REST API関連のリンクを無効化
    remove_action('wp_head', 'rest_output_link_wp_head'); // <head>内のREST APIリンクを停止

    // oEmbed関連のリンクと機能を無効化
    remove_action('wp_head', 'wp_oembed_add_discovery_links'); // oEmbed discovery用のlinkタグを停止
    remove_action('wp_head', 'wp_oembed_add_host_js'); // oEmbed用JavaScriptの読み込みを停止

    // 短縮URLの出力を停止
    remove_action('wp_head', 'wp_shortlink_wp_head'); // <head>内の短縮URL(shortlink)を停止

    // 前後の記事へのリンクを停止
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // rel="prev" / rel="next" のlinkタグを停止

    // 外部サービス用のリンクを停止
    remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writerマニフェストのlinkタグを停止
    remove_action('wp_head', 'rsd_link'); // Really Simple Discovery (RSD) のlinkタグを停止

    // DNSプリフェッチを停止
    remove_action('wp_head', 'wp_resource_hints', 2); // dns-prefetch等のリソースヒントを停止

    // 固定ページのみ自動整形機能を無効化
    if (is_page()) {
      remove_filter('the_content', 'wpautop');
    }
  }

  /**
   * 本文からの抜粋機能
   */
  public function custom_excerpt_length($length)
  {
    if (is_home() || is_front_page()) {
      $return = 45;
    } else {
      $return = 150;
    }

    return $return;
  }

  /**
   * 本文からの抜粋末尾の文字列を指定する
   */
  public function custom_excerpt_more($more)
  {
    return '...';
  }
}