<?php

namespace Database\Seeders;

use App\Models\Dashboard\Story;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `stories` (`id`, `image`, `name_ar`, `name_en`, `title_ar`, `title_en`, `desc_ar`, `desc_en`, `order`, `created_at`, `updated_at`) VALUES
            (1, '1722001468_1.png', 'نارين احمد الحربي', 'نارين احمد الحربي', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 1, '2024-07-26 10:44:28', '2024-07-26 10:55:42'),
            (2, '1722001525_2.png', 'نارين احمد الحربي', 'نارين احمد الحربي', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 2, '2024-07-26 10:45:25', '2024-07-26 10:55:42'),
            (3, '1722001549_3.png', 'نارين احمد الحربي', 'نارين احمد الحربي', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 'نيويورك-امريكا-معهدبراد', 3, '2024-07-26 10:45:49', '2024-07-26 10:55:42');

        ");
    }
}
