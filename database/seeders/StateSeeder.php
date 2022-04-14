<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create([
            'name' => 'to_prepare',
        ]);

        State::create([
            'name' => 'ready',
        ]);

        State::create([
            'name' => 'controlled_on_withdrawal',
        ]);

        State::create([
            'name' => 'controlled_on_return',
        ]);
    }
}
