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
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ClassTypeSeeder::class,
            ExamSeeder::class,
            ClassesSeeder::class,
            SectionSeeder::class,
            SubjectSeeder::class,
            OAuthClientSeeder::class
        ]);
    }
}
