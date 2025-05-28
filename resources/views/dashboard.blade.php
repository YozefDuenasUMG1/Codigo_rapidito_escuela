<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php $rol = Auth::user()->role; @endphp
                    @if ($rol === 'admin')
                        <h3>Bienvenido Administrador</h3>
                        <p>Gestiona usuarios, cursos, sucursales y reportes desde este panel.</p>
                    @elseif ($rol === 'profesor')
                        <h3>Bienvenido Profesor</h3>
                        <p>Accede a la gestión de tus cursos, alumnos y notas.</p>
                    @elseif ($rol === 'alumno')
                        <h3>Bienvenido Alumno</h3>
                        <p>Consulta tus cursos, calificaciones y reportes aquí.</p>
                    @else
                        <h3>Bienvenido</h3>
                        <p>Estás logueado en el sistema.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
