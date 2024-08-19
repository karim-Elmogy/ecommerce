<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppForm extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    protected function plan()
    {
        return $this->belongsTo(PackagePlan::class,'plan_id');
    }

    public function university()
    {
        return $this->belongsTo(Partner::class,'partner_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }

}
