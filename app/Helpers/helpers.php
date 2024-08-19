<?php


use App\Models\Dashboard\Coupon;
use App\Models\Dashboard\Setting;
use Carbon\Carbon;

function setting($attr)
{
    if (\Schema::hasTable('settings')) {
      $phone = $attr;
//      if ($attr == 'phone') {
//          $attr = 'phones';
//      }
        $setting=Setting::where('key',$attr)->first() ??[];
        if ($attr == 'project_name_ar') {
            return ! empty($setting) ? $setting->value : 'الادمن';
        }

        if ($attr == 'project_name_en') {
            return ! empty($setting) ? $setting->value : 'admin';
        }
        if ($attr == 'phone') {
            return ! empty($setting) ? $setting->value : '010300000000';
        }
        if ($attr == 'logo') {
            return ! empty($setting) ? url('/dash-img/setting/'.$setting->value ) : url('../assets/admin/img/avatars/logo.png');
        }
//    if ($phone == 'phone') {
//      return ! empty($setting) && $setting->value ? json_decode($setting->value)[0] : '010300000000';
//      }elseif ($phone == 'phones') {
//          return ! empty($setting) && $setting->value ? implode(",",json_decode($setting->value)) : null;
//      }
        if (! empty($setting)) {
            return $setting->value;

        }
        return false;
    }
    return false;
}

function upload($file , $folder){
    $fileNameWithoutSpaces = str_replace(' ','_',$file->getClientOriginalName());
    $editedFileName = time().'_'.$fileNameWithoutSpaces;
    $file->move($folder, $editedFileName);
    return $editedFileName;
}

function currentDateTime()
{
    return now()->addHours(2)->format('Y-m-d H:i:s');

}

function lang($request,$pro){
    $acceptLanguageHeader = $request->header('Accept-Language');
    $property = $pro . '_' . $acceptLanguageHeader;
    return $property;
}

if (!function_exists('translateMonthToArabic')) {
    function translateMonthToArabic($month)
    {
        $arabicMonths = [
            'January' => 'يناير',
            'February' => 'فبراير',
            'March' => 'مارس',
            'April' => 'إبريل',
            'May' => 'مايو',
            'June' => 'يونيو',
            'July' => 'يوليو',
            'August' => 'أغسطس',
            'September' => 'سبتمبر',
            'October' => 'أكتوبر',
            'November' => 'نوفمبر',
            'December' => 'ديسمبر'
        ];

        return $arabicMonths[$month] ?? $month;
    }
}

function admin()
{
    return auth('admin')->user()->id;
}
function user()
{
    return auth('web')->user();
}

function dateNow()
{
    return Carbon::now()->format('Y-m-d');
}


