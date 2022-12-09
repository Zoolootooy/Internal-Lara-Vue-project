<?php

namespace App\Http\Controllers\Admin;

use App\Models\Snippet as Model;
use App\Models\Page;
use App\Http\Requests\SnippetRequest as Request;

class SnippetController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'snippet';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::with('createdBy', 'pages')
            ->filter()
            ->defaultOrder()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
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
            'pages' => Page::all(),
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
        $model = new Model($request->all());
        $model->save();
        $model->pages()->sync($request->get('pages'));

        return $this->redirect('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $snippet
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $snippet)
    {
        return $this->view('edit', [
            'model' => $snippet,
            'pages' => Page::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $snippet
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $snippet)
    {
        $snippet->fill($request->all())->save();
        $snippet->pages()->sync($request->get('pages'));

        return $this->redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $snippet
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $snippet)
    {
        $status = $snippet->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
