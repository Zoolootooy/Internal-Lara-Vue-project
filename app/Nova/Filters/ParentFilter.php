<?php
namespace App\Nova\Filters;

class ParentFilter extends SelectFilter
{
    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('Category');
    }

    /**
     * @param mixed ...$arguments
     * @return FilterMakeTrait
     */
    public static function make(...$arguments)
    {
        $name = $arguments[0] ?? __('Category');
        $attribute = $arguments[1] ?? 'parent_id';

        return parent::make($name, $attribute);
    }
}
