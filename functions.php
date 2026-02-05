<?php

declare(strict_types=1);

use App\Bootstrap\App;

/**-----------------------------------
 * ここはエントリーポイントのみ。
 * 全ての機能は app/ で管理。
 *
 * /app/helpers.phpのみファサード化
 *----------------------------------*/

//  Composer への依存関係を読み込む
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// アプリケーションを起動
(new App())->boot();