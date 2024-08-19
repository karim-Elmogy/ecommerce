<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FavoriteRequest extends FormRequest
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

    public function prepareForValidation()
    {

        if (app()->runningInConsole()) {
            return;
        }

        if ($this->method() == 'POST') {
            $this->merge([
                'user_id'=>auth()->user()->id,
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
                    'package_id'=>['required'],
                    'partner_id'=>['nullable'],
                ];
            }
            case 'PUT': {
                return [
                    'user_id'=>['required'],
                    'package_id'=>['required'],
                    'partner_id'=>['nullable']
                ];
            }
        }
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->sendResponse(['message'=>$validator->errors()->first()],'failed', false, 401));
    }
}
