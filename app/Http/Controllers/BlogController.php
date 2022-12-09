<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageCategory;

class BlogController extends Controller
{
    /**
     * @var string
     */
    public $controllerName = 'blog';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Page::categoryRecords(PageCategory::CATEGORY_BLOG, $this->itemsPerPage);

        return $this->view('index', compact('models'));
    }

    /**
     * @param Page $model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $model)
    {
        abort_unless($model->visible, 404);

        return $this->view('show', compact('model'));
    }
}
