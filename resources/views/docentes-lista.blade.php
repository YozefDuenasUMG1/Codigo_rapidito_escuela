@extends('layouts.app')

@section('title', 'Lista de Profesores')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">Lista de Profesores</div>
                <div class="card-body">
                    <a href="{{ route('profesores.create') }}" class="btn btn-primary mb-3">Nuevo Profesor</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Especialidad</th>
                                <th>Sucursal</th>
                                <th>Nivel</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docentes as $profesor)
                            <tr>
                                <td>{{ $profesor->id_profesor }}</td>
                                <td>{{ $profesor->nombre }}</td>
                                <td>{{ $profesor->email }}</td>
                                <td>{{ $profesor->telefono }}</td>
                                <td>{{ $profesor->especialidad }}</td>
                                <td>{{ $profesor->sucursal->nombre ?? '-' }}</td>
                                <td>{{ $profesor->nivel->nombre ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('docentes.show', $profesor->id_profesor) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('docentes.edit', $profesor->id_profesor) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('docentes.destroy', $profesor->id_profesor) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $docentes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
