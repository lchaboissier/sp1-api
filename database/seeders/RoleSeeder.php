<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'seven-controller',
        ]);

        Role::create([
            'name' => 'seven-agent',
        ]);

        Role::create([
            'name' => 'client-booker',
        ]);

        Role::create([
            'name' => 'client-admin',
        ]);
    }
}
