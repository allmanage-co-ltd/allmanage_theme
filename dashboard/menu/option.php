<?php

declare(strict_types=1);

/**
 */
function reorder_option_menu()
{
    global $menu;

    // オプションページのpositionとiconを指定
    $menu_config = [
        // 'slug' => [
        //     'pos' => 3,
        //     'icon' => 'dashicons-media-document'
        // ],
    ];

    foreach ($menu_config as $slug => $config) {
        foreach ($menu as $key => $item) {
            if (isset($item[2]) && $item[2] === $slug) {
                unset($menu[$key]);
                $item[6] = $config['icon'];
                $menu[$config['pos']] = $item;
                break;
            }
        }
    }

    ksort($menu);
}
add_action('admin_menu', 'reorder_option_menu', 999);
