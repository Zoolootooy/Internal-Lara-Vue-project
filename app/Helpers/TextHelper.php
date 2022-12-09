<?php

namespace App\Helpers;

use App\Models\Setting;

/**
 * Class TextHelper
 * @package App\Helpers
 */
class TextHelper
{
    /**
     * @param $text
     * @return mixed
     */
    public static function formattedWithSettings($text)
    {
        foreach (Setting::all() as $setting) {
            $key = str_replace('contact_', '', $setting->key);
            $text = str_replace(['{' . $setting->key . '}', '{' . $key . '}'], '<b>' . $setting->value . '</b>', $text);
        }

        return $text;
    }
}
