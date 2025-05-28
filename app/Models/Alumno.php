<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'numero', 'direccion', 'id_sucursal', 'id_nivel', 'id_curso'];
    protected $primaryKey = 'id_alumno';

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_alumno');
    }

    public function nivel()
    {
        return $this->belongsTo(\App\Models\Nivel::class, 'id_nivel');
    }

    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'id_curso');
    }
}
