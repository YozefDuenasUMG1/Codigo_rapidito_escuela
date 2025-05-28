<?php

namespace App\Exports;

use App\Models\Alumno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumnosRegistroExport implements FromCollection, WithHeadings, WithMapping
{
    protected $fecha_inicio;
    protected $fecha_fin;

    public function __construct($fecha_inicio, $fecha_fin)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    public function collection()
    {
        $query = Alumno::with(['sucursal', 'nivel', 'curso']);
        if ($this->fecha_inicio && $this->fecha_fin) {
            $query->whereBetween('created_at', [$this->fecha_inicio, $this->fecha_fin]);
        } elseif ($this->fecha_inicio) {
            $query->whereDate('created_at', '>=', $this->fecha_inicio);
        } elseif ($this->fecha_fin) {
            $query->whereDate('created_at', '<=', $this->fecha_fin);
        }
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Email',
            'Número',
            'Dirección',
            'Sucursal',
            'Curso',
            'Nivel',
            'Fecha de inscripción',
        ];
    }

    public function map($alumno): array
    {
        return [
            $alumno->id_alumno,
            $alumno->nombre,
            $alumno->email,
            $alumno->numero,
            $alumno->direccion,
            $alumno->sucursal->nombre ?? '-',
            $alumno->curso->nombre ?? '-',
            $alumno->nivel->nombre ?? '-',
            $alumno->created_at->format('Y-m-d'),
        ];
    }
} 