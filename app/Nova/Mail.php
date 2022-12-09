<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use App\Models\Mail as Model;
use App\Nova\Filters\OpenedFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Actions\CloseAction;
use App\Nova\Actions\OpenAction;

class Mail extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Model::class;

    /**
     * @var array
     */
    public static $defaultOrder = [
        'created_at' => 'desc'
    ];

    /**
     * @return null|string
     */
    public function subtitle()
    {
        return __('Sender') . ": {$this->sender_name} <{$this->sender_email}>";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'sender_email', 'sender_name', 'subject', 'body'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Mails');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Mail');
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

            Text::make(__('Sender Email'), 'sender_email')
                ->nullable()
                ->sortable()
                ->rules($this->fieldRules('sender_email')),

            Text::make(__('Sender Name'), 'sender_name')
                ->nullable()
                ->sortable()
                ->rules($this->fieldRules('sender_name')),

            Text::make(__('Subject'), 'subject')
                ->nullable()
                ->sortable()
                ->rules($this->fieldRules('subject')),

            Textarea::make(__('Letter Body'), 'body')
                ->nullable()
                ->sortable()
                ->rules($this->fieldRules('body')),

            Boolean::make(__('Opened'), 'opened')
                ->sortable()
                ->rules($this->fieldRules('opened')),
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
            OpenedFilter::make(),
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
            (new CloseAction)->showOnTableRow(),
            (new OpenAction)->showOnTableRow(),
        ];
    }
}
