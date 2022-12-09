<?php
namespace App\Helpers;

use Route;
use Illuminate\Support\Str;
use App\Traits\RuleTrait;

class RuleHelper
{
    use RuleTrait;

    /**
     * @param $field
     * @return bool
     */
    public static function isRequired($field)
    {
        $rules = (new self)->fieldRules($field);

        return !empty($rules) && in_array('required', $rules);
    }

    /**
     * @return string
     */
    protected function getModelName()
    {
        $routeName = Route::currentRouteName();

        return Str::ucfirst(Str::before($routeName, '.'));
    }
}