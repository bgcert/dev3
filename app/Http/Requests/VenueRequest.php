<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// for overwriting the failedValidation() method
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class VenueRequest extends FormRequest
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
        	'city_id' => 'required|integer',
            'name' => 'required|string|min:2|max:64',
            'description' => 'required',
            'address' => 'required|string|max:255',
            'cover' => 'filled|string|max:255',
            'capacity' => 'required|integer',
            'price' => 'nullable|integer',
            'images' => 'filled',
        ];
    }

    public function failedValidation(Validator $validator) { 
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

    public function messages()
	{
	    return [
	    	'city_id.required' => 'Не е избран град',
	    	'name.required' => 'Не е въведено име',
	    	'name.min' => 'Полето трябва да съдържа поне 2 символа',
	    	'name.max' => 'Полето не може да съдържа повече от 64 символа',
	        'description.required' => 'Не е въведено съдържание',
	        'address.required' => 'Не е въведен адрес'
	    ];
	}
}
