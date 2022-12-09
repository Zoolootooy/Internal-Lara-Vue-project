<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter as BaseDateFilter;

class DateFilter extends BaseDateFilter
{
    use FilterMakeTrait;

    /**
     * @var
     */
    public $attribute;

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
        return $query->where($this->attribute, '>=', Carbon::parse($value))
            ->where($this->attribute, '<=', Carbon::parse($value)->addDay());
    }
}
