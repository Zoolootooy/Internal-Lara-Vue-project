<?php

namespace App\Nova\Filters;

class CreatedAtFilter extends DateFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Created At');
    }
}
