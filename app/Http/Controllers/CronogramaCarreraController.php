<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;
use App\Cronograma;
use App\LanzamientoCarrera;
use App\Tipo;
use App\Carrera;

use App\Http\Requests\CronogramaRequest;

use DB;

class CronogramaCarreraController extends Controller
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
            $lanzamientosCarreras = LanzamientoCarrera::search($request->buscar_cronograma)->orderBy('cronogramas.inicio', 'DES')->paginate(10);
            $lanzamientosCarreras->appends(['buscar_cronograma' => $request->buscar_cronograma]);
        }else{
            $lanzamientosCarreras = LanzamientoCarrera::join('cronogramas', 'lanzamiento_carrera.cronograma_id', '=', 'cronogramas.id')->orderBy('cronogramas.inicio', 'DES')->paginate(10);
        }

        if($request->ajax()){
            return response()->json(view('admin.cronograma.partial.tablecarrera')->with('lanzamientosCarreras', $lanzamientosCarreras)->render());
        }
        return view('admin.cronograma.indexcarrera')->with('lanzamientosCarreras', $lanzamientosCarreras);
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
    public function storeCarrera(CronogramaRequest $request)
    {
        $this->validate($request, [
            'matricula' => 'required|numeric|min:0',
            'mensualidad' => 'required|numeric|min:0',
            'carrera_codigo' => 'required|exists:carreras,codigo',
        ]);
        if ($request->ajax()){
            try{
                $cronograma = new Cronograma($request->all());
                $cronograma->save();
                $lanzamientoCarrera = new LanzamientoCarrera($request->all());
                $lanzamientoCarrera->cronograma_id = $cronograma->id;
                $lanzamientoCarrera->save();
                flash('Se agregó la carrera: '.$lanzamientoCarrera->carrera->nombre.' al cronograma', 'success')->important();
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
    public function editCarrera(Request $request, $lanzamientoCarreraId)
    {
        if ($request->ajax()){
            try{
                $lanzamientoCarrera = LanzamientoCarrera::join('cronogramas', 'lanzamiento_carrera.cronograma_id', '=', 'cronogramas.id')->find($lanzamientoCarreraId);
                $tipos = Tipo::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                $carreras = Carrera::orderBy('codigo', 'ASC')->lists('nombre', 'codigo');
                return response()->json([
                    'lanzamientoCarrera' => $lanzamientoCarrera,
                    'inicio' => Carbon::createFromFormat('Y-m-d H:i:s', $lanzamientoCarrera->cronograma->inicio)->format('Y-m-d\TH:i'),
                    'tipos' => $tipos,
                    'carreras' => $carreras,
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
    public function updateCarrera(CronogramaRequest $request, $lanzamientoId)
    {
        $this->validate($request, [
            'mensualidad' => 'required|numeric|min:0',
            'matricula' => 'required|numeric|min:0',
            'carrera_codigo' => 'required|exists:carreras,codigo',
        ]);
        if ($request->ajax()){
            try{
                $lanzamientoCarrera = LanzamientoCarrera::find($lanzamientoId);
                $lanzamientoCarrera->fill($request->all());
                $cronograma = Cronograma::find($lanzamientoCarrera->cronograma->id);
                $cronograma->fill($request->all());
                $lanzamientoCarrera->update();
                $cronograma->update();

                flash('Se modificó el cronograma de la carrera: '.$lanzamientoCarrera->carrera->nombre.' al cronograma', 'warning')->important();
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
    public function destroyCarrera(Request $request, $lanzamientoId)
    {
        if ($request->ajax()){
            try{
                $lanzamientoCarrera = LanzamientoCarrera::find($lanzamientoId);
                $cronograma = Cronograma::find($lanzamientoCarrera->cronograma->id);
                $lanzamientoCarrera->delete();
                $cronograma->delete();
                flash('Se eliminó el cronograma para la carrera: '.$lanzamientoCarrera->carrera->nombre, 'danger')->important();
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
                $carreras = Carrera::orderBy('codigo', 'ASC')->lists('nombre', 'codigo');
                return response()->json([
                    'tipos' => $tipos,
                    'carreras' => $carreras,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'tipos' => null,
                    'carreras' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     *
     *
     */
    public function carrerasdisponibles(Request $request){
        if ($request->ajax()){
            try{
                $fecha_actual = '2016-09-01';//Carbon::now();
                $lanzamientoCarrera = LanzamientoCarrera::join('cronogramas', 'lanzamiento_carrera.cronograma_id', '=', 'cronogramas.id')->join('carreras', 'lanzamiento_carrera.carrera_codigo', '=', 'carreras.codigo')->where('cronogramas.inicio', '>=', $fecha_actual)->orderBy('carreras.nombre', 'ASC')->select('lanzamiento_carrera.id AS id', DB::raw('CONCAT("(", carreras.codigo, ")", " ", carreras.nombre, " - ", "Bs ", lanzamiento_carrera.mensualidad) AS carrera'))->lists('carrera', 'id');
                return response()->json([
                    'carreras' => $lanzamientoCarrera,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'carreras' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
