@extends('layouts.app')

@section('title', 'Gestión de Profesores')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">Gestión de Profesores</div>
                <div class="card-body">
                    <form class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="nivel" class="form-label">Filtrar por Nivel</label>
                            <select id="nivel" class="form-select">
                                <option value="">Todos</option>
                                <option>Principiantes I</option>
                                <option>Principiantes II</option>
                                <option>Avanzados I</option>
                                <option>Avanzados II</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="sucursal" class="form-label">Filtrar por Sucursal</label>
                            <select id="sucursal" class="form-select">
                                <option value="">Todas</option>
                                <option>Puerto Barrios</option>
                                <option>Los Amates</option>
                                <option>Morales</option>
                                <option>El Estor</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="button" class="btn btn-primary w-100" onclick="filtrarTablaDocentes()">Filtrar</button>
                        </div>
                    </form>
                    <table class="table table-striped" id="tablaDocentes">
                        <thead>
                            <tr>
                                <th onclick="ordenarTablaDocentes(0)">#</th>
                                <th onclick="ordenarTablaDocentes(1)">Nombre</th>
                                <th onclick="ordenarTablaDocentes(2)">Email</th>
                                <th onclick="ordenarTablaDocentes(3)">Teléfono</th>
                                <th onclick="ordenarTablaDocentes(4)">Especialidad</th>
                                <th onclick="ordenarTablaDocentes(5)">Sucursal</th>
                                <th onclick="ordenarTablaDocentes(6)">Nivel</th>
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
<script>
function filtrarTablaDocentes() {
    var nivel = document.getElementById('nivel').value;
    var sucursal = document.getElementById('sucursal').value;
    var tabla = document.getElementById('tablaDocentes');
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
function ordenarTablaDocentes(n) {
    var tabla = document.getElementById('tablaDocentes');
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
