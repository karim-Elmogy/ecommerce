<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\AppForm\AppFormController;
use App\Http\Controllers\User\bookConsultation\BookConsultationController;
use App\Http\Controllers\User\Course\CourseController;
use App\Http\Controllers\User\Dashboard\DashboardController;
use App\Http\Controllers\User\Home\HomeController;
use App\Http\Controllers\User\Partner\PartnerController;
use App\Http\Controllers\User\Profile\UserProfileController;
use App\Http\Controllers\User\Student\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){



    Auth::routes(['login'=>false]);

    Route::get('/api/login' , function (){
       return redirect('/user/login');
    })->name('login');


    # paymant Plane
    Route::post('/payment', [AppFormController::class, 'payPlane'])->name('payPlane');
    Route::get('/pay-status',[AppFormController::class, 'status'])->name('statusPlane');


    Route::get('/',[HomeController::class,'index']);
    Route::get('/user/login',[LoginController::class,'Login'])->name('user.getLogin')->middleware('guest.user');;

    Route::post('/user/login',[LoginController::class,'userLogin'])->name('user.login');
    Route::post('/user/logout',[LoginController::class,'logout'])->name('user.logout');
    Route::post('/phoneConfirm',[LoginController::class,'phoneConfirm'])->name('user.phoneConfirm');
    Route::post('/password',[LoginController::class,'password'])->name('password');


    Route::middleware(['auth:web'])->group(function () {



        # paymant Plane
        Route::post('/payment', [AppFormController::class, 'payPlane'])->name('payPlane');
        Route::get('/pay-status',[AppFormController::class, 'status'])->name('statusPlane');





    });


    Route::middleware(['auth:partner'])->group(function () {





    });


});


