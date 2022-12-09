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
use NrmlCo\NovaBigFilter\NovaBigFilter;
use App\Models\MenuItem as Model;
use App\Models\Menu as ParentModel;
use App\Nova\Filters\TypeFilter;
use App\Nova\Filters\MenuFilter;
use App\Nova\Filters\CreatedByFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Actions\MenuAction;
use App\Nova\Actions\OrderAction;

class MenuItem extends Resource
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
        return $this->type == Model::TYPE_PAGE && !empty($this->page)
            ? __('Slug') . ': ' . $this->page->slug
            : __('Url') . ': ' . ($this->url ?? '-');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'link_name', 'url'
    ];

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    //public static $displayInNavigation = false;

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['menu', 'parent', 'page', 'createdBy'];

    /**
     * The sorting resource priority
     *
     * @var int
     */
    public static $priority = 4;

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Menu Items');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Menu Item');
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
        $query->withDepth();

        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            $query->orderBy('_lft');
        }

        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $resourceId = (int) $request['viaResourceId'];

        return array_merge(
            $this->tabFields($resourceId),
            $this->relationshipFields()
        );
    }

    /**
     * @param int|null $resourceId
     * @return array
     */
    public function tabFields(int $resourceId = null)
    {
        return [
            new Tabs(null, [
                __('General Information') => $this->generalFields($resourceId),
                __('Audition Information') => $this->auditionFields(),
            ])
        ];
    }

    /**
     * @param int|null $resourceId
     * @return array
     */
    public function generalFields(int $resourceId = null)
    {
        return [
            Heading::make(__('General Information'))
                ->onlyOnDetail(),

            ID::make()->sortable(),

            BelongsTo::make(__('Menu'), 'menu')
                ->showCreateRelationButton()
                ->rules($this->fieldRules('menu_id'))
                ->help(__('Menu name that holds the item.')),

            Text::make(__('Link Name'), function () {
                    return $this->itemPadding . $this->link_name;
                })->onlyOnIndex()
                ->asHtml(),

            Text::make(__('Link Name'), 'link_name')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('link_name'))
                ->help(__('Caption of the link inside the menu.')),

            BelongsTo::make(__('Parent'), 'parent', MenuItem::class)
                ->withMeta([
                    'belongsToId' => $resourceId,
                ])
                ->readonly(!empty($resourceId))
                ->nullable()
                ->rules($this->fieldRules('parent_id'))
                ->help(__('Parent item inside of the menu that holds the current item.')),

            Badge::make(__('Type'), 'typeText')->map([
                __('Page') => 'success',
                __('Link') => 'info',
                __('Text') => 'warning',
            ]),

            Select::make(__('Type'), 'type')
                ->options(Model::types())
                ->onlyOnForms()
                ->rules($this->fieldRules('type'))
                ->help(__('The Page type refers to a page inside of the system. The Link type refers to a page outside of the system. The Text type is a caption in the menu that is not linked with a web resource.')),

            BelongsTo::make(__('Page'), 'page')
                ->nullable()
                ->showCreateRelationButton()
                ->rules($this->fieldRules('page_id'))
                ->help(__('Page inside of the system that is linked with the menu item.')),

            Text::make(__('Url'), 'url')
                ->nullable()
                ->sortable()
                ->rules($this->fieldRules('url'))
                ->help(__('URL of the web-resource linked with the menu item (for a record with the Link type).')),

            //Boolean::make(__('Inherited'), 'inherited')
            //  ->sortable()
            //  ->rules($this->fieldRules('inherited')),
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
            HasMany::make(__('Children'), 'children', MenuItem::class),
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
            MenuFilter::make(),
            TypeFilter::make()->setOptions(array_flip(Model::types())),
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
            (new MenuAction(array_flip(ParentModel::flippedList())))->showOnTableRow(),
            (new OrderAction())->showOnTableRow(),
        ];
    }
}
