<?php

namespace App\Http\Controllers\Dashboard\Nationality;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NationalityRequest;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        $nationalities=Nationality::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.nationalities.index',get_defined_vars());
    }


    public function create()
    {
        return view('admin.pages.nationalities.create');
    }


    public function store(NationalityRequest $request)
    {
        if (!request()->ajax()) {
            try {
                $nationality=Nationality::create($request->validated());

                return redirect(route('admin.nationality.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function show(Category $Nationality)
    {
        //
    }


    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $nationality=Nationality::find($id);
                return view('admin.pages.nationalities.edit',get_defined_vars());
            }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function update(NationalityRequest $request, $id)
    {
        if (!request()->ajax()) {
            try {
                $nationality = Nationality::find($id);
                $nationality->update($request->validated());


                return redirect(route('admin.nationality.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function destroy($id)
    {
        $nationality=Nationality::find($id);
        if ($nationality) {
            $nationality->delete();
            return redirect(route('admin.nationality.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }

    public function update_nationality_order(Request $request){
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            Nationality::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }
}
