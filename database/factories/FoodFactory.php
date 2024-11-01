<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->lastName(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(1,200),
            'evrg_time' =>  $this->faker->numberBetween(15,300),
        ];
    }
}
