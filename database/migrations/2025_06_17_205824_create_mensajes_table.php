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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->string('recibido_por');
            $table->string('entregado_por');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('tipo', ['Recibido', 'Entregado']);
            $table->string('nombre_documento');
            $table->string('documento'); // puede ser nombre o path
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
