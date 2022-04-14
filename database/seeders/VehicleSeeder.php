<?php

namespace Database\Seeders;

use App\Models\ControlPaper;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::factory(100)->create()->each(function ($vehicle) {
            $controlPaper = ControlPaper::factory()->make();
            $vehicle->controlPaper()->save($controlPaper);
        });
    }
}
