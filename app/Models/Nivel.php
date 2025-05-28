<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    protected $table = 'niveles';

    protected $fillable = ['nombre', 'id_grado'];

    protected $primaryKey = 'id_nivel';

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_nivel');
    }
}
