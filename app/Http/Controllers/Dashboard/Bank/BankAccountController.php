<?php

namespace App\Http\Controllers\Dashboard\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BankAccountRequest;
use App\Models\Dashboard\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index()
    {
        $banks=BankAccount::orderBy('order','asc')->latest()->paginate(10);
        return view('admin.pages.banks.index',get_defined_vars());
    }

    public function create()
    {
        return view('admin.pages.banks.create');
    }


    public function store(BankAccountRequest $request)
    {
        if (!request()->ajax()) {
            try {
                $bank=BankAccount::create(array_except($request->validated(),['image']));
                if($request->image ){
                    $imageName=upload($request->image , 'dash-img/bank');
                    $bank->image=$imageName;
                    $bank->save();
                }
                return redirect(route('admin.bank.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function show(BankAccount $bank)
    {
        //
    }

    public function edit($id)
    {
        if (!request()->ajax()) {
            try {
                $bank=BankAccount::find($id);
                return view('admin.pages.banks.edit',get_defined_vars());
            }catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function update(BankAccountRequest $request, $id)
    {
        if (!request()->ajax()) {
            try {
                $bank = BankAccount::find($id);
                $bank->update(array_except($request->validated(), ['image']));

                if ($request->image) {
                    $imageName = upload($request->image, 'dash-img/bank');
                    $bank->image = $imageName;
                    $bank->save();
                }

                return redirect(route('admin.bank.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
        }
    }


    public function destroy($id)
    {
        $bank=BankAccount::find($id);
        if ($bank) {
            $bank->delete();
            return redirect(route('admin.bank.index'))->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
        }
    }

    public function update_bank_order(Request $request){
        $bank_ids = $request->input('cateIds');
        foreach ($bank_ids as $index => $bank_id) {
            BankAccount::where('id', $bank_id)->update(['order' => $index + 1]);
        }
        return response()->json(['message' => 'Item order updated successfully']);
    }

}
