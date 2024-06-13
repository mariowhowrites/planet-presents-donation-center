<?php

namespace Database\Factories;

use App\Models\Charity;
use App\Models\Tier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charity>
 */
class CharityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'donation_url' => $this->faker->url(),
            'charity_url' => $this->faker->url(),
            'preview_image' => $this->faker->imageUrl(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Charity $charity) {
            Tier::factory()->count(3)->create([
                'charity_id' => $charity->id,
            ]);
        });
    }
}
