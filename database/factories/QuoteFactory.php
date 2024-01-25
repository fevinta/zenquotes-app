<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'author_id' => Author::factory(),
            'quote'     => fake()->sentence(random_int(5, 10))
        ];
    }
}
