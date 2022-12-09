<?php

namespace App\Http\Requests;

class FrontMailRequest extends MailRequest
{
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
        ];
    }
}
