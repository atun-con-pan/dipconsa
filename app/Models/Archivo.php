<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $fillable = ['descripcion', 'archivo', 'nombre_archivo', 'parent_id'];

    public function carpeta()
    {
        return $this->belongsTo(Carpetas::class, 'parent_id');
    }
}
