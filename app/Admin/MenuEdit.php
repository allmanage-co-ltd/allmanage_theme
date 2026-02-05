<?php

namespace App\Admin;

/**-----------------------------------
 *
 *----------------------------------*/
class MenuEdit
{
  public function __construct() {}

  /**
   *
   */
  public function boot(): void
  {
    $this->option();
    $this->admin();
    $this->client();
  }

  private function option(): void
  {
    //
  }

  private function admin(): void
  {
    //
  }

  private function client(): void
  {
    //
  }
}
