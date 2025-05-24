<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 50 patients with vaccinations
        \App\Models\Patient::factory(50)
            ->has(\App\Models\Vaccination::factory()->count(fake()->numberBetween(1, 5)))
            ->create();

        // Create 50 vaccines with vaccinations
        \App\Models\Vaccin::factory(50)
            ->has(\App\Models\Vaccination::factory()->count(fake()->numberBetween(1, 10)))
            ->create();
        

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}