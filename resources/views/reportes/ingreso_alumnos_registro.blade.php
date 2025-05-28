@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registro de Ingreso de Alumnos</h1>
    <form method="GET" action="{{ route('reportes.ingreso_alumnos_registro') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="fecha_inicio" class="form-label">Fecha inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $fecha_inicio }}">
        </div>
        <div class="col-md-4">
            <label for="fecha_fin" class="form-label">Fecha fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $fecha_fin }}">
        </div>
        <div class="col-md-4 align-self-end d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reportes.ingreso_alumnos_registro.exportar', ['fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin]) }}" class="btn btn-success">Exportar a Excel</a>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Número</th>
                <th>Dirección</th>
                <th>Sucursal</th>
                <th>Curso</th>
                <th>Nivel</th>
                <th>Fecha de inscripción</th>
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
                <td>{{ $alumno->curso->nombre ?? '-' }}</td>
                <td>{{ $alumno->nivel->nombre ?? '-' }}</td>
                <td>{{ $alumno->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $alumnos->appends(request()->query())->links() }}
</div>
@endsection 