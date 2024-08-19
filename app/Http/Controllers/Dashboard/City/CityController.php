<?php

namespace App\Http\Controllers\Dashboard\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CityRequest;
use App\Models\Dashboard\Boundary;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\City;
use App\Models\Dashboard\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        $cities=City::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.cities.index',get_defined_vars());
    }

    public function create()
    {
        $counties=County::all();
        return view('admin.pages.cities.create',get_defined_vars());
    }

    public function store(CityRequest $request)
    {
        if (!request()->ajax()) {
            try {
            $boundaryCoordinates = $request->coordinates;

            $city=City::create(array_except($request->validated(),['image']));
                    if($request->image ){
                        $imageName=upload($request->image , 'dash-img/city');
                        $city->image=$imageName;
                        $city->save();
                    }
            foreach (json_decode($boundaryCoordinates) as $coordinates) {
                $boundary = new Boundary();
                $boundary->coordinates = $coordinates;
                $city->boundaries()->save($boundary);
            }
                return redirect(route('admin.city.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $city=City::find($id);
                $coordinatesArray = $city->boundaries->pluck('coordinates')->toArray();
                $counties=County::all();

                return view('admin.pages.cities.edit',get_defined_vars());
            }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function update(CityRequest $request, $id)
    {
        if (!request()->ajax()) {
            try {
                $city = City::find($id);
                $city->update(array_except($request->validated(), ['image']));

                if ($request->image) {
                    $imageName = upload($request->image, 'dash-img/city');
                    $city->image = $imageName;
                    $city->save();
                }

                $boundaryCoordinates = json_decode($request->coordinates);
                $existingBoundaries = $city->boundaries->pluck('coordinates')->toArray();
                if($boundaryCoordinates != null) {
                    if ($existingBoundaries != $boundaryCoordinates) {
                        $city->boundaries()->delete();
                        foreach ($boundaryCoordinates as $coordinate) {
                            $boundary = new Boundary();
                            $boundary->coordinates = $coordinate;
                            $city->boundaries()->save($boundary);
                        }
                    }
                }
                return redirect(route('admin.city.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function destroy($id)
    {
        $city=City::find($id);
        if ($city) {
            $city->delete();
            return redirect(route('admin.city.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }

    public function update_city_order(Request $request){
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            City::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }
}
