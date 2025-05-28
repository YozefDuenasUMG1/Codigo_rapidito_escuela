<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ReporteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí se registran las rutas web de la aplicación.
| Se agrupan por tipo y funcionalidad para mejor mantenimiento.
*/

// Rutas públicas de vistas
Route::redirect('/', '/login');
Route::view('/sidebar-demo', 'sidebar-demo')->name('sidebar.demo');

// Agrupo las rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->middleware(['verified'])->name('dashboard');
    Route::get('/inscribir-alumno', [AlumnoController::class, 'create'])->name('alumnos.inscribir');
    Route::get('/gestion-alumnos', [AlumnoController::class, 'gestion'])->name('alumnos.gestion');
    Route::view('/inicio', 'dashboard')->name('inicio');
    Route::get('/añadir-docente', [App\Http\Controllers\ProfesorController::class, 'create'])->name('docentes.añadir');
    Route::get('/gestion-docentes', [ProfesorController::class, 'index'])
        ->middleware(['role:admin,profesor'])
        ->name('docentes.gestion');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
    Route::resource('docentes', ProfesorController::class);
    Route::resource('grados', App\Http\Controllers\GradoController::class);
    Route::resource('niveles', App\Http\Controllers\NivelController::class);
    Route::resource('cursos', App\Http\Controllers\CursoController::class);
    Route::resource('profesores', App\Http\Controllers\ProfesorController::class);
    Route::resource('alumnos', App\Http\Controllers\AlumnoController::class);
    Route::resource('inscripciones', App\Http\Controllers\InscripcionController::class);
    Route::resource('notas', App\Http\Controllers\NotaController::class);
    Route::resource('sucursales', App\Http\Controllers\SucursalController::class);
    Route::get('/alumnos-lista', [AlumnoController::class, 'index'])->name('alumnos.lista');
    Route::get('/docentes-lista', [ProfesorController::class, 'index'])->name('docentes.lista');
    Route::get('/docentes/{id}', [ProfesorController::class, 'show'])->name('docentes.show');
    Route::get('/docentes/{id}/editar', [ProfesorController::class, 'edit'])->name('docentes.edit');
    Route::get('/gestion-sucursales', [\App\Http\Controllers\SucursalController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('sucursales.gestion');
    Route::get('/gestion-cursos', [\App\Http\Controllers\CursoController::class, 'index'])
        ->middleware(['role:admin'])
        ->name('cursos.gestion');
    Route::get('/reportes/alumnos-por-grado', [ReporteController::class, 'alumnosPorGrado'])->name('reportes.alumnos_por_grado');
    Route::get('/reportes/ingreso-alumnos-registro', [ReporteController::class, 'ingresoAlumnosRegistro'])->name('reportes.ingreso_alumnos_registro');
    Route::get('/reportes/ingreso-alumnos-registro/exportar', [ReporteController::class, 'exportarIngresoAlumnosRegistro'])->name('reportes.ingreso_alumnos_registro.exportar');
    Route::get('/reportes/alumnos-por-grado/exportar', [ReporteController::class, 'exportarAlumnosPorGrado'])->name('reportes.alumnos_por_grado.exportar');
    Route::get('/reportes/ingreso-punteos', [ReporteController::class, 'ingresoPunteos'])->name('reportes.ingreso_punteos');
    Route::get('/reportes/ingreso-punteos/exportar', [ReporteController::class, 'exportarIngresoPunteos'])->name('reportes.ingreso_punteos.exportar');
    Route::get('/dashboard-alumno', [\App\Http\Controllers\AlumnoDashboardController::class, 'index'])
        ->middleware(['role:alumno'])->name('dashboard.alumno');
    Route::get('/dashboard-profesor', [\App\Http\Controllers\ProfesorDashboardController::class, 'index'])
        ->middleware(['role:profesor'])->name('dashboard.profesor');
    Route::middleware(['role:alumno'])->prefix('alumno')->group(function () {
        Route::view('info', 'alumno.info')->name('alumno.info');
        Route::view('punteos', 'alumno.punteos')->name('alumno.punteos');
        Route::view('cursos', 'alumno.cursos')->name('alumno.cursos');
    });
    Route::middleware(['role:profesor'])->prefix('profesor')->group(function () {
        Route::view('gestion-alumnos', 'profesor.gestion-alumnos')->name('profesor.gestion-alumnos');
        Route::view('cursos-niveles', 'profesor.cursos-niveles')->name('profesor.cursos-niveles');
        Route::view('ingresar-punteos', 'profesor.ingresar-punteos')->name('profesor.ingresar-punteos');
        Route::view('ingreso-alumno', 'profesor.ingreso-alumno')->name('profesor.ingreso-alumno');
        Route::view('gestion-alumno', 'profesor.gestion-alumno')->name('profesor.gestion-alumno');
    });
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/gestion-usuarios', [\App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{id}/editar', [\App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('usuarios.update');
    });
});

// Rutas de autenticación
require __DIR__.'/auth.php';
