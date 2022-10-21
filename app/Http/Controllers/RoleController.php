<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Custom\Traits\ConstructsPages;
//use App\Custom\Helpers\Helper;
//use App\Custom\Services\RoleService;


class RoleController extends Controller
{
    use ConstructsPages;

    public function index()
    {
        $this->authorize('read');

        return view($this->view.'.'.__FUNCTION__ , array_merge($this->shared, []));
    }
}
