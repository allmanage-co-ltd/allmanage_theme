<?php

/******************************************************
 *
 * インクルード
 *
 *******************************************************/
// 独自関数の設定
require_once locate_template('inc/function.php');
// スタイル・スクリプトの設定
require_once locate_template('inc/insert-src.php');
// Wordpressの基本設定
require_once locate_template('inc/wp-setting.php');
// パンくずの設定
require_once locate_template('inc/breadcrumb.php');
// ページネーションの設定
require_once locate_template('inc/pagenation.php');
// カスタム投稿の設定
require_once locate_template('inc/custom-post.php');
// SEOの設定
require_once locate_template('inc/seo.php');
// コンバージョンの設定
require_once locate_template('inc/conversion.php');
// CSVフィールドの設定
// require_once locate_template('inc/csv-field.php');
// タスク管理の設定
require_once locate_template('inc/tasks.php');
