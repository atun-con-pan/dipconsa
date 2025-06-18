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
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('dpi');
            $table->string('fecha_nacimiento');
            $table->string('estado_civil');
            $table->string('residencia');
            $table->string('telefono');
            $table->string('email');
            $table->string('cargo');
            $table->string('inicio');
            $table->string('terminacion');
            $table->string('salario');
            $table->string('contrato');
            $table->string('jefe');
            $table->string('cuenta_bancaria');
            $table->string('No_IGSS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};