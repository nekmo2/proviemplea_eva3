<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'email',
        'telefono',
        'codigo_talento',
        'resumen',
        'nivel_educacional',
        'titulo_carrera',
        'anio_egreso',
        'anios_experiencia',
        'areas_experiencia',
        'competencias',
        'rango_renta',
        'tipo_jornada',
        'modalidad',
        'cursos',
        'idiomas',
        'portafolio_url',
        'persona_discapacidad',
        'validado',
        'activo',
        'porcentaje_completitud',
    ];

    /**
     * Relación: una persona puede tener muchos contactos solicitados
     */
    public function contactosSolicitados()
    {
        return $this->hasMany(ContactoSolicitado::class);
    }
}
