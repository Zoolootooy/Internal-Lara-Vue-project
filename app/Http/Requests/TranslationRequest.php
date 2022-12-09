<?php

namespace App\Http\Requests;

class TranslationRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'translation';

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
        $requiredField = empty($this->getModelId()) ? 'required|' : '';

        return [
            'status' => 'sometimes|integer|between:0,1',
            'locale' => 'sometimes|max:255',
            'group' => $requiredField . 'max:255',
            'key' => $requiredField,
            'value' => 'nullable',
        ];
    }
}
