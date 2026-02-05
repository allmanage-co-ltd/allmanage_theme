<?php

namespace App\Admin;

use App\Service\Config;

/**-----------------------------------
 *
 *----------------------------------*/
class Enqueue extends Admin
{
    public function __construct()
    {
        $this->version = (string) Config::get('assets.version', '1.0.0');
    }

    //
    private string $version;

    /**
     *
     */
    public function boot(): void
    {
        add_action('wp_enqueue_scripts', [$this, 'front_css']);
        add_action('wp_enqueue_scripts', [$this, 'front_js']);
        add_action('admin_enqueue_scripts', [$this, 'admin_css']);
        add_action('login_enqueue_scripts', [$this, 'admin_css']);
        add_action('admin_enqueue_scripts', [$this, 'admin_js']);
    }

    /**
     *
     */
    public function front_css(): void
    {
        if (! Config::get('assets.css')) return;
        foreach (Config::get('assets.css') as $css) {
            wp_enqueue_style(basename($css), $css, [], $this->version);
        }
    }

    /**
     *
     */
    public function front_js(): void
    {
        if (Config::get('assets.jquery')) {
            wp_deregister_script('jquery');
            wp_enqueue_script('jquery', Config::get('assets.jquery'), [], false, true);
        }

        if (! Config::get('assets.js')) return;
        foreach (Config::get('assets.js') as $js) {
            wp_enqueue_script(basename($js), $js, ['jquery'], $this->version, true);
        }
    }

    /**
     *
     */
    public function admin_css(): void
    {
        if (! Config::get('assets.admin-css')) return;
        foreach (Config::get('assets.admin-css') as $admin_css) {
            wp_enqueue_script(basename($admin_css), $admin_css, [], $this->version, true);
        }
    }

    /**
     *
     */
    public function admin_js(): void
    {
        wp_enqueue_media();
        if (Config::get('assets.jquery')) {
            wp_deregister_script('jquery');
            wp_enqueue_script('jquery', Config::get('assets.jquery'), [], false, true);
        }

        if (! Config::get('assets.admin-js')) return;
        foreach (Config::get('assets.admin-js') as $js) {
            wp_enqueue_script(basename($js), $js, ['jquery'], $this->version, true);
        }
    }
}