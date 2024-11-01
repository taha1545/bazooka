<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_users' => User::factory(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->numberBetween(123243,34653),
            'is_online' => $this->faker->boolean(),
            'is_charge' =>  $this->faker->boolean(),
        ];
    }
}
