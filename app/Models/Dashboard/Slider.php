<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
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


    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function getDescAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->desc_ar;
        } else {
            return $this->desc_en;
        }
    }
}
