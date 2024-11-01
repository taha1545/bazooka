<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_files', function (Blueprint $table) {
            //
            $table->id();
            //link food
            $table->foreignId('food_id')
                ->constrained('food')
                ->onDelete('cascade');

             //information
           $table->string(column: 'path')->unique();
           $table->string(column: 'type');
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('food_files');
    }
};
