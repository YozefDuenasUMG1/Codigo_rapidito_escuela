<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];
    protected $primaryKey = 'id_curso';

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_curso');
    }

    public function profesor()
    {
        return $this->belongsTo(\App\Models\Profesor::class, 'id_profesor', 'id_profesor');
    }

    public function nivel()
    {
        return $this->belongsTo(\App\Models\Nivel::class, 'id_nivel', 'id_nivel');
    }
}
