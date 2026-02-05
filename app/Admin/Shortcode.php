<?php

namespace App\Admin;

/**-----------------------------------
 *
 *----------------------------------*/
class Shortcode extends Admin
{
    public function __construct() {}

    /**
     *
     */
    public function boot(): void
    {
        add_shortcode('home', 'home');
        add_shortcode('theme_uri', 'theme_uri');
        add_shortcode('theme_dir', 'theme_dir');
        add_shortcode('img_dir', 'img_dir');
    }
}