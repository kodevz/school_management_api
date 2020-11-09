<?php

namespace Database\Seeders;

use App\Models\Roles;
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
        $this->createUsers();
    }

    private function createUsers()
    {
        $password = Hash::make('password'); // Default user password

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@stsp.com',
            'username' => 'super_admin',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(1);
        $user->roles()->save($role);


        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@stsp.com',
            'username' => 'admin',
            'password' => $password,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ]);
        $role = Roles::find(2);
        $user->roles()->save($role);
    }
}
