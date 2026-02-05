<?php

namespace App\Service;

/**-----------------------------------
 *
 *----------------------------------*/

class MyWpQuery
{
  public function __construct() {}

  /**
   *
   */
  public function new(): \WP_Query
  {
    $query = new \WP_Query();
    return $query;
  }
}
