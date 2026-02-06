<?php

namespace App\Admin;

use App\Service\Config;

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
    //
    foreach (Config::get('taxonomies') ?? [] as $name => $args) {
      $postType = $args['post_type'];
      unset($args['post_type']);
      register_taxonomy($name, $postType, $args);
    }
  }
}