<?php

declare(strict_types=1);

/**
 * 追加カスタム投稿
 */
function create_post_type(): void
{
  register_post_type('news', [ // 投稿タイプ名の定義
    'labels' => [
      'name' => 'NEWS', // 管理画面上で表示する投稿タイプ名
      'singular_name' => 'news',    // カスタム投稿の識別名
    ],
    'public' => true,  // 投稿タイプをpublicにするか
    'has_archive' => true, // アーカイブ機能ON/OFF
    'menu_position' => 5,     // 管理画面上での配置場所
    'show_in_rest' => false,  // 5系から出てきた新エディタ「Gutenberg」を有効にする
    'supports' => ['title', 'editor', 'thumbnail'],
  ]);
}
add_action('init', 'create_post_type');


/**
 *　追加カスタムタクソノミー
 */
function add_taxonomy(): void
{
  register_taxonomy(
    'news-term',
    'news',
    [
      'label' => 'NEWSカテゴリー',
      'singular_label' => 'NEWSカテゴリー',
      'labels' => [
        'all_items' => 'NEWSカテゴリー一覧',
        'add_new_item' => 'NEWSカテゴリーを追加',
      ],
      'public' => true,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'hierarchical' => true,
    ]
  );
}
add_action('init', 'add_taxonomy');


/**
 * カスタム投稿のURLを変更
 */
function custom_rewrite_rules_array($rules)
{
  $new_rules = [
    'recruit/([0-9]+)/?$' => 'index.php?post_type=recruit&p=$matches[1]',
  ];

  return $new_rules + $rules;
}
// add_filter( 'rewrite_rules_array', 'custom_rewrite_rules_array' );