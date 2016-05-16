<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon\Carbon;

use App\Carrera;
use App\Http\Requests\CarreraRequest;

class CarreraController extends Controller
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
        $carreras = Carrera::orderBy('updated_at', 'DESC')->paginate(10);
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
                flash()->success('Se agregó la carrera: '.$carrera->nombre);
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
                $carrera = Carrera::find($id);
                return response()->json([
                    'carrera' => $carrera,
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
    public function update(CarreraRequest $request, $id)
    {
        if ($request->ajax()){
            try{
                $carrera = Carrera::find($id);
                $carrera->fill($request->all());
                $carrera->update();
                flash()->warning('Se modificó la carrera: '.$carrera->nombre);
                return response()->json([
                    'mensaje' => $carrera->codigo,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
