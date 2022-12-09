<?php

namespace App\Http\Requests;

class MenuItemRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'menuItem';

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
            'menu_id' => 'required|integer|exists:menus,id',
            'parent_id' => 'nullable|integer|exists:menu_items,id',
            'page_id' => 'nullable|integer|exists:pages,id',
            'type' => 'required|integer|between:0,2',
            'link_name' => 'required|max:100',
            'url' => 'nullable|url|max:255',
            //'inherited' => 'required|boolean',
            'sorting' => 'sometimes|integer',
        ];
    }
}
