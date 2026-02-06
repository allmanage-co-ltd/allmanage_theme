<?php

namespace App\Plugin;

/**-----------------------------------
 *  プラグインhookクラス
 *----------------------------------*/
abstract class Plugin
{
  public function __construct()
  {
    //
  }

  abstract public function boot(): void;
}