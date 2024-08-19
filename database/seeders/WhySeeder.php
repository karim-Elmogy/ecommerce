<?php

namespace Database\Seeders;

use App\Models\Dashboard\newSetting;
use App\Models\Dashboard\Why;
use Illuminate\Database\Seeder;

class WhySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DataSecureSettings = [
            [
                'name_ar' => ' تقدر تقدم بنفسك وقبولك يوصلك في أسرع وقت ',
                'name_en' => 'You can present yourself and your acceptance will reach you as quickly as possible',
                'image' => '1717838680_1.png',
            ],

            [
                'name_ar' => ' متابعة كاملة للطالب من بداية الكورس لنهايته ',
                'name_en' => 'Complete follow-up of the student from the beginning of the course to its end',
                'image' => '1717838790_2.png',
            ],

            [
                'name_ar' => ' خطة دراسية خاصة لكل طالب بناء علي هدفه ',
                'name_en' => 'A special study plan for each student based on his goal',
                'image' => '1717838799_3.png',
            ],

        ];

        foreach ($DataSecureSettings as $setting) {
            Why::create($setting);
        }
    }
}
