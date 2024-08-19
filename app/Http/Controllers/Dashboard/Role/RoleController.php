<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Models\Dashboard\Permission;
use App\Models\Dashboard\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        if (!request()->ajax()) {
            $roles = Role::latest()->paginate(100);
            return view('admin.pages.roles.index',compact('roles'));
        }
    }

    public function create()
    {
        if (!request()->ajax()) {
            $route=[];
            foreach (app()->routes->getRoutes() as $value) {
                $locale = app()->getLocale();
                if($value->getPrefix() == $locale."/dashboard" || $value->getPrefix() == "/".$locale."/dashboard"){
                    if($value->getName() != 'dashboard.' && !is_null($value->getName())){
                        $route[]= str_before(str_after($value->getName(), '.'), '.');
                    }elseif (is_null($value->getName())) {
                        $route[]= 'home' ;

                    }
                }
            }

            $routes = array_values(array_unique($route));
            $public_routes = ['login' , 'post_login' , 'post_login' , 'seenNotify' , 'admin.logout' , 'notification' , 'profile'];
            return view('admin.pages.roles.create',compact('routes','public_routes'));
        }
    }


    public function store(RoleRequest $request)
    {
        if (!request()->ajax()) {
            try {
                DB::beginTransaction();
            $permission_inputs =$request->validated()['permissions'];
            $role = Role::create([
                'name'=>$request->name,
                'desc'=>$request->desc,
            ]);
            $permission_list = [];
            foreach ($permission_inputs as $permission) {
                foreach ($permission as $singlePermission) {
                    $permission_obj= Permission::updateOrCreate(['route_name' => $singlePermission['route_name']],$singlePermission);
                    $permission_list[] =$permission_obj->id;
                }
            }
            $role->permissions()->sync($permission_list);
                DB::commit(); // Commit the transaction
            return redirect(route('admin.role.index'))->with('toast_success', 'تم العملية بنجاح ✌️');
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
            }
        }
    }

    public function show(Role $role)
    {
        if (!request()->ajax()) {
            return view('admin.pages.roles.show',compact('role'));
        }
    }


    public function edit(Role $role)
    {
        if (!request()->ajax()) {
            $route=[];
            foreach (app()->routes->getRoutes() as $value) {
                $locale = app()->getLocale();
                if($value->getPrefix() == $locale."/dashboard" || $value->getPrefix() == "/".$locale."/dashboard"){
                    if($value->getName() != 'dashboard.' && !is_null($value->getName())){
                        $route[]= str_before(str_after($value->getName(),'.'),'.') ;
                    }elseif (is_null($value->getName())) {
                        $route[]= 'home' ;

                    }
                }
            }
            $routes = array_values(array_unique($route));
            $public_routes = ['login' , 'post_login' , 'post_login' , 'seenNotify' , 'admin.logout' , 'notification' , 'profile'];
            return view('admin.pages.roles.edit',compact('role','routes','public_routes'));
        }
    }

    public function update(RoleRequest $request, Role $role)
    {
        if (!request()->ajax()) {
            try {
                DB::beginTransaction();
            $permission_inputs =$request->validated()['permissions'];
            $role->update([
                    'name'=>$request->name,
                    'desc'=>$request->desc,
            ]);
            $permission_list = [];
            foreach ($permission_inputs as $permission) {
                foreach ($permission as $singlePermission) {
                    $permission_obj= Permission::updateOrCreate(['route_name' => $singlePermission['route_name']],$singlePermission);
                    $permission_list[] =$permission_obj->id;
                }
            }
            $role->permissions()->sync($permission_list);
                DB::commit(); // Commit the transaction
                return redirect(route('admin.role.index'))->with('toast_success', 'تم التعديل بنجاح ✌️');
            } catch (\Exception $e) {
                DB::rollBack(); // Roll back the transaction
                return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
            }
        }
    }

    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return response()->json(['value' => 1]);
        }
    }

}
