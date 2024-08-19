<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    use ApiResponseTrait;

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name'=> ['string','required','max:255'],
                    'phone' => ['required', 'unique:users'],
//                    'password' => ['required','min:8'],
                ];
            }
            case 'PUT': {
                return [
                    'name'=> ['string','required','max:255'],
                    'phone' => ['required', 'unique:users'],
//                    'password' => ['required','min:8']
                ];
            }
        }
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendResponse(['message'=>$validator->errors()->first()],'failed', false, 401));
    }
}
