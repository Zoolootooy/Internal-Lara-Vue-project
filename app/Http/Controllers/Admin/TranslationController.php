<?php

namespace App\Http\Controllers\Admin;

use App\Models\Translation as Model;
use App\Http\Requests\TranslationRequest as Request;

class TranslationController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'translation';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::groupedList()
            ->filter()
            ->defaultOrder()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        $page = (int) (request('page') ?? 1);
        $startNumber = ($page - 1) * $this->itemsPerPage;

        return $this->view('index', [
            'models' => $models,
            'languages' => Model::languages(),
            'startNumber' => $startNumber,
            'filters' => new Model(),
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
        (new Model)->saveWithRelations($request->all());

        return $this->redirect('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $translation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $translation)
    {
        return $this->view('edit', [
            'model' => $translation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $translation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $translation)
    {
        $translation->saveWithRelations($request->all());

        return $this->redirect('index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function export()
    {
        return $this->view('export');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $translation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $translation)
    {
        $status = $translation->deleteWithRelations();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
