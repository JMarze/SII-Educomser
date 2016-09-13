<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Inscripcion;
use App\Cronograma;

class InscripcionController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        CarbonInterval::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }

    public function inscribir(Request $reqeust, $cronogramaId, $alumnoId){
        dd($request->all());
    }
}
