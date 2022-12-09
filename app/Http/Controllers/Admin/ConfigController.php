<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ConfigController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'config';

    /**
     * @param Request $request
     * @return bool
     */
    public function sidebarStatus(Request $request)
    {
        if (empty($request->status)) {
            return response()->json(false);
        }

        $value = empty(Cookie::get('sidebarStatus'));

        Cookie::queue('sidebarStatus', $value, 36000);

        return response()->json(true);
    }
}