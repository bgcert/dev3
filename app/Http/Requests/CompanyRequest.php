<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// for overwriting the failedValidation() method
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:32',
            'slug' => 'required|unique:companies,id,'. $this->id . '|regex:/^[a-z][a-z0-9]*[.]{0,1}[a-z][a-z]*$/|max:32',
            'logo' => 'filled|string|max:255',
            'phone' => 'string|max:255',
            'email' => 'email|max:32',
            'address' => 'string|max:255',
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
	    	'name.min' => 'Полето трябва да съдържа поне 3 символа',
	    	'name.max' => 'Полето трябва да съдържа максимум 32 символа',
	    	'slug.required' => 'Полето е задължително',
	    	'slug.unique' => 'Този адрес вече е зает',
	    	'slug.regex' => 'Адресът не отговаря на посочените критерии',
	    ];
	}
}
