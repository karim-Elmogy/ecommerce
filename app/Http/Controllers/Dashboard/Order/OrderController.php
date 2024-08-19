<?php

namespace App\Http\Controllers\Dashboard\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Day;
use App\Http\Controllers\Package;
use App\Http\Controllers\Payment;
use App\Http\Controllers\PaymentDay;
use App\Http\Controllers\PaymentDetail;
use App\Http\Controllers\PaymentRequest;
use App\Http\Controllers\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $payments=Order::latest()->paginate(10);
        return view('admin.pages.orders.index',get_defined_vars());
    }

    public function create()
    {
        $packages=Package::where('admin_id',admin())->get();
        $users=User::all();
        $days=Day::all();
        return view('admin.pages.orders.create',get_defined_vars());
    }

//    public function store(PaymentRequest $request)
//    {
//        if (!request()->ajax()) {
//            DB::beginTransaction();
//            try {
//                $payment=Payment::create(array_except($request->validated(),['start_period','user_address_id']));
//                $paymentDetail=PaymentDetail::create(array_except($request->validated(),['package_id','methods','days.day_id','price','package_type']));
//                $paymentDetail->update([
//                    'payment_id'=>$payment->id,
//                ]);
//
//                foreach ($request->days as $day)
//                {
//                    PaymentDay::create([
//                        'day_id'=>$day,
//                        'payment_id'=>$payment->id,
//                    ]);
//                }
//                DB::commit();
//                // Commit the transaction
//                return redirect(route('admin.order.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
//            } catch (\Exception $e) {
//                DB::rollBack();
//                // Roll back the transaction
//                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
//            }
//        }
//    }

    public function show($id)
    {
        if (!request()->ajax()) {
            DB::beginTransaction();
            try {
                $payment=Order::find($id);
                return view('admin.pages.orders.show',get_defined_vars());
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }
    public function update(Request $request, $id)
    {
        $payment=Order::find($id);
        if ($request->key == 'ok')
        {
            $payment->status=1;
            $payment->save();
        }
        elseif ($request->key == 'delivery')
        {
            $payment->status=2;
            $payment->save();
        }
        else
        {
            $payment->status=3;
            $payment->save();
        }

        return redirect()->back();

    }
}
