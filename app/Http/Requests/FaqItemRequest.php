<?php

namespace App\Http\Requests;

class FaqItemRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'faqItem';

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
            'parent_id' => 'required|integer|exists:faq_categories,id',
            'name' => 'required|max:100',
            'slug' => 'required|alpha_dash|unique:faq_items,slug,' . $this->getModelId() . '|max:100',
            'description' => 'nullable',
            'visible' => 'required|boolean',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'parent_id.required' => 'The category field is required.',
        ];
    }
}
