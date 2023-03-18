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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('posicion')->nullable();
            $table->integer('tipo');
            $table->string('representante');
            $table->string('organizacion');
            $table->string('telefono');
            $table->string('tematica');
            $table->string('numero_participantes')->nullable();
            $table->string('musica')->nullable();
            $table->string('duracion')->nullable();
            $table->string('descripcion');
            $table->foreignId('encuesta_id')->constrained('encuestas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
