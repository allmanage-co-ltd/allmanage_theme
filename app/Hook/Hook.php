<?php

namespace App\Hook;

/**-----------------------------------
 *
 *----------------------------------*/
abstract class Hook
{
  public function __construct()
  {
    //
  }

  abstract public function boot(): void;
}