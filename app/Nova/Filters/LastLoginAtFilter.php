<?php

namespace App\Nova\Filters;

class LastLoginAtFilter extends DateFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Last Login At');
    }
}
