<?php

namespace App\Http\Requests;

class MenuRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'menu';

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
            'type' => 'required|integer',
            'name' => 'required|max:100',
            'slug' => 'required|alpha_dash|unique:menus,slug,' . $this->getModelId() . '|max:100',
            'sorting' => 'sometimes|integer',
        ];
    }
}
