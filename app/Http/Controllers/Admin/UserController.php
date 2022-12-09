<?php

namespace App\Http\Controllers\Admin;

use App\Models\User as Model;
use App\Models\Country;
use App\Models\Role;
use App\Http\Requests\UserRequest as Request;
use App\Http\Requests\PasswordRequest;

class UserController extends AdminController
{
    /**
     * @var string
     */
    public $controllerName = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $models = Model::with('roles')
            ->latest()
            ->filter()
            ->defaultOrder()
            ->paginate($this->itemsPerPage)
            ->withQueryString();

        return $this->view('index', [
            'models' => $models,
            'filters' => new Model(),
            'countries' => Country::list(),
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
            'roles' => Role::all(),
            'countries' => Country::list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $model = new Model($request->all());
        $model->save();
        $model->savePassword($model->password);
        $model->roles()->sync($request->get('roles'));

        return $this->redirect('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Model $user)
    {
        return $this->view('edit', [
            'model' => $user,
            'roles' => Role::all(),
            'countries' => Country::list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Model $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request, Model $user)
    {
        $user->fill($request->all())->save();
        $user->roles()->sync($request->get('roles'));

        return $this->redirect('index');
    }

    /**
     * @param Model|null $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password(Model $user = null)
    {
        return $this->view('password', [
            'model' => $user,
        ]);
    }

    /**
     * @param PasswordRequest $request
     * @param Model $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updatePassword(PasswordRequest $request, Model $user)
    {
        $newPassword = $request->get('new_password');

        $user->fill($request->all());
        $user->savePassword($newPassword);

        return $this->redirect('index')->with('status', __('The password is updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Model  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Model $user)
    {
        $status = $user->delete();

        return $this->redirect('index')
            ->with($status ? 'status' : null, __('The record is deleted.'));
    }
}
