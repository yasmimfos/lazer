<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movies>
 */
class MoviesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => 'comédia',
            'watch_on' => 'disney+',
            'id' => 1,
            'title' => '10 coisas que eu odeio em você'
        ];
    }
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'updated_at' => null,
            'created_at' => null,
        ]);
    }
}
