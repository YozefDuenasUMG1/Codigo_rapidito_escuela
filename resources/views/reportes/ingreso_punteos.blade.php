@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reporte de Ingreso de Punteos</h1>
    <a href="{{ route('notas.create') }}" class="btn btn-success mb-3">Ingresar punteo</a>
    <form method="GET" action="{{ route('reportes.ingreso_punteos') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select name="id_curso" id="id_curso" class="form-select select2">
                <option value="">Todos</option>
                @foreach(App\Models\Curso::orderBy('nombre')->get() as $curso)
                    <option value="{{ $curso->id_curso }}" {{ request('id_curso') == $curso->id_curso ? 'selected' : '' }}>{{ $curso->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="id_nivel" class="form-label">Nivel</label>
            <select name="id_nivel" id="id_nivel" class="form-select select2">
                <option value="">Todos</option>
                @foreach(App\Models\Nivel::orderBy('nombre')->get() as $nivel)
                    <option value="{{ $nivel->id_nivel }}" {{ request('id_nivel') == $nivel->id_nivel ? 'selected' : '' }}>{{ $nivel->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="id_sucursal" class="form-label">Sucursal</label>
            <select name="id_sucursal" id="id_sucursal" class="form-select select2">
                <option value="">Todas</option>
                @foreach(App\Models\Sucursal::orderBy('nombre')->get() as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}" {{ request('id_sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>{{ $sucursal->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 align-self-end d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reportes.ingreso_punteos.exportar', request()->all()) }}" class="btn btn-success">Exportar a Excel</a>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Curso</th>
                <th>Nivel</th>
                <th>Sucursal</th>
                <th>Punteo</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notas as $nota)
            <tr>
                <td>{{ $nota->inscripcion->alumno->nombre ?? '-' }}</td>
                <td>{{ $nota->inscripcion->curso->nombre ?? '-' }}</td>
                <td>{{ $nota->inscripcion->nivel->nombre ?? '-' }}</td>
                <td>{{ $nota->inscripcion->sucursal->nombre ?? '-' }}</td>
                <td>{{ $nota->punteo }}</td>
                <td>{{ $nota->observacion }}</td>
                <td>
                    <a href="{{ route('notas.edit', $nota->id_nota) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('notas.destroy', $nota->id_nota) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar este punteo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $notas->appends(request()->query())->links() }}
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Seleccione',
            allowClear: true
        });
    });
</script>
@endpush
