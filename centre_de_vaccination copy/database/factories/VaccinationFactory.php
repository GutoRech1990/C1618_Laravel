<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccination>
 */
class VaccinationFactory extends Factory
{
    public function definition()
    {
        return [
            'vaccin_id' => \App\Models\Vaccin::factory(),
            'patient_id' => \App\Models\Patient::factory(),
            'vaccination_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}