@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Punteos</h1>
    <a href="{{ route('notas.create') }}" class="btn btn-secondary mb-3">Volver a registrar punteo</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Curso</th>
                <th>Nivel</th>
                <th>Punteo</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notas as $nota)
                <tr>
                    <td>{{ $nota->inscripcion && $nota->inscripcion->alumno ? $nota->inscripcion->alumno->nombre : 'Sin alumno' }}</td>
                    <td>{{ $nota->inscripcion && $nota->inscripcion->curso ? $nota->inscripcion->curso->nombre : 'Sin curso' }}</td>
                    <td>{{ $nota->inscripcion && $nota->inscripcion->nivel ? $nota->inscripcion->nivel->nombre : 'Sin nivel' }}</td>
                    <td>{{ $nota->punteo }}</td>
                    <td>{{ $nota->observacion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $notas->links() }}
</div>
@endsection
