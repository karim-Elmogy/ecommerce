<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Plane extends Model
{
    use HasFactory;
    use LogsActivity;
    public $guarded=[];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->title_ar;
        }
        return ucfirst($this->title_en);
    }


    public function getTrialTypeAttribute()
    {
        if ($this->attributes['trialType'] == 'days') {
            return __('dashboard.general.days');
        } elseif ($this->attributes['trialType'] == 'months') {
            return __('dashboard.general.months');
        } else {
            return null;
        }
    }

}
