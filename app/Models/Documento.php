<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = ['trabajador_id', 'nombre', 'archivo'];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }
}