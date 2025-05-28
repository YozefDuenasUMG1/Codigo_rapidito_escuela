@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detalles del Docente</h1>
    <div class="bg-white shadow rounded p-6">
        <p><strong>Nombre:</strong> {{ $docente->nombre }}</p>
        <p><strong>Email:</strong> {{ $docente->email }}</p>
        <p><strong>Teléfono:</strong> {{ $docente->telefono }}</p>
        <p><strong>Especialidad:</strong> {{ $docente->especialidad }}</p>
        <p><strong>Sucursal:</strong> {{ $docente->sucursal->nombre ?? '-' }}</p>
        <p><strong>Nivel:</strong> {{ $docente->nivel->nombre ?? '-' }}</p>
        <a href="{{ route('profesores.edit', $docente->id_profesor) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar</a>
        <a href="{{ route('docentes.lista') }}" class="mt-4 ml-2 inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Volver</a>
    </div>
</div>
@endsection
