<?php

namespace App\Http\Requests;

class UnitRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'unit';

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
            'parent_id' => 'nullable|integer|exists:units,id',
            'name' => 'required|max:100',
            'slug' => 'required|alpha_dash|unique:units,slug,' . $this->getModelId() . '|max:100',
            'visible' => 'required|boolean',
            'sorting' => 'sometimes|integer',
        ];
    }
}
