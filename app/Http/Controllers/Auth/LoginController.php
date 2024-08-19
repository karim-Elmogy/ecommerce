<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AppFormRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\Dashboard\AppForm;
use App\Models\User\LastLogin;
use App\Models\User\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function Login()
    {
        return view('auth.login');
    }

    public function userLogin(Request $request)
    {
        try {

            if ($request->user_type == 'student'){
                if (!auth('web')->attempt($this->getCredentials($request))) {
                    return redirect()->back()->withErrors(['error' => 'الايميل او  كلمة السر خاطئة ✌️']); // Return false if there was an error
                }
                $last_Login=LastLogin::firstOrCreate([
                    'user_id'=>user()->id,
                ]);
                if ($last_Login){
                    $last_Login->update([
                        'updated_at'=>now(),
                    ]);
                }
                return redirect()->intended(url('/student'));
            }elseif($request->user_type == 'partner'){
                if (!auth('partner')->attempt($this->getPartnerCredentials($request))) {
                    return redirect()->back()->withErrors(['error' => 'الايميل او  كلمة السر خاطئة ✌️']); // Return false if there was an error
                }
//                dd("sd");
//                dd(auth('partner')->user());
                return redirect()->intended(url('/partner'));
            }else{
                if (!auth('team')->attempt($this->getPartnerCredentials($request))) {
                    return redirect()->back()->withErrors(['error' => 'الايميل او  كلمة السر خاطئة ✌️']); // Return false if there was an error
                }
                return redirect()->intended(url('/team'));
            }



        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'حدثت مشكلة اثناء الطلب']); // Return false if there was an error
        }
    }

    protected function getCredentials(Request $request)
    {
        $credentials =[];
        $credentials['phone'] = $request->phone;
        $credentials['password'] = $request->password;
        return $credentials;
    }



    protected function getPartnerCredentials(Request $request)
    {
        $credentials =[];
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;
        $credentials['is_active'] = 1;
        return $credentials;
    }
























    public function logout(Request $request){
        Auth::guard('web')->logout();
        return redirect('/');
    }


    public function phoneConfirm(RegisterRequest $request)
    {
        $data = array_except($request->validated(), []);

        session()->forget('data');
        $request->session()->put('data', $data);

        session()->forget('otp');
        $request->session()->put('otp',1111);


        $user=User::create([
            'name'=>session()->get('data')['name'],
            'phone'=>session()->get('data')['phone'],
            'user_type'=>'student',
        ]);

        $request->session()->put('user_id', $user->id);

        return view('auth.phoneConfirm');
    }

    public function password(Request $request)
    {
        $data = $request->all();

        $inputOTP = session()->get('otp');


        $array = [
            "phoneConfirm1" => $data['phoneConfirm1'],
            "phoneConfirm2" => $data['phoneConfirm2'],
            "phoneConfirm3" => $data['phoneConfirm3'],
            "phoneConfirm4" => $data['phoneConfirm4'],
        ];

        $string = implode("", $array);
        $otp = (int)$string;

        // Check if the input OTP matches any of the stored OTPs
        if (($inputOTP == $otp)) {
            return view('auth.password');
        } else {
            dd("Invalid OTP");
        }
    }


    public function applicationForm(Request $request)
    {


        $request->session()->forget('pass');
        $request->session()->put('pass',$request->pass);

        $user=User::where('phone',session()->get('data')['phone'])->where('user_type','student')->first();

        $user->update([
            'password'=>Hash::make(session()->get('pass')),
            'is_active'=>1,
            'is_complete'=>1,
        ]);

        $last_Login=LastLogin::firstOrCreate([
            'user_id'=>$user->id,
        ]);
        if ($last_Login){
            $last_Login->update([
                'updated_at'=>now(),
            ]);
        }

        Auth::login($user);
        return redirect()->intended(url('/student'));

    }







}
