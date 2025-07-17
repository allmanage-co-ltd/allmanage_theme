<?php

declare(strict_types=1);

/**
 * パンくずリストを生成して出力する
 *
 * WordPressの条件分岐タグ（is_single, is_page, is_archive など）を用いて、
 * 現在表示しているページに応じた階層構造のパンくずリストを自動生成する。
 * HTML構造は <div class="breadcrumb-list"><ul class="breadcrumb">...</ul></div> で出力される。
 *
 * ▼出力例
 * <div class="breadcrumb-list">
 *   <ul class="breadcrumb">
 *     <li><a href="/">TOP</a></li>
 *     <li><a href="/category">カテゴリ名</a></li>
 *     <li>現在のページタイトル</li>
 *   </ul>
 * </div>
 *
 * - トップページ、管理画面、特定ページ(application, maintenance)では何も出力しない
 * - 配列に格納したリスト要素を最終的にimplode()で結合し、ヒアドキュメントで出力
 */
function breadcrumb(): void
{
  global $post;

  if (is_home() || is_front_page() || is_page(['application', 'maintenance']) || is_admin()) {
    return;
  }

  $items = ['<li><a href="' . home_url('/') . '">TOP</a></li>'];

  switch (true) {
    case is_search():
      $items[] = '<li>「' . get_search_query() . '」で検索した結果</li>';
      break;

    case is_tag():
      $items[] = '<li>タグ : ' . single_tag_title('', false) . '</li>';
      break;

    case is_404():
      $items[] = '<li>404 Not found</li>';
      break;

    case is_date():
      $year  = get_query_var('year');
      $month = get_query_var('monthnum');
      $day   = get_query_var('day');

      if ($day) {
        $items[] = '<li><a href="' . get_year_link($year) . '">' . $year . '年</a></li>';
        $items[] = '<li><a href="' . get_month_link($year, $month) . '">' . $month . '月</a></li>';
        $items[] = '<li>' . $day . '日</li>';
      } elseif ($month) {
        $items[] = '<li><a href="' . get_year_link($year) . '">' . $year . '年</a></li>';
        $items[] = '<li>' . $month . '月</li>';
      } else {
        $items[] = '<li>' . $year . '年</li>';
      }
      break;

    case is_category():
      $cat = get_queried_object();
      $cat_id = $cat->parent ? array_reverse(get_ancestors($cat->term_id, 'category'))[0] : $cat->term_id;
      $items[] = '<li>' . get_cat_name($cat_id) . '</li>';
      break;

    case is_author():
      $items[] = '<li>投稿者 : ' . get_the_author_meta('display_name', get_query_var('author')) . '</li>';
      break;

    case is_page():
      if ($post->post_parent) {
        foreach (array_reverse(get_post_ancestors($post->ID)) as $ancestor) {
          $items[] = '<li><a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
        }
      }
      $items[] = '<li>' . $post->post_title . '</li>';
      break;

    case is_attachment():
      if ($post->post_parent) {
        $items[] = '<li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>';
      }
      $items[] = '<li>' . $post->post_title . '</li>';
      break;

    case is_single():
      if (is_singular('post')) {
        $categories = get_the_category($post->ID);
        if (!empty($categories)) {
          $cat = $categories[0];
          if ($cat->parent) {
            $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
            $cat = get_category($ancestors[0]);
          }
          $items[] = '<li><a href="' . home() . 'news">' . $cat->name . '</a></li>';
        }
      } else {
        $obj = get_post_type_object(get_post_type());
        $items[] = '<li><a href="' . home() . 'news">' . $obj->label . '</a></li>';
      }
      $items[] = '<li>' . $post->post_title . '</li>';
      break;

    case is_tax():
    case is_archive():
      $cat = get_queried_object();
      $taxonomy   = is_tax() ? get_taxonomy(get_query_var('taxonomy')) : null;
      $post_type  = $taxonomy->object_type[0] ?? $post->post_type ?? '';
      if ($post_type) {
        $obj = get_post_type_object($post_type);
        $items[] = '<li><a href="' . get_post_type_archive_link($post_type) . '">' . $obj->label . '</a></li>';
      }
      if (!empty($cat->term_id)) {
        if ($cat->parent) {
          foreach (array_reverse(get_ancestors($cat->term_id, $cat->taxonomy)) as $ancestor) {
            $items[] = '<li><a href="' . get_term_link($ancestor, $cat->taxonomy) . '">' . get_cat_name($ancestor) . '</a></li>';
          }
        }
        $items[] = '<li>' . $cat->name . '</li>';
      }
      break;

    default:
      $items[] = '<li>' . wp_title('', false) . '</li>';
      break;
  }

  $list_html = implode("\n", $items);
  echo <<<HTML
<div class="breadcrumb-list">
  <ul class="breadcrumb">
    {$list_html}
  </ul>
</div>
HTML;
}