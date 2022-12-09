<?php

namespace App\Nova\Filters;

class UpdatedAtFilter extends DateFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Updated At');
    }
}
