<?php

namespace App\Http\Requests;

class CountryRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'country';

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
            'name' => 'required|unique:countries,name,' . $this->getModelId() . '|max:50',
            'phone_code' => 'required|integer',
            'vat_rate' => 'nullable|integer',
        ];
    }
}
