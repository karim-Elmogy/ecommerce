<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubParner extends Model
{
    use HasFactory;

    protected $table = "sub_parners";

    protected $guarded  = [];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->p_name_ar);
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
            return $this->p_name_ar;
        }else{
            return $this->p_name_en;
        }
    }

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->title_ar;
        }else{
            return $this->title_en;
        }
    }

    public function getDescAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->p_desc_ar;
        }else{
            return $this->p_desc_en;
        }
    }

   public function partner()
   {
       return $this->belongsTo(Partner::class,'partner_id');
   }
}
