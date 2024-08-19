<?php

namespace App\Http\Controllers\Dashboard\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OfferRequest;
use App\Models\Dashboard\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OfferController extends Controller
{
    public function index()
    {
        $offers=Offer::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.offers.index',get_defined_vars());
    }

    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $offer=Offer::find($id);
                return view('admin.pages.offers.edit', get_defined_vars());
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }

    public function create()
    {
        return view('admin.pages.offers.create',get_defined_vars());
    }


    public function store (OfferRequest $request)
    {
        try {
            $offer=Offer::create(array_except($request->all(),['image']));
            if($request->image ){
                $imageName= upload($request->image , 'dash-img/offer');
                $offer->image=$imageName;
                $offer->save();
            }

            return Redirect::route('admin.offer.index')->with('toast_success', 'تم العملية بنجاح ✌️');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }


    public function update(OfferRequest $request , $id)
    {
        try {
            $offer=Offer::find($id);
            $offer->update(array_except($request->all(),['image']));
            if($request->image ){
                $imageName= upload($request->image , 'dash-img/offer');
                $offer->image=$imageName;
                $offer->save();
            }
            return Redirect::route('admin.offer.index')->with('toast_success', 'تم التعديل بنجاح ✌️');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }


    public function destroy($id)
    {
        $offer = Offer::find($id);
        if ($offer) {
            $offer->delete();
            return Redirect::route('admin.offer.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }




    public function status(Request $request){
        $offerId = $request->input('id');
        $product=Offer::find($offerId);
        $product->update([
            'is_active'=>$request->status,
        ]);
        return redirect()->back();
    }

    public function update_offer_order(Request $request){
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            Offer::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }


}
