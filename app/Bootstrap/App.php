<?php

namespace App\Bootstrap;

use App\Admin\EditMenuAdmin;
use App\Admin\EditMenuClient;
use App\Admin\Enqueue;
use App\Admin\RegisterPostType;
use App\Admin\RegisterTaxonomy;
use App\Admin\Settings;
use App\Admin\Shortcode;
use App\Hook\ACFHook;
use App\Hook\MwFormHook;
use App\Hook\WelcartHook;

/**-----------------------------------
 *
 *----------------------------------*/
class App
{
    public function __construct() {}

    /**
     *
     */
    public function boot(): void
    {
        //
        (new Settings())->boot();
        (new Enqueue())->boot();
        (new RegisterPostType())->boot();
        (new RegisterTaxonomy())->boot();
        (new EditMenuAdmin())->boot();
        (new EditMenuClient())->boot();
        (new Shortcode())->boot();

        //
        (new ACFHook())->boot();
        (new MwFormHook())->boot();
        (new WelcartHook())->boot();
    }
}