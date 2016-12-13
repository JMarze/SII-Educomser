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
use App\Docente;

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

    public function seguimientoCurso($idInscripcion){
        $inscripcion = Inscripcion::find($idInscripcion);
        $alumno = Alumno::find($inscripcion->alumno_id);
        $docentes = $inscripcion->lanzamientoCurso->docentes;
        $curso = Curso::find($inscripcion->lanzamientoCurso->curso->codigo);
        $cantidadClases = $inscripcion->lanzamientoCurso->cronograma->duracion_clase;
        if($inscripcion->lanzamientoCurso->cronograma->tipo->horas_reales != null){
            $cantidadClases = $inscripcion->lanzamientoCurso->cronograma->tipo->horas_reales / $cantidadClases;
        }else{
            $cantidadClases = $inscripcion->lanzamientoCurso->curso->horas_reales / $cantidadClases;
        }

        return view('admin.reporte.seguimiento_curso')
            ->with('inscripcion', $inscripcion)
            ->with('alumno', $alumno)
            ->with('docentes', $docentes)
            ->with('curso', $curso)
            ->with('cantidadClases', $cantidadClases);
    }

    public function seguimientoCarrera($idInscripcionCarrera){
        $inscripcionCarrera = InscripcionCarrera::find($idInscripcionCarrera);
        $alumno = Alumno::find($inscripcionCarrera->alumno_id);
        //$docentes = $inscripcionCarrera->modulos[0]->inscripcion->lanzamientoCurso->docentes;
        $carrera = Carrera::find($inscripcionCarrera->lanzamientoCarrera->carrera->codigo);
        $cursos = $carrera->cursos;
        $cantidadClases = 0;
        foreach($cursos as $curso){
            $cantidadClases += ($curso->horas_reales) / (1.5);
        }

        return view('admin.reporte.seguimiento_carrera')
            ->with('inscripcion', $inscripcionCarrera)
            ->with('alumno', $alumno)
            //->with('docentes', $docentes)
            ->with('carrera', $carrera)
            ->with('cantidadClases', $cantidadClases);
    }

    public function qrcode($idInscripcion){
        $inscripcion = Inscripcion::find($idInscripcion);

        $qrCode = bcrypt($inscripcion->alumno->persona->codigo)
            . "|EDU|" . bcrypt($inscripcion->id)
            . "|EDU|" . $inscripcion->alumno->persona->primer_apellido
            . "|EDU|" . $inscripcion->alumno->persona->segundo_apellido;

        return view('admin.reporte.qr_code')
            ->with('inscripcion', $inscripcion)
            ->with('qrCode', $qrCode);
    }
}
