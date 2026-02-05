<?php

namespace App\Admin;

use App\Service\Metadata;

/**-----------------------------------
 *
 *----------------------------------*/
class Settings extends Admin
{
    public function __construct() {}

    /**
     *
     */
    public function boot(): void
    {
        add_filter('excerpt_more', [$this, 'custom_excerpt_more']);
        add_filter('excerpt_length', [$this, 'custom_excerpt_length'], 999);
        add_action('after_setup_theme', [$this, 'theme_support_add']);
        add_action('wp_head', [$this, 'metadata_add']);
        add_action('init', [$this, 'theme_support_remove']);
        add_action('wp', [$this, 'disable_page_wpautop']);
        add_action('init', [$this, 'disable_emoji']);
    }

    /**
     * 特定のテーマ機能をサポートする
     */
    public function metadata_add(): void
    {
        Metadata::get_base_meta();
        Metadata::get_full_metadeta();
        Metadata::get_gtags();
        Metadata::get_jsonld();
    }

    /**
     * 特定のテーマ機能をサポートする
     */
    public function theme_support_add(): void
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

    /**
     * 特定のテーマ機能を削除する
     */
    public function theme_support_remove(): void
    {
        remove_theme_support('title-tag');
    }

    /**
     * 固定ページのみ自動整形機能を無効化
     */
    public function disable_page_wpautop(): void
    {
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

    /**
     * wordpressの不要な記述を削除
     */
    public function disable_emoji(): void
    {
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email'); // 短縮URLの表示を停止
        remove_action('wp_head', 'print_emoji_detection_script', 7); // 特殊記号　画像変換を停止
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'wp_shortlink_wp_head'); // 前後の記事URLの表示を停止
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Windows Live Writer とのリンクを停止
        remove_action('wp_head', 'wlwmanifest_link'); // RSDのリンクを停止
        remove_action('wp_head', 'rsd_link'); // DNSプリフェッチのリンクを停止
        remove_action('wp_head', 'wp_resource_hints', 2);
    }
}