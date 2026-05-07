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
        Schema::create('water_analyses', function (Blueprint $table) {
        $table->id();

        $table->double('ph');
        $table->double('hardness');
        $table->double('solids');
        $table->double('chloramines');
        $table->double('sulfate');
        $table->double('conductivity');
        $table->double('organic_carbon');
        $table->double('trihalomethanes');
        $table->double('turbidity');

        $table->string('result');
        $table->double('probability');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_analyses');
    }
};
