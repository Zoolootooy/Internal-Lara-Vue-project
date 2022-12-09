<?php

namespace App\Http\Requests;

class QuoteRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'quote';

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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:700',
            'description' => 'nullable',
            'visible' => 'required|boolean',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
