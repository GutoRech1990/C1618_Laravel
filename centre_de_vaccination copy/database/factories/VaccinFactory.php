<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccin>
 */
class VaccinFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'fabricant' => $this->faker->company(),
            'price' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}