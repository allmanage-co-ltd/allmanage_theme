<?php

namespace App\Admin;

/**-----------------------------------
 *
 *----------------------------------*/
class RegisterTaxonomy extends Admin
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
        register_taxonomy(
            'news-cat',
            'news',
            [
                'label' => 'NEWSカテゴリー',
                'singular_label' => 'NEWSカテゴリー',
                'labels' => [
                    'all_items' => 'NEWSカテゴリー一覧',
                    'add_new_item' => 'NEWSカテゴリーを追加',
                ],
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'hierarchical' => true,
            ]
        );
    }
}