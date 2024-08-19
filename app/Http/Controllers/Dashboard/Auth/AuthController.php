<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function create(){
        return view('admin.auth.login');
    }


    public function store(Request $request){
        $credentials = $request->only('email', 'password');

        if(!Auth::guard('admin')->attempt($credentials, $request->filled('remember'))){
             Alert::error(' كلمة السر خاطئة ✌️');
            throw ValidationException::withMessages([
                'email'=>' كلمة السر خاطئة ✌️'
            ]);
        }

        // Check if the user is active
        $user = Auth::guard('admin')->user();
        if (!$user->is_active) {
            Auth::guard('admin')->logout();
            Alert::error('حسابك غير نشط. ✋');
            throw ValidationException::withMessages([
                'email'=>'حسابك غير نشط. ✋'
            ]);
        }

//        Alert::success('اهلا بك في لوحة تحكم ');

        return redirect()->intended(route('admin.home'));
    }



    public function destroy(Request $request){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
