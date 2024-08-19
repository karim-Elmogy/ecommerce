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
        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('slug');
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        DB::table('counties')->insert([
            [
                'id'=>1,
                'name_ar' => 'بريطانيا - المملكة المتحدة',
                'name_en' => 'بريطانيا - المملكة المتحدة',
                'slug' => 'sa4145as4ad45 - بريطانيا - المملكة المتحدة',
                'order'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'id'=>2,
                'name_ar' => 'ايطاليا',
                'name_en' => 'ايطاليا',
                'slug' => 'ايطاليا - 464646464987468',
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
        Schema::dropIfExists('counties');
    }
};
