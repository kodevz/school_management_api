<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $this->createRoles();
    }

    private function createRoles()
    {
        $roles = [

            [
                'name' => 'Super Admin',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Admin',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Teacher',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Parent',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Student',
                'created_at' => Carbon::now()
            ]
        ];
        DB::table('roles')->insert($roles);
    }
}
