<?php
namespace App\Nova\Filters;

class ValueTypeFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Value Type');
    }
}
