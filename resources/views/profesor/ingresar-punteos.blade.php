@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Ingresar punteos</h3>
    <form>
        <div class="mb-3">
            <label for="alumno" class="form-label">Alumno</label>
            <input type="text" class="form-control" id="alumno" placeholder="Nombre del alumno">
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Curso</label>
            <input type="text" class="form-control" id="curso" placeholder="Nombre del curso">
        </div>
        <div class="mb-3">
            <label for="punteo" class="form-label">Punteo</label>
            <input type="number" class="form-control" id="punteo" placeholder="Punteo">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection 