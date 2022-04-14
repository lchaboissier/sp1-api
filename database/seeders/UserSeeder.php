<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstName' => 'Seven',
            'lastName' => 'Controller',
            'email' => 'seven.controller@seven.fr',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
            'agency_id' => 1,
            'company_id' => null,
        ]);

        User::create([
            'firstName' => 'Seven',
            'lastName' => 'Agent',
            'email' => 'seven.agent@seven.fr',
            'password' => Hash::make('12345678'),
            'role_id' => 2,
            'agency_id' => 1,
            'company_id' => null,
        ]);

        User::create([
            'firstName' => 'Client',
            'lastName' => 'Booker',
            'email' => 'client.booker@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 3,
            'agency_id' => null,
            'company_id' => 1,
        ]);

        User::create([
            'firstName' => 'Client',
            'lastName' => 'Admin',
            'email' => 'client.admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 4,
            'agency_id' => null,
            'company_id' => 1,
        ]);
    }
}
