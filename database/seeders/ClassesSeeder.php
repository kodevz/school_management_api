<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->truncate();
        $this->createClasses();
    }

    public function createClasses()
    {
        $classes = [
            [
                'name' => '1 st',
                'class_type_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '2 nd',
                'class_type_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '3 rd',
                'class_type_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '4 th',
                'class_type_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '5 th',
                'class_type_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '6 th',
                'class_type_id' => '3',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '7 th',
                'class_type_id' => '3',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '8 th',
                'class_type_id' => '3',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '9 th',
                'class_type_id' => '4',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '10 th',
                'class_type_id' => '4',
                'created_at' => Carbon::now()
            ],
            [
                'name' => '11 th',
                'class_type_id' => '5',
                'created_at' => Carbon::now()
            ],
        ];
        DB::table('classes')->insert($classes);
    }
}
