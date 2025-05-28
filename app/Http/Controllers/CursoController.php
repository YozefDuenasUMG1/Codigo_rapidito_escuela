<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::paginate(10);
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveles = \App\Models\Nivel::all();
        return view('cursos.create', compact('niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);
        Curso::create($validated);
        return redirect()->route('cursos.index')->with('success', 'Curso creado exitosamente.');
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
        $curso = \App\Models\Curso::findOrFail($id);
        $niveles = \App\Models\Nivel::all();
        return view('cursos.edit', compact('curso', 'niveles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);
        $curso->update($validated);
        return redirect()->route('cursos.index')->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso eliminado exitosamente.');
    }

    public function gestion()
    {
        $cursos = \App\Models\Curso::with('inscripciones')->paginate(10);
        $niveles = \App\Models\Nivel::all();
        return view('gestion-cursos', compact('cursos', 'niveles'));
    }
}
