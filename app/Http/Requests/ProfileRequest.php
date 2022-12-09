<?php

namespace App\Http\Requests;

use Auth;

class ProfileRequest extends UserRequest
{
    /**
     * @return \Illuminate\Routing\Route|null|object|string
     */
    public function getModel()
    {
        return Auth::user();
    }
}