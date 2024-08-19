<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->bank_name_ar;
        }else{
            return $this->bank_name_en;
        }
    }

    public function getAccountAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->bank_account_name_ar;
        } else {
            return $this->bank_account_name_en;
        }
    }
}
