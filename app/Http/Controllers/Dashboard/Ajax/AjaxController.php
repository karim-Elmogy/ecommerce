<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\City;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRegion($city)
    {
        $city = City::find($city)->city;
        return response()->json($city);
    }


    public function applyCoupon(Request $request)
    {
        $code=$request->code;
       $result= coupon($code);
       return redirect()->back();
    }
}
