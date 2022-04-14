<?php

namespace Database\Seeders;

use App\Models\Damage;
use Illuminate\Database\Seeder;

class DamageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Damage::factory(100)->create();
    }
}
