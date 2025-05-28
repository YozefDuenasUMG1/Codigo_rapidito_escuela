@extends('layouts.app')

@section('title', 'Editar Sucursal')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark">Editar Sucursal</div>
                <div class="card-body">
                    <form action="{{ route('sucursales.update', $sucursal->id_sucursal) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $sucursal->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" class="form-control" value="{{ $sucursal->ubicacion }}" required>
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Sucursal</button>
                        <a href="{{ route('sucursales.gestion') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 