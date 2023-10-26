<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        
        return [
            'title' => $title,
            'body' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'version' => $this->faker->numberBetween(1, 5),
            'slug' => Str::slug($title),
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory(), // Create a User instance
        ];
    }
}
