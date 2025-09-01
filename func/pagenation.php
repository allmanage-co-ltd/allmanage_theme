<?php

declare(strict_types=1);

/**
 * ページネーションを生成して出力する
 *
 * WordPress のグローバル変数 $paged, $wp_query を用いて、
 * 現在のページ番号と最大ページ数を元にページネーションを生成する。
 * 前後ページリンク、および指定範囲内のページ番号リンクを <ul class="pagination"> 内に出力する。
 *
 * ▼出力例
 * <ul class="pagination justify-content-center">
 *   <li class="page-item first"><a href="/page/1" class="page-link"><i class="fas fa-angle-left"></i></a></li>
 *   <li class="page-item active"><a href="#" class="page-link">1</a></li>
 *   <li class="page-item"><a href="/page/2" class="page-link">2</a></li>
 *   <li class="page-item last"><a href="/page/3" class="page-link"><i class="fas fa-angle-right"></i></a></li>
 * </ul>
 *
 * - $pages 引数が空の場合、自動的に $wp_query->max_num_pages を使用する
 * - $range により現在ページ周辺のページリンク数を制御できる
 * - 1ページのみの場合は何も出力しない
 *
 * @param int|string $pages 総ページ数（空の場合は自動算出）
 * @param int        $range 表示するページ番号の範囲（デフォルト5）
 */

function wp_pagination($pages = '', int $range = 5): void
{
  global $paged, $wp_query;

  $paged = $paged ?: 1;
  $pages = $pages !== '' ? (int)$pages : (int)($wp_query->max_num_pages ?: 1);

  if ($pages <= 1) {
    return;
  }

  $page_center = (int)ceil($range / 2);
  $page_minus  = $page_center - 1;
  $page_plus   = $range % 2 === 0 ? $page_minus + 1 : $page_minus;
  $pag_col     = ($pages - $range) + 1;

  $start = 1;
  $end   = $pages;

  if ($pages > $range) {
    if ($paged <= $page_center) {
      $start = 1;
      $end   = $range;
    } elseif ($paged + $page_minus >= $pages) {
      $start = $pag_col;
      $end   = $pages;
    } else {
      $start = $paged - $page_minus;
      $end   = $paged + $page_plus;
    }
  }

  // ページ番号ループをまとめて作成
  $page_links = '';
  for ($i = $start; $i <= $end; $i++) {
    $active_class = $paged === $i ? 'active' : '';
    $link = $paged === $i ? '#' : get_pagenum_link($i);

    $page_links .= <<<HTML
      <li class="page-item {$active_class}">
        <a href="{$link}" class="page-link">{$i}</a>
      </li>
      HTML;
  }

  // 前へ・次へリンク
  $prev_link = $paged > 1
    ? '<a href="' . get_pagenum_link($paged - 1) . '" class="page-link"><i class="fas fa-angle-left"></i></a>'
    : '';
  $next_link = $paged < $pages
    ? '<a href="' . get_pagenum_link($paged + 1) . '" class="page-link"><i class="fas fa-angle-right"></i></a>'
    : '';


  echo <<<HTML
    <ul class="pagination justify-content-center">
      <li class="page-item first">{$prev_link}</li>
      {$page_links}
      <li class="page-item last">{$next_link}</li>
    </ul>
    HTML;
}