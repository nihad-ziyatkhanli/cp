<?php

namespace App\Custom\Traits;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Custom\Services\MenuItemService;

trait ConstructsPages
{
    use AuthorizesRequests;
    use ConvertsEmptyStringsToNull;

    public $mi_title;
    public $mi_code;
    public $view;
    public $menu_data;
    public $success;

    public function bootConstructsPages()
    {
        $this->authorize('access_cp');
    }

    public function mountConstructsPages()
    {
        $menu_item = MenuItemService::current();
        $this->mi_title = $menu_item['title'];
        $this->mi_code = $menu_item['code'];
        $this->view = 'cp.' . $this->mi_code . '.' . substr(strrchr(static::class, '\\'), 1);
        $this->menu_data = auth()->user()->getMenuData($this->mi_code);
    }

    public function bootedConstructsPages()
    {
        $this->success = session('success');
    }
}
