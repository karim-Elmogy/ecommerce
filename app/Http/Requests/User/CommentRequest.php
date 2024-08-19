<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
                    'comment' => ['required','string'],
                    'user_id'=>['required'],
                    'article_id'=>['required'],


                ];
            }
        }

    }
}
