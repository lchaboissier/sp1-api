<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'street' => $this->faker->streetAddress(),
            'postalCode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'mail' => $this->faker->email(),
            'phoneNumber' => $this->faker->phoneNumber(),
            'drivingLicense' => $this->faker->numberBetween(10000, 99999),
            'company_id' => $this->faker->numberBetween(1, Company::count()),
        ];
    }
}
