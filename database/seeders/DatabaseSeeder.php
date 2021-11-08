<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(JobTypeSeeder::class);
        $this->call(PersonalProfileSeeder::class);
        $this->call(JobHistorySeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(SparkSkillSeeder::class);
    }
}
