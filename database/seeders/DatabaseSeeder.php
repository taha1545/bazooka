<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Food;
use App\Models\FoodFile;
use App\Models\Order;
use App\Models\OrderFood;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //user 300
        $users = User::factory(300)->create();
         //50 driver
         $driverUsers = $users->take(50); 
         $drivers = Driver::factory(50)->create([
            'id_users' => function () use ($driverUsers) {
                return $driverUsers->random()->id;
            },
        ]);
         //250 customer
         $customerUsers = $users->skip(50)->take(250); 
         $customers = Customer::factory(250)->create([
            'id_users' => function () use ($customerUsers) {
                return $customerUsers->random()->id;
            },
        ]);
          //food 20
          $foods = Food::factory(20)->create();
         //food file 40
         FoodFile::factory(20)->create([
            'food_id' => $foods->random()->id,
        ]);
         //oder 50
         $orders = Order::factory(50)->create();

        // order-food n:n
         $orders->each(function ($order) use ($foods) {
          $order->foods()->attach($foods->random(rand(1, 5))->pluck('id')->toArray());
                });
       
    }
}
