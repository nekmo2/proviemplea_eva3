<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Empresa;
use App\Models\Persona;

class ContactoSolicitado extends Model
{
    protected $table = 'contactos_solicitados';

    protected $fillable = [
        'empresa_id',
        'persona_id',
        'estado',
        'notas_admin',
        'fecha_contacto',
        'fecha_entrevista',
        'fecha_resultado',
    ];

    /**
     * Relación: un contacto pertenece a una empresa
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * Relación: un contacto pertenece a una persona
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
