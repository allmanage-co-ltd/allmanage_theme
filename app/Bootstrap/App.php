<?php

namespace App\Bootstrap;

use App\Hook\Enqueue;
use App\Hook\SetupTheme;
use App\Hook\Shortcode;
use App\Admin\EditMenuAdmin;
use App\Admin\EditMenuClient;
use App\Admin\RegisterPostType;
use App\Admin\RegisterTaxonomy;
use App\Plugin\ACF;
use App\Plugin\MwForm;
use App\Plugin\Welcart;

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
    (new SetupTheme())->boot();
    (new Shortcode())->boot();
    (new Enqueue())->boot();

    //
    (new RegisterPostType())->boot();
    (new RegisterTaxonomy())->boot();
    (new EditMenuAdmin())->boot();
    (new EditMenuClient())->boot();

    //
    (new ACF())->boot();
    (new MwForm())->boot();
    (new Welcart())->boot();
  }
}