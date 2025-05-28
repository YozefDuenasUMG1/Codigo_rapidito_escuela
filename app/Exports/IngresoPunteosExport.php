<?php

namespace App\Exports;

use App\Models\Nota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IngresoPunteosExport implements FromView
{
    protected $filtros;

    public function __construct($filtros = [])
    {
        $this->filtros = $filtros;
    }

    public function view(): View
    {
        $query = Nota::with(['inscripcion.alumno', 'inscripcion.curso', 'inscripcion.nivel', 'inscripcion.sucursal']);
        if (!empty($this->filtros['id_curso'])) {
            $query->whereHas('inscripcion', function($q) {
                $q->where('id_curso', $this->filtros['id_curso']);
            });
        }
        if (!empty($this->filtros['id_nivel'])) {
            $query->whereHas('inscripcion', function($q) {
                $q->where('id_nivel', $this->filtros['id_nivel']);
            });
        }
        if (!empty($this->filtros['id_sucursal'])) {
            $query->whereHas('inscripcion', function($q) {
                $q->where('id_sucursal', $this->filtros['id_sucursal']);
            });
        }
        $notas = $query->get();
        return view('exports.ingreso_punteos', [
            'notas' => $notas
        ]);
    }
}
