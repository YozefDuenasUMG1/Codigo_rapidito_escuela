@extends('layouts.app')

@section('title', 'Lista de Alumnos')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">Lista de Alumnos</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <a href="{{ route('alumnos.create') }}" class="btn btn-primary mb-3">Nuevo Alumno</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Número</th>
                                <th>Dirección</th>
                                <th>Sucursal</th>
                                <th>Nivel</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnos as $alumno)
                            <tr>
                                <td>{{ $alumno->id_alumno }}</td>
                                <td>{{ $alumno->nombre }}</td>
                                <td>{{ $alumno->email }}</td>
                                <td>{{ $alumno->numero }}</td>
                                <td>{{ $alumno->direccion }}</td>
                                <td>{{ $alumno->sucursal->nombre ?? '-' }}</td>
                                <td>{{ $alumno->nivel->nombre ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('alumnos.show', $alumno->id_alumno) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('alumnos.edit', $alumno->id_alumno) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('alumnos.destroy', $alumno->id_alumno) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $alumnos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
