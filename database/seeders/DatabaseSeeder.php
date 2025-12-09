<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(9)->create();
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@cringe.com',
        ]);

        Category::factory(5)->create();
        Movie::factory(50)->create();
        Review::factory(150)->create();
    }
}
