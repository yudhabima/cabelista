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
    Schema::create('material_quizzes', function (Blueprint $table) {
        $table->id();

        $table->foreignId('material_id')
              ->constrained('materials')
              ->onDelete('cascade');

        $table->string('question');
        $table->string('A');
        $table->string('B');
        $table->string('C');
        $table->string('D');
        $table->string('answer');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_quizzes');
    }
};
