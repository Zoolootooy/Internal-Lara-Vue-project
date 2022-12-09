<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Heading;
use Eminiarts\Tabs\Tabs;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use App\Nova\Fields\Cover;
use App\Models\User as Model;
use App\Nova\Files\CleanFile;
use App\Nova\Files\StoreFile;
use App\Nova\Files\DeleteFile;
use App\Nova\Filters\StatusFilter;
use App\Nova\Filters\CountryFilter;
use App\Nova\Filters\GenderFilter;
use App\Nova\Filters\CreatedAtFilter;
use App\Nova\Filters\LastLoginAtFilter;
use App\Nova\Actions\StatusAction;
use App\Nova\Actions\PasswordAction;

class User extends Resource
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
        return __('Email') . ': ' . ($this->email ?? '-');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'username', 'email', 'first_name', 'last_name', 'zip', 'city', 'address', 'phone'
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = [];

    /**
     * The sorting resource priority
     *
     * @var int
     */
    public static $priority = 1;

    /**
     * @var array
     */
    public static $defaultOrder = [
        'created_at' => 'desc'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('User');
    }

    /**
     * Get the logical group associated with the resource.
     *
     * @return string
     */
    public static function group()
    {
        return __('Users');
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
                __('Address Information') => $this->addressFields(),
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

            Cover::make(__('Avatar'), 'avatar')
                ->rounded()
                ->exceptOnForms()
                ->hideFromIndex(),

            Image::make(__('Avatar'), 'avatar')
                ->store(new CleanFile)
                //->store(new StoreFile)
                ->delete(new DeleteFile)
                ->preview(function ($value) {
                    return $value ? $this->getFileUrl('avatar') : null;
                })
                ->thumbnail(function ($value) {
                    return $value ? $this->getThumbnailUrl('avatar') : null;
                })
                ->acceptedTypes('image/*')
                ->prunable()
                ->nullable()
                ->rules($this->fieldRules('avatar')),

            Text::make(__('Username'), 'username')
                ->sortable()
                ->rules($this->fieldRules('username')),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules($this->fieldRules('email')),

            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->hideWhenUpdating()
                ->rules($this->fieldRules('password')),

            Text::make(__('Full Name'), 'fullName')
                ->exceptOnForms(),

            Text::make(__('Roles'), 'rolesText')
                ->exceptOnForms(),

            Text::make(__('First Name'), 'first_name')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('first_name')),

            Text::make(__('Last Name'), 'last_name')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('last_name')),

            Text::make(__('Phone'), 'phone')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('phone')),

            Date::make(__('Birthday'), 'birthday')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('birthday'))
                ->withMeta(['placeholder' => __('Birthday')]),

            Badge::make(__('Gender'), 'genderText')->map([
                __('Not Set') => 'warning',
                __('Male') => 'info',
                __('Female') => 'success',
            ])->hideFromIndex(),

            Select::make(__('Gender'), 'gender')
                ->options(Model::genders())
                ->onlyOnForms()
                ->rules($this->fieldRules('gender')),

            Badge::make(__('Status'), 'statusText')->map([
                __('Blocked') => 'danger',
                __('New') => 'warning',
                __('Verified') => 'success',
            ]),

            Select::make(__('Status'), 'status')
                ->options(Model::statuses())
                ->onlyOnForms()
                ->rules($this->fieldRules('status'))
                ->help(__('Determined if the user is new, verified, or blocked.')),
        ];
    }

    /**
     * @return array
     */
    public function addressFields()
    {
        return [
            Heading::make(__('Address Information'))
                ->onlyOnDetail(),

            Place::make(__('Address'), 'address')
                ->postalCode('zip')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('address')),

            Text::make(__('Zip'), 'zip')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('zip')),

            Text::make(__('City'), 'city')
                ->nullable()
                ->hideFromIndex()
                ->sortable()
                ->rules($this->fieldRules('city')),

            BelongsTo::make(__('Country'), 'country')
                ->nullable()
                ->hideFromIndex()
                ->rules($this->fieldRules('country')),
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

            DateTime::make(__('Registered At'), 'created_at')
                ->readonly()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->sortable(),

            Date::make(__('Registered At'), 'created_at')
                ->readonly()
                ->onlyOnIndex()
                ->sortable(),

            DateTime::make(__('Updated At'), 'updated_at')
                ->readonly()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->sortable(),

            DateTime::make(__('Email Verified At'), 'email_verified_at')
                ->readonly()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->sortable()
                ->withMeta(['placeholder' => '—']),

            DateTime::make(__('Last Login At'), 'last_login_at')
                ->readonly()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->sortable()
                ->withMeta(['placeholder' => '—']),

            Date::make(__('Last Login At'), 'last_login_at')
                ->readonly()
                ->onlyOnIndex()
                ->sortable(),
        ];
    }

    /**
     * @return array
     */
    public function relationshipFields()
    {
        return [
            BelongsToMany::make(__('Roles'), 'roles'),
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
            StatusFilter::make()->setOptions(array_flip(Model::statuses())),
            CountryFilter::make(),
            GenderFilter::make()->setOptions(array_flip(Model::genders())),
            CreatedAtFilter::make(__('Registered At')),
            LastLoginAtFilter::make(),
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
            (new StatusAction(Model::statuses()))->showOnTableRow(),
            (new PasswordAction)->showOnTableRow(),
        ];
    }
}
