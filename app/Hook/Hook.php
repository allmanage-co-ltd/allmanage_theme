<?php

namespace App\Hook;

/**-----------------------------------
 *  プラグインhookクラス
 *----------------------------------*/
abstract class Hook
{
    abstract public function __construct();
    abstract public function boot(): void;
}