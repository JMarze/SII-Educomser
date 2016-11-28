<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Curso;
use App\Carrera;
use App\Docente;

class AyudaController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        CarbonInterval::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }

    public function cursos(Request $request){
        if ($request->buscar_curso){
            $cursos = Curso::search($request->buscar_curso)->where('vigente', '=', '1')->orderBy('nombre', 'ASC')->paginate(10);
            $cursos->appends(['buscar_curso' => $request->buscar_curso]);
        }else{
            $cursos = Curso::where('vigente', '=', '1')->orderBy('nombre', 'ASC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.ayuda.partial.table_cursos')->with('cursos', $cursos)->render());
        }
        return view('admin.ayuda.index_cursos')->with('cursos', $cursos);
    }

    public function carreras(Request $request){
        if ($request->buscar_carrera){
            $carreras = Carrera::search($request->buscar_carrera)->where('vigente', '=', '1')->orderBy('nombre', 'ASC')->paginate(10);
            $carreras->appends(['buscar_carrera' => $request->buscar_carrera]);
        }else{
            $carreras = Carrera::where('vigente', '=', '1')->orderBy('nombre', 'ASC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.ayuda.partial.table_carreras')->with('carreras', $carreras)->render());
        }
        return view('admin.ayuda.index_carreras')->with('carreras', $carreras);
    }

    public function docentes(Request $request){
        if ($request->buscar_persona){
            $docentes = Docente::search($request->buscar_persona)->where('vigente', '=', '1')->orderBy('docentes.updated_at', 'DESC')->paginate(10);
            $docentes->appends(['buscar_persona' => $request->buscar_persona]);
        }else{
            $docentes = Docente::where('vigente', '=', '1')->orderBy('docentes.updated_at', 'DESC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.docente.partial.table')->with('docentes', $docentes)->render());
        }
        return view('admin.ayuda.index_docentes')->with('docentes', $docentes);
    }
}
