<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        if (!request()->ajax()) {
            return view('admin.pages.settings.index');
        }
    }

    public function store(Request $request)
    {
        if (!request()->ajax()) {
            DB::beginTransaction();
            try {
                $inputs= array_except($request->all(),['logo','password','_token']);
                foreach ($inputs as $key => $value) {
                    Setting::updateOrCreate(['key' => trim($key)],['value'=> $value]);
                }
                if($request->logo ){
                    $imageName= upload($request->logo , 'dash-img/setting');
                    Setting::updateOrCreate(['key' => 'logo'],['value'=> $imageName]);
                }
                DB::commit(); // Commit the transaction
                return redirect(route('admin.setting.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
            }
        }
    }
}
