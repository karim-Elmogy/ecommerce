<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();
            $table->string('slug');
            $table->string('order')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });



        DB::table('categories')->insert([
            [
                'name_ar' => 'البرامج الصيفية',
                'name_en' => 'البرامج الصيفية',
                'desc_ar'=>' يتيح لك المسافر حجز فنادق بأفضل الأسعار ويوفر لك أماكن إقامة متنوعة ما بين الرخيصة إلى الفاخرة والتي تلبي جميع احتياجاتك. قارن بين الأسعار واختر من بين أكثر من مليون فندق حول العالم. ',
                'desc_en'=>' يتيح لك المسافر حجز فنادق بأفضل الأسعار ويوفر لك أماكن إقامة متنوعة ما بين الرخيصة إلى الفاخرة والتي تلبي جميع احتياجاتك. قارن بين الأسعار واختر من بين أكثر من مليون فندق حول العالم. ',
                'slug' => '65a378979795a2-البرامج الصيفية',
                'image' => '1717562620_1.png',
                'order'=>1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'القبولات الجامعية',
                'name_en' => 'القبولات الجامعية',
                'desc_ar'=>' يتيح لك المسافر حجز فنادق بأفضل الأسعار ويوفر لك أماكن إقامة متنوعة ما بين الرخيصة إلى الفاخرة والتي تلبي جميع احتياجاتك. قارن بين الأسعار واختر من بين أكثر من مليون فندق حول العالم. ',
                'desc_en'=>' يتيح لك المسافر حجز فنادق بأفضل الأسعار ويوفر لك أماكن إقامة متنوعة ما بين الرخيصة إلى الفاخرة والتي تلبي جميع احتياجاتك. قارن بين الأسعار واختر من بين أكثر من مليون فندق حول العالم. ',
                'slug' => '65a3a456546465a2-القبولات الجامعية',
                'image' => '1717562634_2.png',
                'order'=>2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_ar' => 'اللغة الانجليزية',
                'name_en' => 'اللغة الانجليزية',
                'dasc_ar'=>' يتيح لك المسافر حجز فنادق بأفضل الأسعار ويوفر لك أماكن إقامة متنوعة ما بين الرخيصة إلى الفاخرة والتي تلبي جميع احتياجاتك. قارن بين الأسعار واختر من بين أكثر من مليون فندق حول العالم. ',
                'dasc_en'=>' يتيح لك المسافر حجز فنادق بأفضل الأسعار ويوفر لك أماكن إقامة متنوعة ما بين الرخيصة إلى الفاخرة والتي تلبي جميع احتياجاتك. قارن بين الأسعار واختر من بين أكثر من مليون فندق حول العالم. ',
                'slug' => '65a3a456546465a2-اللغة الانجليزية',
                'image' => '1717562646_3.png',
                'order'=>3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
