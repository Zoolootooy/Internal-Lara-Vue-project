<?php
namespace App\Nova\Filters;

use App\Models\Country;

class CountryFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Country');
    }

    /**
     * @param mixed ...$arguments
     * @return FilterMakeTrait
     */
    public static function make(...$arguments)
    {
        $name = $arguments[0] ?? null;
        $attribute = $arguments[1] ?? 'country_id';
        $options = $arguments[2] ?? Country::flippedList();

        return parent::make($name, $attribute, $options);
    }
}
