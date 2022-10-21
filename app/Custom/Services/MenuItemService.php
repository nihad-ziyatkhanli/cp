<?php

namespace App\Custom\Services;

use App\Custom\Helpers\Helper;

class MenuItemService
{
    /*  Returns an array containing current menu item details:
        Example:
        [
            'code' => 'roles',
            'title' => 'Roles',
            'url' => '/cp/roles',
        ]
    */

    public static function current()
    {
        $menu_items = config('cp.menu_items');
        $url = Helper::parse(\Request::getPathInfo(), '/', 3);

        $arr = [];
        foreach ($menu_items as $key => $item) {
            if (isset($item['url']) && $item['url'] === $url) {
                $arr = [
                    'code' => $key,
                    'title' => $item['title'],
                    'url' => $url,
                ];
                break;
            } elseif (isset($item['children'])) {
                foreach ($item['children'] as $key => $item) {
                    if (isset($item['url']) && $item['url'] === $url) {
                        $arr = [
                            'code' => $key,
                            'title' => $item['title'],
                            'url' => $url,
                        ];
                        break 2;
                    }
                }
            }
        }
        return $arr;
    }
}
