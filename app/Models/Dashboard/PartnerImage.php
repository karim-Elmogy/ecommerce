<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerImage extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at' , 'deleted_at'];
}
