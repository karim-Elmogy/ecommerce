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
        Schema::create('boundaries', function (Blueprint $table) {
            $table->id();
            $table->mediumText('coordinates');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->timestamps();
        });

        DB::statement("
        INSERT INTO `boundaries` (`id`, `coordinates`, `city_id`, `created_at`, `updated_at`) VALUES
(9, '53.39716449563822,-3.011218288535349', 1, '2024-06-05 03:15:55', '2024-06-05 03:15:55'),
(10, '53.394912612793014,-3.0062401086037083', 1, '2024-06-05 03:15:55', '2024-06-05 03:15:55'),
(11, '53.39736920635202,-3.0036651879494114', 1, '2024-06-05 03:15:55', '2024-06-05 03:15:55'),
(12, '50.7308551296877,-1.8942770717173474', 2, '2024-06-05 03:17:49', '2024-06-05 03:17:49'),
(13, '50.71498874337532,-1.8887839076548474', 2, '2024-06-05 03:17:49', '2024-06-05 03:17:49'),
(14, '50.7171625385264,-1.8369421718150036', 2, '2024-06-05 03:17:49', '2024-06-05 03:17:49'),
(15, '50.73498385597908,-1.8547949550181286', 2, '2024-06-05 03:17:49', '2024-06-05 03:17:49'),
(16, '53.4928188684702,-2.267820199660693', 3, '2024-06-05 03:18:53', '2024-06-05 03:18:53'),
(17, '53.47116275808576,-2.2575205170435053', 3, '2024-06-05 03:18:53', '2024-06-05 03:18:53'),
(18, '53.478110261901264,-2.1751230561060053', 3, '2024-06-05 03:18:53', '2024-06-05 03:18:53'),
(19, '53.50098811292615,-2.1833628021997553', 3, '2024-06-05 03:18:53', '2024-06-05 03:18:53');

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boundaries');
    }
};
