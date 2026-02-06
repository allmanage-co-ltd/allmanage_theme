<?php

return [
  'news' => [
    'labels' => ['name' => 'NEWS', 'singular_name' => 'news'],
    'public' => true,
    'has_archive' => true,
    'menu_position' => 5,
    'show_in_rest' => false,
    'supports' => ['title', 'editor', 'thumbnail'],
  ],
];