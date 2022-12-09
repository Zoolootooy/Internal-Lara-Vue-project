<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mail as Model;
use App\Mail\ContactMail;
use App\Models\Mail;
use App\Http\Requests\MailRequest as Request;

class MailController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'mail';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::latest()
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
     * @param  Model  $mail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $mail)
    {
        return $this->view('edit', [
            'model' => $mail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Model  $mail
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $mail)
    {
        $mail->fill($request->all())->save();

        return $this->redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $mail
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $mail)
    {
        $status = $mail->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
