@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Alumno</h1>
    <form action="{{ route('alumnos.update', $alumno) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $alumno->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $alumno->email }}" required>
        </div>
        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" name="numero" class="form-control" value="{{ $alumno->numero }}" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ $alumno->direccion }}" required>
        </div>
        <div class="mb-3">
            <label for="id_sucursal" class="form-label">Sucursal</label>
            <select name="id_sucursal" class="form-control" required>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}" @if($alumno->id_sucursal == $sucursal->id_sucursal) selected @endif>{{ $sucursal->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_nivel" class="form-label">Nivel</label>
            <select name="id_nivel" class="form-control" required>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id_nivel }}" @if($alumno->id_nivel == $nivel->id_nivel) selected @endif>{{ $nivel->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select name="id_curso" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}" @if($alumno->id_curso == $curso->id_curso) selected @endif>{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
