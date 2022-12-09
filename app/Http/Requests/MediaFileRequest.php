<?php

namespace App\Http\Requests;

class MediaFileRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'mediaFile';

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
        $requiredFile = empty($this->getModelId()) ? 'required|' : '';

        return [
            'parent_id' => 'nullable|integer|exists:media_categories,id',
            'name' => 'max:100',
            'file' => $requiredFile. 'image|mimes:jpeg,png,jpg,gif,svg|max:700',
            'visible' => 'required|boolean',
            'sorting' => 'sometimes|integer',
            'created_by' => 'nullable|integer|exists:users,id',
        ];
    }
}
