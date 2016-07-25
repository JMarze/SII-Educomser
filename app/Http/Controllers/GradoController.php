<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Grado;
use App\Http\Requests\GradoRequest;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar_grado){
            $grados = Grado::search($request->buscar_grado)->orderBy('descripcion', 'ASC')->paginate(10);
            $grados->appends(['buscar_grado' => $request->buscar_grado]);
        }else{
            $grados = Grado::orderBy('descripcion', 'ASC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.grado.partial.table')->with('grados', $grados)->render());
        }
        return view('admin.grado.index')->with('grados', $grados);
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
    public function store(GradoRequest $request)
    {
        if ($request->ajax()){
            try{
                $grado = new Grado($request->all());
                $grado->save();
                flash('Se agregó el grado: '.$grado->descripcion, 'success')->important();
                return response()->json([
                    'mensaje' => $grado->id,
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
    public function edit(Request $request, $id)
    {
        if ($request->ajax()){
            try{
                $grado = Grado::find($id);
                return response()->json([
                    'grado' => $grado,
                    'profesiones' => $grado->profesiones()->count(),
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
    public function update(GradoRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $grado = Grado::find($id);
                $grado->fill($request->all());
                $grado->update();
                flash('Se modificó el grado: '.$grado->descripcion, 'warning')->important();
                return response()->json([
                    'mensaje' => $grado->id,
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
                $grado = Grado::find($id);
                $grado->delete();
                flash('Se eliminó el grado: '.$grado->descripcion, 'danger')->important();
                return response()->json([
                    'mensaje' => $grado->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde. El mensaje es el siguiente: '.$ex->getMessage(), 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
