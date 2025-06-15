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
        Schema::create('matricula', function (Blueprint $table) {
            $table->id('codigo');
            $table->bigInteger('alumno')->unsigned();
            $table->foreign('alumno')->references('codigo')->on('alumno');
            $table->bigInteger('grado')->unsigned();
            $table->foreign('grado')->references('codigo')->on('grado');
            $table->bigInteger('materia')->unsigned();
            $table->foreign('materia')->references('codigo')->on('materia');
            $table->year('año_matricula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matricula');
    }
};
