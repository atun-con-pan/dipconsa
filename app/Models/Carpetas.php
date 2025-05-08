<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carpetas extends Model
{
    protected $fillable = ['nombre', 'parent_id'];

    // Relación para subcarpetas
    public function subcarpetas()
    {
        return $this->hasMany(Carpetas::class, 'parent_id');
    }

    // Relación inversa para la carpeta padre
    public function parent()
    {
        return $this->belongsTo(Carpetas::class, 'parent_id');
    }
}
