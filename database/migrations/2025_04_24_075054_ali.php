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
        //
        Schema::create('ali', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Plan name
            $table->string('type_of_support');    // Type of support (Cash, Food, etc.)
            $table->unsignedBigInteger('supporter_id'); // Link to supporter
            $table->timestamps();
        
            $table->foreign('supporter_id')->references('id')->on('supporters')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //ssss
    }
};


// ali salahb