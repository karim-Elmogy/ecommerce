<?php

namespace App\Http\Controllers\Dashboard\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OfferRequest;
use App\Models\Dashboard\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SliderController extends Controller
{
    public function index()
    {
        $sliders=Slider::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.sliders.index',get_defined_vars());
    }

    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $slider=Slider::find($id);
                return view('admin.pages.sliders.edit', get_defined_vars());
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function create()
    {
        return view('admin.pages.sliders.create',get_defined_vars());
    }


    public function store (OfferRequest $request)
    {
        try {
            $slider=Slider::create(array_except($request->all(),['image']));
            if($request->image ){
                $imageName= upload($request->image , 'dash-img/slider');
                $slider->image=$imageName;
                $slider->save();
            }

            return Redirect::route('admin.slider.index')->with('toast_success', 'تم العملية بنجاح ✌️');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }


    public function update(OfferRequest $request , $id)
    {
        try {
            $slider=Slider::find($id);
            $slider->update(array_except($request->all(),['image']));
            if($request->image ){
                $imageName= upload($request->image , 'dash-img/slider');
                $slider->image=$imageName;
                $slider->save();
            }
            return Redirect::route('admin.slider.index')->with('toast_success', 'تم التعديل بنجاح ✌️');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }


    public function destroy($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            $slider->delete();
            return Redirect::route('admin.slider.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }




//    public function status(Request $request){
//        $offerId = $request->input('id');
//        $product=Offer::find($offerId);
//        $product->update([
//            'is_active'=>$request->status,
//        ]);
//        return redirect()->back();
//    }

    public function update_slider_order(Request $request){
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            Slider::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }
}
