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
        $carreras = Carrera::orderBy('created_at', 'DESC')->paginate(10);
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
            $carrera = new Carrera($request->all());
            try{
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
