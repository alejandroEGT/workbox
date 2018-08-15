<?php

namespace App\Http\Controllers;

use App\Colaborador;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
{
    public function contar_by_proyecto($id_proyecto)
    {
    	$col = Colaborador::where('id_proyecto',$id_proyecto)->get();
    	return count($col);
    }
    public function todos_colaboradores($id_proyecto)
    {
    	$verify_col = Colaborador::select('id_user')->where('id_proyecto', $id_proyecto)->get();

    	return User::whereNotIn('id', $verify_col)->get();
    }
    public function mis_colaboradores($id_proyecto)
    {
    	$col = DB::table('Users as us')
    			->join('colaborador as col','col.id_user','us.id')
    			->where('col.id_proyecto', $id_proyecto)->get();

        return $col;
    }
    public function agregar_colaboradores(Request $r)
    {
    	$col = new Colaborador;
    	$col->id_proyecto = $r->id_proyecto;
    	$col->id_user = $r->colaborador;
    	if ($col->save()) {
    		return "success";
    	}
    }
}
