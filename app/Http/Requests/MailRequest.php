<?php

namespace App\Http\Requests;

class MailRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $modelName = 'mail';

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
            'sender_email' => 'required|email|max:255',
            'sender_name' => 'required|max:255',
            'subject' => 'required|max:255',
            'body' => 'required',
            'opened' => 'required|boolean',
        ];
    }
}
