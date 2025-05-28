@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alumnos del Grado: {{ $grado->nombre ?? 'No especificado' }}</h1>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
