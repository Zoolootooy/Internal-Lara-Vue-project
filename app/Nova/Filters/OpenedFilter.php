<?php

namespace App\Nova\Filters;

class OpenedFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Opened');
    }
}
