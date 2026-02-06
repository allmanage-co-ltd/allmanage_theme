<?php

namespace App\Plugin;

/**-----------------------------------
 *  プラグインhookクラス
 *----------------------------------*/
abstract class Plugin
{
    abstract public function __construct();
    abstract public function boot(): void;
}