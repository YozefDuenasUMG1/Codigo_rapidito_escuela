<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::paginate(10);
        return view('docentes-lista', compact('docentes'));
    }

    public function create()
    {
        return view('añadir-docente');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email',
            'telefono' => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
        ]);

        Docente::create($validated);

        return redirect()->route('docentes.index')->with('success', 'Docente creado exitosamente.');
    }

    public function show(Docente $docente)
    {
        return view('docentes.show', compact('docente'));
    }

    public function edit($id)
    {
        $docente = Docente::findOrFail($id);
        return view('gestion-docentes', compact('docente'));
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:docentes,email,' . $docente->id . ',id',
            'telefono' => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
        ]);

        $docente->update($validated);

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}