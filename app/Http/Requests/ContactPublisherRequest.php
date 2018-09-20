<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactPublisherRequest extends FormRequest
{
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
        	'about' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'from' => 'required|string|max:64',
            'email' => 'required|email|max:64',
            'phone' => 'required|string|max:64',
        	'body' => 'required|string'
        ];
    }

    public function messages()
	{
	    return [
	    	'subject.required' => 'Полето е задължително',
	    	'from.required' => 'Полето е задължително',
	    	'email.required' => 'Полето е задължително',
	    	'email.email' => 'Невалиде e-mail',
	    	'phone.required' => 'Полето е задължително',
	    	'body.required' => 'Полето е задължително'
	    ];
	}
}
