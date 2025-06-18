<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $fillable = ['nombre', 'parent_id', 'path'];
    protected $table = 'carpetas';

    public function hijos()
    {
        return $this->hasMany(Documentos::class, 'parent_id');
    }

    public function padre()
    {
        return $this->belongsTo(Documentos::class, 'parent_id');
    }
}