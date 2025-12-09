<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();

        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => $this->faker->unique()->words(3, true) . ' ' . $this->faker->year(),
            'release_year' => $this->faker->numberBetween(1980, 2020),
            'poster_url' => 'https://via.placeholder.com/640x480.png?text=' . urlencode($this->faker->word()),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
