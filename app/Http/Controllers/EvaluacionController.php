<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Inscripcion;

class EvaluacionController extends Controller
{
    public function evaluar($idInscripcion){
        $inscripcion = Inscripcion::find($idInscripcion);

        return view('evaluacion.index')->with('inscripcion', $inscripcion);
    }

    public function registrarEvaluacion($idInscripcion){}
}
