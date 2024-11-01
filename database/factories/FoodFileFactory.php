<?php

namespace Database\Factories;

use App\Models\food_file;
use App\Models\food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\food_file>
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
            'food_id' => food::factory(),
            'path'=>$this->faker->imageUrl(),
            'type'=>$this->faker->name(),
        ];
    }
}
