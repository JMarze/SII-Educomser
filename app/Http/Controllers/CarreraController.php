<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Carrera;
use App\Curso;
use App\Http\Requests\CarreraRequest;

class CarreraController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        CarbonInterval::setLocale('es');
        setlocale(LC_TIME, 'Spanish_Bolivia');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar_carrera){
            $carreras = Carrera::search($request->buscar_carrera)->orderBy('updated_at', 'DESC')->paginate(10);
            $carreras->appends(['buscar_carrera' => $request->buscar_carrera]);
        }else{
            $carreras = Carrera::orderBy('updated_at', 'DESC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.carrera.partial.table')->with('carreras', $carreras)->render());
        }
        return view('admin.carrera.index')->with('carreras', $carreras);
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
    public function store(CarreraRequest $request)
    {
        if ($request->ajax()){
            try{
                $carrera = new Carrera($request->all());
                $carrera->save();
                flash('Se agregó la carrera: '.$carrera->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
            $carrera = Carrera::find($id);
            $totalHoras = $carrera->cursos->sum('horas_reales');
            $meses = floor($totalHoras/30);
            $semanas = floor(($totalHoras-(30*$meses))/7.5);
            $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
            $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
            return view('admin.carrera.show')->with('carrera', $carrera)->with('duracion', $duracion);
        }catch(\Exception $ex){
            flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
            return redirect()->route('admin.carrera.index');
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
                $carrera = Carrera::find($id);
                return response()->json([
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarreraRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $carrera = Carrera::find($id);
                $carrera->fill($request->all());
                $carrera->update();
                flash('Se modificó la carrera: '.$carrera->nombre, 'warning')->important();
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
     * Upload Logo
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'logo' => 'required|image',
        ]);
        if ($request->ajax()){
            try{
                $carrera = Carrera::find($id);
                $carrera->logo = $request->logo;
                $carrera->update();
                flash('Se modificó la carrera: '.$carrera->nombre, 'warning')->important();
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
                $carrera = Carrera::find($id);
                $carrera->delete();
                if ($carrera->logo != null){
                    if (\Storage::disk('local')->exists($carrera->logo)){
                        \Storage::disk('local')->delete($carrera->logo);
                    }
                }
                flash('Se eliminó la carrera: '.$carrera->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
                $cursos = Curso::orderBy('nombre', 'ASC')->lists('nombre', 'codigo');
                return response()->json([
                    'cursos' => $cursos,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'cursos' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     *
     *
     */
    public function verLogo($nombreLogo){
        $logo = \Storage::disk('local')->get($nombreLogo);
        return new Response($logo, 200);
    }

    /**
     *
     *
     */
    public function attach(Request $request, $id){
        if ($request->ajax()){
            try{
                $carrera = Carrera::find($id);
                $cursos = $carrera->cursos()->orderBy('carrera_curso.orden', 'ASC')->get();
                return response()->json([
                    'cursos' => $cursos,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'cursos' => null,
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
                $carrera = Carrera::find($id);
                $carrera->cursos()->detach();
                for($i=0; $i<count($request['curso_codigo']); $i++){
                    $carrera->cursos()->attach([
                        $request['curso_codigo'][$i] => ['orden' => $request['curso_orden'][$i]]
                    ]);
                }
                $carrera->updated_at = Carbon::now();
                $carrera->update();
                flash('Se vincularon los cursos a la carrera: '.$carrera->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
