<?php

namespace App\Hook;

/**-----------------------------------
 *
 *----------------------------------*/
abstract class Hook
{
  abstract public function __construct();
  abstract public function boot(): void;
}