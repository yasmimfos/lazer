<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author' => 'Penelope Douglas',
            'category' => 'dark romance',
            'format' => 'ebook',
            'id' => 1,
            'title' => 'Corrupt'
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
