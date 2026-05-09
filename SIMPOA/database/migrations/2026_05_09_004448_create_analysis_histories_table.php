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
        Schema::create('analysis_histories', function (Blueprint $table) {

            $table->id();

            // =========================
            // PARAMETER AIR
            // =========================
            $table->float('ph');

            $table->float('hardness');

            $table->float('solids');

            $table->float('chloramines');

            $table->float('sulfate');

            $table->float('conductivity');

            $table->float('organic_carbon');

            $table->float('trihalomethanes');

            $table->float('turbidity');

            // =========================
            // HASIL AI
            // =========================
            $table->string('result');

            $table->float('probability');

            $table->string('confidence');

            // =========================
            // TIMESTAMP
            // =========================
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysis_histories');
    }
};