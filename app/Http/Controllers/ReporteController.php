<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Inscripcion;
use App\InscripcionCarrera;
use App\Alumno;
use App\Curso;
use App\Carrera;

class ReporteController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }

    public function boletaInscripcion($idInscripcion){
        $inscripcion = Inscripcion::find($idInscripcion);
        $alumno = Alumno::find($inscripcion->alumno_id);
        $curso = Curso::find($inscripcion->lanzamientoCurso->curso->codigo);

        return view('admin.reporte.boleta_inscripcion')
            ->with('inscripcion', $inscripcion)
            ->with('alumno', $alumno)
            ->with('curso', $curso);
    }

    public function boletaInscripcionCarrera($idInscripcionCarrera){
        $inscripcionCarrera = InscripcionCarrera::find($idInscripcionCarrera);
        $alumno = Alumno::find($inscripcionCarrera->alumno_id);
        $carrera = Carrera::find($inscripcionCarrera->lanzamientoCarrera->carrera->codigo);

        return view('admin.reporte.boleta_inscripcion_carrera')
            ->with('inscripcion', $inscripcionCarrera)
            ->with('alumno', $alumno)
            ->with('carrera', $carrera);
    }
}
