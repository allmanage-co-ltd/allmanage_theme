<?php

namespace App\Service;

/**-----------------------------------
 *
 *----------------------------------*/
class MyWpQuery extends Service
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