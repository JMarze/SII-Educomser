<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Alumno;
use App\Persona;
use App\Expedicion;
use App\Profesion;
use App\Grado;
use App\Http\Requests\AlumnoRequest;

use DB;

class AlumnoController extends Controller
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
        if ($request->buscar_persona){
            $alumnos = Alumno::search($request->buscar_persona)->orderBy('alumnos.updated_at', 'DESC')->paginate(10);
            $alumnos->appends(['buscar_persona' => $request->buscar_persona]);
        }else{
            $alumnos = Alumno::orderBy('alumnos.updated_at', 'DESC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.alumno.partial.table')->with('alumnos', $alumnos)->render());
        }
        return view('admin.alumno.index')->with('alumnos', $alumnos);
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
    public function store(AlumnoRequest $request)
    {
        $this->validate($request, [
            'codigo' => 'required|string|min:7|max:12|unique:personas',
            'email' => 'string|email|max:50|unique:personas',
        ]);
        if ($request->ajax()){
            try{
                $persona = new Persona($request->all());
                $persona->save();
                $alumno = new Alumno($request->all());
                $alumno->persona_codigo = $persona->codigo;
                $alumno->save();
                flash('Se agregó el alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'success')->important();
                return response()->json([
                    'mensaje' => $persona->codigo,
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
            $alumno = Alumno::find($id);
            return view('admin.alumno.show')->with('alumno', $alumno);
        }catch(\Exception $ex){
            flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
            return redirect()->route('admin.alumno.index');
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
                $alumno = Alumno::join('personas', 'alumnos.persona_codigo', '=', 'personas.codigo')->find($id);
                $expediciones = Expedicion::orderBy('ciudad', 'ASC')->lists('ciudad', 'codigo');
                return response()->json([
                    'alumno' => $alumno,
                    'expediciones' => $expediciones,
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
    public function update(AlumnoRequest $request, $id)
    {
        $alumno = Alumno::find($id);
        $persona = Persona::find($alumno->persona->codigo);
        $this->validate($request, [
            'codigo' => 'required|string|min:7|max:12|unique:personas,codigo,'.$persona->codigo.',codigo',
            'email' => 'string|email|max:50|unique:personas,email,'.$persona->codigo.',codigo',
        ]);
        if ($request->ajax()){
            try{
                $alumno->fill($request->all());
                $persona->fill($request->all());
                $alumno->update();
                $persona->update();
                flash('Se modificó el alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'warning')->important();
                return response()->json([
                    'mensaje' => $alumno->id,
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
                $alumno = Alumno::find($id);
                $persona = Persona::find($alumno->persona->codigo);
                $alumno->delete();
                $persona->delete();
                flash('Se eliminó el alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'danger')->important();
                return response()->json([
                    'mensaje' => $alumno->id,
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
                $expediciones = Expedicion::orderBy('ciudad', 'ASC')->lists('ciudad', 'codigo');
                $profesiones = Grado::join('profesiones', 'grados.id', '=', 'profesiones.grado_id')->orderBy('profesiones.titulo', 'ASC')->select('profesiones.id', DB::raw('CONCAT(grados.abreviatura, " ", profesiones.titulo) AS profesion'))->lists('profesion', 'profesiones.id');
                return response()->json([
                    'expediciones' => $expediciones,
                    'profesiones' => $profesiones,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'expediciones' => null,
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
                $alumno = Alumno::find($id);
                $profesiones = $alumno->persona->profesiones()->join('grados', 'profesiones.grado_id', '=', 'grados.id')->select('profesiones.id', 'grados.abreviatura', 'profesiones.titulo')->get();
                return response()->json([
                    'profesiones' => $profesiones,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'profesiones' => null,
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
                $alumno = Alumno::find($id);
                $persona = Persona::find($alumno->persona->codigo);
                $alumno->persona->profesiones()->detach();
                for($i=0; $i<count($request['profesiones_id']); $i++){
                    $alumno->persona->profesiones()->attach($request['profesiones_id'][$i]);
                }
                $alumno->updated_at = Carbon::now();
                $alumno->update();
                flash('Se vincularon las profesiones al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'success')->important();
                return response()->json([
                    'mensaje' => $alumno->id,
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