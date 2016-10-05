<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Cronograma;
use App\LanzamientoCurso;
use App\Tipo;
use App\Curso;
use App\Docente;

use App\Http\Requests\CronogramaRequest;

use DB;

class CronogramaController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->buscar_cronograma){
            $lanzamientosCursos = LanzamientoCurso::search($request->buscar_cronograma)->orderBy('cronogramas.inicio', 'DES')->paginate(10);
            $lanzamientosCursos->appends(['buscar_cronograma' => $request->buscar_cronograma]);
        }else{
            $lanzamientosCursos = LanzamientoCurso::join('cronogramas', 'lanzamiento_curso.cronograma_id', '=', 'cronogramas.id')->orderBy('cronogramas.inicio', 'DES')->paginate(10);
        }

        if($request->ajax()){
            return response()->json(view('admin.cronograma.partial.table')->with('lanzamientosCursos', $lanzamientosCursos)->render());
        }
        return view('admin.cronograma.index')->with('lanzamientosCursos', $lanzamientosCursos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCurso(CronogramaRequest $request)
    {
        $this->validate($request, [
            'costo' => 'required|numeric|min:0',
            'curso_codigo' => 'required|exists:cursos,codigo',
        ]);
        if ($request->ajax()){
            try{
                $cronograma = new Cronograma($request->all());
                $cronograma->save();
                $lanzamientoCurso = new LanzamientoCurso($request->all());
                $lanzamientoCurso->cronograma_id = $cronograma->id;
                $lanzamientoCurso->save();
                flash('Se agregó el curso: '.$lanzamientoCurso->curso->nombre.' al cronograma', 'success')->important();
                return response()->json([
                    'mensaje' => $cronograma->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al agregar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCurso(Request $request, $lanzamientoCursoId)
    {
        if ($request->ajax()){
            try{
                $lanzamientoCurso = LanzamientoCurso::join('cronogramas', 'lanzamiento_curso.cronograma_id', '=', 'cronogramas.id')->find($lanzamientoCursoId);
                $tipos = Tipo::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                $cursos = Curso::orderBy('codigo', 'ASC')->lists('nombre', 'codigo');
                return response()->json([
                    'lanzamientoCurso' => $lanzamientoCurso,
                    'inicio' => Carbon::createFromFormat('Y-m-d H:i:s', $lanzamientoCurso->cronograma->inicio)->format('Y-m-d\TH:i'),
                    'tipos' => $tipos,
                    'cursos' => $cursos,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCurso(CronogramaRequest $request, $lanzamientoId)
    {
        $this->validate($request, [
            'costo' => 'required|numeric|min:0',
            'curso_codigo' => 'required|exists:cursos,codigo',
        ]);
        if ($request->ajax()){
            try{
                $lanzamientoCurso = LanzamientoCurso::find($lanzamientoId);
                $lanzamientoCurso->fill($request->all());
                $cronograma = Cronograma::find($lanzamientoCurso->cronograma->id);
                $cronograma->fill($request->all());
                $lanzamientoCurso->update();
                $cronograma->update();

                flash('Se modificó el cronograma del curso: '.$lanzamientoCurso->curso->nombre.' al cronograma', 'warning')->important();
                return response()->json([
                    'mensaje' => $cronograma->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al modificar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCurso(Request $request, $lanzamientoId)
    {
        if ($request->ajax()){
            try{
                $lanzamientoCurso = LanzamientoCurso::find($lanzamientoId);
                $cronograma = Cronograma::find($lanzamientoCurso->cronograma->id);
                $lanzamientoCurso->delete();
                $cronograma->delete();
                flash('Se eliminó el cronograma para el curso: '.$lanzamientoCurso->curso->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $cronograma->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     *
     *
     */
    public function listar(Request $request){
        if ($request->ajax()){
            try{
                $tipos = Tipo::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                $cursos = Curso::orderBy('codigo', 'ASC')->lists('nombre', 'codigo');
                $docentes = Docente::join('personas', 'docentes.persona_codigo', '=', 'personas.codigo')->orderBy('personas.primer_apellido', 'ASC')->select('docentes.id', DB::raw('CONCAT(personas.primer_apellido, " ", personas.segundo_apellido, " ", personas.nombres) AS nombre_completo'))->lists('nombre_completo', 'id');
                return response()->json([
                    'tipos' => $tipos,
                    'cursos' => $cursos,
                    'docentes' => $docentes,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'tipos' => null,
                    'cursos' => null,
                    'docentes' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     *
     *
     */
    public function attach(Request $request, $lanzamientoId){
        if ($request->ajax()){
            try{
                $lanzamientoCurso = LanzamientoCurso::find($lanzamientoId);
                $docentes = $lanzamientoCurso->docentes()->join('personas', 'docentes.persona_codigo', '=', 'personas.codigo')->orderBy('personas.primer_apellido', 'ASC')->select('docentes.id', DB::raw('CONCAT(personas.primer_apellido, " ", personas.segundo_apellido, " ", personas.nombres) AS nombre_completo'))->get();
                return response()->json([
                    'docentes' => $docentes,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'docentes' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     *
     *
     */
    public function postattach(Request $request, $lanzamientoId){
        if ($request->ajax()){
            try{
                $lanzamientoCurso = LanzamientoCurso::find($lanzamientoId);
                $lanzamientoCurso->docentes()->detach();
                for($i=0; $i<count($request['docentes_id']); $i++){
                    $lanzamientoCurso->docentes()->attach($request['docentes_id'][$i]);
                }
                $lanzamientoCurso->updated_at = Carbon::now();
                $lanzamientoCurso->update();
                flash('Se vincularon los docentes al curso', 'success')->important();
                return response()->json([
                    'mensaje' => $lanzamientoCurso->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al vincular... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
