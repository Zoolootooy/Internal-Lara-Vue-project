<?php
namespace App\Nova\Filters;

class TypeFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Type');
    }
}
