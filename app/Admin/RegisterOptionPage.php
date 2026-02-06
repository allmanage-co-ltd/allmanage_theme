<?php

namespace App\Admin;

/**-----------------------------------
 *
 *----------------------------------*/
class RegisterOptionPage extends Admin
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
  }
}