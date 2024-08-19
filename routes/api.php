<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\DesignYourCourse\DesignYourCourseController;
use App\Http\Controllers\Api\Favorite\FavoriteController;
use App\Http\Controllers\Api\Form\FormController;
use App\Http\Controllers\Api\General\GeneralController;
use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Api\Order\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('student')->group(function(){

    // Login
    Route::post('/login', [AuthController::class,'login']);

    // Register
    Route::post('/register', [AuthController::class,'register']);

    // OTP
    Route::post('/checkOtp', [AuthController::class,'checkOtp']);

    // Create Password
    Route::post('/create-password', [AuthController::class,'createPassword']);

    // HOME
    Route::get('/home', [HomeController::class,'home']);

    // English Packages
    Route::get('/english-packages', [HomeController::class,'englishPackages']);

    // University Packages
    Route::get('/university-packages', [HomeController::class,'universityPackages']);

    // Show University Packages
    Route::get('/university-packages/{id}', [HomeController::class,'showUniversityPackages']);

    Route::get('/specialization/{specialization_id}', [HomeController::class,'showSpecialization']);


    // Summer Packages
    Route::get('/summer-packages', [HomeController::class,'summerPackages']);

    // Book
    Route::post('/student-book', [HomeController::class,'book']);

    // Why Choose Utopia
    Route::get('/why-choose-utopia', [GeneralController::class,'whyChooseUtopia']);

    // Stories
    Route::get('/stories', [GeneralController::class,'stories']);

    // Banks
    Route::get('/banks-account', [GeneralController::class,'banks']);


    // Counties
    Route::get('/counties', [GeneralController::class,'counties']);


    // cities
    Route::get('/cities', [GeneralController::class,'cities']);

    // Partner Image
    Route::get('/partner-images', [GeneralController::class,'partnerImage']);


    // County Filter
    Route::get('/county-filter/{county_id}', [GeneralController::class,'countyFilter']);

    // City Filter
    Route::get('/city-filter/{city_id}', [GeneralController::class,'cityFilter']);

    // Name Filter
    Route::get('/name-filter', [GeneralController::class,'nameFilter']);


    // Nationalities
    Route::get('/nationalities', [GeneralController::class,'nationalities']);

    // Filter City By County
    Route::get('/filter-city-by-county/{county_id}', [GeneralController::class,'filterCity']);

    // Filter City Name
    Route::get('/filter-city-name', [GeneralController::class,'filterCityName']);

    // Filter Package By Number Of Weeks
    Route::get('/filter-package-by-weeks/{city_id}/{numberOfWeeks}/{start_date}', [GeneralController::class,'filterPackageByNumberOfWeeks']);

    // Show Partner Details
    Route::get('/show-partner-details/{id}', [GeneralController::class,'showPartnerDetails']);




});


Route::middleware('auth:sanctum')->prefix('student')->group(function(){

    //Logout
    Route::post('/logout', [AuthController::class,'logout']);

    //Reset Password
    Route::post('/reset-password', [AuthController::class,'resetPassword']);

    // Profile
    Route::get('/getProfile', [ProfileController::class,'profile']);
    Route::post('/editProfile', [ProfileController::class,'updateProfile']);

    // App Form
    Route::post('/register-package', [FormController::class,'appForm']);

    //University App Form
    Route::post('/university-register-package', [FormController::class,'unAppForm']);

    // Favorite
    Route::get('/favorite', [FavoriteController::class,'favorite']);
    Route::post('/store-favorite', [FavoriteController::class,'store']);




    // Choose your course details
    Route::get('/choose-your-course-details/{partner_id}', [GeneralController::class,'show']);


    // Choose your course details
    Route::post('/design-your-course/store', [DesignYourCourseController::class,'store']);



   // All Orders
    Route::get('/orders', [OrderController::class,'index']);

    // Show Order
    Route::get('/order/show/{order_id}', [OrderController::class,'show']);



});
