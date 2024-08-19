<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Service;
use App\Models\Dashboard\AppForm;
use App\Models\User\UniversityAppForm;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (request()->from){
            $records=User::whereBetween('created_at', [request()->from, request()->to])->with('lastLogin')->latest()->paginate(10);
        }
        else{
            $records=User::latest()->paginate(10);
        }
        return view('admin.pages.clients.index',get_defined_vars());
    }

    public function edit($id)
    {
        $user=User::with('app')->find($id);
        return view('admin.pages.clients.edit', get_defined_vars());
    }

    public function create()
    {
        return view('admin.pages.clients.create');
    }


    public function store (UserRequest $request)
    {
        try {
            DB::beginTransaction(); // Begin the transaction
            $user=User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
//                'address' => $request->address,
//                'whatsapp' => $request->whatsapp,
//                'facebook' => $request->facebook,
//                'website' => $request->website,
                'password'=> Hash::make($request->password),
            ]);

            if($request->image ){
                $imageName= $this->service->upload($request->image , 'dash-img/user');
                $user->image=$imageName;
                $user->save();
            }
            DB::commit(); // Commit the transaction
            return Redirect::route('admin.client.index')->with('toast_success', 'تم العملية بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

    public function show($id)
    {
        $user=User::find($id);
        return view('admin.pages.clients.show',get_defined_vars());

    }

    public function update(UserRequest $request , $id)
    {
        try {
            DB::beginTransaction(); // Begin the transaction
            $admin=User::find($id);

            $admin->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
//                'address' => $request->address,
//                'whatsapp' => $request->whatsapp,
//                'facebook' => $request->facebook,
//                'website' => $request->website,
                'password'=> Hash::make($request->password),
            ]);

            if($request->image ){
                $imageName= $this->service->upload($request->image , 'dash-img/user');
                $admin->image=$imageName;
                $admin->save();
            }
            DB::commit(); // Commit the transaction
            return Redirect::route('admin.client.index')->with('toast_success', 'تم التعديل بنجاح ✌️');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }


    public function destroy($id)
    {
        $record = User::find($id);
        if ($record) {
            $record->delete();
            return Redirect::route('admin.client.index')->with('toast_success', 'تم الحذف بنجاح ✌️');
        } else {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }




    public function status(\Request $request){
        $productId = $request->input('id');
        $product=User::find($productId);
        $product->update([
            'is_active'=>$request->status,
        ]);
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function showApp($id)
    {
        $app=AppForm::find($id);
        return view('admin.pages.clients.show2',get_defined_vars());

    }

    public function showAppUniversity($id)
    {
        $app=UniversityAppForm::find($id);
        return view('admin.pages.clients.show3',get_defined_vars());

    }

}
