<?php

namespace App\Hook;

use App\Service\Config;

/**-----------------------------------
 * Enqueue Hook
 *----------------------------------*/
class Enqueue extends Hook
{
  private string $version;

  public function __construct()
  {
    $this->version = (string) Config::get('assets.version', '1.0.0');
  }

  /**
   *
   */
  public function boot(): void
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueue_front']);
    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin']);
    add_action('login_enqueue_scripts', [$this, 'enqueue_admin']);
  }

  /**
   * フロント用アセット
   */
  public function enqueue_front(): void
  {
    $this->enqueue_jquery();
    $this->enqueue_styles(Config::get('assets.css'));
    $this->enqueue_scripts(Config::get('assets.js'));
  }

  /**
   * 管理画面用アセット
   */
  public function enqueue_admin(): void
  {
    wp_enqueue_media();

    $this->enqueue_jquery();
    $this->enqueue_styles(Config::get('assets.admin-css'));
    $this->enqueue_scripts(Config::get('assets.admin-js'));
  }

  /**
   * jQuery差し替え
   */
  private function enqueue_jquery(): void
  {
    $jquery = Config::get('assets.jquery');
    if (! $jquery) return;

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', $jquery, [], null, true);
  }

  /**
   * CSSまとめて登録
   */
  private function enqueue_styles(?array $styles): void
  {
    if (empty($styles)) return;

    foreach ($styles as $handle => $src) {
      wp_enqueue_style(
        is_string($handle) ? $handle : md5($src),
        $src,
        [],
        $this->version
      );
    }
  }

  /**
   * JSまとめて登録
   */
  private function enqueue_scripts(?array $scripts): void
  {
    if (empty($scripts)) return;

    foreach ($scripts as $handle => $src) {
      wp_enqueue_script(
        is_string($handle) ? $handle : md5($src),
        $src,
        ['jquery'],
        $this->version,
        true
      );
    }
  }
}