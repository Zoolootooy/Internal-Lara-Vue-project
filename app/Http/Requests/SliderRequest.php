<?php

namespace App\Http\Requests;

class SliderRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'slider';

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
        $requiredImg = empty($this->getModelId()) ? 'required|' : '';

        return [
            'name' => 'required|max:100',
            'image' => $requiredImg . 'image|mimes:jpeg,png,jpg,gif,svg|max:700',
            'description' => 'nullable',
            'video_url' => 'nullable|url|max:255',
            'forward_url' => 'nullable|url|max:255',
            'type' => 'required|boolean',
            'visible' => 'required|boolean',
            'position' => 'required|integer',
            'button_caption' => 'nullable|max:100',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
