@extends('layouts.app')

@section('title', 'Gestión de Alumnos')

@php
    $alumnos = $alumnos ?? [];
    $sucursales = $sucursales ?? [];
    $niveles = $niveles ?? ['Principiantes I', 'Principiantes II', 'Avanzados I', 'Avanzados II'];
    $sort = $sort ?? 'id_alumno';
    $direction = $direction ?? 'asc';
@endphp

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">Gestión de Alumnos</div>
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
                    <form class="row g-3 mb-4" method="GET" action="">
                        <div class="col-md-4">
                            <label for="nivel" class="form-label">Filtrar por Nivel</label>
                            <select id="nivel" name="nivel" class="form-select">
                                <option value="">Todos</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel }}" {{ request('nivel') == $nivel ? 'selected' : '' }}>{{ $nivel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="id_sucursal" class="form-label">Filtrar por Sucursal</label>
                            <select id="id_sucursal" name="id_sucursal" class="form-select">
                                <option value="">Todas</option>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id_sucursal }}" {{ request('id_sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>{{ $sucursal->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        </div>
                    </form>
                    <table class="table table-striped" id="tablaAlumnos">
                        <thead>
                            <tr>
                                <th><a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'id_alumno', 'direction' => ($sort == 'id_alumno' && $direction == 'asc') ? 'desc' : 'asc'])) }}"># @if($sort == 'id_alumno')<span>{{ $direction == 'asc' ? '↑' : '↓' }}</span>@endif</a></th>
                                <th><a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'nombre', 'direction' => ($sort == 'nombre' && $direction == 'asc') ? 'desc' : 'asc'])) }}">Nombre @if($sort == 'nombre')<span>{{ $direction == 'asc' ? '↑' : '↓' }}</span>@endif</a></th>
                                <th><a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'email', 'direction' => ($sort == 'email' && $direction == 'asc') ? 'desc' : 'asc'])) }}">Email @if($sort == 'email')<span>{{ $direction == 'asc' ? '↑' : '↓' }}</span>@endif</a></th>
                                <th><a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'direccion', 'direction' => ($sort == 'direccion' && $direction == 'asc') ? 'desc' : 'asc'])) }}">Dirección @if($sort == 'direccion')<span>{{ $direction == 'asc' ? '↑' : '↓' }}</span>@endif</a></th>
                                <th><a href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'numero', 'direction' => ($sort == 'numero' && $direction == 'asc') ? 'desc' : 'asc'])) }}">Teléfono @if($sort == 'numero')<span>{{ $direction == 'asc' ? '↑' : '↓' }}</span>@endif</a></th>
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
                                <td>{{ $alumno->direccion }}</td>
                                <td>{{ $alumno->numero }}</td>
                                <td>{{ $alumno->sucursal->nombre ?? '-' }}</td>
                                <td>{{ $alumno->nivel->nombre ?? '-' }}</td>
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
<script>
function filtrarTabla() {
    var nivel = document.getElementById('nivel').value;
    var sucursal = document.getElementById('sucursal').value;
    var tabla = document.getElementById('tablaAlumnos');
    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (var i = 0; i < filas.length; i++) {
        var celdaSucursal = filas[i].getElementsByTagName('td')[5].textContent;
        var celdaNivel = filas[i].getElementsByTagName('td')[6].textContent;
        var mostrar = true;
        if (nivel && celdaNivel !== nivel) mostrar = false;
        if (sucursal && celdaSucursal !== sucursal) mostrar = false;
        filas[i].style.display = mostrar ? '' : 'none';
    }
}
function ordenarTabla(n) {
    var tabla = document.getElementById('tablaAlumnos');
    var filas, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        filas = tabla.rows;
        for (i = 1; i < (filas.length - 1); i++) {
            shouldSwitch = false;
            x = filas[i].getElementsByTagName("TD")[n];
            y = filas[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            filas[i].parentNode.insertBefore(filas[i + 1], filas[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>
@endsection
