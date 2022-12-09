<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\Mail;
use App\Models\Unit;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['partials.footer', 'partials.nav'], function ($view) {
            $view->with('menuItems', MenuItem::with('page')->get()->toTree());
        });

        View::composer(['home.partials.posts', 'partials.footer'], function ($view) {
            $itemNumber = 3;
            $view->with('posts', Page::categoryRecords(PageCategory::CATEGORY_BLOG, $itemNumber));
        });

        View::composer(['admin.partials.topbar'], function ($view) {
            $itemNumber = 10;
            $view->with('mails', Mail::paginate($itemNumber))
                ->with('newMailNumber', Mail::new()->count())
                ->with('unitList', Unit::visible()->get());
        });

        View::composer(['*partials.head'], function ($view) {
            $mode = Cookie::get('selectedMode');
            $theme = Str::before($mode, '-');
            $theme = !empty($theme) ? $theme : 'light';
            $view->with('theme', $theme);
        });
    }
}
