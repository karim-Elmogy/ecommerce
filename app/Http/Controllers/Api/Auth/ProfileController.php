<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Resources\Api\Auth\AuthResource;
use App\Http\Resources\Api\Auth\DelailsAuthResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    use ApiResponseTrait;


    public function profile()
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            DB::commit();
            return $this->sendResponse(new DelailsAuthResource($user));
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function updateProfile(ProfileRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            if($request->image){
                $imageName= Upload($request->image , 'dash-img/user');
                $user->image=$imageName;
                $user->save();
            }
            DB::commit();
            return $this->sendResponseImage(new DelailsAuthResource($user));
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }
}
