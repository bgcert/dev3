<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// for overwriting the failedValidation() method
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EventRequest extends FormRequest
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
        $rules = [
        	'city_id' => 'required|integer',
        	'cover' => 'filled|string|max:255',
            'address' => 'required|string|max:255',
            'start_date' => 'required|date_format:"Y-m-d"|after:today',
            'end_date' => 'required|date_format:"Y-m-d"|after:start_date',
            'start_at' => 'required|date_format:"H:i"',
            'end_at' => 'required|date_format:"H:i"|after:start_at',
            'price' => 'required|integer'
        ];

        if ($this->has('theme_id'))
        {
            $rules += ['theme_id'=> 'required|integer'];
        }

        return $rules;
    }

    public function failedValidation(Validator $validator) { 
        //write your bussiness logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

    public function messages()
	{
	    return [
	    	'theme_id.required' => 'Не е избрана тема',
	    	'city_id.required' => 'Не е избран град',
	    	'address.required' => 'Не е въведен адрес',
	        'start_date.required' => 'Не е въведена начална дата',
	        'start_date.required' => 'Не е въведена начална дата',
	        'end_date.required' => 'Не е въведена крайна дата',
	        'price.required' => 'Не е въведена цена',
	    ];
	}
}
