<?php

namespace App\Http\Requests;

class PermissionRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'permission';

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
            'unit_id' => 'required|integer|exists:units,id',
            'action' => 'required|alpha_dash|max:100',
        ];
    }
}
