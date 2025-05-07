<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\JobListing;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'company' => fake()->company(),
            'location' => fake()->city(),
            'employer_id' => Employer::factory()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (JobListing $jobListing) {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $jobListing->tags()->attach($tags);
        });
    }
}