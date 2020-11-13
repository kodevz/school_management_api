<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\StaffMaster;
use App\Models\StudentMaster;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('user_roles')->truncate();
        DB::table('users')->truncate();
        DB::table('staff_master')->truncate();
        DB::table('student_master')->truncate();
        $this->createUsers();
    }

    private function createUsers()
    {
        $password = Hash::make('password'); // Default user password

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@stps.com',
            'username' => 'super_admin',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(1);
        $user->roles()->save($role);


        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@stps.com',
            'username' => 'admin',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(2);
        $user->roles()->save($role);

        $user = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@stps.com',
            'username' => 'teacher1',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(3);
        $user->roles()->save($role);

        $staff = new StaffMaster();
        $staff->code = date('Y/m/d') . '/' . $user->id;
        $staff->emp_date = '2016-10-10';
        $staff->user_id = $user->id;
        $staff->save();


        $user = User::create([
            'name' => 'Parent',
            'email' => 'parent@stps.com',
            'username' => 'parent1',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(4);
        $user->roles()->save($role);

        $user = User::create([
            'name' => 'Ravi',
            'email' => 'ravi@stps.com',
            'username' => 'ravi0001',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(5);
        $user->roles()->save($role);

        $studentMaster = new StudentMaster();
        $studentMaster->class_id = 9;
        $studentMaster->section_id = 14;
        $studentMaster->admission_no = $user->id;
        $studentMaster->admission_date = '2016-10-01';
        $studentMaster->year_admitted = 2016;
        $studentMaster->session = Str::random(5);
        $studentMaster->age = 10;
        $studentMaster->parent_id = 4;
        $studentMaster->user_id = $user->id;
        $studentMaster->save();
    }
}
