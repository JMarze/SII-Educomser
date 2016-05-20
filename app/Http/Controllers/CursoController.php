<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Curso;
use App\Area;
use App\Dificultad;
use App\Http\Requests\CursoRequest;

class CursoController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
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
                flash()->success('Se agregó el curso: '.$curso->nombre);
                return response()->json([
                    'mensaje' => $curso->codigo,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al agregar... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex,
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
    public function edit(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $curso = Curso::find($id);
                return response()->json([
                    'curso' => $curso,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al buscar datos... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex,
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
                flash()->warning('Se modificó el curso: '.$curso->nombre);
                return response()->json([
                    'mensaje' => $curso->codigo,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al modificar... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex,
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
                flash()->warning('Se modificó el curso: '.$curso->nombre);
                return response()->json([
                    'mensaje' => $curso->codigo,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al modificar... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex,
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
                \Storage::disk('local')->delete($curso->logo);
                flash()->error('Se eliminó el curso: '.$curso->nombre);
                return response()->json([
                    'mensaje' => $curso->codigo,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al eliminar... Intenta más tarde');
                return response()->json([
                    'mensaje' => $ex,
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
                    'mensaje' => $ex,
                ]);
            }
        }
    }
}
