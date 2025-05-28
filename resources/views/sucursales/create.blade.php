@extends('layouts.app')

@section('title', 'Nueva Sucursal')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Nueva Sucursal</div>
                <div class="card-body">
                    <form action="{{ route('sucursales.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" name="ubicacion" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Crear Sucursal</button>
                        <a href="{{ route('sucursales.gestion') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 