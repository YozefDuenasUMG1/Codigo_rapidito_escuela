@extends('layouts.app')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3>Bienvenido, {{ Auth::user()->name }}</h3>
                <p>Este es tu panel de profesor. Aquí puedes gestionar tus cursos y alumnos.</p>
                <hr class="my-4">
                <h4>Mis cursos a cargo</h4>
                <ul>
                    @foreach($cursos as $curso)
                        <li>{{ $curso->nombre }}</li>
                    @endforeach
                </ul>
                <h4 class="mt-4">Últimos alumnos inscritos</h4>
                <ul>
                    @foreach($inscripciones as $inscripcion)
                        <li>{{ $inscripcion->alumno->name ?? 'Sin alumno' }}</li>
                    @endforeach
                </ul>
                <div class="mt-4 alert alert-info">Recuerda mantener actualizados los punteos y la asistencia.</div>
            </div>
        </div>
    </div>
</div>
@endsection 