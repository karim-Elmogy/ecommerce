<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $id = $this->coupon;
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'code' => ['required', 'unique:coupons'],
                    'discount_percentage' => ['integer', 'max:100','min:1','required'],
                    'expiry_date' => ['required','date'],
                    'is_active' => ['nullable','boolean'],
                ];
            }
            case 'PUT': {
                return [
                    'code' => ['required', 'unique:coupons,code,'.$id],
                    'discount_percentage' => ['integer', 'max:100','min:1','required'],
                    'expiry_date' => ['required','date'],
                    'is_active' => ['nullable','boolean']
                ];
            }
        }
    }
}
