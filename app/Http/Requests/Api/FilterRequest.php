<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilterRequest extends FormRequest
{

    use ApiResponseTrait;
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
                    'city_id'=>['required'],
                    'numberOfWeeks'=>['required'],
                    'start_date'=>['required'],
                ];
            }
        }
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendResponse(['message'=>$validator->errors()->first()],'failed', false, 401));
    }
}
