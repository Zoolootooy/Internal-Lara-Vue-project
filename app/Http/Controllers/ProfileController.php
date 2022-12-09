<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Country;
use App\Http\Requests\ProfileRequest as Request;
use App\Http\Requests\PasswordRequest;

class ProfileController extends Controller
{
    /**
     * @var string
     */
    public $controllerName = 'profile';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->view('index', [
            'model' => Auth::user(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return $this->view('edit', [
            'model' => Auth::user(),
            'countries' => Country::list(),
        ]);
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->fill($request->all())->save();

        return $this->redirect('index')->with('status', __('The profile is updated.'));;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        return $this->view('password', [
            'model' => Auth::user(),
        ]);
    }

    /**
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordRequest $request)
    {
        $newPassword = $request->get('new_password');

        $user = Auth::user();
        $user->savePassword($newPassword);

        return $this->redirect('index')->with('status', __('The password is updated.'));
    }
}
