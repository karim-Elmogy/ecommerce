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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('order')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->longText('desc_ar')->nullable();
            $table->longText('desc_en')->nullable();
            $table->timestamps();
        });


        DB::table('sliders')->insert([
            [
                'image'=>'1716794524_1.png',
                'title_ar'=>'',
                'title_en'=>'',
                'desc_ar'=>'',
                'desc_en'=>'',

                'order'=>3,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'image'=>'1716794540_2.png',
                'title_ar'=>'حجوزات الطيران',
                'title_en'=>'حجوزات الطيران',
                'desc_ar'=>'يمكنك حجز تذاكر الطيران عن طريق الإتصال على الرقم الموحد',
                'desc_en'=>'يمكنك حجز تذاكر الطيران عن طريق الإتصال على الرقم الموحد',
                'order'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'image'=>'1716794557_3.png',
                'title_ar'=>'وجهاتنا',
                'title_en'=>'وجهاتنا',
                'desc_ar'=>'استكشف أجمل الوجهات معنا لتحضى بأفضل الأوقات',
                'desc_en'=>'استكشف أجمل الوجهات معنا لتحضى بأفضل الأوقات',
                'order'=>2,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
