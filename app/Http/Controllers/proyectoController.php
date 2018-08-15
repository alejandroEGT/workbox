<?php

namespace App\Http\Controllers;

use App\Colaborador;
use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class proyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Proyecto::where('id_user',Auth::user()->id)->get();

        if (count($p) > 0) {
            return $p;
        }else{
            return null;
        }
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
        //dd($request->all());
        $p = new Proyecto;
        $p->nombre = $request->nombre;
        $p->cliente = $request->cliente;
        $p->estado = '1';//en desarrollo
        $p->id_user = Auth::user()->id;
        if ($p->save()) {
            $col = new Colaborador;
            $col->id_proyecto = $p->id;
            $col->id_user = Auth::user()->id;
            if($col->save()){
                return "success";
            }
            return "failed";
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
        $p = Proyecto::join('estado_proyecto as ep','ep.id','proyecto.estado')
        ->where('proyecto.id',$id)->first();
        $estados = DB::table('estado_proyecto')->where('estado','!=', $p->estado)->get();
        return [
            'p' => $p,
            'estados' => $estados
        ];
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
    public function cambiar_estado_proyecto(Request $r)
    {
        $p = Proyecto::find($r->id_proyecto);
        if ($p) {
            $p->estado = $r->id_estado;
            if ($p->save()) {
                return "success";
            }
        }
    }
}
