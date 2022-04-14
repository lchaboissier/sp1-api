<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleModel::create([
            'name' => 'Polo',
            'seats' => '5',
            'brand_id' => '2'
        ]);

        VehicleModel::create([
            'name' => 'Golf',
            'seats' => '5',
            'brand_id' => '2'
        ]);

        VehicleModel::create([
            'name' => 'Tiguan',
            'seats' => '5',
            'brand_id' => '2'
        ]);

        VehicleModel::create([
            'name' => 'Mercedes-Benz GLC',
            'seats' => '5',
            'brand_id' => '1'
        ]);

        VehicleModel::create([
            'name' => 'Mercedes-Benz GLE',
            'seats' => '5',
            'brand_id' => '1'
        ]);

        VehicleModel::create([
            'name' => 'Audi A2',
            'seats' => '5',
            'brand_id' => '3'
        ]);

        VehicleModel::create([
            'name' => 'Audi A4',
            'seats' => '5',
            'brand_id' => '3'
        ]);
    }
}
