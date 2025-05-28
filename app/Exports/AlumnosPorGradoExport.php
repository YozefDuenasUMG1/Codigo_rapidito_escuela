<?php

namespace App\Exports;

use App\Models\Alumno;
use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AlumnosPorGradoExport implements FromView
{
    protected $id_grado;
    protected $id_nivel;

    public function __construct($id_grado = null, $id_nivel = null)
    {
        $this->id_grado = $id_grado;
        $this->id_nivel = $id_nivel;
    }

    public function view(): View
    {
        $grados = Grado::all();
        $niveles = Nivel::when($this->id_grado, function($query) {
            return $query->where('id_grado', $this->id_grado);
        })->get();
        $grado = $this->id_grado ? Grado::find($this->id_grado) : null;
        $nivel = $this->id_nivel ? Nivel::find($this->id_nivel) : null;

        if (!$this->id_grado) {
            $alumnos = Alumno::with(['nivel.grado', 'sucursal'])->get();
        } else {
            $alumnos = Alumno::whereHas('nivel', function($query) {
                $query->where('id_grado', $this->id_grado);
                if ($this->id_nivel) {
                    $query->where('id_nivel', $this->id_nivel);
                }
            })->with(['nivel.grado', 'sucursal'])->get();
        }

        return view('exports.alumnos_por_grado', [
            'alumnos' => $alumnos,
            'grado' => $grado,
            'nivel' => $nivel,
            'grados' => $grados,
            'niveles' => $niveles,
            'id_grado' => $this->id_grado,
            'id_nivel' => $this->id_nivel,
        ]);
    }
}
