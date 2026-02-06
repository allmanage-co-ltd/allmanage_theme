<?php

namespace App\Admin;

use App\Service\Config;

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
    //
    foreach (Config::get('post-types') ?? [] as $name => $args) {
      register_post_type($name, $args);
    }
  }
}