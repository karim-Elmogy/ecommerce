<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
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
        if (app()->getLocale() == 'ar'  ||  request()->header('Accept-Language') == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }

    public function boundaries(){
        return $this->hasMany(Boundary::class);
    }

    public function county(){
        return $this->belongsTo(County::class,'county_id');
    }

    public function package(){
        return $this->hasMany(Package::class,'city_id');
    }


}
