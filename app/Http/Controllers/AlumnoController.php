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
use App\Inscripcion;
use App\InscripcionCarrera;
use App\Historial;
use App\LanzamientoCurso;
use App\Curso;
use App\LanzamientoCarrera;
use App\Cronograma;
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

    /**
     *
     *
     */
    public function postattachcurso(Request $request, $id){
        $this->validate($request, [
            'lanzamiento_curso_id' => 'required|exists:lanzamiento_curso,id',
            'publicidad_id' => 'required|exists:publicidades,id',
            'tipo_asistencia' => 'required|in:hoja,qr',
        ]);
        if ($request->ajax()){
            try{
                $alumno = Alumno::find($id);
                $persona = Persona::find($alumno->persona->codigo);
                $lanzamientoCurso = LanzamientoCurso::find($request->lanzamiento_curso_id);
                $inscripcion = new Inscripcion($request->all());
                $inscripcion->alumno_id = $id;
                $inscripcion->save();
                flash('Se inscribió al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres.' al curso: '.$lanzamientoCurso->curso->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $inscripcion->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al inscribir... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
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
    public function postattachmodulo(Request $request, $codigoPersona, $idInscripcionCarrera){
        $this->validate($request, [
            'modulo_id' => 'required|exists:lanzamiento_curso,id',
            'publicidad_id' => 'required|exists:publicidades,id',
            'tipo_asistencia' => 'required|in:hoja,qr',
        ]);
        if ($request->ajax()){
            try{
                $alumno = Alumno::find($codigoPersona);
                $persona = Persona::find($alumno->persona->codigo);
                $lanzamientoCurso = LanzamientoCurso::find($request->modulo_id);
                $inscripcion = new Inscripcion($request->all());
                $inscripcion->alumno_id = $codigoPersona;
                $inscripcion->lanzamiento_curso_id = $lanzamientoCurso->id;
                $inscripcion->modulo_carrera = true;
                $inscripcion->save();

                $inscripcionCarrera = InscripcionCarrera::find($idInscripcionCarrera);
                $inscripcionCarrera->updated_at = Carbon::now();
                $inscripcionCarrera->update();
                $inscripcionCarrera->modulos()->attach($inscripcion->id);

                flash('Se inscribió al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres.' al módulo: '.$lanzamientoCurso->curso->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $inscripcion->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al inscribir... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
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
    public function postattachcarrera(Request $request, $id){
        $this->validate($request, [
            'lanzamiento_carrera_id' => 'required|exists:lanzamiento_carrera,id',
        ]);
        if ($request->ajax()){
            try{
                $alumno = Alumno::find($id);
                $persona = Persona::find($alumno->persona->codigo);
                $lanzamientoCarrera = LanzamientoCarrera::find($request->lanzamiento_carrera_id);
                $inscripcionCarrera = new InscripcionCarrera($request->all());
                $inscripcionCarrera->alumno_id = $id;
                $inscripcionCarrera->save();
                flash('Se inscribió al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres.' a la carrera: '.$lanzamientoCarrera->carrera->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $inscripcionCarrera->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al inscribir... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
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
    public function postattachcursopersonalizado(Request $request, $id){
        $this->validate($request, [
            'curso_codigo' => 'required|exists:cursos,codigo',
            'costo' => 'required|min:0',
            'publicidad_id' => 'required|exists:publicidades,id',
            'tipo_id' => 'required|exists:tipos,id',
            'inicio' => 'required|date',
            'duracion_clase' => 'required|numeric|min:0|max:8',
            'tipo_asistencia' => 'required|in:hoja,qr',
        ]);
        if ($request->ajax()){
            try{
                $cronograma = new Cronograma($request->all());
                $cronograma->save();
                $lanzamientoCurso = new LanzamientoCurso($request->all());
                $lanzamientoCurso->cronograma_id = $cronograma->id;
                $lanzamientoCurso->save();
                $alumno = Alumno::find($id);
                $persona = Persona::find($alumno->persona->codigo);
                $inscripcion = new Inscripcion($request->all());
                $inscripcion->alumno_id = $id;
                $inscripcion->lanzamiento_curso_id = $lanzamientoCurso->id;
                $inscripcion->save();
                flash('Se inscribió al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres.' al curso: '.$lanzamientoCurso->curso->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $inscripcion->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al inscribir... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
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
    public function postattachhistorial(Request $request, $id){
        $this->validate($request, [
            'fecha_finalizacion' => 'required|date',
            'nota' => 'required|min:0|max:100',
            'certificado' => 'required',
        ]);
        if ($request->ajax()){
            try{
                $inscripcion = Inscripcion::find($id);
                $historial = new Historial($request->all());
                $historial->inscripcion_id = $inscripcion->id;
                $historial->save();
                flash('El alumno: '.$inscripcion->alumno->persona->primer_apellido.' '.$inscripcion->alumno->persona->segundo_apellido.' '.$inscripcion->alumno->persona->nombres.' finalizó el curso: '.$inscripcion->lanzamientoCurso->curso->nombre.' con la nota de: '.$historial->nota.'%', 'success')->important();
                return response()->json([
                    'mensaje' => $historial->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al finalizar el curso... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
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
    public function postattachcertificado(Request $request, $id){
        $this->validate($request, [
            'certificado' => 'required',
        ]);
        if ($request->ajax()){
            try{
                $historial = Historial::find($id);
                $historial->certificado = $request->certificado;
                $historial->update();

                $curso = Curso::find($historial->inscripcion->lanzamientoCurso->curso->codigo);

                $persona = Persona::find($historial->inscripcion->alumno->persona->codigo);

                if($historial->certificado){
                    flash('Se extendió certificado al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres.' por el curso: '.$curso->nombre, 'success')->important();
                }else{
                    flash('No se extendió certificado al alumno: '.$persona->primer_apellido.' '.$persona->segundo_apellido.' '.$persona->nombres.' por el curso: '.$curso->nombre, 'warning')->important();
                }

                return response()->json([
                    'mensaje' => $historial->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al finalizar el curso... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
