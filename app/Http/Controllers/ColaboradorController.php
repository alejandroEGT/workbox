<?php

namespace App\Http\Controllers;

use App\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function contar_by_proyecto($id_proyecto)
    {
    	$col = Colaborador::where('id_proyecto',$id_proyecto)->get();
    	return count($col);
    }
}
