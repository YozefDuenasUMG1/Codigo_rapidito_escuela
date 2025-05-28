@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Lista de cursos y niveles</h3>
    <h4>Cursos</h4>
    <ul>
        @foreach(\App\Models\Curso::with('nivel')->get() as $curso)
            <li>
                <strong>{{ $curso->nombre }}</strong> - {{ $curso->descripcion }}<br>
                Nivel: {{ $curso->nivel->nombre ?? 'N/A' }}
            </li>
        @endforeach
    </ul>
    <h4 class="mt-4">Niveles</h4>
    <ul>
        @foreach(\App\Models\Nivel::with('grado')->get() as $nivel)
            <li>
                <strong>{{ $nivel->nombre }}</strong>
                @if($nivel->grado)
                    (Grado: {{ $nivel->grado->nombre }})
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection 