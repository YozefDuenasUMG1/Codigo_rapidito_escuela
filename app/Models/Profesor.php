<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';

    protected $primaryKey = 'id_profesor';

    protected $fillable = ['nombre', 'email', 'telefono', 'especialidad'];

    public function cursos()
    {
        return $this->hasMany(\App\Models\Curso::class, 'id_profesor', 'id_profesor');
    }

    public function inscripciones()
    {
        return $this->hasManyThrough(
            \App\Models\Inscripcion::class,
            \App\Models\Curso::class,
            'id_profesor', // Foreign key on Curso
            'id_curso',    // Foreign key on Inscripcion
            'id_profesor', // Local key on Profesor
            'id_curso'     // Local key on Curso
        );
    }

    public function sucursal()
    {
        return $this->belongsTo(\App\Models\Sucursal::class, 'id_sucursal');
    }

    public function nivel()
    {
        return $this->belongsTo(\App\Models\Nivel::class, 'id_nivel');
    }
}
