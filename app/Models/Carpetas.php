<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carpetas extends Model
{
    protected $fillable = ['nombre', 'parent_id'];
    protected $table = 'carpetas';

    public function hijos()
    {
        return $this->hasMany(Carpetas::class, 'parent_id');
    }

    public function padre()
    {
        return $this->belongsTo(Carpetas::class, 'parent_id');
    }
}