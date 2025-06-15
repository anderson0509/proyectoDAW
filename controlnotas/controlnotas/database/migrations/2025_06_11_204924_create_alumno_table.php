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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id('codigo');
            $table->bigInteger('encargado')->unsigned();
            $table->foreign('encargado')->references('codigo')->on('encargado');
            $table->integer('nie');
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('correo', 50);
            $table->date('fecha_nacimiento');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
