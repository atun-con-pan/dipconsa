<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'recibido_por',
        'entregado_por',
        'fecha',
        'hora',
        'tipo',
        'nombre_documento',
        'documento'
    ];
}
