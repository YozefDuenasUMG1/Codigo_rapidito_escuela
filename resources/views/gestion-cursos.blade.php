@extends('layouts.app')
@section('title', 'Gestión de Cursos y Niveles')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Gestión de Cursos</div>
                <div class="card-body">
                    <a href="{{ route('cursos.create') }}" class="btn btn-primary mb-3">Nuevo Curso</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cursos as $curso)
                            <tr>
                                <td>{{ $curso->id_curso }}</td>
                                <td>{{ $curso->nombre }}</td>
                                <td>{{ $curso->descripcion }}</td>
                                <td>
                                    <a href="{{ route('cursos.edit', $curso->id_curso) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('cursos.destroy', $curso->id_curso) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $cursos->links() }}
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info text-white">Gestión de Niveles</div>
                <div class="card-body">
                    <a href="{{ route('niveles.create') }}" class="btn btn-info mb-3">Nuevo Nivel</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Grado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($niveles as $nivel)
                            <tr>
                                <td>{{ $nivel->id_nivel }}</td>
                                <td>{{ $nivel->nombre }}</td>
                                <td>{{ $nivel->grado->nombre ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('niveles.edit', $nivel->id_nivel) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('niveles.destroy', $nivel->id_nivel) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 