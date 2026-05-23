<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre_empresa',
        'rut_empresa',
        'email',
        'logo_url',
        'rubro',
        'tipo_empresa',
        'presentacion',
        'beneficios',
        'contacto_nombre',
        'contacto_email',
        'contacto_telefono',
        'validado',
        'activo',
    ];

    /**
     * Relación: una empresa puede tener muchos contactos solicitados
     */
    public function contactosSolicitados()
    {
        return $this->hasMany(ContactoSolicitado::class);
    }
}
