<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country as Model;
use App\Http\Requests\CountryRequest as Request;

class CountryController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'country';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::filter()
            ->defaultOrder()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
            'filters' => new Model(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $country)
    {
        return $this->view('edit', [
            'model' => $country,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Model $country
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $country)
    {
        $country->fill($request->all())->save();

        return $this->redirect('index');
    }
}
