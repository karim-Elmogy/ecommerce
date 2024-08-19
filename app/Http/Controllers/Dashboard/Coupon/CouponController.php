<?php

namespace App\Http\Controllers\Dashboard\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CouponRequest;
use App\Models\Dashboard\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons=Coupon::latest()->paginate(10);
        return view('admin.pages.coupons.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.pages.coupons.create');
    }

    public function store(CouponRequest $request)
    {
        if (!request()->ajax()) {
            try {
                Coupon::create($request->all());
                return redirect(route('admin.coupon.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
            }
        }
    }

    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $coupon = Coupon::find($id);
                return view('admin.pages.coupons.edit', get_defined_vars());
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }



    public function update(CouponRequest $request,$id)
    {
        if (!request()->ajax()) {
            try {
                $coupon=Coupon::find($id);
                $coupon->update($request->all());
                return redirect(route('admin.coupon.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
            }
        }
    }

    public function destroy($id)
    {
        $coupon=Coupon::find($id);
        if ($coupon) {
            $coupon->delete();
            return redirect(route('admin.coupons.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

    public function status(Request $request){
        $couponId = $request->input('id');
        $coupon=Coupon::find($couponId);
        $coupon->update([
            'is_active'=>$request->status,
        ]);
        return redirect()->back();
    }

}
