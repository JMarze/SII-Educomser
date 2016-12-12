<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\LanzamientoCurso;
use App\LanzamientoCarrera;
use App\Curso;
use App\Carrera;
use App\Alumno;
use App\Docente;
use App\Area;

class HomeController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        CarbonInterval::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lanzamientosCurso = LanzamientoCurso::join('cronogramas', 'lanzamiento_curso.cronograma_id', '=', 'cronogramas.id')->join('cursos', 'lanzamiento_curso.curso_codigo', '=', 'cursos.codigo')->join('tipos', 'cronogramas.tipo_id', '=', 'tipos.id')->orderBy('cronogramas.inicio', 'ASC')->where([['cronogramas.slider', '=', '1'], ['tipos.mostrar_cronograma', '=', '1'], ])->get();

        $lanzamientosCarrera = LanzamientoCarrera::join('cronogramas', 'lanzamiento_carrera.cronograma_id', '=', 'cronogramas.id')->join('carreras', 'lanzamiento_carrera.carrera_codigo', '=', 'carreras.codigo')->join('tipos', 'cronogramas.tipo_id', '=', 'tipos.id')->orderBy('cronogramas.inicio', 'ASC')->where([['cronogramas.slider', '=', '1'], ['tipos.mostrar_cronograma', '=', '1'], ])->get();

        $duraciones = collect();
        foreach($lanzamientosCurso as $lanzamientoCurso){
            $totalHoras = $lanzamientoCurso->curso->horas_reales;
            $meses = floor($totalHoras/30);
            if($lanzamientoCurso->cronograma->tipo->horas_reales == null){
                $semanas = floor(($totalHoras-(30*$meses))/7.5);
                $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
                $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
                $duraciones->put($lanzamientoCurso->curso_codigo, $duracion);
            }else{
                $duracion = '4 sábados';
                $duraciones->put($lanzamientoCurso->curso_codigo, $duracion);
            }
        }

        $duraciones_carrera = collect();
        foreach($lanzamientosCarrera as $lanzamientoCarrera){
            $totalHoras = $lanzamientoCarrera->carrera->cursos->sum('horas_reales');
            $meses = floor($totalHoras/30);
            $semanas = floor(($totalHoras-(30*$meses))/7.5);
            $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
            $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
            $duraciones_carrera->put($lanzamientoCarrera->carrera_codigo, $duracion);
        }

        $cursos = Curso::orderBy('updated_at', 'DESC')->where('vigente', '=', '1')->take(4)->get();
        $carreras = Carrera::orderBy('updated_at', 'DESC')->where('vigente', '=', '1')->take(4)->get();

        $totalCursos = Curso::get()->count();
        $totalCursosVigentes = Curso::where('vigente', '=', '1')->get()->count();
        $totalCarreras = Carrera::get()->count();
        $totalCarrerasVigentes = Carrera::where('vigente', '=', '1')->get()->count();

        $totalAlumnos = Alumno::get()->count();

        return view('index')
            ->with('lanzamientosCurso', $lanzamientosCurso)->with('duraciones', $duraciones)
            ->with('lanzamientosCarrera', $lanzamientosCarrera)->with('duraciones_carrera', $duraciones_carrera)
            ->with('cursos', $cursos)
            ->with('totalCursos', $totalCursos)->with('totalCursosVigentes', $totalCursosVigentes)
            ->with('carreras', $carreras)
            ->with('totalCarreras', $totalCarreras)->with('totalCarrerasVigentes', $totalCarrerasVigentes)
            ->with('totalAlumnos', $totalAlumnos);
    }

    public function cursos(){
        $cursos = Curso::where('vigente', '=', '1')->orderBy('nombre', 'ASC')->get();
        $areas = Area::orderBy('nombre', 'ASC')->get();

        return view('curso.index')
            ->with('cursos', $cursos)
            ->with('areas', $areas);
    }

    public function verCurso($codigoCurso){
        $curso = Curso::find($codigoCurso);

        $totalHoras = $curso->horas_reales;
        $meses = floor($totalHoras/30);
        $semanas = floor(($totalHoras-(30*$meses))/7.5);
        $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
        $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);

        return view('curso.show')->with('curso', $curso)->with('duracion', $duracion);
    }

    public function carreras(){
        $carreras = Carrera::where('vigente', '=', '1')->orderBy('nombre', 'ASC')->get();

        return view('carrera.index')
            ->with('carreras', $carreras);
    }

    public function verCarrera($codigoCarrera){
        $carrera = Carrera::find($codigoCarrera);

        $totalHoras = $carrera->cursos->sum('horas_reales');
        $meses = floor($totalHoras/30);
        $semanas = floor(($totalHoras-(30*$meses))/7.5);
        $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
        $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);

        return view('carrera.show')->with('carrera', $carrera)->with('duracion', $duracion);
    }

    public function verCronograma(){
        $lanzamientosCurso = LanzamientoCurso::join('cronogramas', 'lanzamiento_curso.cronograma_id', '=', 'cronogramas.id')->join('cursos', 'lanzamiento_curso.curso_codigo', '=', 'cursos.codigo')->join('tipos', 'cronogramas.tipo_id', '=', 'tipos.id')->orderBy('cronogramas.inicio', 'ASC')->where('tipos.mostrar_cronograma', '=', '1')->get();

        $lanzamientosCarrera = LanzamientoCarrera::join('cronogramas', 'lanzamiento_carrera.cronograma_id', '=', 'cronogramas.id')->join('carreras', 'lanzamiento_carrera.carrera_codigo', '=', 'carreras.codigo')->join('tipos', 'cronogramas.tipo_id', '=', 'tipos.id')->orderBy('cronogramas.inicio', 'ASC')->where('tipos.mostrar_cronograma', '=', '1')->get();

        $duraciones = collect();
        foreach($lanzamientosCurso as $lanzamientoCurso){
            $totalHoras = $lanzamientoCurso->curso->horas_reales;
            $meses = floor($totalHoras/30);
            if($lanzamientoCurso->cronograma->tipo->horas_reales == null){
                $semanas = floor(($totalHoras-(30*$meses))/7.5);
                $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
                $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
                $duraciones->put($lanzamientoCurso->curso_codigo, $duracion);
            }else{
                $duracion = '4 sábados';
                $duraciones->put($lanzamientoCurso->curso_codigo, $duracion);
            }
        }

        $duraciones_carrera = collect();
        foreach($lanzamientosCarrera as $lanzamientoCarrera){
            $totalHoras = $lanzamientoCarrera->carrera->cursos->sum('horas_reales');
            $meses = floor($totalHoras/30);
            $semanas = floor(($totalHoras-(30*$meses))/7.5);
            $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
            $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
            $duraciones_carrera->put($lanzamientoCarrera->carrera_codigo, $duracion);
        }

        return view('cronograma.show')
            ->with('lanzamientosCurso', $lanzamientosCurso)->with('duraciones', $duraciones)
            ->with('lanzamientosCarrera', $lanzamientosCarrera)->with('duraciones_carrera', $duraciones_carrera);
    }

    public function contacto(){
        return view('contacto');
    }
}
