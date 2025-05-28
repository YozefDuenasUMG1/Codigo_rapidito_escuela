<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Sucursal;
use App\Models\Nivel;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CredencialesUsuario;
use Illuminate\Support\Facades\Notification;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::with(['sucursal', 'nivel'])->paginate(10);
        return view('alumnos-lista', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = Sucursal::all();
        $niveles = Nivel::all();
        $cursos = Curso::all();
        return view('inscribir-alumno', compact('sucursales', 'niveles', 'cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:alumnos,email',
            'numero' => 'required|string|max:8',
            'direccion' => 'required|string',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_nivel' => 'required|exists:niveles,id_nivel',
            'id_curso' => 'required|exists:cursos,id_curso',
        ]);
        $alumno = \App\Models\Alumno::create($validated);
        $adminEmail = auth()->user()->email ?? config('mail.from.address');
        $mensaje = 'Alumno creado exitosamente.';
        if (!filter_var($alumno->email, FILTER_VALIDATE_EMAIL)) {
            $mensaje .= ' Advertencia: El email del alumno no es válido, no se enviaron credenciales.';
        } elseif (\App\Models\User::where('email', $alumno->email)->exists()) {
            $mensaje .= ' Advertencia: Ya existe un usuario con este email, no se crearon nuevas credenciales.';
        } else {
            $password = Str::random(10);
            $user = User::create([
                'name' => $alumno->nombre,
                'email' => $alumno->email,
                'password' => Hash::make($password),
                'role' => 'alumno',
            ]);
            // $user->notify(new CredencialesUsuario($user->email, $password, 'alumno'));
            // Notification::route('mail', $adminEmail)
            //     ->notify(new \App\Notifications\CredencialesUsuario($user->email, $password, 'alumno'));
            $mensaje .= ' (Envío de credenciales desactivado en desarrollo).';
        }
        return redirect()->route('alumnos.index')->with('success', $mensaje);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alumno = Alumno::with(['sucursal', 'nivel'])->findOrFail($id);
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $sucursales = Sucursal::all();
        $niveles = Nivel::all();
        $cursos = Curso::all();
        return view('alumnos.edit', compact('alumno', 'sucursales', 'niveles', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:alumnos,email,' . $alumno->id_alumno . ',id_alumno',
            'numero' => 'required|string|max:8',
            'direccion' => 'required|string',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
        ]);
        $alumno->update($validated);
        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado exitosamente.');
    }

    public function gestion(Request $request)
    {
        $query = Alumno::with(['sucursal', 'nivel']);
        if ($request->filled('nivel')) {
            $query->whereHas('nivel', function($q) use ($request) {
                $q->where('nombre', $request->nivel);
            });
        }
        if ($request->filled('id_sucursal')) {
            $query->where('id_sucursal', $request->id_sucursal);
        }
        $sortable = ['id_alumno', 'nombre', 'email', 'direccion', 'numero'];
        $sort = $request->get('sort', 'id_alumno');
        $direction = $request->get('direction', 'asc');
        if (!in_array($sort, $sortable)) {
            $sort = 'id_alumno';
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }
        $query->orderBy($sort, $direction);
        $alumnos = $query->paginate(10)->appends($request->all());
        $sucursales = Sucursal::all();
        $niveles = ['Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II'];
        return view('gestion-alumnos', compact('alumnos', 'sucursales', 'niveles', 'sort', 'direction'));
    }
}
