<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            AgencySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TripTypeSeeder::class,
            DriverSeeder::class,
            StateSeeder::class,
            BrandSeeder::class,
            VehicleModelSeeder::class,
            VehicleSeeder::class,
            BookingStatusSeeder::class,
            BookingSeeder::class,
            ControlPaperSeeder::class,
            DamageTypeSeeder::class,
            PartSeeder::class,
            DamageSeeder::class,
            //CapacitySeeder::class,
            //CanSeeder::class,
        ]);
    }
}
