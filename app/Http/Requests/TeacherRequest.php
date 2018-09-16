<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// for overwriting the failedValidation() method
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TeacherRequest extends FormRequest
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
            'name' => 'required|string|min:4|max:64',
            'image' => 'filled|string|max:255',
            'details' => 'required'
        ];
    }

    public function failedValidation(Validator $validator) { 
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

    public function messages()
	{
	    return [
	    	'name.required' => 'Не е въведено име',
	    	'name.min' => 'Полето трябва да съдържа поне 4 символа',
	    	'name.max' => 'Полето не може да съдържа повече от 64 символа',
	        'details.required' => 'Не е въведено съдържание'
	    ];
	}
}
