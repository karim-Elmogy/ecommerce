<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    use ApiResponseTrait;

    public function authorize()
    {
        return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                return [
                    'user_id' => ['required'],
                    'password' => ['confirmed','required','min:8'],
                ];
            }

        }
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendResponse(['message'=>$validator->errors()->first()],'failed', false, 401));
    }
}
