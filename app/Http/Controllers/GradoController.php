<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grado;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::paginate(10);
        return view('grados.index', compact('grados'));
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
            'nombre' => 'required|in:Novato,Experto',
        ]);
        Grado::create($validated);
        return redirect()->route('grados.index')->with('success', 'Grado creado exitosamente.');
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
        $grado = Grado::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|in:Novato,Experto',
        ]);
        $grado->update($validated);
        return redirect()->route('grados.index')->with('success', 'Grado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        $grado->delete();
        return redirect()->route('grados.index')->with('success', 'Grado eliminado exitosamente.');
    }
}
