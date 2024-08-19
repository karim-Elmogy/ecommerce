<?php

namespace App\Http\Controllers\Dashboard\County;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CountyRequest;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{

    public function index()
    {
        $counties=County::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.counties.index',get_defined_vars());
    }


    public function create()
    {
        return view('admin.pages.counties.create');
    }


    public function store(CountyRequest $request)
    {
        if (!request()->ajax()) {
            try {
                $county=County::create(array_except($request->validated(),['image']));
//                if($request->image ){
//                    $imageName=upload($request->image , 'dash-img/county');
//                    $county->image=$imageName;
//                    $county->save();
//                }
                return redirect(route('admin.county.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function show(Category $county)
    {
        //
    }


    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $county=County::find($id);
                return view('admin.pages.counties.edit',get_defined_vars());
            }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function update(CountyRequest $request, $id)
    {
        if (!request()->ajax()) {
            try {
                $county = County::find($id);
                $county->update(array_except($request->validated(), ['image']));

//                if ($request->image) {
//                    $imageName = upload($request->image, 'dash-img/county');
//                    $county->image = $imageName;
//                    $county->save();
//                }

                return redirect(route('admin.county.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function destroy($id)
    {
        $county=County::find($id);
        if ($county) {
            $county->delete();
            return redirect(route('admin.county.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }

    public function update_county_order(Request $request){
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            County::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }
}
