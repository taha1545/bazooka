<?php

namespace Database\Factories;

use App\Models\User;
use APP\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
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
            'phone' => $this->faker->numberBetween(2345678,345678),
            'is_banned' => $this->faker->boolean(),
            'bonus' => $this->faker->numberBetween(0, 100),
        ];
    }
}
