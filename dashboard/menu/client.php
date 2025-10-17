<?php

declare(strict_types=1);

/**
 * お客さんへ渡すユーザー権限の管理画面メニューをカスタマイズする
 * 基本的には「新着情報」「カスタム投稿」「メディア」「その他プラグイン」「必要オプション」のみ表示
 * 上記以外のメニューにアクセスできるリンクなども全て削除
 */


/**
 * 表示したいメニューのスラッグを指定
 *
 * ※指定スラッグのメニューが無くてもスルーされるのであらかじめ登録しても問題ありません。
 */
function my_custom_menus()
{
  return [
    'post' => [
      'news',
      'works',
      'products',
      'case',
    ],
    'option' => [
      'usc-e-shop/usc-e-shop.php', // ウェルカート
      'usces_orderlist',           // ウェルカート
    ],
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
    // 'edit.php',                   // 投稿
    'upload.php',                 // メディア
    'profile.php',                // プロフィール
  ];

  $customMenus = my_custom_menus();

  // カスタム投稿のメニューを追加
  if (!empty($customMenus['post'])) {
    foreach ($customMenus['post'] as $postType) {
      $allowedMenus[] = 'edit.php?post_type=' . $postType;
    }
  }

  // オプションページのメニューを追加
  if (!empty($customMenus['option'])) {
    foreach ($customMenus['option'] as $optionPage) {
      $allowedMenus[] =  $optionPage;
    }
  }

  global $menu;
  foreach ($menu as $key => $value) {
    $menu_slug = $value[2];
    $keep = in_array($menu_slug, $allowedMenus);

    // サブメニューがあり、いずれかが許可されてる場合も keep にする
    if (!$keep && !empty($GLOBALS['submenu'][$menu_slug])) {
      foreach ($GLOBALS['submenu'][$menu_slug] as $submenu_item) {
        $submenu_slug = $submenu_item[2];
        if (in_array($submenu_slug, $allowedMenus)) {
          $keep = true;
          break;
        }
      }
    }

    if (!$keep) {
      remove_menu_page($menu_slug);
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
add_action('admin_menu', 'remove_menus_for_editor', 9999);


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
add_action('admin_bar_menu', 'customize_admin_bar_for_limited_users', 9999);