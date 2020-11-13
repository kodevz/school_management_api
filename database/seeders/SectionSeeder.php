<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->truncate();
        $this->createSections();
    }

    public function createSections()
    {
        $sections = [
            [
                'name' => 'A',
                'class_id' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'B',
                'class_id' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'B',
                'class_id' => '2',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '3',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'B',
                'class_id' => '3',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '4',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'B',
                'class_id' => '4',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '5',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '6',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '7',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '8',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '9',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'B',
                'class_id' => '9',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'A',
                'class_id' => '10',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'B',
                'class_id' => '10',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Computer Science',
                'class_id' => '11',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Biology',
                'class_id' => '11',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Commerce',
                'class_id' => '11',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Computer Science',
                'class_id' => '12',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Biology',
                'class_id' => '12',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Commerce',
                'class_id' => '12',
                'created_at' => Carbon::now()
            ],
        ];
        DB::table('sections')->insert($sections);
    }
}
