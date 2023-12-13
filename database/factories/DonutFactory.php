<?php

namespace Database\Factories;

use App\Enums\AustralianState;
use App\Enums\Type;
use App\Models\Donut;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Donut>
 */
class DonutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'location' => fake()->company(),
            'state' => AustralianState::VIC,
            'type' => Type::RING,
            'details' => fake()->paragraph(),
            'rating_size' => fake()->numberBetween(1, 5),
            'rating_appearance' => fake()->numberBetween(1, 5),
            'rating_value' => fake()->numberBetween(1, 5),
            'photo_path' => null,
        ];
    }
}
