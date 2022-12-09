<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu as Model;
use App\Http\Requests\MenuRequest as Request;

class MenuController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'menu';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::with('createdBy')
            ->filter()
            ->defaultOrder()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
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
        (new Model)->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $menu)
    {
        return $this->view('edit', [
            'model' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $menu)
    {
        $menu->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $menu)
    {
        $status = $menu->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
