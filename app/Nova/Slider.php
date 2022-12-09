<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use App\Nova\Fields\Cover;
use App\Nova\Files\CleanFile;
use App\Nova\Files\StoreFile;
use App\Nova\Files\DeleteFile;
use App\Models\Slider as Model;
use App\Nova\Filters\TypeFilter;
use App\Nova\Filters\VisibleFilter;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Actions\HideAction;
use App\Nova\Actions\ShowAction;

class Slider extends Resource
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
        return __('Type') . ': ' . ($this->typeText ?? '-');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description', 'video_url', 'forward_url', 'button_caption'
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
    public static $priority = 1;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Sliders');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Slider');
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
                __('Content Information') => $this->contentFields(),
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
                //->delete(new DeleteFile)
                ->preview(function ($value) {
                    return $value ? $this->getFileUrl('image') : null;
                })
                ->thumbnail(function ($value) {
                    return $value ? $this->getThumbnailUrl('image') : null;
                })
                ->acceptedTypes('image/*')
                ->prunable()
                ->deletable(false)
                ->rules($this->fieldRules('image')),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules($this->fieldRules('name'))
                ->help(__('Slide name that is shown as the header caption on the slide.')),

            Trix::make(__('Content'), 'description')
                ->alwaysShow()
                ->nullable()
                ->rules($this->fieldRules('description'))
                ->help(__('Text that is shown on the slide.')),

            Boolean::make(__('Visible'), 'visible')
                ->sortable()
                ->rules($this->fieldRules('visible')),
        ];
    }

    /**
     * @return array
     */
    public function contentFields()
    {
        return [
            Heading::make(__('Content Information'))
                ->onlyOnDetail(),

            Badge::make(__('Type'), 'typeText')->map([
                __('Image Slide') => 'success',
                __('Video Slide') => 'info',
            ]),

            Select::make(__('Type'), 'type')
                ->options(Model::types())
                ->onlyOnForms()
                ->rules($this->fieldRules('type'))
                ->help(__('You can choose whether you want to show a graphic slide or you want to display a video on it.')),

            Text::make(__('Video Url'), 'video_url')
                ->nullable()
                ->onlyOnForms()
                ->sortable()
                ->rules($this->fieldRules('video_url'))
                ->help(__('URL to the video that is shown on the slide in case you choose the Video type.')),

            Text::make('Video Url', function () {
                    return $this->video_url
                        ? '<a href="' . $this->video_url . '" class="no-underline text-primary font-bold">' . $this->video_url . '</a>'
                        : '<p>—</p>';
                })->asHtml()
                ->onlyOnDetail(),

            Text::make(__('Button Caption'), 'button_caption')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('button_caption'))
                ->help(__('In case you want to display a linked button on the slide, add a caption for it.')),

            Text::make(__('Forward Url'), 'forward_url')
                ->nullable()
                ->onlyOnForms()
                ->sortable()
                ->rules($this->fieldRules('forward_url'))
                ->help(__('In case you want to display a linked button on the slide, add a forward URL for it.')),

            Text::make('Forward Url', function () {
                    return $this->forward_url
                        ? '<a href="' . $this->forward_url . '" class="no-underline text-primary font-bold">' . $this->forward_url . '</a>'
                        : '<p>—</p>';
                })->asHtml()
                ->onlyOnDetail(),

            Badge::make(__('Position'), 'positionText')->map([
                __('Left') => 'info',
                __('Center') => 'warning',
                __('Right') => 'success',
            ]),

            Select::make(__('Position'), 'position')
                ->options(Model::positions())
                ->onlyOnForms()
                ->rules($this->fieldRules('position'))
                ->help(__('Choose how you want to align the content on the slide.')),
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
            TypeFilter::make()->setOptions(array_flip(Model::types())),
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
