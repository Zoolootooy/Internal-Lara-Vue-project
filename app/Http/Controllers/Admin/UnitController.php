<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit as Model;
use App\Http\Requests\UnitRequest as Request;

class UnitController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'unit';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::defaultOrder()
            ->filter()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
            'filters' => new Model(),
            'units' => Model::list(),
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
            'units' => Model::list(),
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
     * @param  Model  $unit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $unit)
    {
        return $this->view('edit', [
            'model' => $unit,
            'units' => Model::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $unit
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $unit)
    {
        $unit->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $unit
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $unit)
    {
        $status = $unit->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
