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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('lat');
            $table->text('lng');
            $table->integer('order')->nullable();

            $table->string('url');


            $table->unsignedBigInteger('county_id');
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('cascade');

            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });


   DB::statement("

INSERT INTO `cities` (`id`, `name_ar`, `name_en`, `lat`, `lng`, `order`,`county_id`,`image`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'ليفربول', 'Liverpool', '53.4083714', '-2.9915726', 1,1,'1717568127_1.png', 'lyfrbol-6660027f3956f', '2024-06-05 03:15:27', '2024-06-05 03:15:27'),
(2, 'بورنموث', 'Bournemouth', '50.7220101', '-1.8667169', 3,1,'1717568269_2.png', 'bornmoth-6660030d8e249', '2024-06-05 03:17:49', '2024-06-05 03:17:49'),
(3, 'مانشستر', 'Manchester', '53.4807593', '-2.2426305', 2,1, '1717568333_manchester-town-hall.jpg', 'manshstr-6660034de0ea8', '2024-06-05 03:18:53', '2024-06-05 03:18:53');

   ");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
