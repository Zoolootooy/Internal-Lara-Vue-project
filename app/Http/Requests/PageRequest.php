<?php

namespace App\Http\Requests;

class PageRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'page';

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
            'parent_id' => 'nullable|integer|exists:page_categories,id',
            'link_name' => 'required|max:100',
            'slug' => 'required|alpha_dash|unique:pages,slug,' . $this->getModelId() . '|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:700',
            //'content' => 'required',
            'title' => 'nullable|max:100',
            'meta_keywords' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'header' => 'nullable|max:100',
            'visible' => 'required|integer|between:0,3',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }
}