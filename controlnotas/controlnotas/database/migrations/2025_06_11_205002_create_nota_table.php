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
        Schema::create('nota', function (Blueprint $table) {
            $table->id('codigo');
            $table->bigInteger('trimestre')->unsigned();
            $table->foreign('trimestre')->references('codigo')->on('trimestre');
            $table->bigInteger('matricula')->unsigned();
            $table->foreign('matricula')->references('codigo')->on('matricula');
            $table->integer('actividad1');
            $table->integer('actividad2');
            $table->integer('actividad3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};
