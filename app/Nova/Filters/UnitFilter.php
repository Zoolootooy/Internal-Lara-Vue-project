<?php
namespace App\Nova\Filters;

use App\Models\Unit;

class UnitFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Unit');
    }

    /**
     * @param mixed ...$arguments
     * @return FilterMakeTrait
     */
    public static function make(...$arguments)
    {
        $name = $arguments[0] ?? null;
        $attribute = $arguments[1] ?? 'unit_id';
        $options = $arguments[2] ?? Unit::flippedList();

        return parent::make($name, $attribute, $options);
    }
}
