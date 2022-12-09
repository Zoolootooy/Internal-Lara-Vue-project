<?php

namespace App\Nova\Filters;

class VisibleFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Visible');
    }
}
