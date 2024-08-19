<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('whies')->delete();
        DB::table('stories')->delete();
        // \App\Models\User::factory(10)->create();

        $this->call(StorySeeder::class);
        $this->call(WhySeeder::class);
    }
}
