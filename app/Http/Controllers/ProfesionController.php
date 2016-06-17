<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Profesion;
use App\Grado;
use App\Http\Requests\ProfesionRequest;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar_profesion){
            $profesiones = Profesion::search($request->buscar_profesion)->orderBy('titulo', 'ASC')->paginate(10);
            $profesiones->appends(['buscar_profesion' => $request->buscar_profesion]);
        }else{
            $profesiones = Profesion::orderBy('titulo', 'ASC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.profesion.partial.table')->with('profesiones', $profesiones)->render());
        }
        return view('admin.profesion.index')->with('profesiones', $profesiones);
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
    public function store(ProfesionRequest $request)
    {
        if ($request->ajax()){
            try{
                $profesion = new Profesion($request->all());
                $profesion->save();
                flash()->success('Se agregó la profesión: '.$profesion->nombre);
                return response()->json([
                    'mensaje' => $profesion->id,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al agregar... Intenta más tarde');
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
    public function edit(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $profesion = Profesion::find($id);
                $grados = Grado::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');
                return response()->json([
                    'profesion' => $profesion,
                    'grados' => $grados,
                    //'personas' => $profesion->personas()->count(),
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al buscar datos... Intenta más tarde');
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
    public function update(ProfesionRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $profesion = Profesion::find($id);
                $profesion->fill($request->all());
                $profesion->update();
                flash()->warning('Se modificó la profesión: '.$profesion->nombre);
                return response()->json([
                    'mensaje' => $profesion->id,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al modificar... Intenta más tarde');
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
                $profesion = Profesion::find($id);
                $profesion->delete();
                flash()->error('Se eliminó la profesión: '.$profesion->nombre);
                return response()->json([
                    'mensaje' => $profesion->id,
                ]);
            }catch(\Exception $ex){
                flash()->error('Wow!!! se presentó un problema al eliminar... Intenta más tarde');
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
                $grados = Grado::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');
                return response()->json([
                    'grados' => $grados,
                ]);
            }catch(\Exception $ex){
                return response()->json([
                    'grados' => null,
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
