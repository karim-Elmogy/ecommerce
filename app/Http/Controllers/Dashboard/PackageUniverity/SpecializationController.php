<?php

namespace App\Http\Controllers\Dashboard\PackageUniverity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SpecializationRequest;
use App\Models\Dashboard\Partner;
use App\Models\Dashboard\SubParner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SpecializationController extends Controller
{
    public function index()
    {
        $records=SubParner::latest()->paginate(10);
        return view('admin.pages.specializations.index',get_defined_vars());
    }

    public function edit($slug)
    {
        $specialization=SubParner::find($slug);
        $partners=Partner::all();
        return view('admin.pages.specializations.edit', get_defined_vars());
    }

    public function create()
    {
        $partners=Partner::all();
        return view('admin.pages.specializations.create',get_defined_vars());
    }


    public function store (SpecializationRequest $request)
    {

        try {

            $specialization=SubParner::create(array_except($request->validated(),['image']));
            if ($request->has('image') && is_array($request->image)) {
                foreach ($request->image as $image) {
                    $imageName= upload($image , 'dash-img/specialization');
                    $specialization->image=$imageName;
                    $specialization->save();
                }
            }



            DB::commit(); // Commit the transaction
            return Redirect::route('admin.specialization.index')->with('toast_success', 'تم العملية بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

//    public function show($slug)
//    {
//        $partner=Partner::where('slug',$slug)->first();
//        return view('admin.pages.partners.show',get_defined_vars());
//
//    }

    public function update(SpecializationRequest $request , $slug)
    {
        try {
            $specialization=SubParner::find($slug);
            $specialization->update(array_except($request->validated(), ['image']));



            if ($request->has('image') && is_array($request->image)) {
                foreach ($request->image as $image) {
                    $imageName= upload($image , 'dash-img/specialization');
                    $specialization->image=$imageName;
                    $specialization->save();
                }
            }


            DB::commit(); // Commit the transaction
        return Redirect::route('admin.specialization.index')->with('toast_success', 'تم التعديل بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }


    public function destroy($slug)
    {
        $specialization=SubParner::find($slug);
        if ($specialization) {
            $specialization->delete();
            return Redirect::route('admin.specialization.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

}
