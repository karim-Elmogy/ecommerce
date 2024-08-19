<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileRequest extends FormRequest
{
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
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'image'=>['required'],
                ];
            }
            case 'PUT': {
                return [
                    'image'=>['required']
                ];
            }
        }
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendResponse(['message'=>$validator->errors()->first()],'failed', false, 401));
    }
}
