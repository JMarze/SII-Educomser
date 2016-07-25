<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Area;
use App\Http\Requests\AreaRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar_area){
            $areas = Area::search($request->buscar_area)->orderBy('nombre', 'ASC')->paginate(10);
            $areas->appends(['buscar_area' => $request->buscar_area]);
        }else{
            $areas = Area::orderBy('nombre', 'ASC')->paginate(10);
        }

        if ($request->ajax()){
            return response()->json(view('admin.area.partial.table')->with('areas', $areas)->render());
        }
        return view('admin.area.index')->with('areas', $areas);
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
    public function store(AreaRequest $request)
    {
        if ($request->ajax()){
            try{
                $area = new Area($request->all());
                $area->save();
                flash('Se agregó el área: '.$area->nombre, 'success')->important();
                return response()->json([
                    'mensaje' => $area->id,
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
                $area = Area::find($id);
                return response()->json([
                    'area' => $area,
                    'cursos' => $area->cursos()->count(),
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
    public function update(AreaRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $area = Area::find($id);
                $area->fill($request->all());
                $area->update();
                flash('Se modificó el área: '.$area->nombre, 'warning')->important();
                return response()->json([
                    'mensaje' => $area->id,
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
                $area = Area::find($id);
                $area->delete();
                flash('Se eliminó el área: '.$area->nombre, 'danger')->important();
                return response()->json([
                    'mensaje' => $area->id,
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
