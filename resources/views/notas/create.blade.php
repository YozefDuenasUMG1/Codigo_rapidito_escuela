@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Punteo</h1>
    <a href="{{ route('reportes.ingreso_punteos') }}" class="btn btn-info mb-3">Ver lista de punteos</a>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="window.location='{{ route('notas.create') }}'" ></button>
        </div>
        <a href="{{ route('notas.create') }}" class="btn btn-secondary mb-3">Volver</a>
    @endif
    <form method="POST" action="{{ route('notas.store') }}">
        @csrf
        <div class="mb-3">
            <label for="id_inscripcion" class="form-label">Inscripción (Alumno - Curso - Nivel - Sucursal)</label>
            <select name="id_inscripcion" id="id_inscripcion" class="form-select" required>
                <option value="">Seleccione una inscripción</option>
                @foreach($inscripciones as $inscripcion)
                    <option value="{{ $inscripcion->id_inscripcion }}">{{ $inscripcion->alumno ? $inscripcion->alumno->nombre : 'Sin alumno' }} - {{ $inscripcion->curso ? $inscripcion->curso->nombre : 'Sin curso' }} - {{ $inscripcion->nivel ? $inscripcion->nivel->nombre : 'Sin nivel' }} - {{ $inscripcion->sucursal ? $inscripcion->sucursal->nombre : 'Sin sucursal' }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="punteo" class="form-label">Punteo</label>
            <input type="number" name="punteo" id="punteo" class="form-control" min="0" max="100" required>
        </div>
        <div class="mb-3">
            <label for="observacion" class="form-label">Observación</label>
            <textarea name="observacion" id="observacion" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#id_inscripcion').select2({
            width: '100%',
            placeholder: 'Seleccione una inscripción',
            allowClear: true
        });
    });
</script>
@endpush
