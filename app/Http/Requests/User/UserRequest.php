<?php

namespace App\Http\Requests\User;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id=$this->client;
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [
                ];
            }
            case 'POST': {
                return [
                    'name' => ['string'],
                    'password' => ['confirmed','required'],
                    'image' => ['nullable'],
                    'phone' => ['nullable', 'regex:/^\d{11}$/', 'numeric', 'unique:users,phone']
                ];
            }
            case 'PUT': {
                return [
                    'name' => ['string'],
                    'password' => ['nullable'],
                    'image' => ['nullable'],
                    'phone' => ['nullable', 'regex:/^\d{11}$/', 'numeric', 'unique:users,phone,'.$id],
                ];

            }
        }
    }

    public function messages()
    {
        return [

        ];
    }
}
