<?php

namespace App\Service;

/**-----------------------------------
 *
 *----------------------------------*/
class Config extends Service
{
    public function __construct() {}

    /**
     *
     */
    public static function get(string $key, $default = null): mixed
    {
        static $configs = [];

        $parts = explode('.', $key, 2);
        $file  = $parts[0] ?? null;
        $path  = $parts[1] ?? null;

        if (!$file) {
            return $default;
        }

        if (!array_key_exists($file, $configs)) {
            $configPath = theme_dir() . "config/{$file}.php";

            if (!file_exists($configPath)) {
                return $default;
            }

            $loaded = require $configPath;

            if (!is_array($loaded)) {
                return $default;
            }

            $configs[$file] = $loaded;
        }

        if ($path === null) {
            return $configs[$file];
        }

        return self::array_get($configs[$file], $path, $default);
    }

    /**
     *
     */
    private static function array_get(array $array, string $key, $default = null): mixed
    {
        if ($key === '') {
            return $array;
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }
            $array = $array[$segment];
        }

        return $array;
    }
}