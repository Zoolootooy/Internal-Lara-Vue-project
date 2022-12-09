<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use App\Models\Snippet as Model;
use App\Nova\Filters\LocationFilter;
use App\Nova\Filters\VisibleFilter;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Actions\HideAction;
use App\Nova\Actions\ShowAction;

class Snippet extends Resource
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
        'id', 'name', 'slug', 'content'
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
    public static $priority = 5;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Snippets');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Snippet');
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
                ->help(__('Snippet name for internal usage.')),

            Text::make(__('Slug'), 'slug')
                ->sortable()
                ->rules($this->fieldRules('slug'))
                ->help(__('Unique identifier for accessing the resource.')),

            Code::make(__('Content'), 'content')
                ->rules($this->fieldRules('content'))
                ->help(__('Content of the snippet that will be located in the page.')),

            Badge::make(__('Location'), 'locationText')->map([
                __('None') => 'warning',
                __('Header') => 'success',
                __('Footer') => 'info',
            ]),

            Select::make(__('Location'), 'location')
                ->options(Model::locations())
                ->onlyOnForms()
                ->rules($this->fieldRules('location'))
                ->help(__('The snippet can be located in the header of the page, the footer of the page, or added to the page by placing a reference to it.')),

            Boolean::make(__('Visible'), 'visible')
                ->sortable()
                ->rules($this->fieldRules('visible')),
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
            BelongsToMany::make(__('Pages'), 'pages'),
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
        return [
            (new NovaBigFilter)->hideFilterTitle(),
        ];
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
            LocationFilter::make()->setOptions(array_flip(Model::locations())),
            VisibleFilter::make(),
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
        return [
            (new HideAction)->showOnTableRow()
                ->canSee(function ($request) {
                    return !$this->resource->exists || $this->visible;
                }),
            (new ShowAction)->showOnTableRow()
                ->canSee(function ($request) {
                    return !$this->resource->exists || !$this->visible;
                }),
        ];
    }
}
