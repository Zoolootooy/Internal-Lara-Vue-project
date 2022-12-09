<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Metrics\CountryCounter;

use App\Nova\Metrics\FaqCategoryCounter;
use App\Nova\Metrics\FaqItemCounter;
use App\Nova\Metrics\MailCounter;
use App\Nova\Metrics\MediaCategoryCounter;
use App\Nova\Metrics\MediaFileCounter;
use App\Nova\Metrics\MenuCounter;
use App\Nova\Metrics\MenuItemCounter;
use App\Nova\Metrics\PageCounter;
use App\Nova\Metrics\PageCategoryCounter;
use App\Nova\Metrics\PermissionCounter;
use App\Nova\Metrics\QuoteCounter;
use App\Nova\Metrics\RoleCounter;
use App\Nova\Metrics\SettingCounter;
use App\Nova\Metrics\SliderCounter;
use App\Nova\Metrics\SnippetCounter;
use App\Nova\Metrics\UnitCounter;
use App\Nova\Metrics\UserCounter;

use App\Nova\Metrics\UsersByStatus;
use App\Nova\Metrics\FaqItemsByCategory;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::style('nova', './css/nova.css');

        Nova::script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js');
        Nova::script('nova', './js/nova.js');

        Nova::sortResourcesBy(function ($resource) {
            $maxPriority = 10000;
            return $resource::$priority ?? $maxPriority;
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user, $permission) {
            if ($user->isSuperAdmin()
                || $user->hasPermission($permission)) {
                return true;
            }
//            return in_array($user->email, [
//                //
//            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            //new Help,
            new UsersByStatus,
            new FaqItemsByCategory,

            // Users
            new UserCounter,
            new RoleCounter,
            new PermissionCounter,

            // Content
            new SnippetCounter,
            new PageCounter,
            new PageCategoryCounter,
            new MenuCounter,
            new MenuItemCounter,
            new MediaFileCounter,
            new MediaCategoryCounter,

            // Modules
            new FaqCategoryCounter,
            new FaqItemCounter,
            new SliderCounter,
            new QuoteCounter,

            // Other
            new MailCounter,
            new SettingCounter,
            new UnitCounter,
            new CountryCounter,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
