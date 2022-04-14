<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookingStatus::create([
            'name' => 'not completed'
        ]);
        BookingStatus::create([
            'name' => 'awaiting'
        ]);

        BookingStatus::create([
            'name' => 'ongoing'
        ]);

        BookingStatus::create([
            'name' => 'completed'
        ]);
    }
}
