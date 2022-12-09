<?php

namespace App\Http\Controllers\Admin;

use App\Models\FaqItem as Model;
use App\Models\FaqCategory;
use App\Http\Requests\FaqItemRequest as Request;

class FaqItemController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'faqItem';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::with(['category', 'createdBy'])
            ->filter()
            ->defaultOrder()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
            'filters' => new Model(),
            'categories' => FaqCategory::list(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return $this->view('create', [
            'model' => new Model(),
            'categories' => FaqCategory::list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        (new Model)->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $faqItem
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $faqItem)
    {
        return $this->view('edit', [
            'model' => $faqItem,
            'categories' => FaqCategory::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $faqItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $faqItem)
    {
        $faqItem->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $faqItem
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $faqItem)
    {
        $status = $faqItem->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
