<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name_ar' => ['string', 'max:255'],
                    'name_en' => ['string', 'max:255'],
                    'password' => ['confirmed','nullable'],
                    'role_id' => ['required', 'exists:roles,id'],
                    'image' => ['nullable'],
                ];
            }
            case 'PUT': {
                return [
                    'name_ar' => ['string', 'max:255'],
                    'name_en' => ['string', 'max:255'],
                    'password' => ['confirmed','nullable'],
                    'role_id' => ['required', 'exists:roles,id'],
                    'image' => ['nullable']
                ];
            }
        }
    }


    public function messages()
    {
        return [
            'password.confirmed'=>'كلمة المرور غير متطابقة',
        ];
    }
}
