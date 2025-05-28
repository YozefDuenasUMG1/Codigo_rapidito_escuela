@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Alumno</h1>
    <form action="{{ route('alumnos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" name="numero" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_sucursal" class="form-label">Sucursal</label>
            <select name="id_sucursal" class="form-control" required>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select name="id_curso" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}">{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_nivel" class="form-label">Nivel</label>
            <select name="id_nivel" class="form-control" required>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id_nivel }}">{{ $nivel->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
