<?php
namespace App\Nova\Filters;

use App\Models\User;

class CreatedByFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Created By');
    }

    /**
     * @param mixed ...$arguments
     * @return FilterMakeTrait
     */
    public static function make(...$arguments)
    {
        $name = $arguments[0] ?? __('Created By');
        $attribute = $arguments[1] ?? 'created_by';
        $options = $arguments[2] ?? User::flippedList();

        return parent::make($name, $attribute, $options);
    }
}
