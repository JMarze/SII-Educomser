<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Inscripcion;
use App\InscripcionCarrera;
use App\Curso;
use App\Carrera;

class InscripcionController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        CarbonInterval::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }

    public function editCurso(Request $request, $id){
        if ($request->ajax()){
            try{
                $inscripcion = Inscripcion::find($id);
                $curso = Curso::find($inscripcion->lanzamientoCurso->curso_codigo);
                return response()->json([
                    'inscripcion' => $inscripcion,
                    'curso' => $curso,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function editCarrera(Request $request, $id){
        if ($request->ajax()){
            try{
                $inscripcionCarrera = InscripcionCarrera::find($id);
                $carrera = Carrera::find($inscripcionCarrera->lanzamientoCarrera->carrera_codigo);
                return response()->json([
                    'inscripcion' => $inscripcionCarrera,
                    'carrera' => $carrera,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function destroyCurso(Request $request, $id){
        if ($request->ajax()){
            try{
                $inscripcion = Inscripcion::find($id);
                $inscripcion->delete();
                flash('Se eliminó la inscripcion al curso: '.$inscripcion->lanzamientoCurso->curso->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $inscripcion->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function destroyCarrera(Request $request, $id){
        if ($request->ajax()){
            try{
                $inscripcionCarrera = InscripcionCarrera::find($id);
                $inscripcionCarrera->delete();
                flash('Se eliminó la inscripcion a la carrera: '.$inscripcionCarrera->lanzamientoCarrera->carrera->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $inscripcionCarrera->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function destroyModulo(Request $request, $idInscripcion, $idInscripcionCarrera){
        if ($request->ajax()){
            try{
                $inscripcionCarrera = InscripcionCarrera::find($idInscripcionCarrera);
                $inscripcionCarrera->modulos()->detach($idInscripcion);

                $inscripcion = Inscripcion::find($idInscripcion);
                $inscripcion->delete();

                flash('Se eliminó la inscripcion al carrera: '.$inscripcion->lanzamientoCurso->curso->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $inscripcionCarrera->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
