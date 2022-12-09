<?php

namespace App\Nova\Filters;

use App\Models\Menu;

class MenuFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Menu');
    }

    /**
     * @param mixed ...$arguments
     * @return FilterMakeTrait
     */
    public static function make(...$arguments)
    {
        $name = $arguments[0] ?? null;
        $attribute = $arguments[1] ?? 'menu_id';
        $options = $arguments[2] ?? Menu::flippedList();

        return parent::make($name, $attribute, $options);
    }
}
