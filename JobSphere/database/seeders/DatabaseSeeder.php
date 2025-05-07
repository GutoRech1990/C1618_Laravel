<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\JobListing;
use App\Models\Tag;
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
        Tag::factory(15)->create();

        Employer::factory(10)->has(
            JobListing::factory()->count(fake()->numberBetween(2, 5)),
            "joblisting"
        )->create();

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}