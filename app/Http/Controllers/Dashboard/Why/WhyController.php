<?php

namespace App\Http\Controllers\Dashboard\Why;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\WhyRequest;
use App\Models\Dashboard\Why;
use Illuminate\Http\Request;

class WhyController extends Controller
{
    public function index()
    {
        $whies=Why::latest()->paginate(10);
        return view('admin.pages.why.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.pages.why.create');
    }

    public function store(WhyRequest $request)
    {
        if (!request()->ajax()) {
            try {
                $why=Why::create(array_except($request->validated(),['image']));
                if($request->image ){
                    $imageName=upload($request->image , 'dash-img/why');
                    $why->image=$imageName;
                    $why->save();
                }
                return redirect(route('admin.why.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $why=Why::find($id);
                return view('admin.pages.why.edit',get_defined_vars());
            }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function update(WhyRequest $request, $id)
    {
        if (!request()->ajax()) {
            try {
                $why = Why::find($id);
                $why->update(array_except($request->validated(), ['image']));

                if ($request->image) {
                    $imageName = upload($request->image, 'dash-img/why');
                    $why->image = $imageName;
                    $why->save();
                }

                return redirect(route('admin.why.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function destroy($id)
    {
        $why=Why::find($id);
        if ($why) {
            $why->delete();
            return redirect(route('admin.why.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }


}
