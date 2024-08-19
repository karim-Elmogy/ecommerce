<?php

namespace App\Http\Controllers\Dashboard\newSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\NewSettingRequest;
use App\Models\Dashboard\newSetting;
use App\Models\Dashboard\Partner;
use App\Models\Order;
use App\Models\PartnerPlanPrice;
use App\Models\User\DesignYourCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RulesController extends Controller
{
    public function index(){
        $courses = newSetting::where('partner_id',null)->where('section','courses')->get();
        $living = newSetting::where('partner_id',null)->where('section','living')->get();
        $pick_up = newSetting::where('partner_id',null)->where('section','pick_up')->get();
        $medical = newSetting::where('partner_id',null)->where('section','medical')->get();
        $other_fees = newSetting::where('partner_id',null)->where('section','other_fees')->get();

        $partners=Partner::all();

        $c_partner=0;
        return view('admin.pages.settings.Rules.index',get_defined_vars());
    }
    public function index2($id){
        $courses = newSetting::where('partner_id',$id)->where('section','courses')->get();
        $living = newSetting::where('partner_id',$id)->where('section','living')->get();
        $pick_up = newSetting::where('partner_id',$id)->where('section','pick_up')->get();
        $medical = newSetting::where('partner_id',$id)->where('section','medical')->get();
        $other_fees = newSetting::where('partner_id',$id)->where('section','other_fees')->get();
        $partners=Partner::all();
        $c_partner=Partner::find($id)->id;

        return view('admin.pages.settings.Rules.index',get_defined_vars());
    }

    public function show ($id)
    {
        $payment = DesignYourCourse::findOrfail($id);

        return view('admin.pages.settings.Rules.show',get_defined_vars());
    }
    public function edit($id){
        $getItem = newSetting::findOrfail($id);
        $partners=Partner::all();
        return view('admin.pages.settings.Rules.edit',[
            'item'=>$getItem,
            'partners'=>$partners,
        ]);
    }

    public function create(){
        $partners=Partner::all();
        return view('admin.pages.settings.Rules.create',get_defined_vars());
    }
    public function update(NewSettingRequest $request,$id){
        $getNavBarItem = newSetting::findOrfail($id);
        $getNavBarItem->update(array_except($request->all(), ['from','to', 'price', 'year', 'unit', 'date']));


        $froms = $request->input('from');
        $tos = $request->input('to');
        $prices = $request->input('price');
        $years = $request->input('year');
        $units = $request->input('unit');
        $partnerId = $getNavBarItem->id; // Assuming $package is defined elsewhere

        if ($froms) {
            foreach ($froms as $index => $t) {
                // Define unique criteria for each package plan
                $uniqueCriteria = [
                    'from' => $t,
                    'setting_id' => $partnerId,
                ];

                // Define the data for each package plan
                $packageData = [
                    'from' => $t,
                    'to' =>$tos[$index],
                    'price' => $prices[$index], // Access the corresponding price
                    'year' => $years[$index], // Access the corresponding unit
                    'unit' => $units[$index], // Access the corresponding unit
                    'setting_id' => $partnerId,
                ];

                // Use updateOrCreate for each record
                PartnerPlanPrice::updateOrCreate($uniqueCriteria, $packageData);

            }
        }



        return redirect()->back()->with('toast_success', 'تم التعديل بنجاح ✌️');
    }

    public function store(NewSettingRequest $request){

        DB::beginTransaction();
        try {
        $item=newSetting::create(array_except($request->all(), ['from','to', 'price', 'year','unit', 'date']));


        $froms = $request->input('from');
        $tos = $request->input('to');
        $prices = $request->input('price');
        $years = $request->input('year');
        $units = $request->input('unit');

        $packageData = [];
        if ($froms) {
            foreach ($froms as $index => $from) {
                $to = $tos[$index];
                $eachPrice = $prices[$index];
                $eachYear = $years[$index];
                $eachUnit = $units[$index];

                $packageData[] = [
                    'from' => $from,
                    'to' => $to,
                    'price' => $eachPrice,
                    'year' => $eachYear,
                    'unit' => $eachUnit,
                    'setting_id' => $item->id,
                ];

                PartnerPlanPrice::create($packageData[$index]);
            }
        }
            DB::commit();
        return redirect(route('admin.course.index'))->with('toast_success', 'تم الاضافة بنجاح ✌️');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب: ' . $e->getMessage()]);
        }
    }

    public function destroy($id){
        $getItem = newSetting::findOrfail($id);
        $getItem->delete();

        return redirect()->back()->with('toast_success', 'تم الحذف بنجاح ✌️');
    }


    public function orders()
    {

        $payments=DesignYourCourse::latest()->paginate(10);
        return view('admin.pages.settings.Rules.orders',get_defined_vars());
    }

    public function deleteUnit($id){
        $unit = PartnerPlanPrice::findOrfail($id);
        $unit->delete();
    }
}
