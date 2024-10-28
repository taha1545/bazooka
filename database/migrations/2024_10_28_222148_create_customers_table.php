<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id()->primary();
            //link user
            $table->foreignId('id_users')
                ->constrained('users')
                ->onDelete('cascade');
             // detail
            $table->string('name');
            $table->integer('phone');
            //event
            $table->boolean('is_banned');
            $table->integer('bonus');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
