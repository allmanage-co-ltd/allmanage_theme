<?php

declare(strict_types=1);

/**
 * NEWS
 */
function create_post_type_news(): void
{
  register_post_type('news', [
    'labels' => [
      'name' => 'NEWS',
      'singular_name' => 'news',
    ],
    'public' => true,
    'has_archive' => true,
    'menu_position' => 5,
    'show_in_rest' => false,
    'supports' => ['title', 'editor', 'thumbnail'],
  ]);
  register_taxonomy(
    'news-cat',
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
add_action('init', 'create_post_type_news');


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
