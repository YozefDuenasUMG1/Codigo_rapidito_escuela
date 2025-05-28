@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Mi información</h3>
    <ul>
        <li><strong>Nombre:</strong> {{ Auth::user()->name }}</li>
        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
        <!-- Agrega más datos de inscripción aquí -->
    </ul>
</div>
@endsection 