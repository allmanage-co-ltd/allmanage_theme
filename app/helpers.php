<?php

/**-----------------------------------
 * グローバルな関数を定義
 * ここに書いたものはどこからでも呼び出せます。
 *
 * ・スタティックメソッドを呼ぶ際はシグネチャを合わせる
 * ・なるべく薄く済ませる
 * ・ロジックはServiceクラス等に切り出す
 *----------------------------------*/

/**
 *
 */
function logger(string $type, string $message, array $context = []): void
{
    $logger = \App\Service\Logger::get();

    match ($type) {
        'info'  => $logger->info($message, $context),
        'error' => $logger->error($message, $context),
        default => $logger->info($message, $context),
    };
}

/**
 *
 */
function home(): string
{
    return home_url();
}

/**
 *
 */
function url(string $slug = 'home'): string
{
    return \App\Service\Config::get("permalink.{$slug}") ?? home_url('/');
}

/**
 *
 */
function theme_uri()
{
    return rtrim(get_template_directory_uri(), '/') . '/';
}

/**
 *
 */
function theme_dir()
{
    return rtrim(get_template_directory(), '/') . '/';
}

/**
 *
 */
function img_dir()
{
    return theme_uri() . '/assets/img';
}

/**
 *
 */
function config(string $key, $default = null)
{
    return \App\Service\Config::get($key, $default);
}

/**
 *
 */
function view()
{
    return \App\Service\Render::view();
}

/**
 *
 */
function layout(string $name)
{
    return \App\Service\Render::layout($name);
}

/**
 *
 */
function component(string $name, array $data = [])
{
    return \App\Service\Render::component($name, $data);
}

/**
 *
 */
function is_local()
{
    $host = $_SERVER['HTTP_HOST'];

    if (empty($host)) {
        return false;
    }

    $localhosts = [
        'localhost',
        '127.0.0.1',
        'web-checker',
    ];

    foreach ($localhosts as $localhost) {
        if (strpos($host, $localhost) !== false) {
            return true;
        }
    }

    return false;
}

/**
 *
 */
function is_iphone()
{
    $is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');
    if ($is_iphone) {
        return true;
    }

    return false;
}

/**
 *
 */
function is_android()
{
    $is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Android');
    if ($is_android) {
        return true;
    }

    return false;
}

/**
 *
 */
function is_ipad()
{
    $is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
    if ($is_ipad) {
        return true;
    }

    return false;
}

/**
 *
 */
function is_kindle()
{
    $is_kindle = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle');
    if ($is_kindle) {
        return true;
    }

    return false;
}

/**
 *
 */
function is_mobile()
{
    $useragents = [
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android', // 1.5+ Android
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate', // Other iPhone browser
    ];
    $pattern = '/' . implode('|', $useragents) . '/i';

    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

/**
 *
 */
function isBot()
{
    $bot_list = [
        'Googlebot',
        'Yahoo! Slurp',
        'Mediapartners-Google',
        'msnbot',
        'bingbot',
        'MJ12bot',
        'Ezooms',
        'pirst; MSIE 8.0;',
        'Google Web Preview',
        'ia_archiver',
        'Sogou web spider',
        'Googlebot-Mobile',
        'AhrefsBot',
        'YandexBot',
        'Purebot',
        'Baiduspider',
        'UnwindFetchor',
        'TweetmemeBot',
        'MetaURI',
        'PaperLiBot',
        'Showyoubot',
        'JS-Kit',
        'PostRank',
        'Crowsnest',
        'PycURL',
        'bitlybot',
        'Hatena',
        'facebookexternalhit',
        'NINJA bot',
        'YahooCacheSystem',
    ];
    $is_bot = false;
    foreach ($bot_list as $bot) {
        if (false !== stripos($_SERVER['HTTP_USER_AGENT'], $bot)) {
            $is_bot = true;

            break;
        }
    }

    return $is_bot;
}