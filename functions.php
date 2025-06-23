<?php

declare(strict_types=1);

// インクルード
// 独自関数の設定
require_once locate_template('func/function.php');

// スタイル・スクリプトの設定
require_once locate_template('func/insert-src.php');

// Wordpressの基本設定
require_once locate_template('func/wp-setting.php');

// パンくずの設定
require_once locate_template('func/breadcrumb.php');

// ページネーションの設定
require_once locate_template('func/pagenation.php');

// カスタム投稿の設定
require_once locate_template('func/custom-post.php');

// お客さんへ渡す管理画面の表示メニュー
require_once locate_template('func/admin-menu.php');