<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $table = 'trabajadores';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombres', 'apellidos', 'dpi', 'fecha_nacimiento', 'estado_civil', 'residencia', 'telefono', 'email', 'cargo', 'inicio', 'terminacion', 'salario', 'contrato', 'jefe', 'cuenta_bancaria', 'No_IGSS',
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}