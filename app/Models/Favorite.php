<?php

namespace App\Models;

use App\Models\Dashboard\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
