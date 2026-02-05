<?php

declare(strict_types=1);

use App\App;

/**-----------------------------------
 * ここはエントリーポイントのみ。
 * 全ての機能は app/ で管理。
 *----------------------------------*/
require_once __DIR__ . '/vendor/autoload.php';

$app = new App();
$app->boot();