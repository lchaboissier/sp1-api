<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\Booking;
use App\Models\Company;
use App\Models\Driver;
use App\Models\TripType;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //  $date = $this->faker->dateTimeBetween('-10 years', Carbon::now()->addYears(1))->format('Y-m-d');
        $date = $this->faker->dateTimeBetween('-1 day', '1 week')->format('Y-m-d');
        $active = false;
        if($date>Carbon::now()) {
            $active = true;
        }

        $companyId = $this->faker->numberBetween(1, Company::count());

        $agencyId = $this->faker->numberBetween(1, Agency::count());

        $drivers = Driver::all()->where('company_id', '=', $companyId);

        $driverIds = [];

        $tripId = $this->faker->numberBetween(1, TripType::count());

        if ($tripId == 2){
            $agencyArrivedId = $agencyId;
        }
        else {
            $test = $this->faker->numberBetween(1, Agency::count());
            while ($test == $agencyId){
                $test = $this->faker->numberBetween(1, Agency::count());
            }
            $agencyArrivedId = $test;
        }

        foreach($drivers as $driver)
        {
            $driverIds[] = $driver->id;
        }

        return [
            'driver_id' => $this->faker->randomElement($driverIds),
            'vehicle_id' => $this->faker->numberBetween(1, Vehicle::count()),
            'dateTime' => $date,
            'halfDay' => $this->faker->numberBetween(1,2),
            'active' => $active,
            'booking_status_id' => $active ? 2 : 4,
            'trip_type_id' => $tripId,
            'company_id' => $companyId,
            'agency_id' => $agencyId,
            'agencyArrived_id' => $agencyArrivedId,
        ];
    }
}
