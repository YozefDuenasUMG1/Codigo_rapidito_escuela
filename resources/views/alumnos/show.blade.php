@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Alumno</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $alumno->nombre }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $alumno->email }}</p>
            <p class="card-text"><strong>Número:</strong> {{ $alumno->numero }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $alumno->direccion }}</p>
            <p class="card-text"><strong>Sucursal:</strong> {{ $alumno->sucursal->nombre ?? '-' }}</p>
            <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('alumnos.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
