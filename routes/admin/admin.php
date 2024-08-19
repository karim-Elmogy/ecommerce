<?php


use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Ajax\AjaxController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Bank\BankAccountController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\City\CityController;
use App\Http\Controllers\Dashboard\County\CountyController;
use App\Http\Controllers\Dashboard\Coupon\CouponController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Nationality\NationalityController;
use App\Http\Controllers\Dashboard\newSetting\ContactController;
use App\Http\Controllers\Dashboard\newSetting\RulesController;
use App\Http\Controllers\Dashboard\Offer\OfferController;
use App\Http\Controllers\Dashboard\Order\OrderController;
use App\Http\Controllers\Dashboard\Package\PackageController;
use App\Http\Controllers\Dashboard\PackageUniverity\SpecializationController;
use App\Http\Controllers\Dashboard\Partner\PartnerController;
use App\Http\Controllers\Dashboard\Role\RoleController;
use App\Http\Controllers\Dashboard\Setting\SettingController;
use App\Http\Controllers\Dashboard\Slider\SliderController;
use App\Http\Controllers\Dashboard\Story\StoryController;
use App\Http\Controllers\Dashboard\Team\TeamWorkController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Why\WhyController;
use App\Http\Controllers\User\bookConsultation\BookConsultationController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/',function (){
    return redirect('/ar');
});

Route::get('/admin')->middleware('CheckAdminRedirect');

Route::get('admin/login', [AuthController::class,'create'])->name('admin.login')->middleware('guest.admin');
Route::post('admin/login',[AuthController::class,'store'])->name('admin.store');

Route::get('admin/theme', [HomeController::class, 'theme'])->name('theme');
Route::get('admin/regions/{regions}',[AjaxController::class,'getRegion'])->name('cities.get');
Route::get('admin/apply/coupon',[AjaxController::class,'applyCoupon'])->name('apply.coupon');

Route::delete('admin/package/unit/{id}',[PackageController::class,'deleteUnit']);
Route::delete('admin/setting/unit/{id}',[RulesController::class,'deleteUnit']);
Route::delete('admin/partner/unit/{id}',[PartnerController::class,'deleteUnit']);
Route::get('admin/image-package/{id}',[PackageController::class,'deleteImage']);
Route::get('admin/image-partner/{id}',[PartnerController::class,'deleteImage']);


Route::post('admin/update_offer_order',[OfferController::class,'update_offer_order'])->name('update_offer_order');
Route::post('admin/update_slider_order',[SliderController::class,'update_slider_order'])->name('update_slider_order');

Route::post('admin/update_order',[CategoryController::class,'update_category_order'])->name('update_category_order');
Route::post('admin/update_bank',[BankAccountController::class,'update_bank_order'])->name('update_bank_order');

Route::post('admin/update_package_order',[PackageController::class,'update_package_order'])->name('update_package_order');
Route::post('admin/update_county_order',[CountyController::class,'update_county_order'])->name('update_county_order');
Route::post('admin/update_nationality_order',[NationalityController::class,'update_nationality_order'])->name('update_nationality_order');
Route::post('admin/update_story_order',[StoryController::class,'update_story_order'])->name('update_story_order');

Route::post('admin/update_city_order',[CityController::class,'update_city_order'])->name('update_city_order');

Route::get('dashboard/course/all-course',[RulesController::class,'orders'])->name('admin.course.all-course');
Route::get('/your-route-url/{id}',[RulesController::class,'index2']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'admin','role']
    ], function(){

    Route::middleware(['admin'])->name('admin.')->prefix('dashboard')->group(function () {

        Route::get('/admin',[HomeController::class,'index'])->name('home');

        Route::get('/search',[HomeController::class,'search'])->name('search');

//        Route::get('/user/search',[UserController::class,'index'])->name('user.search');

        Route::get('/slider/search',[SliderController::class,'index'])->name('slider.search');


        Route::get('/profile', [HomeController::class, 'edit'])->name('profile.edit');
//        Route::get('/log', [LogController::class, 'index'])->name('log');
        Route::put('/profile', [HomeController::class, 'update'])->name('profile.update');
        Route::get('users/export/', [UserController::class, 'export'])->name('export');


        // roles
        Route::resource('role',RoleController::class);

        // admins
        Route::resource('users',AdminController::class);


        Route::resource('client',UserController::class);

        // update status admin
        Route::post('admins/status',[AdminController::class,'status'])->name('admins.status');
        Route::post('partner/status',[PartnerController::class,'status'])->name('partner.status');
        Route::post('admin/package',[PackageController::class,'status'])->name('package.status');
        Route::post('admin/package/note/{id}',[PackageController::class,'note'])->name('package.note');
        Route::post('clients/status',[UserController::class,'status'])->name('clients.status');
        Route::post('offer/status',[OfferController::class,'status'])->name('offer.status');
        Route::post('coupon/status',[CouponController::class,'status'])->name('coupon.status');


        Route::get('show-app-form/{id}',[UserController::class,'showApp'])->name('show-app-form');
        Route::get('show-app-university-form/{id}',[UserController::class,'showAppUniversity'])->name('show-app-university-form');




        // offer
        Route::resource('offer',OfferController::class);


        // order
        Route::resource('order',OrderController::class);


        // course
        Route::resource('course',RulesController::class);


        // team
        Route::resource('team',TeamWorkController::class);

        // partner
        Route::resource('partner',PartnerController::class);

        // specialization
        Route::resource('specialization',SpecializationController::class);

        // slider
        Route::resource('slider',SliderController::class);

        // bookConsultation
        Route::resource('book',BookConsultationController::class);


        // County
        Route::resource('county',CountyController::class);
        // nationality
        Route::resource('nationality',NationalityController::class);


        // Bank
        Route::resource('bank',BankAccountController::class);



        // Story
        Route::resource('story',StoryController::class);

        // city
        Route::resource('city',CityController::class);

        // coupon
        Route::resource('coupon',CouponController::class);
        // category
        Route::resource('category',CategoryController::class);




        Route::resource('package',PackageController::class);


        Route::resource('why',WhyController::class);

        Route::resource('settings',ContactController::class);


        // settings
        Route::resource('setting',SettingController::class)->only('index', 'store');

        Route::post('/logout',[AuthController::class,'destroy'])->name('logout');



    });


});

