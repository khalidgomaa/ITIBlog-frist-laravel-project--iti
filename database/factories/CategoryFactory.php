<?php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // Generate a random word as the category name
            'user_id' => \App\Models\User::factory(), // If categories have a user_id association, create a User instance.
            'logo' => $this->faker->imageUrl(), // If categories have a logo field, generate a random image URL.
        ];
    }
}
