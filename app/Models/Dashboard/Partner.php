<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Partner extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = ['id', 'created_at' , 'deleted_at'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name_en);
        });

        static::updating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name_en);
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

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->sort_title_ar;
        }else{
            return $this->sort_title_en;
        }
    }

    public function getDescAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->desc_ar;
        }else{
            return $this->desc_en;
        }
    }

    public function partnerImage()
    {
        return $this->hasMany(PartnerImage::class,'partner_id');
    }

    public function specialization()
    {
        return $this->hasMany(SubParner::class,'partner_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }







}
