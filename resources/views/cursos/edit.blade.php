@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark">Editar Curso</div>
                <div class="card-body">
                    <form action="{{ route('cursos.update', $curso->id_curso) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $curso->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_nivel" class="form-label">Nivel</label>
                            <select name="id_nivel" class="form-control" required>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id_nivel }}" @if($curso->id_nivel == $nivel->id_nivel) selected @endif>{{ $nivel->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" required>{{ $curso->descripcion }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Curso</button>
                        <a href="{{ route('cursos.gestion') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 