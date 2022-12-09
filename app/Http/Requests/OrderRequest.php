<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'order';

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
            'extern_cards' => 'boolean',
            'price' => 'required|numeric',
            'full_name' => 'required|max:255|min:5',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:19|max:19',
            'address' => 'required|min:10',
        ];
    }
}
