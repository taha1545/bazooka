<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_customer' => Customer::factory(),
            'id_driver' => Driver::factory(),
             //
            'is_cook' => $this->faker->boolean(),
            'is_finish' => $this->faker->boolean(),
            //
            'location_lat'=>"124345.3",
            'location_long'=>"12345.3",
        ];
    }
}
