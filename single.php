<?php
$post_type = get_post_type();

$header = theme_dir() . 'header.php';
$footer = theme_dir() . 'footer.php';
$file   = theme_dir() . "view/single/{$post_type}.php";

if (
  !post_type_exists($post_type) ||
  !file_exists($file)
) {
  to_404notfound();
  exit;
}

foreach ([$header, $file, $footer] as $f) {
  include_once $f;
}