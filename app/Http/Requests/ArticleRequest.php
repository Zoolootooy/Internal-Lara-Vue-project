<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'article';

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
            'title' => 'required|max:50|min:5',
            'image' => 'image|mimes:png,jpg|max:700',
            'short_description' => 'nullable|min:50|max:500',
            'description' => 'max:10000',
            'created_by' => 'nullable|integer|exists:users,id',
            'visible' => 'required|integer|between:0,3',
        ];
    }
}
