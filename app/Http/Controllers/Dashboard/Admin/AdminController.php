<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminRequest;
use App\Http\Services\Service;
use App\Models\Dashboard\Admin;
use App\Models\Dashboard\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $records=Admin::whereNot('id',1)->latest()->paginate(10);
        return view('admin.pages.users.index',get_defined_vars());
    }

    public function edit($id)
    {
        $user=Admin::find($id);
        $roles=Role::all();
        return view('admin.pages.users.edit', get_defined_vars());
    }

    public function create()
    {
        $record = Admin::get();
        $roles=Role::all();
        return view('admin.pages.users.create',get_defined_vars());
    }


    public function store (AdminRequest $request)
    {
        try {
            DB::beginTransaction(); // Begin the transaction
            $admin=Admin::create([
                'name_ar'=> $request->name_ar,
                'name_en'=> $request->name_en,
                'email'=> $request->email,
                'role_id'=> $request->role_id,
                'password'=> Hash::make($request->password),
            ]);

            if($request->image ){
                $imageName= $this->service->upload($request->image , 'dash-img/admin');
                $admin->image=$imageName;
                $admin->save();
            }
            DB::commit(); // Commit the transaction
            return Redirect::route('admin.users.index')->with('toast_success', 'تم العملية بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

    public function show($id)
    {
        $admin=Admin::find($id);
        return view('admin.pages.users.show',get_defined_vars());

    }

    public function update(AdminRequest $request , $id)
    {
        try {
            DB::beginTransaction(); // Begin the transaction
        $admin=Admin::find($id);

        $admin->update([
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'email'=> $request->email,
            'role_id'=> $request->role_id,
            'password'=> Hash::make($request->password),
        ]);

        if($request->image ){
            $imageName= $this->service->upload($request->image , 'dash-img/admin');
            $admin->image=$imageName;
            $admin->save();
        }
            DB::commit(); // Commit the transaction
            return Redirect::route('admin.users.index')->with('toast_success', 'تم التعديل بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }


    public function destroy($id)
    {
        $record = Admin::find($id);
        if ($record) {
            $record->delete();
            return Redirect::route('admin.users.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }




    public function status(Request $request){
        $productId = $request->input('id');
        $product=Admin::find($productId);
        $product->update([
            'is_active'=>$request->status,
        ]);
        return redirect()->back();
    }




}
