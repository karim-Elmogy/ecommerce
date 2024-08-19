<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Why extends Model
{
    protected $table = "whies";
    use HasFactory;
    protected $guarded = [];


    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar'  ||  request()->header('Accept-Language') == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }
}
