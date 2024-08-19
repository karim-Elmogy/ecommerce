<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateProfileRequest;
use App\Http\Services\Service;
use App\Models\Dashboard\Admin;
use App\Models\Dashboard\Car;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Driver;
use App\Models\Dashboard\Nationality;
use App\Models\Dashboard\Offer;
use App\Models\Dashboard\Package;
use App\Models\Dashboard\Payment;
use App\Models\Dashboard\Period;
use App\Models\Dashboard\Reason;
use App\Models\Dashboard\Region;
use App\Models\Dashboard\Ride;
use App\Models\Dashboard\Supervisor;
use App\Models\Dashboard\Supplier;
use App\Models\Dashboard\Worker;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $admins=Admin::whereNot('id',1)->count();
        $offers=Offer::count();
        $cities=City::count();
        $categories=Category::count();
        return view('admin.index',get_defined_vars());
    }

    public function edit()
    {
        $user=Auth::guard('admin');
        return view('admin.profile.edit', get_defined_vars());
    }

    public function update(UpdateProfileRequest $request)
    {
        $admin=auth('admin')->user();
        $admin->name_ar = $request->name_ar;
        $admin->name_en = $request->name_en;

        if($request->password != null){
            auth('admin')->user()->password = Hash::make($request->password);
        }

        if($request->image ){
            $imageName= $this->service->upload($request->image , 'dash-img/admin');
            $admin->image=$imageName;
            $admin->save();
        }



        auth('admin')->user()->save();
        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }


    public function theme()
    {
        $theme=request()->val;
        $id=Auth::guard('admin')->user()->id;
        $admin=Admin::find($id);
        if($theme == 'light'){
            $admin->update([
                'theme_default'=>0,
            ]);
        }else{
            $admin->update([
                'theme_default'=>1,
            ]);
        }

    }

    public function search()
    {
        $query=request()->input('query');
        $users = User::where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('phone_number', 'like', '%' . $query . '%')
                            ->orWhere('name', 'like', '%' . $query . '%');
                    });
                })
                ->get();
        return view('admin.pages.orders.search',get_defined_vars());
    }






}
