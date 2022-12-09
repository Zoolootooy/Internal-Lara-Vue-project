<?php

namespace App\Http\Requests;

use App\Models\Setting;

class SettingRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'setting';

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
            'type' => 'nullable|integer',
            'value_type' => 'required|integer',
            'title' => 'required|max:100',
            'key' => 'required|alpha_dash|unique:settings,key,' . $this->getModelId() . '|max:100',
            'value' => 'required|max:100|' . $this->getValueRule(),
        ];
    }

    /**
     * @return string
     */
    private function getValueRule()
    {
        $valueRule = 'string';
        $valueType = (int) (request()->value_type ?? optional($this->getModel())->value_type);

        if ($valueType == Setting::TYPE_BOOLEAN) {
            $valueRule = 'boolean';
        } elseif ($valueType == Setting::TYPE_INTEGER) {
            $valueRule = 'integer';
        } elseif ($valueType == Setting::TYPE_EMAIL) {
            $valueRule = 'email';
        }

        return $valueRule;
    }
}
