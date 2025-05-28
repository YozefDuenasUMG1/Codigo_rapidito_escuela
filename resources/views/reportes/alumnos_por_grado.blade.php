@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte de Alumnos por Grado y Nivel</h1>
    <form method="GET" action="{{ route('reportes.alumnos_por_grado') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="id_grado" class="form-label">Grado</label>
            <select name="id_grado" id="id_grado" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los grados</option>
                @foreach($grados as $g)
                    <option value="{{ $g->id_grado }}" {{ (isset($id_grado) && $id_grado == $g->id_grado) ? 'selected' : '' }}>{{ $g->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="id_nivel" class="form-label">Nivel</label>
            <select name="id_nivel" id="id_nivel" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los niveles</option>
                @foreach($niveles as $n)
                    <option value="{{ $n->id_nivel }}" {{ (isset($id_nivel) && $id_nivel == $n->id_nivel) ? 'selected' : '' }}>{{ $n->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 align-self-end d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reportes.alumnos_por_grado.exportar', ['id_grado' => request('id_grado'), 'id_nivel' => request('id_nivel')]) }}" class="btn btn-success">Exportar a Excel</a>
        </div>
    </form>

    @if($grado)
        <h4>Grado: {{ $grado->nombre }}</h4>
    @elseif(empty($id_grado))
        <h4>Grado: Todos</h4>
    @endif
    @if($nivel)
        <h5>Nivel: {{ $nivel->nombre }}</h5>
    @elseif(empty($id_nivel))
        <h5>Nivel: Todos</h5>
    @endif

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
    {{ $alumnos->appends(request()->query())->links() }}
</div>
@endsection