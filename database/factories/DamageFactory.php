<?php

namespace Database\Factories;

use App\Models\ControlPaper;
use App\Models\Damage;
use App\Models\DamageType;
use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

class DamageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Damage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'control_paper_id' => $this->faker->unique()->numberBetween(1, ControlPaper::count()),
            'damage_type_id' => $this->faker->numberBetween(1, DamageType::count()),
            'part_id' => $this->faker->numberBetween(1, Part::count()),
        ];
    }
}
