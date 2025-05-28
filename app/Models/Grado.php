<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];
    protected $primaryKey = 'id_grado';

    public function niveles()
    {
        return $this->hasMany(Nivel::class, 'id_grado');
    }
}
