@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select name="role" id="role" class="form-select" required>
                <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="profesor" {{ old('role', $usuario->role) == 'profesor' ? 'selected' : '' }}>Profesor</option>
                <option value="alumno" {{ old('role', $usuario->role) == 'alumno' ? 'selected' : '' }}>Alumno</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection 