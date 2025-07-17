<?php
$taxonomy = get_query_var('taxonomy');

$header = theme_dir() . 'header.php';
$footer = theme_dir() . 'footer.php';
$file   = theme_dir() . "view/taxonomy/{$taxonomy}.php";

if (
  empty($taxonomy) ||
  !taxonomy_exists($taxonomy) ||
  !is_tax($taxonomy) ||
  !file_exists($file)
) {
  to_404notfound();
}

foreach ([$header, $file, $footer] as $f) {
  include_once $f;
}