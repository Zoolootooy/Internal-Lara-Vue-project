<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Nova::routes();
Route::get('nova', 'HomeController@index');

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::resources([
        'page' => 'PageController',
        'user' => 'UserController',
        'role' => 'RoleController',
        'permission' => 'PermissionController',
        'country' => 'CountryController',
        'faqCategory' => 'FaqCategoryController',
        'faqItem' => 'FaqItemController',
        'mail' => 'MailController',
        'mediaCategory' => 'MediaCategoryController',
        'mediaFile' => 'MediaFileController',
        'menu' => 'MenuController',
        'menuItem' => 'MenuItemController',
        'unit' => 'UnitController',
        'pageCategory' => 'PageCategoryController',
        'quote' => 'QuoteController',
        'setting' => 'SettingController',
        'slider' => 'SliderController',
        'translation' => 'TranslationController',
        'snippet' => 'SnippetController',
        'article' => 'ArticleController',
        'benefit' => 'BenefitController',
        'order' => 'OrderController',
        'product' => 'ProductController',
        'tag' => 'TagController',
    ], ['except' => ['show']]);

    Route::get('user/{user}/password', 'UserController@password')->name('user.password');
    Route::put('user/{user}/updatePassword', 'UserController@updatePassword')->name('user.updatePassword');
    Route::post('mediafile/load', 'MediaFileController@load')->name('file.load');
    Route::get('translation/export', 'TranslationController@export')->name('translation.export');
    Route::post('config/sidebarStatus', 'ConfigController@sidebarStatus')->name('config.sidebarStatus');
    Route::get('', 'SiteController@index')->name('admin');

});



Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('', 'ProfileController@index')->name('index');
    Route::get('edit', 'ProfileController@edit')->name('edit');
    Route::put('update', 'ProfileController@update')->name('update');
    Route::get('password', 'ProfileController@password')->name('password');
    Route::put('updatePassword', 'ProfileController@updatePassword')->name('updatePassword');
});

Route::get('home', 'HomeController@index')->name('home');
Route::get('contact', 'HomeController@contact')->name('home.contact');
Route::get('articles', 'HomeController@articles')->name('home.articles');
Route::get('articles/{id}', 'HomeController@articlesCurrent')->name('home.current-article');
Route::get('purchase', 'HomeController@purchase')->name('home.purchase');
Route::post('feedback', 'HomeController@feedback')->name('feedback');
Route::post('makeOrder', 'PurchaseController@makeOrder')->name('makeOrder');
Route::post('updateOrderStatus', 'PurchaseController@updateOrderStatus')->name('backToSite');
Route::post('deliveryPayment', 'PurchaseController@deliveryPayment')->name('makeDeliveryOrder');
Route::get('getTags', 'PurchaseController@getTags')->name('getTags');
Route::post('send', 'HomeController@send')->name('send');
Route::get('blog', 'BlogController@index')->name('blog');
Route::get('blog/{model:slug}', 'BlogController@show')->name('blog.show');
Route::get('{page:slug}', 'HomeController@page');
Route::get('', 'HomeController@index')->name('home');

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback')->name('login.facebook.callback');

//Auth::routes();

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');

//Route::fallback('FallbackController'); // __invoke
