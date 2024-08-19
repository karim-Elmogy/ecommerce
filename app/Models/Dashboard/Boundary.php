<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boundary extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}



