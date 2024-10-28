<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {

            $table->id()->primary();
            //link user
            $table->foreignId('id_users')
                ->constrained('users')
                ->onDelete('cascade');
             // detail
            $table->string('name');
            $table->integer('phone');
            //status
            $table->boolean('is_online');
            $table->boolean('is_charge');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
