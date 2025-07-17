<?php

declare(strict_types=1);

get_header();

$base_folder  = 'view/page/';
$slug         = $post->post_name;
$parent_slugs = [];

// 親ページがある場合はフォルダ階層を作る
if ($ancestors = get_post_ancestors($post->ID)) {
  foreach (array_reverse($ancestors) as $ancestor) {
    $parent_slugs[] = get_post($ancestor)->post_name;
  }
}

$dir = $base_folder . (empty($parent_slugs) ? '' : implode('/', $parent_slugs) . '/') . $slug;

/**
 * 優先度
 * 1. /view/page/hoge/index.php
 * 2. /view/page/hoge.php
 */
$index_file = $dir . '/index';
if (locate_template($index_file . '.php')) {
  $file = $index_file;
} elseif (locate_template($dir . '.php')) {
  $file = $dir;
} else {
  to_404notfound();
}

get_template_part($file);
get_footer();
