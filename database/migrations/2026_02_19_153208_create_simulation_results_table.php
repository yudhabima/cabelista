<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('simulation_results', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('absen');
        $table->integer('score');
        $table->integer('status_t568a')->default(0);
        $table->integer('status_t568b')->default(0);
        $table->string('time_used', 50); // dalam detik
        $table->integer('cable_used');
        $table->integer('rj45_used');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulation_results');
    }
};
