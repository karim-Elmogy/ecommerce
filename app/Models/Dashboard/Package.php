<?php

namespace App\Models\Dashboard;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;
    public $guarded=[];


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
    public function packageData()
    {
        return $this->hasOne(PackageData::class,'package_id');
    }

    public function packagePlan()
    {
        return $this->hasMany(PackagePlan::class,'package_id');
    }

    public function packageDelalis()
    {
        return $this->hasMany(DelalisPackage::class,'package_id');
    }

    public function packageImage()
    {
        return $this->hasMany(ImagePackage::class,'package_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class,'partner_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function favorite()
    {
        return $this->hasOne(Favorite::class,'package_id');
    }


    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->name_ar;
        } else {
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
}
