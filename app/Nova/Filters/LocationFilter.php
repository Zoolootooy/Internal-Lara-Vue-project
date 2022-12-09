<?php
namespace App\Nova\Filters;

class LocationFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Location');
    }
}
