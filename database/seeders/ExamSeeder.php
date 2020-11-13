<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->truncate();
        $this->createExams();
    }

    public function createExams()
    {
        $exams = [
            [
                'name' => 'Half Yearly',
                'term' => '1',
                'year' => '2019-2020',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Yearly',
                'term' => '1',
                'year' => '2020',
                'created_at' => Carbon::now()
            ]
        ];
        DB::table('exams')->insert($exams);
    }
}
