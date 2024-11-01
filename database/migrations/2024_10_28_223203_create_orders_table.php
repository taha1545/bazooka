<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id()->primary();
            //link customer
            $table->foreignId('id_customer')
                ->constrained('customers');
            //link driver
            $table->foreignId('id_driver')
               ->constrained('drivers');
             //status
            $table->boolean('is_cook');
            $table->boolean('is_finish');
            //location
            $table->string("location_lat");
            $table->string("location_long");
            //time
            $table->timestamps();
        });


        Schema::create('order_food', function (Blueprint $table) {

            $table->id();
            //link food
            $table->foreignId('food_id')
                ->constrained('food');
            //link order
            $table->foreignId('order_id')
               ->constrained('orders');
             //number of each food
            $table->integer("number")->default(1);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_food');
    }
};
