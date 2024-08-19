<?php

namespace App\Http\Controllers\Api\Favorite;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FavoriteRequest;
use App\Http\Resources\Api\Auth\DelailsAuthResource;
use App\Http\Resources\Api\Favorite\FavoriteResource;
use App\Http\Resources\Api\Package\PackageResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    use ApiResponseTrait;
    public function favorite()
    {
        try {
            $user = auth()->user()->id;
            return $this->sendResponse(FavoriteResource::collection(Favorite::where('user_id',$user)->latest()->paginate($request->per_page ?? 10)), customModel:Favorite::where('user_id',$user)->count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function store(FavoriteRequest $request)
    {
        try {
            $favorite=Favorite::where('user_id',$request->user_id)->where('package_id',$request->package_id)->first();
            if($favorite){
                $favorite->delete();
                return $this->sendResponse([
                    'message' => 'تم الازالة من المفضلة',
                    'package'=>new FavoriteResource($favorite),
                    ]);
            }else{
                $favorite=Favorite::create($request->validated());
                return $this->sendResponse([
                    'message' => 'تم الاضافة الي المفضلة',
                    'package'=>new FavoriteResource($favorite),
                ]);
            }

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }
}
