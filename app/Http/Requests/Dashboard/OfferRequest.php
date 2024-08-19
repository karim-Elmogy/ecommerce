<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
                'admin_id'=>admin(),
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
                    'image' => ['required','image'],
                    'admin_id' => ['required'],
                    'start' => ['nullable'],
                    'end' => ['nullable'],
                ];
            }
            case 'PUT': {
                return [
                    'image' => ['nullable','image'],
                    'admin_id' => ['nullable'],
                    'start' => ['nullable'],
                    'end' => ['nullable'],
                ];
            }
        }
    }
}
