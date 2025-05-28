@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Lista de cursos</h3>
    <ul>
        @forelse(\App\Models\Curso::with(['profesor', 'nivel'])->get() as $curso)
            <li>
                <strong>{{ $curso->nombre }}</strong> - {{ $curso->descripcion }}<br>
                <small>
                    Profesor: {{ $curso->profesor->nombre ?? 'N/A' }}<br>
                    Nivel: {{ $curso->nivel->nombre ?? 'N/A' }}
                </small>
            </li>
        @empty
            <li>No hay cursos disponibles.</li>
        @endforelse
    </ul>
</div>
@endsection 