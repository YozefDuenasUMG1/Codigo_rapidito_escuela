<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::paginate(10);
        return view('sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string',
        ]);
        Sucursal::create($validated);
        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada exitosamente.');
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
        $sucursal = \App\Models\Sucursal::findOrFail($id);
        return view('sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string',
        ]);
        $sucursal->update($validated);
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();
        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada exitosamente.');
    }

    public function gestion()
    {
        $sucursales = \App\Models\Sucursal::paginate(10);
        return view('gestion-sucursales', compact('sucursales'));
    }
}
