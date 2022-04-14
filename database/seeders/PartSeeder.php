<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Part::create([
           'name' => 'front_left_wing',
        ]);

        Part::create([
           'name' => 'back_left_wing',
        ]);

        Part::create([
           'name' => 'front_right_wing',
        ]);

        Part::create([
           'name' => 'back_right_wing',
        ]);

        Part::create([
           'name' => 'grille',
        ]);

        Part::create([
           'name' => 'front_left_headlight',
        ]);

        Part::create([
           'name' => 'front_right_headlight',
        ]);

        Part::create([
           'name' => 'driver_seat',
        ]);

        Part::create([
           'name' => 'passenger_seat',
        ]);

        Part::create([
           'name' => 'dashboard',
        ]);

        Part::create([
           'name' => 'left_front_door',
        ]);

        Part::create([
           'name' => 'right_front_door',
        ]);

        Part::create([
           'name' => 'left_back_door',
        ]);

        Part::create([
           'name' => 'right_back_door',
        ]);
    }
}
