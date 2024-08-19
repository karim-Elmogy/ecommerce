<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageData extends Model
{
    use HasFactory;
    public $guarded=[];

    public function getQuestionAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->question_ar;
        } else {
            return $this->question_en;
        }
    }

    public function getAnswerAttribute()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->answer_ar;
        } else {
            return $this->answer_en;
        }
    }

}
