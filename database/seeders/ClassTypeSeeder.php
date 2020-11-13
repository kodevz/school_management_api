<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('class_types')->truncate();
        $this->createClassTypes();
    }

    public function createClassTypes()
    {
        $classTypes = [
            [
                'name' => 'Nursery',
                'code' => 'Nur',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Primary',
                'code' => 'PRI',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Middle',
                'code' => 'MID',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'High',
                'code' => 'HIGH',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Secondary',
                'code' => 'SEC',
                'created_at' => Carbon::now()
            ]
        ];
        DB::table('class_types')->insert($classTypes);
    }
    
}
