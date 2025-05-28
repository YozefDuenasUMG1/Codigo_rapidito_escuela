<table>
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Curso</th>
            <th>Nivel</th>
            <th>Sucursal</th>
            <th>Punteo</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notas as $nota)
        <tr>
            <td>{{ $nota->inscripcion->alumno->nombre ?? '-' }}</td>
            <td>{{ $nota->inscripcion->curso->nombre ?? '-' }}</td>
            <td>{{ $nota->inscripcion->nivel->nombre ?? '-' }}</td>
            <td>{{ $nota->inscripcion->sucursal->nombre ?? '-' }}</td>
            <td>{{ $nota->punteo }}</td>
            <td>{{ $nota->observacion }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
