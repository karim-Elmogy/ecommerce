<?php

namespace App\Http\Controllers\Dashboard\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PackageRequest;
use App\Models\Dashboard\Article;
use App\Models\Dashboard\ArticleData;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\City;
use App\Models\Dashboard\ImagePackage;
use App\Models\Dashboard\Package;
use App\Models\Dashboard\PackageData;
use App\Models\Dashboard\PackagePlan;
use App\Models\Dashboard\Partner;
use App\Models\User\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::orderBy('order','asc')->with('packageData')->paginate(10);
        return view('admin.pages.packages.index', get_defined_vars());
    }



    public function create()
    {
        $cities=City::all();
        $categories=Category::where('id','!=',2)->get();
        $partners=Partner::get();
        return view('admin.pages.packages.create',get_defined_vars());
    }


    public function store(PackageRequest $request)
    {
        if (!request()->ajax()) {
            DB::beginTransaction();
            try {
                $package = Package::create(array_except($request->all(), ['image', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'answer_e', 'time', 'price', 'unit', 'date']));

                if ($request->has('image') && is_array($request->image)) {
                    foreach ($request->image as $image) {
                        $imageName = upload($image, 'dash-img/package');
                        ImagePackage::create([
                            'image' => $imageName,
                            'package_id' => $package->id,
                        ]);
                    }
                }

                PackageData::create([
                    'answer_a' => $request->input('answer_a'),
                    'answer_b' => $request->input('answer_b'),
                    'answer_c' => $request->input('answer_c'),
                    'answer_d' => $request->input('answer_d'),
                    'answer_e' => $request->input('answer_e'),
                    'package_id' => $package->id,
                ]);

                $times = $request->input('time');
                $prices = $request->input('price');
                $units = $request->input('unit');

                $packageData = [];
                if ($times) {
                    foreach ($times as $index => $eachTime) {
                        $eachPrice = $prices[$index];
                        $eachUnit = $units[$index];

                        $packageData[] = [
                            'time' => $eachTime,
                            'price' => $eachPrice,
                            'unit' => $eachUnit,
                            'package_id' => $package->id,
                        ];

                        PackagePlan::create($packageData[$index]);
                    }
                }

                DB::commit();
                return redirect(route('admin.package.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب: ' . $e->getMessage()]);
            }
        }
    }




    public function show($id)
    {
        $package = Package::with(['packageData','packageImage'])->findOrFail($id);
        return view('admin.pages.packages.show', get_defined_vars());
    }



    public function edit($id)
    {
        $package = Package::with(['packageData','packageImage'])->findOrFail($id);
        $cities=City::all();
        $categories=Category::where('id','!=',2)->get();
        $partners=Partner::get();

        if (!$package->packageData) {
            return redirect()->back()->with('error', 'Package data not found.');
        }

        return view('admin.pages.packages.edit',get_defined_vars());
    }



    public function update(PackageRequest $request, Package $package)
    {

        try {


        $package->update(array_except($request->all(), ['image', 'answer_a', 'answer_b', 'answer_c', 'answer_d','answer_e','time','price','unit','date']));

        if ($request->has('image') && is_array($request->image)) {
            foreach ($request->image as $image) {
                $imageName = upload($image, 'dash-img/package');
                ImagePackage::create([
                    'image' => $imageName,
                    'package_id' => $package->id,
                ]);
            }
        }


        $packageData=PackageData::where('package_id',$package->id)->first();

        $packageData->update([
            'answer_a' => $request->input('answer_a'),
            'answer_b' => $request->input('answer_b'),
            'answer_c' => $request->input('answer_c'),
            'answer_d' => $request->input('answer_d'),
            'answer_e' =>$request->input('answer_e'),
            'package_id' => $package->id,


        ]);









        $time = $request->input('time');
        $prices = $request->input('price'); // Renamed to avoid confusion
        $units = $request->input('unit');
        $packageId = $package->id; // Assuming $package is defined elsewhere

        if ($time) {
            foreach ($time as $index => $t) {
                // Define unique criteria for each package plan
                $uniqueCriteria = [
                    'time' => $t,
                    'package_id' => $packageId,
                ];

                // Define the data for each package plan
                $packageData = [
                    'time' => $t,
                    'price' => $prices[$index], // Access the corresponding price
                    'unit' => $units[$index], // Access the corresponding unit
                    'package_id' => $packageId,
                ];

                // Use updateOrCreate for each record
                PackagePlan::updateOrCreate($uniqueCriteria, $packageData);

            }
        }




        return redirect(route('admin.package.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');


                } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']);
            }
    }


    public function destroy(Package $package)
    {
        DB::beginTransaction();
        try {
            $package->packageData()->delete();
            $package->delete();
            DB::commit();
            return redirect()->route('admin.package.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة أثناء الطلب']);
        }
    }


    public function deleteUnit($id){
        $unit = PackageData::findOrfail($id);
        $unit->delete();
    }

    public function deleteImage($id)
    {
        $unit = ImagePackage::findOrfail($id);
        $unit->delete();
    }

    public function update_package_order(Request $request)
    {
        $cat_ids = $request->input('cateIds');
        foreach ($cat_ids as $index => $cat_id) {
            Package::where('id', $cat_id)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Item order updated successfully']);
    }

    public function status(Request $request){
        $productId = $request->input('id');
        $product=Package::find($productId);
        $product->update([
            'is_note'=>$request->status,
        ]);
        return redirect()->back();
    }

    public function note(Request $request , $id){
        $product=Package::find($id);
        $product->update([
            'note'=>$request->note,
        ]);
        return redirect()->back();
    }

}
