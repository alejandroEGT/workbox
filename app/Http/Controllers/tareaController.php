<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class tareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(Request $request)
    {
        $fecha = $request->fecha;
        $t = new Tarea;
        $t->nombre = $request->nombre;
        $t->fecha_inicio = date('Y-m-d', strtotime($fecha[0]));
        $t->fecha_fin = date('Y-m-d', strtotime($fecha[1]));
        $t->horas_estimadas = $request->hora_estimada;
        $t->id_proyecto = $request->id_proyecto;
        $t->id_user = Auth::user()->id;
        $t->estado = $request->estado_tarea;
        if ($t->save()) {
            return "success";
        }
        return "failed";
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
    public function estados_tarea()
    {
        return DB::table('estado_tarea')->get();
    }
    public function traer_tareas_by_proyecto($id_proyecto)
    {
        $t = Tarea::join('estado_tarea as et','et.id','tarea.estado')
        ->where([
            'id_user'=> Auth::user()->id,
            'id_proyecto'=> $id_proyecto
        ])->get();
        if (count($t)>0) {
            return [
                'tareas' => $t,
                'estado' => 'success'
            ];
        }

        return "failed";
    }
}
