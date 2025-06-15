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
        
        Schema::create('encargado', function (Blueprint $table) {
            $table->id('codigo');
            $table->string('dui', 13);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('correo', 100);
            $table->string('parentesco', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encargado');
    }
};
