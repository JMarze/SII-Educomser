<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;

use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Curso;
use App\Area;
use App\Dificultad;
use App\Capitulo;
use App\Topico;
use App\Http\Requests\CursoRequest;
use App\Http\Requests\CapituloRequest;
use App\Http\Requests\TopicoRequest;

class CursoController extends Controller
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
        if ($request->buscar_curso){
            $cursos = Curso::search($request->buscar_curso)->orderBy('updated_at', 'DESC')->paginate(10);
            $cursos->appends(['buscar_curso' => $request->buscar_curso]);
        }else{
            $cursos = Curso::orderBy('updated_at', 'DESC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.curso.partial.table')->with('cursos', $cursos)->render());
        }
        return view('admin.curso.index')->with('cursos', $cursos);
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
    public function store(CursoRequest $request)
    {
        if ($request->ajax()){
            try{
                $curso = new Curso($request->all());
                $curso->save();
                flash('Se agregó el curso: '.$curso->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $curso->codigo,
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
            $curso = Curso::find($id);
            $totalHoras = $curso->horas_reales;
            $meses = floor($totalHoras/30);
            $semanas = floor(($totalHoras-(30*$meses))/7.5);
            $dias = ceil(($totalHoras-(30*$meses)-(7.5*$semanas))/1.5);
            $duracion = CarbonInterval::create(0, $meses, $semanas, $dias, 0, 0, 0);
            return view('admin.curso.show')->with('curso', $curso)->with('duracion', $duracion);
        }catch(\Exception $ex){
            flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
            return redirect()->route('admin.curso.index');
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
                $curso = Curso::find($id);
                $areas = Area::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                $dificultades = Dificultad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                return response()->json([
                    'curso' => $curso,
                    'areas' => $areas,
                    'dificultades' => $dificultades,
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
    public function update(CursoRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $curso = Curso::find($id);
                $curso->fill($request->all());
                $curso->update();
                flash('Se modificó el curso: '.$curso->nombre, 'warning')->important();
                return response()->json([
                    'mensaje' => $curso->codigo,
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
                $curso = Curso::find($id);
                $curso->logo = $request->logo;
                $curso->update();
                flash('Se modificó el curso: '.$curso->nombre, 'warning')->important();
                return response()->json([
                    'mensaje' => $curso->codigo,
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
                $curso = Curso::find($id);
                $curso->delete();
                if ($curso->logo != null){
                    if (\Storage::disk('local')->exists($curso->logo)){
                        \Storage::disk('local')->delete($curso->logo);
                    }
                }
                flash('Se eliminó el curso: '.$curso->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $curso->codigo,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function create_capitulo(CapituloRequest $request, $id){
        if ($request->ajax()){
            try{
                $curso = Curso::find($id);
                $capitulo = new Capitulo($request->all());
                $capitulo->save();
                flash('Se agregó el capítulo: '.$capitulo->titulo.' al curso: '.$curso->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $capitulo->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al agregar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }

    public function create_topico(TopicoRequest $request, $id){
        if ($request->ajax()){
            try{
                $capitulo = Capitulo::find($id);
                $topico = new Topico($request->all());
                $topico->save();
                flash('Se agregó el subtítulo: '.$topico->subtitulo.' al capítulo: '.$capitulo->titulo, 'success')->important();
                return response()->json([
                    'mensaje' => $topico->id,
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
     *
     *
     */
    public function listar(Request $request){
        if ($request->ajax()){
            try{
                $areas = Area::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                $dificultades = Dificultad::orderBy('nombre', 'ASC')->lists('nombre', 'id');
                return response()->json([
                    'areas' => $areas,
                    'dificultades' => $dificultades,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'areas' => null,
                    'dificultades' => null,
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
}
