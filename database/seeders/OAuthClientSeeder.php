<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->truncate();
        $this->oauthClientCreate();
    }

    public function oauthClientCreate()
    {
        $oauthClients = [
            [
                'name' => 'Laravel Personal Access Client',
                'secret' => 'V5CyHXBU8QyVfLcZ8FXsrWwOFBh1VDqSWvfCxIbm',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => '1',
                'password_client' => '0',
                'revoked' => '0',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Laravel Password Grant Client',
                'secret' => 'RjoSYkYmRdT7zGRUBVrJrmc3FrHTaUmJAfkeC0bA',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => '0',
                'password_client' => '1',
                'revoked' => '0',
                'created_at' => Carbon::now()
            ]
        ];
        DB::table('oauth_clients')->insert($oauthClients);
    }
}
