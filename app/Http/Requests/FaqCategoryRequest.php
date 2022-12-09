<?php

namespace App\Http\Requests;

class FaqCategoryRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'faqCategory';

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
            'slug' => 'required|alpha_dash|unique:faq_categories,slug,' . $this->getModelId() . '|max:100',
            'keywords' => 'nullable|max:255',
            'visible' => 'required|boolean',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
