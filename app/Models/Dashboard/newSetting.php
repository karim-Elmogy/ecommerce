<?php

namespace App\Models\Dashboard;

use App\Models\PartnerPlanPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class newSetting extends Model
{
    use HasFactory;

   protected $guarded = [];

    public function itemPlan()
    {
        return $this->hasMany(PartnerPlanPrice::class,'setting_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class,'partner_id');
    }

}
