<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['id_inscripcion', 'punteo', 'observacion'];
    protected $primaryKey = 'id_nota';

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion');
    }

    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'id_curso', 'id_curso');
    }
}
