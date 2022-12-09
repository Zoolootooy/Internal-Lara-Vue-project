<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use App\Nova\Fields\Cover;
use App\Nova\Files\CleanFile;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use App\Models\Page as Model;
use App\Models\PageCategory as ParentModel;
use App\Nova\Files\DeleteFile;
use App\Nova\Filters\ParentFilter;
use App\Nova\Filters\VisibleFilter;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Actions\CategoryAction;
use App\Nova\Actions\VisibilityAction;

class Page extends Resource
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
        'id', 'link_name', 'slug', 'content', 'title', 'meta_keywords', 'meta_description', 'header'
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['category', 'createdBy'];

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
        return __('Pages');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Page');
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
                __('Metadata Information') => $this->metadataFields(),
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

            Text::make(__('Link Name'), 'link_name')
                ->sortable()
                ->rules($this->fieldRules('link_name'))
                ->help(__('Caption for the link inside the menu.')),

            Text::make(__('Slug'), 'slug')
                ->sortable()
                ->rules($this->fieldRules('slug'))
                ->help(__('Unique identifier for generating a link to the resource.')),

            BelongsTo::make(__('Category'), 'category', PageCategory::class)
                ->nullable()
                ->showCreateRelationButton()
                ->rules($this->fieldRules('parent_id'))
                ->help(__('Page category.')),

            Trix::make(__('Content'), 'content')->alwaysShow()->nullable()
                ->rules($this->fieldRules('content')), // ->stacked()

            Badge::make(__('Visible'), 'visibleText')->map([
                __('No') => 'danger',
                __('Yes') => 'success',
                __('Logged') => 'warning',
                __('Guest') => 'warning',
            ]),

            Select::make(__('Visible'), 'visible')
                ->options(Model::visibleStatuses())
                ->onlyOnForms()
                ->rules($this->fieldRules('visible'))
                ->help(__('Record visibility and the possibility to manage the visibility for all users at once, as well as for logged in or not logged in users separately.')),
        ];
    }

    /**
     * @return array
     */
    public function metadataFields()
    {
        return [
            Heading::make(__('Metadata Information'))
                ->onlyOnDetail(),

            Text::make(__('Title'), 'title')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('title'))
                ->help(__('Content of the &lt;title&gt; element located inside of the &lt;header&gt;.')),

            Text::make(__('Meta Keywords'), 'meta_keywords')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('meta_keywords'))
                ->help(__('Content of the &lt;meta name="keywords" content="..."&gt; element located inside of the &lt;header&gt;.')),

            Text::make(__('Meta Description'), 'meta_description')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('meta_description'))
                ->help(__('Content of the &lt;meta name="description" content="..."&gt; element located inside of the &lt;header&gt;.')),

            Text::make(__('Header'), 'header')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('header'))
                ->help(__('Content of the &lt;h1&gt; header element located on the top of the page.')),
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
            BelongsToMany::make(__('Snippets'), 'snippets', Snippet::class),

            HasMany::make(__('Menu Items'), 'menuItems', MenuItem::class),
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
            ParentFilter::make()->setOptions(ParentModel::flippedList()),
            VisibleFilter::make()->setOptions(array_flip(Model::visibleStatuses())),
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
            (new CategoryAction(array_flip(ParentModel::flippedList())))->showOnTableRow(),
            (new VisibilityAction(Model::visibleStatuses()))->showOnTableRow(),
        ];
    }
}