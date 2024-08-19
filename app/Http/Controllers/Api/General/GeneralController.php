<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterRequest;
use App\Http\Resources\Api\Bank\BankResource;
use App\Http\Resources\Api\City\CityResource;
use App\Http\Resources\Api\County\CountyResource;
use App\Http\Resources\Api\Package\DesignPackageResource;
use App\Http\Resources\Api\Package\MYPackageResource;
use App\Http\Resources\Api\Package\PackageResource;
use App\Http\Resources\Api\Setting\SettingResource;
use App\Http\Resources\Api\University\ImageResource;
use App\Http\Resources\Api\University\UniversityResource;
use App\Http\Resources\Api\Why\WhyResource;
use App\Http\Resources\Api\Story\StoryResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Dashboard\BankAccount;
use App\Models\Dashboard\City;
use App\Models\Dashboard\County;
use App\Models\Dashboard\Nationality;
use App\Models\Dashboard\newSetting;
use App\Models\Dashboard\Package;
use App\Models\Dashboard\Partner;
use App\Models\Dashboard\PartnerImage;
use App\Models\Dashboard\Story;
use App\Models\Dashboard\Why;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    use ApiResponseTrait;
    public function whyChooseUtopia()
    {
        try {
            return $this->sendResponse(WhyResource::collection(Why::latest()->paginate($request->per_page ?? 10)), customModel:Why::count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function stories()
    {
        try {
            return $this->sendResponse(StoryResource::collection(Story::orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:Story::count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function banks()
    {
        try {
            return $this->sendResponse(BankResource::collection(BankAccount::orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:BankAccount::count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function counties()
    {
        try {
            return $this->sendResponse(CountyResource::collection(County::orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:County::count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function cities()
    {
        try {
            return $this->sendResponse(CityResource::collection(City::orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:City::count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function partnerImage()
    {
        try {
            return $this->sendResponse(ImageResource::collection(PartnerImage::paginate($request->per_page ?? 10)), customModel:PartnerImage::count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }


    public function countyFilter($county_id)
    {
        try {
            $cities = City::where('county_id', $county_id)->pluck('id')->toArray();
            if (request()->type == 'package'){
                $packages=Package::whereIn('city_id', $cities)->where('category_id',3)->orderBy('order','asc');
                return $this->sendResponse(PackageResource::collection($packages->paginate($request->per_page ?? 10)), customModel:$packages->count());
            }else{
                $partners = Partner::whereIn('city_id', $cities);
                return $this->sendResponse(UniversityResource::collection($partners->paginate($request->per_page ?? 10)), customModel:$partners->count());
            }
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }


    public function cityFilter($city_id)
    {
        try {
            if (request()->type == 'package'){
                $packages=Package::where('city_id', $city_id)->where('category_id',3)->orderBy('order','asc');
                return $this->sendResponse(PackageResource::collection($packages->paginate($request->per_page ?? 10)), customModel:$packages->count());
            }else{
                $partners = Partner::where('city_id', $city_id);
                return $this->sendResponse(UniversityResource::collection($partners->paginate($request->per_page ?? 10)), customModel:$partners->count());
            }
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }


    public function nameFilter()
    {
        try {
            if (request()->type == 'package'){
                $query=request()->input('query');
                $packages = Package::where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name_ar', 'like', '%' . $query . '%')
                            ->orWhere('name_en', 'like', '%' . $query . '%');
                    });
                })->orWhereHas('city', function($cityQuery) use ($query) {
                        $cityQuery->where('name_ar', 'like', '%' . $query . '%')
                            ->orWhere('name_en', 'like', '%' . $query . '%');
                    })->orWhereHas('partner', function($partnerQuery) use ($query) {
                    $partnerQuery->where('name_ar', 'like', '%' . $query . '%')
                        ->orWhere('name_en', 'like', '%' . $query . '%');
                })->orderBy('order', 'asc');
                return $this->sendResponse(PackageResource::collection($packages->paginate($request->per_page ?? 10)), customModel:$packages->count());
            }else{
                $query=request()->input('query');
                $partners = Partner::where(function ($queryBuilder) use ($query) {
                            $queryBuilder->where(function ($queryBuilder) use ($query) {
                                $queryBuilder->where('name_ar', 'like', '%' . $query . '%')
                                    ->orWhere('name_en', 'like', '%' . $query . '%');
                            });
                })->orWhereHas('city', function($cityQuery) use ($query) {
                    $cityQuery->where('name_ar', 'like', '%' . $query . '%')
                        ->orWhere('name_en', 'like', '%' . $query . '%');
                });
                return $this->sendResponse(UniversityResource::collection($partners->paginate($request->per_page ?? 10)), customModel:$partners->count());
            }
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }


    public function filterCity($county_id)
    {
        try {
            return $this->sendResponse(CityResource::collection(City::where('county_id', $county_id)->orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:City::where('county_id', $county_id)->count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function filterCityName()
    {
        try {
                $query=request()->input('query');
                $cities = City::where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name_ar', 'like', '%' . $query . '%')
                            ->orWhere('name_en', 'like', '%' . $query . '%');
                    });
                })->orderBy('order', 'asc');
            return $this->sendResponse(CityResource::collection($cities->paginate($request->per_page ?? 10)), customModel:$cities->count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function filterPackageByNumberOfWeeks($city_id,$numberOfWeeks,$start_date)
    {
        try {
            $partners = Partner::where(function ($queryBuilder) use ($city_id) {
                $queryBuilder->where(function ($queryBuilder) use ($city_id) {
                    $queryBuilder->where('city_id',$city_id);
                });
            });
            return $this->sendResponse([
                'city'=>City::find($city_id)->name,
                'numberOfWeeks'=>$numberOfWeeks,
                'start_date'=>$start_date,
                'partners'=>MYPackageResource::collection($partners->paginate($request->per_page ?? 10)),
            ], customModel:$partners->count());
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function showPartnerDetails($id)
    {
        try {
            $partner = Partner::find($id);
            return $this->sendResponse(new DesignPackageResource($partner));
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function show($partner_id)
    {
        try {
            $courses = newSetting::where('partner_id',$partner_id)->where('section','courses')->get();
            $living = newSetting::where('partner_id',$partner_id)->where('section','living')->get();
            $pick_up = newSetting::where('partner_id',$partner_id)->where('section','pick_up')->get();
            $medical = newSetting::where('partner_id',$partner_id)->where('section','medical')->get();
            $other_fees = newSetting::where('partner_id',$partner_id)->where('section','other_fees')->get();

            return $this->sendResponse([
                'courses'=>SettingResource::collection($courses),
                'living'=>SettingResource::collection($living),
                'pick_up'=>SettingResource::collection($pick_up),
                'medical'=>SettingResource::collection($medical),
                'other_fees'=>SettingResource::collection($other_fees),
            ]);
        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }




    public function nationalities()
    {
        try {
            return $this->sendResponse(CountyResource::collection(Nationality::orderBy('order','asc')->paginate($request->per_page ?? 10)), customModel:Nationality::count());

        } catch (\Exception $e) {
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }



}
