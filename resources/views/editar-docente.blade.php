@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Docente</h1>
    <form action="{{ route('profesores.update', $docente->id_profesor) }}" method="POST" class="bg-white shadow rounded p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $docente->nombre) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $docente->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $docente->telefono) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Especialidad</label>
            <input type="text" name="especialidad" value="{{ old('especialidad', $docente->especialidad) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Sucursal</label>
            <select name="id_sucursal" class="w-full border rounded px-3 py-2" required>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}" @if($docente->id_sucursal == $sucursal->id_sucursal) selected @endif>{{ $sucursal->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Nivel</label>
            <select name="id_nivel" class="w-full border rounded px-3 py-2" required>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id_nivel }}" @if($docente->id_nivel == $nivel->id_nivel) selected @endif>{{ $nivel->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="color: #222; background: #fff; border: 2px solid #16a34a; font-weight: bold;" class="px-4 py-2 rounded hover:bg-green-50 mt-4 mr-2">Actualizar</button>
        <a href="{{ route('docentes.lista') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mt-4">Cancelar</a>
    </form>
</div>
@endsection
