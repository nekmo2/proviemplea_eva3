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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('telefono')->nullable();

            $table->string('codigo_talento')->unique();

            $table->text('resumen')->nullable();

            $table->enum('nivel_educacional', [
                'basica',
                'media',
                'tecnica',
                'universitaria',
                'postgrado'
            ])->nullable();

            $table->string('titulo_carrera')->nullable();

            $table->integer('anio_egreso')->nullable();

            $table->integer('anios_experiencia')->default(0);

            $table->json('areas_experiencia')->nullable();

            $table->json('competencias')->nullable();

            $table->string('rango_renta')->nullable();

            $table->enum('tipo_jornada', [
                'completa',
                'part-time',
                'por-horas'
            ])->nullable();

            $table->enum('modalidad', [
                'presencial',
                'remoto',
                'hibrido'
            ])->nullable();

            $table->json('cursos')->nullable();

            $table->json('idiomas')->nullable();

            $table->string('portafolio_url')->nullable();

            $table->boolean('persona_discapacidad')->default(false);

            $table->boolean('validado')->default(false);

            $table->boolean('activo')->default(true);

            $table->integer('porcentaje_completitud')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
