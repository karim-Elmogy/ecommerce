<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $id=$this->user;
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => ['string', 'max:255'],
                    'password' => ['confirmed','nullable'],
                    'image' => ['nullable'],
                    'phone' => ['nullable', 'regex:/^\d{11}$/', 'numeric', 'unique:users,phone,'.$id],
                ];
            }
        }
    }
}
