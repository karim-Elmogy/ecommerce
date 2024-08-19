<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class Admin extends Authenticatable
{
    use LogsActivity;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $guarded = ['id', 'created_at' , 'deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Roles & Permissions
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function hasPermissions($route, $method = null)
    {
        if ($this->user_type == 'superadmin') {
            return true;
        }
        if (is_null($method)) {
            if ($this->role->permissions->contains('route_name',$route.".index")) {
                return true;
            }elseif ($this->role->permissions->contains('route_name',$route.".store")) {
                return true;
            }elseif ($this->role->permissions->contains('route_name',$route.".update")) {
                return true;
            }elseif ($this->role->permissions->contains('route_name',$route.".destroy")) {
                return true;
            }elseif ($this->role->permissions->contains('route_name',$route.".show")) {
                return true;
            }elseif ($this->role->permissions->contains('route_name',$route.".wallet")) {
                return true;
            }
        }else{
            return $this->role->permissions->contains('route_name',$route.".".$method);
        }
        return false;
    }

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar'  || request()->header('Accept-Language') == 'ar'){
            return $this->name_ar;
        }else{
            return $this->name_en;
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }
}
