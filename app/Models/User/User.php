<?php

namespace App\Models\User;

use App\Models\Dashboard\Advertisement;
use App\Models\Dashboard\AppForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable
{
    use LogsActivity;
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->name);
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



    public function lastLogin()
    {
        return $this->hasOne(LastLogin::class,'user_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function app()
    {
        return $this->hasMany(AppForm::class,'user_id');
    }

    public function universityApp()
    {
        return $this->hasMany(UniversityAppForm::class,'user_id');
    }



    public function createToken(string $name, array $abilities = ['*'])
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(240)),
            'abilities' => $abilities,
        ]);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }
}
