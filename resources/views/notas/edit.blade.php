@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Punteo</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('notas.update', $nota->id_nota) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Inscripción (Alumno - Curso - Nivel - Sucursal)</label>
            <input type="text" class="form-control" value="{{ $nota->inscripcion->alumno->nombre ?? 'Sin alumno' }} - {{ $nota->inscripcion->curso->nombre ?? 'Sin curso' }} - {{ $nota->inscripcion->nivel->nombre ?? 'Sin nivel' }} - {{ $nota->inscripcion->alumno && $nota->inscripcion->alumno->sucursal ? $nota->inscripcion->alumno->sucursal->nombre : 'Sin sucursal' }}" disabled>
        </div>
        <div class="mb-3">
            <label for="punteo" class="form-label">Punteo</label>
            <input type="number" name="punteo" id="punteo" class="form-control @error('punteo') is-invalid @enderror" min="0" max="100" value="{{ old('punteo', $nota->punteo) }}" required>
            @error('punteo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="observacion" class="form-label">Observación</label>
            <textarea name="observacion" id="observacion" class="form-control @error('observacion') is-invalid @enderror">{{ old('observacion', $nota->observacion) }}</textarea>
            @error('observacion')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('reportes.ingreso_punteos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
