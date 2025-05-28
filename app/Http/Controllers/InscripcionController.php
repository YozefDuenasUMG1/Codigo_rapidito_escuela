<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inscripciones = Inscripcion::paginate(10);
        return view('inscripciones.index', compact('inscripciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_alumno' => 'required|exists:alumnos,id_alumno',
            'id_nivel' => 'required|exists:niveles,id_nivel',
            'id_curso' => 'required|exists:cursos,id_curso',
            'id_profesor' => 'required|exists:profesores,id_profesor',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'fecha_inscripcion' => 'required|date',
        ]);
        Inscripcion::create($validated);
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $validated = $request->validate([
            'id_alumno' => 'required|exists:alumnos,id_alumno',
            'id_nivel' => 'required|exists:niveles,id_nivel',
            'id_curso' => 'required|exists:cursos,id_curso',
            'id_profesor' => 'required|exists:profesores,id_profesor',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'fecha_inscripcion' => 'required|date',
        ]);
        $inscripcion->update($validated);
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada exitosamente.');
    }
}
