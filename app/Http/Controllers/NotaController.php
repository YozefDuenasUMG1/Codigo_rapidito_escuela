<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Alumno;
use App\Models\Inscripcion;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = Nota::paginate(10);
        return view('notas.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cargar inscripciones con relaciones alumno, curso y nivel
        $inscripciones = Inscripcion::with(['alumno', 'curso', 'nivel'])->get();
        return view('notas.create', compact('inscripciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_inscripcion' => 'required|exists:inscripciones,id_inscripcion',
            'punteo' => 'required|integer|min:0|max:100',
            'observacion' => 'nullable|string',
        ]);
        Nota::create($validated);
        return redirect()->route('notas.index')->with('success', 'Nota creada exitosamente.');
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
    public function edit($id)
    {
        $nota = Nota::with(['inscripcion.alumno.sucursal', 'inscripcion.curso', 'inscripcion.nivel'])->findOrFail($id);
        return view('notas.edit', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nota = Nota::findOrFail($id);
        $validated = $request->validate([
            'punteo' => 'required|integer|min:0|max:100',
            'observacion' => 'nullable|string',
        ]);
        $nota->update($validated);
        return redirect()->route('reportes.ingreso_punteos')->with('success', 'Nota actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nota = Nota::findOrFail($id);
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota eliminada exitosamente.');
    }
}
