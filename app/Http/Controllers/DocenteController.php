<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Docente;
use App\Persona;
use App\Expedicion;
use App\Http\Requests\DocenteRequest;

class DocenteController extends Controller
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
            $docentes = Docente::search($request->buscar_persona)->orderBy('docentes.updated_at', 'DESC')->paginate(10);
            $docentes->appends(['buscar_persona' => $request->buscar_persona]);
        }else{
            $docentes = Docente::orderBy('docentes.updated_at', 'DESC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.docente.partial.table')->with('docentes', $docentes)->render());
        }
        return view('admin.docente.index')->with('docentes', $docentes);
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
    public function store(DocenteRequest $request)
    {
        $this->validate($request, [
            'codigo' => 'required|string|min:7|max:12|unique:personas',
            'email' => 'string|email|max:50|unique:personas',
            'email_institucional' => 'string|email|max:50|unique:docentes',
            'social_facebook' => 'string|url|max:100|unique:docentes',
            'social_twitter' => 'string|url|max:100|unique:docentes',
            'social_googleplus' => 'string|url|max:100|unique:docentes',
            'social_youtube' => 'string|url|max:100|unique:docentes',
            'social_linkedin' => 'string|url|max:100|unique:docentes',
            'social_website' => 'string|url|max:100|unique:docentes',
        ]);
        if ($request->ajax()){
            try{
                $persona = new Persona($request->all());
                $persona->save();
                $docente = new Docente($request->all());
                $docente->persona_codigo = $persona->codigo;
                $docente->save();
                flash('Se agregó el docente: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'success')->important();
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
            $docente = Docente::find($id);
            return view('admin.docente.show')->with('docente', $docente);
        }catch(\Exception $ex){
            flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
            return redirect()->route('admin.docente.index');
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
                $docente = Docente::join('personas', 'docentes.persona_codigo', '=', 'personas.codigo')->find($id);
                $expediciones = Expedicion::orderBy('ciudad', 'ASC')->lists('ciudad', 'codigo');
                return response()->json([
                    'docente' => $docente,
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
    public function update(DocenteRequest $request, $id)
    {
        $docente = Docente::find($id);
        $persona = Persona::find($docente->persona->codigo);
        $this->validate($request, [
            'codigo' => 'required|string|min:7|max:12|unique:personas,codigo,'.$persona->codigo.',codigo',
            'email' => 'string|email|max:50|unique:personas,email,'.$persona->codigo.',codigo',
            'email_institucional' => 'string|email|max:50|unique:docentes,email_institucional,'.$docente->id,
            'social_facebook' => 'string|url|max:100|unique:docentes,social_facebook,'.$docente->id,
            'social_twitter' => 'string|url|max:100|unique:docentes,social_twitter,'.$docente->id,
            'social_googleplus' => 'string|url|max:100|unique:docentes,social_googleplus,'.$docente->id,
            'social_youtube' => 'string|url|max:100|unique:docentes,social_youtube,'.$docente->id,
            'social_linkedin' => 'string|url|max:100|unique:docentes,social_linkedin,'.$docente->id,
            'social_website' => 'string|url|max:100|unique:docentes,social_website,'.$docente->id,
        ]);
        if ($request->ajax()){
            try{
                $docente->fill($request->all());
                $persona->fill($request->all());
                $docente->update();
                $persona->update();
                flash('Se modificó el docente: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'warning')->important();
                return response()->json([
                    'mensaje' => $docente->id,
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
                $docente = Docente::find($id);
                $persona = Persona::find($docente->persona->codigo);
                $docente->delete();
                $persona->delete();
                flash('Se eliminó el docente: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres, 'danger')->important();
                return response()->json([
                    'mensaje' => $docente->id,
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
                return response()->json([
                    'expediciones' => $expediciones,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'expediciones' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
