<?php

namespace App\Http\Requests\User;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UniversityAppFormRequest extends FormRequest
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

    public function prepareForValidation()
    {

        if (app()->runningInConsole()) {
            return;
        }

        if ($this->method() == 'POST') {
            $this->merge([
                'user_id'=>user()->id,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'user_id'=>['required'],
                    'city_name'=>['required'],
                    'nationality_id'=>['required'],
                    'f_name'=>['required'],
                    'l_name'=>['required'],
                    'phone'=>['required'],

                    'partner_id'=>['required'],
                    'specialization_id'=>['required'],

                    'email'=>['required'],
                    'postal_code'=>['required'],
                    'birthday'=>['required'],
                    'gender'=>['required'],
                    'level'=>['required'],
                    'address'=>['required'],
                    'special_requests'=>['required'],
                    'hear_about_utopia'=>['required'],
                    'contact_you_to_book'=>['required'],
                    'passport'=>['nullable'],
                    'school_certificate'=>['nullable'],
                    'image'=>['nullable'],


                ];
            }
        }
    }

//    protected function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(
//            redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب'])
//        );
//    }
}
