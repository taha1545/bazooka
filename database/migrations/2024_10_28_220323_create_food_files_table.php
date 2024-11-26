<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('food_files', function (Blueprint $table) {
            $table->id();
            
            // Foreign key linking to the `food` table
            $table->foreignId('food_id')
                ->constrained('food')
                ->onDelete('cascade');
    
            // File information
            $table->string('path')->unique();  // Path to the file
            $table->string('name');             // Original name of the file
            $table->string('type');             // MIME type or extension
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('food_files');
    }
};
