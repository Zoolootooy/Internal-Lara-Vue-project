<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use App\Models\Setting as Model;
use App\Nova\Filters\ValueTypeFilter;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;

class Setting extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Model::class;

    /**
     * @return null|string
     */
    public function subtitle()
    {
        return __('Value') . ': ' . ($this->value ?? '-');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'key', 'value'
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['createdBy'];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Settings');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Setting');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return $this->tabFields();
    }

    /**
     * @return array
     */
    public function tabFields()
    {
        return [
            new Tabs(null, [
                __('General Information') => $this->generalFields(),
                __('Audition Information') => $this->auditionFields(),
            ])
        ];
    }

    /**
     * @return array
     */
    public function generalFields()
    {
        return [
            Heading::make(__('General Information'))
                ->onlyOnDetail(),

            ID::make()->sortable(),

            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules($this->fieldRules('title'))
                ->help(__('Name of the setting.')),

            Text::make(__('Key'), 'key')
                ->sortable()
                ->rules($this->fieldRules('key'))
                ->help(__('Unique identifier for accessing the setting.')),

            Text::make(__('Value'), 'value')
                ->sortable()
                ->rules($this->fieldRules('value'))
                ->help(__('Value of the setting.')),

            Badge::make(__('Value Type'), 'valueTypeText')->map([
                __('String') => 'warning',
                __('Text') => 'warning',
                __('Boolean') => 'warning',
                __('Integer') => 'warning',
                __('Email') => 'warning',
            ]),

            Select::make(__('Value Type'), 'value_type')
                ->options(Model::valueTypes())
                ->onlyOnForms()
                ->rules($this->fieldRules('value_type'))
                ->help(__('Type of the setting.')),

            Badge::make(__('Type'), 'typeText')->map([
                __('Custom') => 'info',
                __('System') => 'success',
            ]),

            Select::make(__('Type'), 'type')
                ->options(Model::types())
                ->onlyOnForms()
                ->rules($this->fieldRules('type'))
                ->help(__('Determines whether the entry was added by a user (Custom type) or installed with the system.')),
        ];
    }

    /**
     * @return array
     */
    public function auditionFields()
    {
        return [
            Heading::make(__('Audition Information'))
                ->onlyOnDetail(),

            BelongsTo::make(__('Created By'), 'createdBy', User::class)
                ->readonly()
                ->hideWhenCreating()
                ->nullable(),

            DateTime::make(__('Created At'), 'created_at')
                ->readonly()
                ->hideWhenCreating()
                ->hideFromIndex()
                ->sortable(),

            Date::make(__('Created At'), 'created_at')
                ->readonly()
                ->onlyOnIndex()
                ->sortable(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->readonly()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            ValueTypeFilter::make()->setOptions(array_flip(Model::valueTypes())),
            CreatedByFilter::make(),
            CreatedAtFilter::make(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
