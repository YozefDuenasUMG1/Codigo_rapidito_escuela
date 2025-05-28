<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\Sucursal;
use App\Models\Nivel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CredencialesUsuario;
use Illuminate\Support\Facades\Notification;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::with(['sucursal', 'nivel'])->paginate(10);
        // Para la vista docentes-lista
        if (request()->routeIs('docentes.lista')) {
            return view('docentes-lista', ['docentes' => $profesores]);
        }
        // Para la vista gestion-docentes
        if (request()->routeIs('docentes.gestion')) {
            return view('gestion-docentes', ['docentes' => $profesores]);
        }
        // Fallback
        return view('docentes-lista', ['docentes' => $profesores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = \App\Models\Sucursal::all();
        $niveles = \App\Models\Nivel::all();
        return view('añadir-docente', compact('sucursales', 'niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:profesores,email',
            'telefono' => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);
        $profesor = Profesor::create($validated);
        $adminEmail = auth()->user()->email ?? config('mail.from.address');
        $mensaje = 'Profesor creado exitosamente.';
        if (!filter_var($profesor->email, FILTER_VALIDATE_EMAIL)) {
            $mensaje .= ' Advertencia: El email del profesor no es válido, no se enviaron credenciales.';
        } elseif (User::where('email', $profesor->email)->exists()) {
            $mensaje .= ' Advertencia: Ya existe un usuario con este email, no se crearon nuevas credenciales.';
        } else {
            $password = Str::random(10);
            $user = User::create([
                'name' => $profesor->nombre,
                'email' => $profesor->email,
                'password' => Hash::make($password),
                'role' => 'profesor',
            ]);
            // $user->notify(new CredencialesUsuario($user->email, $password, 'profesor'));
            // Notification::route('mail', $adminEmail)
            //     ->notify(new \App\Notifications\CredencialesUsuario($user->email, $password, 'profesor'));
            $mensaje .= ' (Envío de credenciales desactivado en desarrollo).';
        }
        return redirect()->route('profesores.index')->with('success', $mensaje);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $docente = Profesor::with(['sucursal', 'nivel'])->findOrFail($id);
        return view('ver-docente', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $docente = Profesor::findOrFail($id);
        $sucursales = \App\Models\Sucursal::all();
        $niveles = \App\Models\Nivel::all();
        return view('editar-docente', compact('docente', 'sucursales', 'niveles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $docente = Profesor::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:profesores,email,' . $docente->id_profesor . ',id_profesor',
            'telefono' => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);
        $docente->update($validated);
        return redirect()->route('docentes.gestion')->with('success', 'Docente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado exitosamente.');
    }
}
