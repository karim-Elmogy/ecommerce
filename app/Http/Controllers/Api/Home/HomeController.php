<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BookConsultationRequest;
use App\Http\Requests\Dashboard\SpecializationRequest;
use App\Http\Resources\Api\Book\BookResource;
use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Offer\OfferResource;
use App\Http\Resources\Api\Package\PackageResource;
use App\Http\Resources\Api\University\PackageUniversityResource;
use App\Http\Resources\Api\University\UniversityResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\Offer;
use App\Models\Dashboard\Package;
use App\Models\Dashboard\Partner;
use App\Models\Dashboard\SubParner;
use App\Models\User\bookConsultation;

class HomeController extends Controller
{
    use ApiResponseTrait;
    public function home()
    {
        try {
            $categories=Category::take(3)->get();
            $offers=Offer::where('start','<',currentDateTime())
                ->where('end','>',currentDateTime())->latest()->get();
            $englishPackages=Package::where('category_id',3)->orderBy('order','asc')->take(4)->get();
            $universityPackages=Partner::take(4)->get();
            $summerPackages=Package::where('category_id',1)->orderBy('order','asc')->take(4)->get();

            return $this->sendResponse([
                'categories'=>CategoryResource::collection($categories),
                'offers'=>OfferResource::collection($offers),
                'englishPackages'=>PackageResource::collection($englishPackages),
                'universityPackages'=>UniversityResource::collection($universityPackages),
                'summerPackages'=>PackageResource::collection($summerPackages),
            ]);
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function englishPackages()
    {
        try {
            return $this->sendResponse(PackageResource::collection(Package::where('category_id',3)->orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:Package::where('category_id',3)->count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function universityPackages()
    {
        try {
            return $this->sendResponse(UniversityResource::collection(Partner::paginate($request->per_page ?? 10)), customModel:Partner::count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function summerPackages()
    {
        try {
            return $this->sendResponse(PackageResource::collection(Package::where('category_id',1)->orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:Package::where('category_id',1)->count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function book(BookConsultationRequest $request)
    {
        if (!request()->ajax()) {
            try {
                $book=bookConsultation::create($request->validated());
                return $this->sendResponse(new BookResource($book));
            } catch (\Exception $e) {
                return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
            }
        }
    }

    public function showUniversityPackages($id)
    {
        try {
            $partner=Partner::find($id);
            if($partner){
                return $this->sendResponse(new UniversityResource($partner));
            }else{
                return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function showSpecialization($id)
    {
        try {
            $specialization=SubParner::find($id);
            if($specialization){
                return $this->sendResponse(new PackageUniversityResource($specialization));
            }else{
                return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }



}
