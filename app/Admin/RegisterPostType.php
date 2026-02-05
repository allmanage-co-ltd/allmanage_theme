<?php

namespace App\Admin;

/**-----------------------------------
 *
 *----------------------------------*/
class RegisterPostType extends Admin
{
    public function __construct() {}

    /**
     *
     */
    public function boot(): void
    {
        add_action('init', [$this, 'register']);
    }

    /**
     *
     */
    public function register(): void
    {
        register_post_type('news', [
            'labels' => [
                'name' => 'NEWS',
                'singular_name' => 'news',
            ],
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'show_in_rest' => false,
            'supports' => ['title', 'editor', 'thumbnail'],
        ]);
    }
}