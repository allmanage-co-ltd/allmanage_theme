<?php

namespace App\Hook;

/**-----------------------------------
 *
 *----------------------------------*/
class ACFHook extends Hook
{
    public function __construct() {}

    /**
     *
     */
    public function boot(): void
    {
        // add_action('acf/init', [$this, 'register_option_page']);
    }

    /**
     *
     */
    public function register_option_page(): void
    {
        // if (function_exists('acf_add_options_page')) {
        //     acf_add_options_page([
        //         'page_title' => 'テーマ設定',
        //         'menu_title' => 'テーマ設定',
        //         'menu_slug'  => 'theme-settings',
        //         'capability' => 'manage_options',
        //         'redirect'   => false,
        //     ]);
        // }
    }
}