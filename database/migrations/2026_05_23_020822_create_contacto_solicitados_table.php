<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contactos_solicitados', function (Blueprint $table) {
            $table->id();

            $table->foreignId('empresa_id')->constrained('empresas');
            $table->foreignId('persona_id')->constrained('personas');

            $table->enum('estado', [
                'pendiente',
                'contactado',
                'entrevista',
                'seleccionado',
                'no-seleccionado',
                'proceso-cerrado'
            ])->default('pendiente');

            $table->text('notas_admin')->nullable();

            $table->timestamp('fecha_contacto')->nullable();
            $table->timestamp('fecha_entrevista')->nullable();
            $table->timestamp('fecha_resultado')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contactos_solicitados');
    }
};
