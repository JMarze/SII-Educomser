<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tipo;
use App\Http\Requests\TipoRequest;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar_tipo){
            $tipos = Tipo::search($request->buscar_tipo)->orderBy('nombre', 'ASC')->paginate(10);
            $tipos->appends(['buscar_tipo' => $request->buscar_tipo]);
        }else{
            $tipos = Tipo::orderBy('nombre', 'ASC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.tipo.partial.table')->with('tipos', $tipos)->render());
        }
        return view('admin.tipo.index')->with('tipos', $tipos);
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
    public function store(TipoRequest $request)
    {
        if ($request->ajax()){
            try{
                $tipo = new Tipo($request->all());
                $tipo->horas_reales = ($tipo->horas_reales != 0)?$tip->horas_reales:null;
                $tipo->save();
                flash('Se agregó el tipo de cronograma: '.$tipo->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $tipo->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al agregar... Intenta más tarde', 'danger')->important();
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
                $tipo = Tipo::find($id);
                return response()->json([
                    'tipo' => $tipo,
                    //'cronogramas' => $tipo->cronogramas()->count(),
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al buscar datos... Intenta más tarde', 'danger')->important();
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
    public function update(TipoRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $tipo = Tipo::find($id);
                $tipo->fill($request->all());
                $tipo->horas_reales = ($tipo->horas_reales != 0)?$tip->horas_reales:null;
                $tipo->update();
                flash('Se modificó el tipo de cronograma: '.$tipo->nombre, 'warning')->important();
                return response()->json([
                    'mensaje' => $tipo->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al modificar... Intenta más tarde', 'danger')->important();
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
                $tipo = Tipo::find($id);
                $tipo->delete();
                flash('Se eliminó el tipo de cronograma: '.$tipo->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $tipo->id,
                ]);
            }catch(\Exception $ex){
                flash('Wow!!! se presentó un problema al eliminar... Intenta más tarde', 'danger')->important();
                return response()->json([
                    'mensaje' => $ex->getMessage(),
                ]);
            }
        }
    }
}
