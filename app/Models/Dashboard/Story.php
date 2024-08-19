<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->name_ar;
        }
        return ucfirst($this->name_en);
    }
    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->title_ar;
        }
        return ucfirst($this->title_en);
    }

    public function getDescAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->desc_ar;
        }
        return ucfirst($this->desc_en);
    }
}
