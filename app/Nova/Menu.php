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
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Eminiarts\Tabs\Tabs;
use App\Models\Menu as Model;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;

class Menu extends Resource
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
        return __('Slug') . ': ' . ($this->slug ?? '-');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'slug'
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['createdBy'];

    /**
     * The sorting resource priority
     *
     * @var int
     */
    public static $priority = 3;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Menus');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Menu');
    }

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group()
    {
        return __('Content');
    }

    /**
     * @param NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return parent::indexQuery($request, $query)->withCount('items');
    }

    /**
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function detailQuery(NovaRequest $request, $query)
    {
        return parent::detailQuery($request, $query->withCount('items'));
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return array_merge(
            $this->tabFields(),
            $this->relationshipFields()
        );
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

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules($this->fieldRules('name'))
                ->help(__('Menu name for internal usage.')),

            Text::make(__('Slug'), 'slug')
                ->sortable()
                ->rules($this->fieldRules('slug'))
                ->help(__('Unique identifier for accessing to the resource.')),

            Badge::make(__('Items'), 'items_count')->map([
                $this->items_count => 'info',
            ]),

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
     * @return array
     */
    public function relationshipFields()
    {
        return [
            HasMany::make(__('Items'), 'items', MenuItem::class),
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
