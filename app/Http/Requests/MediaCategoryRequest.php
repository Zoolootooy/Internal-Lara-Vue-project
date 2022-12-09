<?php

namespace App\Http\Requests;

class MediaCategoryRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'mediaCategory';

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
            'slug' => 'required|alpha_dash|unique:media_categories,slug,' . $this->getModelId() . '|max:100',
            'description' => 'nullable',
            'visible' => 'required|boolean',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
