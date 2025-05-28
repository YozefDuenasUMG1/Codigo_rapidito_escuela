@extends('layouts.app')

@section('title', 'Inscribir Alumno')

@php
    $sucursales = $sucursales ?? [];
    $niveles = $niveles ?? [];
    $cursos = $cursos ?? [];
@endphp

@section('content')
<!-- Contenedor centrado (sin position fixed) -->
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 15px;
    background: #f8f9fa;
">
    <div class="card shadow-lg border-0" style="
        border-radius: 1rem;
        max-width: 400px;
        width: 100%;
        padding: 15px 20px;
        background: white;
        max-height: 90vh;
        overflow-y: auto;
    ">
        <div class="card-body p-0">
            <div class="text-center mb-3">
                <div class="bg-success p-2 rounded-circle d-inline-block animate__animated animate__bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="28" height="28" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5zm0 7v-6m0 6a9 9 0 110-18 9 9 0 010 18z" />
                    </svg>
                </div>
                <h2 class="mt-2 mb-1 text-success" style="font-size: 1.5rem;">¡Inscríbete Hoy!</h2>
                <p class="text-muted small mb-0">Únete a nuestra comunidad de aprendizaje 🎯</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('alumnos.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">👤 Nombre Completo</label>
                    <input type="text" name="nombre" class="form-control rounded-pill py-1" required style="font-size: 0.9rem;">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">📧 Correo Electrónico</label>
                    <input type="email" name="email" class="form-control rounded-pill py-1" required style="font-size: 0.9rem;">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">📞 Número</label>
                    <input type="text" name="numero" class="form-control rounded-pill py-1" required style="font-size: 0.9rem;">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">🏠 Dirección</label>
                    <input type="text" name="direccion" class="form-control rounded-pill py-1" required style="font-size: 0.9rem;">
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">🏢 Sucursal</label>
                    <select name="id_sucursal" class="form-select rounded-pill py-1" required style="font-size: 0.9rem;">
                        <option value="">Selecciona una sucursal</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">📚 Curso</label>
                    <select name="id_curso" class="form-select rounded-pill py-1" required style="font-size: 0.9rem;">
                        <option value="">Selecciona un curso</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id_curso }}">{{ $curso->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-semibold" style="font-size: 0.9rem;">🎓 Nivel</label>
                    <select name="id_nivel" class="form-select rounded-pill py-1" required style="font-size: 0.9rem;">
                        <option value="">Selecciona un nivel</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id_nivel }}">{{ $nivel->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg fw-bold shadow-sm rounded-pill py-2" style="font-size: 1rem;">
                        ✅ Inscribir Alumno
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
