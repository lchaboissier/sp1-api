<?php

namespace Database\Seeders;

use App\Models\DamageType;
use Illuminate\Database\Seeder;

class DamageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DamageType::create([
            'type' => 'RS',
        ]);

        DamageType::create([
            'type' => 'RP',
        ]);

        DamageType::create([
            'type' => 'EC',
        ]);
    }
}
