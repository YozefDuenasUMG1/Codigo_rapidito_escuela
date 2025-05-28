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
}
