<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    protected $modelName = 'product';
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
            'name' => 'required|unique:products|string',
            'price' => 'required|regex:([0-9]\.[0-9]{2})',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'price.regex' => 'Price entry format: 10.00',
        ];
    }
}
