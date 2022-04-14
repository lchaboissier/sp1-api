<?php

namespace Database\Factories;

use App\Models\ControlPaper;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ControlPaperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ControlPaper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->numberBetween(1,2),
            'kilometers' => $this->faker->numberBetween(10000,350000),
            'dateTime' => $this->faker->dateTime(),
            'observations' => $this->faker->text(150),
            'vehicle_id' => $this->faker->numberBetween(1, Vehicle::count()),
            'signed' => $this->faker->boolean(),
        ];
    }
}
