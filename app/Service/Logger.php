<?php

namespace App\Service;

use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;

/**-----------------------------------
 *
 *----------------------------------*/
class Logger extends Service
{
    public function __construct() {}

    private static ?MonoLogger $logger = null;

    /**
     *
     */
    public static function get(): MonoLogger
    {
        if (self::$logger !== null) {
            return self::$logger;
        }

        $out = theme_dir() . '/logs/app.log';

        self::$logger = new MonoLogger('app');
        self::$logger->pushHandler(
            new StreamHandler($out, MonoLogger::INFO)
        );

        return self::$logger;
    }
}