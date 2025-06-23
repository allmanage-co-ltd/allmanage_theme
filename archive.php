<?php
$post_type = get_query_var('post_type');

if (post_type_exists($post_type) && is_post_type_archive($post_type)) {
  $file = 'view/archive/' . $post_type . '.php';

  if (file_exists(theme_dir() . $file)) {
    include_once(theme_dir() . 'header.php');
    include_once(theme_dir() . $file);
    include_once(theme_dir() . 'footer.php');
  } else {
    get_template_part('archive');
  }
} else {
  header("HTTP/1.0 404 Not Found");
  include_once(theme_dir() . '404.php');
  exit;
}