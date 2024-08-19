<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at','deleted_at'];

    public function users()
    {
        return $this->hasMany(Admin::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
