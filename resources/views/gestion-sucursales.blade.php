@extends('layouts.app')
@section('title', 'Gestión de Sucursales')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">Gestión de Sucursales</div>
                <div class="card-body">
                    <a href="{{ route('sucursales.create') }}" class="btn btn-primary mb-3">Nueva Sucursal</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sucursales as $sucursal)
                            <tr>
                                <td>{{ $sucursal->id_sucursal }}</td>
                                <td>{{ $sucursal->nombre }}</td>
                                <td>{{ $sucursal->ubicacion }}</td>
                                <td>
                                    <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sucursales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 