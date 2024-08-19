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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('order')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->timestamps();
        });

        DB::table('offers')->insert([
            [
                'id'=>1,
                'image'=>'1717476853_1716794540_2.png',
                'start' => '2024-05-20',
                'end' => '2030-05-20',
                'order'=>3,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>2,
                'image'=>'1717476880_3.png',
                'start' => '2024-05-20',
                'end' => '2030-05-20',
                'order'=>2,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>3,
                'image'=>'1717476841_1716794524_1.png',
                'start' => '2024-05-20',
                'end' => '2030-05-20',
                'order'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
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
        Schema::dropIfExists('offers');
    }
};
