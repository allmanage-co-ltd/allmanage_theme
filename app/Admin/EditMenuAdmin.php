<?php

namespace App\Admin;

/**-----------------------------------
 *
 *----------------------------------*/
class EditMenuAdmin extends Admin
{
    public function __construct() {}

    /**
     *
     */
    public function boot(): void
    {
        if (! $this->limited_role()) return;
        $this->hidden_admin_bar();
    }

    /**
     *
     */
    public function limited_role(): bool
    {
        return current_user_can('administrator');
    }

    /**
     *
     */
    public function hidden_admin_bar(): void
    {
        show_admin_bar(false);
    }
}