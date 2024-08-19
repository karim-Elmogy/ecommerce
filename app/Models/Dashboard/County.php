<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class County extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name_ar);
        });

        static::updating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name_ar);
        });
    }
    protected function generateUniqueSlug($title)
    {
        $slug = Str::slug($title.'-' . uniqid());
        $count = static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->count();
        if ($count > 0) {
            $slug .= '-' . uniqid();
        }
        return $slug;
    }


    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar'  ||  request()->header('Accept-Language') == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }

    public function city()
    {
        return $this->hasMany(City::class,'county_id');
    }
}
