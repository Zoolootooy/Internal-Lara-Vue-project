<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;

abstract class AdminController extends Controller
{
    /**
     * @var null
     */
    public $areaName = 'admin.';

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
}
