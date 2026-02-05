<?php

namespace App\Service;

/**-----------------------------------
 * サービスクラス
 *
 * ・副作用やロジックをまとめるクラス
 * ・基本はstaticメソッドで実装する
 * ・WPで呼ぶ際はhelper.phpを挟む
 *----------------------------------*/
abstract class Service
{
    abstract public function __construct();
    // abstract public function boot(): void;
}