<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// for overwriting the failedValidation() method
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ThemeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	// Validate if current user is the owner of this theme!
    	// \Auth::id() == this->user_id or something :D
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
        	'category_id' => 'required|integer',
            'title' => 'required|max:255',
            'excerpt' => 'required',
        	'body' => 'required',
        	'cover' => 'max:255',
        	'duration' => 'required|integer',
        ];
    }

    public function failedValidation(Validator $validator) { 
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

    public function messages()
	{
	    return [
	    	'category_id.required' => 'Не е избрана категория',
	        'title.required' => 'Не е въведено заглавие',
	        'title.max' => 'Заглавието е надвишава максималната дължина от 255 символа',
	        'excerpt.required' => 'Не е въведено кратко описание',
	        'body.required'  => 'Не е въведено съдържание',
	        'duration.required'  => 'Не е въведена продължителност',
	    ];
	}
}
