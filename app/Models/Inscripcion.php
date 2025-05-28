<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = ['id_alumno', 'id_nivel', 'id_curso', 'id_profesor', 'id_sucursal', 'fecha_inscripcion'];

    protected $primaryKey = 'id_inscripcion';

    public function alumno()
    {
        return $this->belongsTo(\App\Models\Alumno::class, 'id_alumno', 'id_alumno');
    }
    public function nivel()
    {
        return $this->belongsTo(\App\Models\Nivel::class, 'id_nivel');
    }
    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'id_curso', 'id_curso');
    }
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_profesor');
    }
    public function notas()
    {
        return $this->hasMany(Nota::class, 'id_inscripcion');
    }
    public function sucursal()
    {
        return $this->belongsTo(\App\Models\Sucursal::class, 'id_sucursal');
    }
}
