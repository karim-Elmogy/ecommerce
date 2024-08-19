<?php

namespace App\Http\Requests\User;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppFormRequest extends FormRequest
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
                    'email'=>['required'],
                    'postal_code'=>['required'],
                    'birthday'=>['required'],
                    'gender'=>['required'],
                    'level'=>['required'],
                    'address'=>['required'],
                    'is_smoker'=>['required'],
                    'problem_with_pets'=>['required'],
                    'relative_name'=>['required'],
                    'relative_relation'=>['required'],
                    'relative_phone'=>['required'],
                    'abs_her_id'=>['required'],
                    'abs_her_phone'=>['required'],
                    'health_problems'=>['required'],
                    'health_problems_desc'=>['required'],
                    'special_requests'=>['required'],
                    'hear_about_utopia'=>['required'],
                    'contact_you_to_book'=>['required'],
                    'passport'=>['nullable'],
                    'school_certificate'=>['nullable'],
                    'image'=>['nullable'],
                    'partner_id'=>['required'],
                    'package_id'=>['required'],
                    'plan_id'=>['required'],



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
