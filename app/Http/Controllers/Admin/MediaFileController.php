<?php

namespace App\Http\Controllers\Admin;

use App\Models\MediaFile as Model;
use App\Models\MediaCategory;
use App\Http\Requests\MediaFileRequest as Request;

class MediaFileController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'mediaFile';

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
            'categories' => MediaCategory::list(),
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
            'categories' => MediaCategory::list(),
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
     * @param  Model  $mediaFile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $mediaFile)
    {
        return $this->view('edit', [
            'model' => $mediaFile,
            'categories' => MediaCategory::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $mediaFile
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $mediaFile)
    {
        $mediaFile->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function load(Request $request)
    {
        $model = new Model();
        $model->fill($request->all())->save();
        $fileUrl = $model->getFileUrl('file');

        return [
            'location' => $fileUrl,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $mediaFile
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $mediaFile)
    {
        $status = $mediaFile->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
