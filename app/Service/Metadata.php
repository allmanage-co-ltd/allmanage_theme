<?php

namespace App\Service;

use App\Helper\Config;

/**-----------------------------------
 *
 *----------------------------------*/

class Metadata
{
  public function __construct(
    private string $sitename = Config::get(''),
    private string $gtags = Config::get(''),
  ) {
    //
  }

  public static function get_title(): string
  {
    return '';
  }

  public static function get_description(): string
  {
    return '';
  }

  public static function get_gtag(): string
  {
    return '';
  }

  public static function get_jsonld(): string
  {
    return '';
  }
}
