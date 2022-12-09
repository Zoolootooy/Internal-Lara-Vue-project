<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use App\Nova\Fields\Cover;
use App\Nova\Files\CleanFile;
use App\Nova\Files\StoreFile;
use App\Nova\Files\DeleteFile;
use App\Models\Quote as Model;
use App\Nova\Filters\VisibleFilter;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Actions\HideAction;
use App\Nova\Actions\ShowAction;

class Quote extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Model::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description'
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
        return __('Quotes');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Quote');
    }

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group()
    {
        return __('Modules');
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

            Cover::make(__('Image'), 'image')
                ->rounded()
                ->exceptOnForms()
                ->hideFromIndex(),

            Image::make(__('Image'), 'image')
                ->store(new CleanFile)
                //->store(new StoreFile)
                ->delete(new DeleteFile)
                ->preview(function ($value) {
                    return $value ? $this->getFileUrl('image') : null;
                })
                ->thumbnail(function ($value) {
                    return $value ? $this->getThumbnailUrl('image') : null;
                })
                ->acceptedTypes('image/*')
                ->prunable()
                ->nullable()
                ->rules($this->fieldRules('image'))
                ->help(__('Avatar of the user that has given the feedback.')),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules($this->fieldRules('name'))
                ->help(__('Name of the user that has given the feedback.')),

            Trix::make(__('Description'), 'description')
                ->alwaysShow()
                ->nullable()
                ->rules($this->fieldRules('description'))
                ->help(__('Content of the feedback.')),

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
