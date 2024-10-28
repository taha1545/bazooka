<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {

        Schema::create('food', function (Blueprint $table) {
            //
            $table->id()->primary();
            //information
            $table->string('name');
            $table->string('type');
            $table->longText('description');
            // important
            $table->float("price");
            $table->string("evrg_time");            
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
