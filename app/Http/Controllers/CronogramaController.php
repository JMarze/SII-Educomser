<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Cronograma;
use App\Tipo;
use App\Curso;
use App\Docente;

use App\Http\Requests\CronogramaRequest;

use DB;

class CronogramaController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        CarbonInterval::setLocale('es');
        setlocale(LC_TIME, "Spanish_Bolivia");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar_cronograma){
            $cronogramas = Cronograma::search($request->buscar_cronograma)->orderBy('inicio', 'DESC')->paginate(10);
            $cronogramas->appends(['buscar_cronograma' => $request->buscar_cronograma]);
        }else{
            $cronogramas = Cronograma::orderBy('inicio', 'DESC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.cronograma.partial.table')->with('cronogramas', $cronogramas)->render());
        }
        return view('admin.cronograma.index')->with('cronogramas', $cronogramas);
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
    public function store(CronogramaRequest $request)
    {
        if ($request->ajax()){
            try{
                $cronograma = new Cronograma($request->all());
                $cronograma->save();
                flash('Se agregó el cronograma para el curso: '.$cronograma->curso->nombre, 'success')->important();
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
        try{
            $cronograma = Cronograma::find($id);

            $totalHoras = ($cronograma->tipo->horas_reales)?$cronograma->tipo->horas_reales:$cronograma->curso->horas_reales;
            $mes = $cronograma->duracion_clase * 20;
            $semana = $cronograma->duracion_clase * 5;
            $dia = $cronograma->duracion_clase;

            $meses = floor($totalHoras/$mes);
            $semanas = floor(($totalHoras-($mes*$meses))/$semana);
            $dias = ceil(($totalHoras-($mes*$meses)-($semana*$semanas))/$dia);

            $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
            return view('admin.cronograma.show')->with('cronograma', $cronograma)->with('duracion', $duracion);
        }catch(\Exception $ex){
            flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
            return redirect()->route('admin.cronograma.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $cronograma = Cronograma::join('cursos', 'cronogramas.curso_codigo', '=', 'cursos.codigo')->find($id);
                $tipos = Tipo::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                $cursos = Curso::orderBy('codigo', 'ASC')->lists('nombre', 'codigo');
                return response()->json([
                    'cronograma' => $cronograma,
                    'inicio' => Carbon::createFromFormat('Y-m-d H:i:s', $cronograma->inicio)->format('Y-m-d\TH:i'),
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
    public function update(CronogramaRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $cronograma = Cronograma::find($id);
                $cronograma->fill($request->all());
                $cronograma->update();
                flash('Se modificó el cronograma para el curso: '.$cronograma->curso->nombre, 'warning')->important();
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $cronograma = Cronograma::find($id);
                $cronograma->delete();
                flash('Se eliminó el cronograma para el curso: '.$cronograma->curso->nombre, 'danger')->important();
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
    public function attach(Request $request, $id){
        if ($request->ajax()){
            try{
                $cronograma = Cronograma::find($id);
                $docentes = $cronograma->docentes()->join('personas', 'docentes.persona_codigo', '=', 'personas.codigo')->orderBy('personas.primer_apellido', 'ASC')->select('docentes.id', DB::raw('CONCAT(personas.primer_apellido, " ", personas.segundo_apellido, " ", personas.nombres) AS nombre_completo'))->get();
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
    public function postattach(Request $request, $id){
        if ($request->ajax()){
            try{
                $cronograma = Cronograma::find($id);
                $cronograma->docentes()->detach();
                for($i=0; $i<count($request['docentes_id']); $i++){
                    $cronograma->docentes()->attach($request['docentes_id'][$i]);
                }
                $cronograma->updated_at = Carbon::now();
                $cronograma->update();
                flash('Se vincularon los docentes al cronograma', 'success')->important();
                return response()->json([
                    'mensaje' => $cronograma->id,
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
