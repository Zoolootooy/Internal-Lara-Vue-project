<?php

namespace App\Http\Requests;

use Auth;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $requiredOldPassword = $this->isCurrentUser() ? 'required|' : '';

        return [
            'old_password' => $requiredOldPassword . 'password',
            'new_password' => 'required|min:6|max:255',
            'confirm_password' => 'required|required_with:new_password|same:new_password|min:6|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'old_password.password' => __('The old password is incorrect.'),
        ];
    }

    /**
     * @return bool
     */
    private function isCurrentUser()
    {
        return !empty(Auth::user())
            && Auth::user()->id == $this->getModelId();
    }
}