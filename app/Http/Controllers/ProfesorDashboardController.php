<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Profesor;
class ProfesorDashboardController extends Controller
{
    public function index()
    {
        $profesor = Profesor::where('email', Auth::user()->email)->first();
        $cursos = $profesor ? $profesor->cursos : collect();
        $inscripciones = $profesor ? $profesor->inscripciones()->with('alumno')->get() : collect();
        return view('dashboard-profesor', compact('profesor', 'cursos', 'inscripciones'));
    }
} 