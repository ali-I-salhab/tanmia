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
        Schema::create('benifite_plan', function (Blueprint $table) {
            // Use the exact same column type as your plans table
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('benifite_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('plan_id')
                  ->references('id')
                  ->on('plans')
                  ->onDelete('cascade');

            $table->foreign('benifite_id')
                  ->references('id')
                  ->on('benifites')
                  ->onDelete('cascade');

            // Composite primary key
            // $table->primary(['plan_id', 'benifite_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benifite_plan');
    }
};
