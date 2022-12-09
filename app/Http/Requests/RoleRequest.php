<?php

namespace App\Http\Requests;

class RoleRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'role';

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
        return [
            'name' => 'required|max:100',
            'type' => 'required|integer|between:0,1',
        ];
    }
}
