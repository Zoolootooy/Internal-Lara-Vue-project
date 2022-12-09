<?php

namespace App\Http\Requests;

class SnippetRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'snippet';

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
            'slug' => 'required|alpha_dash|unique:snippets,slug,' . $this->getModelId() . '|max:100',
            'content' => 'required',
            'visible' => 'required|boolean',
            'location' => 'required|integer|between:0,2',
        ];
    }
}
