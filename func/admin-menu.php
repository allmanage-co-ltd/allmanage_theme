<?php

/**
 * お客さんへ渡すユーザー権限の管理画面メニューをカスタマイズする
 * 基本的には「投稿」「カスタム投稿」「メディア」のみ表示
 * 上記以外のメニューにアクセスできるリンクなども全て削除
 */


/**
 * 表示したいカスタム投稿スラッグを指定
 *
 * ※指定スラッグのカスタム投稿が無くてもスルーされるのであらかじめ登録しても問題ありません。
 */
function my_custom_post_types()
{
  return [
    'news',
    'works',
  ];
}


/**
 * 対象ユーザーロール判定
 */
function is_limited_admin_user()
{
  return current_user_can('editor') ||
    current_user_can('author') ||
    current_user_can('contributor') ||
    current_user_can('subscriber');
}


/**
 * 管理画面メニューから指定メニュー以外を削除
 */
function remove_menus_for_editor()
{
  if (! is_limited_admin_user()) {
    return;
  }

  // 表示メニュー
  $allowedMenus = [
    'index.php',                  // ダッシュボード
    'edit.php',                   // 投稿
    'upload.php',                 // メディア
  ];

  $customPostType = my_custom_post_types();

  // カスタム投稿の指定があれば表示メニューに追加
  if (count($customPostType) > 0) {
    foreach ($customPostType as $postType) {
      $allowedMenus[] = 'edit.php?post_type=' . $postType;
    }
  }

  global $menu;
  foreach ($menu as $key => $value) {
    if (! in_array($value[2], $allowedMenus)) {
      remove_menu_page($value[2]);
    }
  }

  // ダッシュボードから指定のボックスを削除
  remove_meta_box('dashboard_site_health', 'dashboard', 'normal');    // サイトヘルスステータス
  remove_meta_box('dashboard_right_now', 'dashboard', 'normal');      // 概要
  // remove_meta_box('dashboard_activity', 'dashboard', 'normal');       // アクティビティ
  // remove_meta_box('dashboard_quick_press', 'dashboard', 'side');      // クイックドラフト
  remove_meta_box('dashboard_primary', 'dashboard', 'side');          // WordPressイベントとニュース
  // remove_action('welcome_panel', 'wp_welcome_panel');                 // ようこそパネル
}
add_action('admin_menu', 'remove_menus_for_editor', 999);


/**
 * 更新通知を削除
 */
function hide_update_notice_for_editor()
{
  if (! is_limited_admin_user()) {
    return;
  }

  remove_action('admin_notices', 'update_nag', 3);
  remove_action('network_admin_notices', 'update_nag', 3);
}
add_action('admin_init', 'hide_update_notice_for_editor');


/**
 * 上部管理バーからコメントと新規追加を削除
 */
function customize_admin_bar_for_limited_users($wp_admin_bar)
{
  if (! is_limited_admin_user()) {
    return;
  }

  $wp_admin_bar->remove_node('wp-logo');       // WordPressロゴ
  $wp_admin_bar->remove_node('comments');      // コメント
  $wp_admin_bar->remove_node('new-content');   // 新規追加
}
add_action('admin_bar_menu', 'customize_admin_bar_for_limited_users', 999);