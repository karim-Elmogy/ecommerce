<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $guarded =[];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
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
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;
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

    public function packages()
    {
        return $this->hasMany(Package::class,'category_id');
    }

}
