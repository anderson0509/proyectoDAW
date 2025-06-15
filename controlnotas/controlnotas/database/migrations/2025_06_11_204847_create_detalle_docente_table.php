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
        Schema::create('detalle_docente', function (Blueprint $table) {
            $table->id('codigo');
            $table->bigInteger('docente')->unsigned();
            $table->foreign('docente')->references('codigo')->on('docente');
            $table->bigInteger('grado')->unsigned();
            $table->foreign('grado')->references('codigo')->on('grado');
            $table->bigInteger('materia')->unsigned();
            $table->foreign('materia')->references('codigo')->on('materia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_docente');
    }
};
