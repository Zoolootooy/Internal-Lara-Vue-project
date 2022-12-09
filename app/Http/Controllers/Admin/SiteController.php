<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Benefit;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Snippet;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\MediaFile;
use App\Models\MediaCategory;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Slider;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use App\Models\Quote;
use App\Models\Mail;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\Country;

class SiteController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'site';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = [
            'user' => [
                'module' => 'user',
                'icon' => 'users',
                'caption' => __('Users'),
                'number' => User::count(),
            ],
            'role' => [
                'module' => 'role',
                'icon' => 'user-secret',
                'caption' => __('Roles'),
                'number' => Role::count(),
            ],
            'permission' => [
                'module' => 'permission',
                'icon' => 'universal-access',
                'caption' => __('Permissions'),
                'number' => Permission::count(),
            ],
            'snippet' => [
                'module' => 'snippet',
                'icon' => 'puzzle-piece',
                'caption' => __('Snippets'),
                'number' => Snippet::count(),
            ],
            'page' => [
                'module' => 'page',
                'icon' => 'file',
                'caption' => __('Pages'),
                'number' => Page::count(),
            ],
            'pageCategory' => [
                'module' => 'pageCategory',
                'icon' => 'folder',
                'caption' => __('Categories'),
                'number' => PageCategory::count(),
            ],
            'mediaFile' => [
                'module' => 'mediaFile',
                'icon' => 'medium',
                'caption' => __('Media Files'),
                'number' => MediaFile::count(),
            ],
            'mediaCategory' => [
                'module' => 'mediaCategory',
                'icon' => 'sliders',
                'caption' => __('Categories'),
                'number' => MediaCategory::count(),
            ],
            'menu' => [
                'module' => 'menu',
                'icon' => 'list',
                'caption' => __('Menus'),
                'number' => Menu::count(),
            ],
            'menuItem' => [
                'module' => 'menuItem',
                'icon' => 'list',
                'caption' => __('Menu Items'),
                'number' => MenuItem::count(),
            ],
            'slider' => [
                'module' => 'slider',
                'icon' => 'image',
                'caption' => __('Sliders'),
                'number' => Slider::count(),
            ],
            'faqCategory' => [
                'module' => 'faqCategory',
                'icon' => 'bars',
                'caption' => __('Categories'),
                'number' => FaqCategory::count(),
            ],
            'faqItem' => [
                'module' => 'faqItem',
                'icon' => 'question-circle',
                'caption' => __('Faq Items'),
                'number' => FaqItem::count(),
            ],
            'quote' => [
                'module' => 'quote',
                'icon' => 'quote-right',
                'caption' => __('Quotes'),
                'number' => Quote::count(),
            ],
            'mail' => [
                'module' => 'mail',
                'icon' => 'envelope',
                'caption' => __('Mails'),
                'number' => Mail::count(),
            ],
            'setting' => [
                'module' => 'setting',
                'icon' => 'cogs',
                'caption' => __('Settings'),
                'number' => Setting::count(),
            ],
            'unit' => [
                'module' => 'unit',
                'icon' => 'folder',
                'caption' => __('Units'),
                'number' => Unit::count(),
            ],
            'country' => [
                'module' => 'country',
                'icon' => 'globe',
                'caption' => __('Countries'),
                'number' => Country::count(),
            ],
            'article' => [
                'module' => 'article',
                'icon' => 'newspaper-o',
                'caption' => __('Articles'),
                'number' => Article::count(),
            ],
            'benefit' => [
                'module' => 'benefit',
                'icon' => 'list',
                'caption' => __('Benefits'),
                'number' => Benefit::count(),
            ],
            'order' => [
                'module' => 'order',
                'icon' => 'shopping-cart',
                'caption' => __('Order'),
                'number' => Order::count(),
            ],
            'product' => [
                'module' => 'product',
                'icon' => 'fa-money-bill',
                'caption' => __('Product'),
                'number' => Product::count(),
            ],
        ];

        $icons = [
            [
                'item' => $items['user'],
            ],
            [
                'item' => $items['role'],
                'secondItem' => $items['permission'],
            ],
            [
                'item' => $items['page'],
                'secondItem' => $items['pageCategory'],
            ],
            [
                'item' => $items['mediaFile'],
                'secondItem' => $items['mediaCategory'],
                'title' =>__('Media'),
            ],
            [
                'item' => $items['menu'],
                'secondItem' => $items['menuItem'],
            ],
            [
                'item' => $items['faqCategory'],
                'secondItem' => $items['faqItem'],
                'title' => __('Faq'),
            ],
            [
                'item' => $items['mail'],
            ],
            [
                'item' => $items['setting'],
            ],
            [
                'item' => $items['snippet'],
            ],
            [
                'item' => $items['slider'],
            ],
            [
                'item' => $items['quote'],
            ],
            [
                'item' => $items['article'],
            ],
            [
                'item' => $items['benefit'],
            ],
            [
                'item' => $items['order'],
            ],
            [
                'item' => $items['product'],
            ],
        ];

        $itemsPerPage = 5;

        $users = User::latest()->paginate($itemsPerPage);
        $pages = Page::with('createdBy')->latest()->orderBy('id', 'DESC')->paginate($itemsPerPage);
        $author = ['article', 'benefit', 'mediaFile', 'faqCategory', 'slider'];
        $manager = ['product', 'order'];
        return $this->view('index', compact('icons', 'users', 'pages', 'author', 'manager'));


    }
}
