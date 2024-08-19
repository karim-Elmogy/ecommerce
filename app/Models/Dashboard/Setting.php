<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $guarded = ['id', 'created_at' , 'deleted_at'];



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }
    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }
}
