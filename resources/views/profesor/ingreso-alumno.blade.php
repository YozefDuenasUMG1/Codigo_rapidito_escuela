@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Ingreso de alumno</h3>
    <form>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre del alumno">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email del alumno">
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>
@endsection 