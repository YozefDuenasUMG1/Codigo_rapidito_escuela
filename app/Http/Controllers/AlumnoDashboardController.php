<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
class AlumnoDashboardController extends Controller
{
    public function index()
    {
        $alumno = Auth::user();
        $inscripciones = $alumno->inscripciones()->with(['curso.nivel', 'curso.profesor', 'nivel', 'profesor'])->get();
        $notas = $alumno->notas()->with(['curso', 'inscripcion'])->get();
        // $cursos = Curso::with(['profesor', 'nivel'])->get();
        return view('dashboard-alumno', compact('alumno', 'inscripciones', 'notas'));
    }
} 