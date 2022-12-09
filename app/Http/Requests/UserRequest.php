<?php

namespace App\Http\Requests;

class UserRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'user';

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
        $requiredPassword = empty($this->getModelId()) ? 'required|' : '';

        return [
            'username' => 'required|alpha_dash|unique:users,username,' . $this->getModelId() . '|min:2|max:255',
            'email' => 'required|email|unique:users,email,' . $this->getModelId() . '|max:255',
            'password' => $requiredPassword . 'min:6|max:255',
            'first_name' => 'nullable|max:100',
            'last_name' => 'nullable|max:100',
            'country_id' => 'nullable|integer|exists:countries,id',
            'zip' => 'nullable|alpha_num|max:10',
            'city' => 'nullable|max:100',
            'address' => 'nullable|max:100',
            'phone' => 'nullable|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:700',
            'birthday' => 'nullable|date|before:today',
            'gender' => 'nullable|integer|between:0,1',
            'status' => 'required|integer|between:-1,1',
        ];
    }
}