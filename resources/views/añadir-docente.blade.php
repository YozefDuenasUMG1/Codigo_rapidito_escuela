@extends('layouts.app')

@section('title', 'Añadir Docente')

@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center bg-light py-4">
    <div class="card shadow-lg border-0" style="max-width: 420px; width: 100%; border-radius: 1rem;">
        <div class="card-body p-4">

            <!-- Encabezado visual -->
            <div class="text-center mb-4">
                <div class="bg-success p-3 rounded-circle d-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 14v-2a4 4 0 10-8 0v2H6v6h12v-6h-2zM12 2a5 5 0 00-5 5h2a3 3 0 016 0h2a5 5 0 00-5-5z"/>
                    </svg>
                </div>
                <h4 class="mt-3 mb-1 text-success fw-bold">Registrar Docente</h4>
                <p class="text-muted small">Agrega nuevos docentes al sistema 🧑‍🏫</p>
            </div>

            <!-- Formulario -->
            @php
                $sucursales = $sucursales ?? [];
                $niveles = $niveles ?? [];
            @endphp
            <form action="{{ route('docentes.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-semibold">👤 Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control rounded-pill py-2 px-3" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">📧 Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control rounded-pill py-2 px-3" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label fw-semibold">📞 Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control rounded-pill py-2 px-3" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label fw-semibold">🏠 Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control rounded-pill py-2 px-3" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="especialidad" class="form-label fw-semibold">🏅 Especialidad</label>
                    <input type="text" name="especialidad" id="especialidad" class="form-control rounded-pill py-2 px-3" placeholder="" required>
                </div>

                <div class="mb-3">
                    <label for="id_sucursal" class="form-label fw-semibold">🏢 Sucursal</label>
                    <select name="id_sucursal" id="id_sucursal" class="form-select rounded-pill py-2 px-3" required>
                        <option value="">Selecciona una sucursal</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_nivel" class="form-label fw-semibold">🎓 Nivel</label>
                    <select name="id_nivel" id="id_nivel" class="form-select rounded-pill py-2 px-3" required>
                        <option value="">Selecciona un nivel</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id_nivel }}">{{ $nivel->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg fw-bold rounded-pill py-2">
                        ✅ Registrar Docente
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
