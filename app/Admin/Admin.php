<?php

namespace App\Admin;

/**-----------------------------------
 *  管理画面、WPセットアップクラス
 *----------------------------------*/
abstract class Admin
{
    abstract public function __construct();
    abstract public function boot(): void;
}