<?php

namespace Database\Factories;

use App\Models\food_file;
use App\Models\food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodFile>
 */
class FoodFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => Food::factory(),
            'path' => 'uploads/' . $this->faker->uuid . '.jpg', // Generates a unique file path
            'name' => $this->faker->word() . '.jpg',                       // Generates a random file name
            'type' => 'image/jpeg',                                        // Example MIME type
        ];
    }
    
}
