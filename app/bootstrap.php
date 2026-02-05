<?php

namespace App;

use App\Admin\AdminFooter;
use App\Admin\CustomPost;
use App\Admin\MenuEdit;
use App\Admin\Settings;
use App\Admin\Shortcode;
use App\Hook\ACFHook;
use App\Hook\MwFormHook;
use App\Hook\WelcartHook;

/**-----------------------------------
 *
 *------------------------------------
 *
 */
class App
{
  public const VERSION = '0.1.0';

  public function __construct() {}

  /**-----------------------------------
   *
   *----------------------------------*/
  public function boot()
  {
    //
    new Settings();
    new CustomPost();
    new MenuEdit();
    new Shortcode();
    new AdminFooter();

    //
    new ACFHook();
    new MwFormHook();
    new WelcartHook();

    //
    $this->enqueue();
  }

  /**-----------------------------------
   *
   *----------------------------------*/
  public function enqueue()
  {
    $dir = get_template_directory_uri();

    // フロントCSS
    add_action('wp_enqueue_scripts', function () use ($dir) {
      wp_enqueue_style('style', $dir . '/assets/css/style.css', false, $this::VERSION);
      wp_enqueue_style('include', $dir . '/assets/css/include.css', false, $this::VERSION);
    });

    // フロントJS
    add_action('wp_enqueue_scripts', function () use ($dir) {
      wp_deregister_script('jquery');
      wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', [], false, true);
      wp_enqueue_script('scripts', $dir . '/assets/js/scripts.js', ['jquery'], $this::VERSION, true);
      wp_enqueue_script('scripts_add', $dir . '/assets/js/scripts_add.js', ['jquery'], $this::VERSION, true);
    });

    // 管理画面CSS
    add_action('admin_enqueue_scripts', function () use ($dir) {
      wp_enqueue_style('admin', $dir . '/assets/admin/admin.css', false, $this::VERSION);
    });

    // ログイン画面CSS
    add_action('login_enqueue_scripts', function () use ($dir) {
      wp_enqueue_style('admin', $dir . '/assets/admin/admin.css', false, $this::VERSION);
    });

    // 管理画面JS
    add_action('admin_enqueue_scripts', function () use ($dir) {
      wp_enqueue_media();
      wp_deregister_script('jquery');
      wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', [], false, true);
      wp_enqueue_script('admin', $dir . '/assets/admin/admin.js', ['jquery'], $this::VERSION, true);
    });
  }
}