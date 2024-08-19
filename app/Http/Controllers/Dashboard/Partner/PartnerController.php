<?php

namespace App\Http\Controllers\Dashboard\Partner;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PartnerRequset;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Partner;
use App\Models\Dashboard\PartnerImage;
use App\Models\Dashboard\SubParner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class PartnerController extends Controller
{
    public function index()
    {
        $records=Partner::latest()->paginate(10);
        return view('admin.pages.partners.index',get_defined_vars());
    }

    public function edit($slug)
    {
        $partner=Partner::where('slug',$slug)->first();
        $cities=City::all();
        return view('admin.pages.partners.edit', get_defined_vars());
    }

    public function create()
    {
        $cities=City::all();
        return view('admin.pages.partners.create',get_defined_vars());
    }


    public function store (PartnerRequset $request)
    {

        try {
            DB::beginTransaction(); // Begin the transaction
            $partner=Partner::create(array_except($request->all(), ['image']));

            if ($request->has('image') && is_array($request->image)) {
                foreach ($request->image as $image) {
                    $imageName= upload($image , 'dash-img/partner');
                    PartnerImage::create([
                        'image' => $imageName,
                        'partner_id' => $partner->id,
                    ]);
                }
            }



            DB::commit(); // Commit the transaction
            return Redirect::route('admin.partner.index')->with('toast_success', 'تم العملية بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

    public function show($slug)
    {
        $partner=Partner::where('slug',$slug)->first();
        return view('admin.pages.partners.show',get_defined_vars());

    }

    public function update(PartnerRequset $request , $slug)
    {
        try {
            DB::beginTransaction(); // Begin the transaction
            $partner=Partner::where('slug',$slug)->first();

            $partner->update(array_except($request->all(), ['image']));

            if ($request->has('image') && is_array($request->image)) {
                foreach ($request->image as $image) {
                    $imageName= upload($image , 'dash-img/partner');
                    PartnerImage::create([
                        'image' => $imageName,
                        'partner_id' => $partner->id,
                    ]);
                }
            }





            DB::commit(); // Commit the transaction
            return Redirect::route('admin.partner.index')->with('toast_success', 'تم التعديل بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }


    public function destroy($slug)
    {
        $record=Partner::where('slug',$slug)->first();
        if ($record) {
            $record->delete();
            return Redirect::route('admin.partner.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }




    public function status(Request $request){
        $productId = $request->input('id');
        $product=Partner::find($productId);
        $product->update([
            'is_active'=>$request->status,
        ]);
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function deleteImage($id)
    {
        $unit = PartnerImage::findOrfail($id);
        $unit->delete();
    }


    public function deleteUnit($id){
        $unit = SubParner::findOrfail($id);
        $unit->delete();
    }
}
