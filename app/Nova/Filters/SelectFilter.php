<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class SelectFilter extends Filter
{
    use FilterMakeTrait;

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * @var
     */
    public $attribute;

    /**
     * @var array|null|void
     */
    public $options = [];

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where($this->attribute, $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return $this->options ?? $this->getDefaultOptions();
    }

    /**
     * return null
     */
    public function getDefaultOptions()
    {
        return [
            __('No') => 0,
            __('Yes') => 1,
        ];
    }
}
