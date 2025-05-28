<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Grado;

class NivelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveles = Nivel::with('grado')->paginate(10);
        return view('niveles.index', compact('niveles'));
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
            'nombre' => 'required|in:Principiantes I,Principiantes II,Avanzados I,Avanzados II',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);
        Nivel::create($validated);
        return redirect()->route('niveles.index')->with('success', 'Nivel creado exitosamente.');
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
        $nivel = Nivel::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|in:Principiantes I,Principiantes II,Avanzados I,Avanzados II',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);
        $nivel->update($validated);
        return redirect()->route('niveles.index')->with('success', 'Nivel actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();
        return redirect()->route('niveles.index')->with('success', 'Nivel eliminado exitosamente.');
    }
}
