<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\VehicleModel;
use App\Models\State;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'matriculation' => strtoupper($this->faker->bothify('??')).$this->faker->bothify('-###-').strtoupper($this->faker->bothify('??')),
            'agency_id' => $this->faker->numberBetween(1, Agency::count()),
            'state_id' => $this->faker->numberBetween(1, State::count()),
            'vehicle_model_id' => $this->faker->numberBetween(1, VehicleModel::count()),
        ];
    }
}
