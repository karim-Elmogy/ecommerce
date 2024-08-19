<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\CreatePasswordRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Resources\Api\Auth\AuthResource as Resource;
use App\Http\Resources\Api\Auth\OtpResource;
use App\Http\Resources\Api\Auth\RegisterResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User\OTP;
use App\Models\User\User;
use App\Models\User\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(AuthRequest $request)
    {
        DB::beginTransaction();
        try {

            if (!auth()->attempt($this->getCredentials($request))) {
                return $this->sendResponse(['message' =>trans('api.auth.failed')],'failed', false, 401);
            }

            $user=Model::where('phone',$request->phone)->first();
            if (!$user || !$user->phone) {
                return $this->sendResponse(['message' =>trans('api.auth.failed')],'failed', false, 401);
            }

            $token=$user->createToken('student-auth-token')->plainTextToken;
            $user->setAttribute('token',$token);
            DB::commit();
            return $this->sendResponse(new Resource($user));
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'], 'failed', false, 401);
        }
    }


    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user= Model::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
            ]);

            $otpCode=1111;
            $otp= Otp::firstOrCreate([
                'user_id'=>$user->id,
                'otp'=>$otpCode,
            ]);



            // sent otp to student
            // here

            $user->setAttribute('otp',$otp->otp);

            DB::commit();
            return $this->sendResponse(new RegisterResource($user));
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }


    public function checkOtp(Request $request)
    {
        DB::beginTransaction();
        try {
            $otp=Otp::where('user_id',$request->user_id)->first();
            if ($otp->otp == $request->code){
                $user=User::find($request->user_id);
                DB::commit();
                return $this->sendResponse(new OtpResource($user));
            }else{
                return $this->sendResponse(['message' => trans('api.auth.not_valid_code')], 'failed', false, 401);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function createPassword(CreatePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user=User::find($request->user_id);
            if ($user){
                $user->update([
                    'password'=> Hash::make($request->password),
                    'is_active'=>1,
                    'is_complete'=>1,
                ]);
                $token=$user->createToken('student-auth-token')->plainTextToken;
                $user->setAttribute('token',$token);
                DB::commit();
                return $this->sendResponse(new OtpResource($user));
            }else{
                return $this->sendResponse( ['message' => trans('api.auth.not_valid_code')], 'failed', false, 401);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user=auth()->user();
            if (!$user) {
                return $this->sendResponse([trans('api.auth.failed')], 'failed', false, 401);
            }
            $user->update([
                'password'=> Hash::make($request->password),
            ]);
            DB::commit();
            return $this->sendResponse(['message' => __('api.auth.done')],  'success', true, 200);

        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    public function logout()
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $user->tokens()->delete();
            auth('web')->logout();
            DB::commit();
            return $this->sendResponse(['message' => 'تم تسجيل الخروج بنجاح'],  'success', true, 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->sendResponse(['message' => 'حدثت مشكلة اثناء الطلب'],  'failed', false, 401);
        }
    }

    protected function getCredentials(Request $request)
    {
        $credentials =[];
        $credentials['phone'] = $request->phone;
        $credentials['password'] = $request->password;
        return $credentials;
    }


}
