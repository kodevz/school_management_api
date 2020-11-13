<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->truncate();
        $this->createSubjects();
    }

    public function createSubjects()
    {
        $subjects = [
            [
                'name' => 'Tamil',
                'slug' => 'Tam',
                'class_id' => '9',
                'teacher_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'English',
                'slug' => 'Eng',
                'class_id' => '9',
                'teacher_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Maths',
                'slug' => 'Mat',
                'class_id' => '9',
                'teacher_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Science',
                'slug' => 'Sci',
                'class_id' => '9',
                'teacher_id' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Social',
                'slug' => 'Soc',
                'class_id' => '9',
                'teacher_id' => 1,
                'created_at' => Carbon::now()
            ],
        ];
        DB::table('subjects')->insert($subjects);
    }
}
