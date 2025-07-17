<?php

declare(strict_types=1);

// 汎用関数
require_once locate_template('func/functions.php');

// [WP] 汎用関数
require_once locate_template('func/wp-functions.php');

// [WP] 基本設定
require_once locate_template('func/wp-functions.php');

// [WP] お客さんへ渡す管理画面の表示メニュー
require_once locate_template('func/wp-client-menu.php');

// [WP] スタイル・スクリプト
require_once locate_template('func/wp-insert-src.php');

// [WP] カスタム投稿
require_once locate_template('func/wp-custom-post.php');

// [WP] ショートコード
require_once locate_template('func/wp-shotecode.php');

// [UI] パンくず
require_once locate_template('func/ui-breadcrumb.php');

// [UI] ページネーション
require_once locate_template('func/ui-pagenation.php');