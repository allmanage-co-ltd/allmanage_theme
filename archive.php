<?php
$post_type = get_query_var('post_type');

$header = theme_dir() . 'header.php';
$footer = theme_dir() . 'footer.php';
$file   = theme_dir() . "view/archive/{$post_type}.php";

if (
  !post_type_exists($post_type) ||
  !is_post_type_archive($post_type) ||
  !file_exists($file)
) {
  to_404notfound();
}

foreach ([$header, $file, $footer] as $f) {
  include_once $f;
}