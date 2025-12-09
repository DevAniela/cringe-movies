<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $movie = Movie::inRandomOrder()->first() ?? Movie::factory()->create();

        return [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'cringe_rating' => $this->faker->numberBetween(1, 10),
            'content' => $this->faker->text(200),    
        ];
    }
}
