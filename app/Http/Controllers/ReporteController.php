<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumnosRegistroExport;
use App\Exports\AlumnosPorGradoExport;
use App\Exports\IngresoPunteosExport;

class ReporteController extends Controller
{
    // Reporte de alumnos por grado y nivel (filtros dinámicos)
    public function alumnosPorGrado(Request $request)
    {
        $id_grado = $request->input('id_grado');
        $id_nivel = $request->input('id_nivel');

        $grados = Grado::all();
        $niveles = Nivel::when($id_grado, function($query) use ($id_grado) {
            return $query->where('id_grado', $id_grado);
        })->get();

        $alumnos = collect();
        $grado = null;
        $nivel = null;

        // Si no se selecciona grado, mostrar todos los alumnos de todos los grados
        if (!$id_grado) {
            $alumnos = \App\Models\Alumno::with(['nivel.grado', 'sucursal'])->paginate(10);
        } else {
            $grado = Grado::find($id_grado);
            $alumnos = \App\Models\Alumno::whereHas('nivel', function($query) use ($id_grado, $id_nivel) {
                $query->where('id_grado', $id_grado);
                if ($id_nivel) {
                    $query->where('id_nivel', $id_nivel);
                }
            })->with(['nivel.grado', 'sucursal'])->paginate(10);
            if ($id_nivel) {
                $nivel = Nivel::find($id_nivel);
            }
        }

        return view('reportes.alumnos_por_grado', compact('alumnos', 'grado', 'nivel', 'grados', 'niveles', 'id_grado', 'id_nivel'));
    }

    // Reporte tipo registro de ingreso de alumnos
    public function ingresoAlumnosRegistro(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        $query = \App\Models\Alumno::query();

        if ($fecha_inicio && $fecha_fin) {
            $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);
        } elseif ($fecha_inicio) {
            $query->whereDate('created_at', '>=', $fecha_inicio);
        } elseif ($fecha_fin) {
            $query->whereDate('created_at', '<=', $fecha_fin);
        }

        $alumnos = $query->with(['sucursal', 'nivel', 'curso'])->orderBy('created_at', 'desc')->paginate(10);

        return view('reportes.ingreso_alumnos_registro', compact('alumnos', 'fecha_inicio', 'fecha_fin'));
    }

    // Exportar a Excel el registro de ingreso de alumnos
    public function exportarIngresoAlumnosRegistro(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        return Excel::download(new AlumnosRegistroExport($fecha_inicio, $fecha_fin), 'ingreso_alumnos_registro.xlsx');
    }

    // Exportar a Excel el reporte de alumnos por grado
    public function exportarAlumnosPorGrado(Request $request)
    {
        $id_grado = $request->input('id_grado');
        $id_nivel = $request->input('id_nivel');
        return \Maatwebsite\Excel\Facades\Excel::download(new AlumnosPorGradoExport($id_grado, $id_nivel), 'alumnos_por_grado.xlsx');
    }

    // Reporte de ingreso de punteos (vista)
    public function ingresoPunteos(Request $request)
    {
        $filtros = [
            'id_curso' => $request->input('id_curso'),
            'id_nivel' => $request->input('id_nivel'),
            'id_sucursal' => $request->input('id_sucursal'),
        ];
        // Aquí podrías cargar catálogos para los filtros si lo deseas
        $notas = \App\Models\Nota::with(['inscripcion.alumno', 'inscripcion.curso', 'inscripcion.nivel', 'inscripcion.sucursal'])
            ->when($filtros['id_curso'], fn($q) => $q->whereHas('inscripcion', fn($q2) => $q2->where('id_curso', $filtros['id_curso'])))
            ->when($filtros['id_nivel'], fn($q) => $q->whereHas('inscripcion', fn($q2) => $q2->where('id_nivel', $filtros['id_nivel'])))
            ->when($filtros['id_sucursal'], fn($q) => $q->whereHas('inscripcion', fn($q2) => $q2->where('id_sucursal', $filtros['id_sucursal'])))
            ->paginate(20);
        return view('reportes.ingreso_punteos', compact('notas', 'filtros'));
    }

    // Exportar a Excel el reporte de ingreso de punteos
    public function exportarIngresoPunteos(Request $request)
    {
        $filtros = [
            'id_curso' => $request->input('id_curso'),
            'id_nivel' => $request->input('id_nivel'),
            'id_sucursal' => $request->input('id_sucursal'),
        ];
        return \Maatwebsite\Excel\Facades\Excel::download(new IngresoPunteosExport($filtros), 'ingreso_punteos.xlsx');
    }
}